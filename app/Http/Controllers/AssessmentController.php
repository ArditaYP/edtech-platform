<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\QuestionOption;
use App\Models\AssessmentResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AssessmentController extends Controller
{
    /**
     * Display the assessment form.
     */
    public function take(Course $course)
    {
        $user = Auth::user();

        // Check if user is enrolled
        $isEnrolled = $user->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->exists();

        if (!$isEnrolled) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Anda harus berlangganan kelas ini terlebih dahulu untuk mengikuti tes.');
        }

        $questions = $course->questions()->with('options')->orderBy('order_number')->get();

        return view('assessments.take', compact('course', 'questions'));
    }

    /**
     * Process assessment submission.
     */
    public function submit(Request $request, Course $course)
    {
        $user = Auth::user();

        // Check if user is enrolled
        $isEnrolled = $user->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->exists();

        if (!$isEnrolled) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Anda harus berlangganan kelas ini terlebih dahulu.');
        }

        $request->validate([
            'answers' => 'required|array',
        ]);

        $answers = $request->input('answers', []);
        
        $categoriesCount = [
            'konselor' => 0,
            'hr' => 0,
            'ux_researcher' => 0,
            'trainer' => 0,
        ];
        
        $answersPayload = [];

        // Fetch options and calculate counts
        $options = QuestionOption::whereIn('id', array_values($answers))->with('question')->get();

        foreach ($options as $option) {
            $cat = $option->category_result;
            if (isset($categoriesCount[$cat])) {
                $categoriesCount[$cat]++;
            }

            $answersPayload[] = [
                'question_id' => $option->question_id,
                'question_text' => $option->question->question_text,
                'selected_option_id' => $option->id,
                'selected_option_text' => $option->option_text,
                'category' => $cat
            ];
        }

        $totalQuestions = count($answersPayload);
        $percentages = [];

        foreach ($categoriesCount as $cat => $count) {
            $percentages[$cat] = $totalQuestions > 0 ? round(($count / $totalQuestions) * 100, 2) : 0;
        }

        // Determine top category (career result)
        arsort($percentages);
        $topCategory = array_key_first($percentages);

        // Save result
        $result = AssessmentResult::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'answers_payload' => $answersPayload,
            'top_category' => $topCategory,
            'percentages_payload' => $percentages,
        ]);

        return redirect()->route('assessments.result', $course->slug);
    }

    /**
     * Show assessment results.
     */
    public function result(Course $course)
    {
        $user = Auth::user();

        // Check if user is enrolled
        $isEnrolled = $user->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->exists();

        if (!$isEnrolled) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Anda harus berlangganan kelas ini terlebih dahulu.');
        }

        // Get latest assessment result
        $result = AssessmentResult::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->latest()
            ->first();

        if (!$result) {
            return redirect()->route('assessments.take', $course->slug)
                ->with('error', 'Anda belum mengikuti asesmen ini.');
        }

        return view('assessments.result', compact('course', 'result'));
    }

    /**
     * Download assessment result PDF.
     */
    public function downloadPdf(Course $course)
    {
        $user = Auth::user();

        $isEnrolled = $user->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->exists();

        if (!$isEnrolled) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Anda harus berlangganan kelas ini terlebih dahulu.');
        }

        $result = AssessmentResult::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->latest()
            ->first();

        if (!$result) {
            return redirect()->route('assessments.take', $course->slug)
                ->with('error', 'Anda belum mengikuti asesmen ini.');
        }

        $pdf = Pdf::loadView('assessments.pdf', compact('user', 'course', 'result'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download("Sertifikat-Asesmen-Psikologi-" . $user->name . ".pdf");
    }
}
