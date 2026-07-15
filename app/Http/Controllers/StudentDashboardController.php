<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    /**
     * Display the student dashboard page.
     */
    public function index()
    {
        $user = Auth::user();

        // Get enrolled courses along with category details
        $myCourses = $user->enrollments()
            ->with(['course.category'])
            ->latest()
            ->get();

        // Compute statistic counters
        $totalCourses = $myCourses->count();

        $completedCourses = $user->enrollments()
            ->where('status', 'completed')
            ->count();

        $totalCertificates = $user->assessmentResults()->count();

        $myResults = $user->assessmentResults()->get()->keyBy('course_id');

        return view('student.dashboard', compact(
            'user',
            'myCourses',
            'totalCourses',
            'completedCourses',
            'totalCertificates',
            'myResults'
        ));
    }
}
