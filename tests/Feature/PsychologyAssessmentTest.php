<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\Question;
use App\Models\QuestionOption;
use Database\Seeders\PsychologySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PsychologyAssessmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_psychology_seeder_creates_course_questions_and_options(): void
    {
        $this->seed(PsychologySeeder::class);

        // Assert course is seeded
        $course = Course::where('slug', 'tes-asesmen-psikologi-temukan-karir-idealmu')->first();
        $this->assertNotNull($course);
        $this->assertTrue($course->is_assessment);
        $this->assertEquals(150000, $course->price);

        // Assert 10 questions are seeded
        $this->assertCount(10, $course->questions);

        // Assert each question has 4 options
        foreach ($course->questions as $question) {
            $this->assertCount(4, $question->options);

            // Assert categories are correctly mapped
            $categories = $question->options->pluck('category_result')->toArray();
            $this->assertContains('konselor', $categories);
            $this->assertContains('hr', $categories);
            $this->assertContains('ux_researcher', $categories);
            $this->assertContains('trainer', $categories);
        }
    }

    public function test_non_enrolled_user_cannot_access_assessment(): void
    {
        $this->seed(PsychologySeeder::class);
        $user = \App\Models\User::factory()->create();
        $course = Course::where('slug', 'tes-asesmen-psikologi-temukan-karir-idealmu')->first();

        $response = $this->actingAs($user)->get("/assessments/{$course->slug}/take");

        $response->assertRedirect("/kelas/{$course->slug}");
        $response->assertSessionHas('error');
    }

    public function test_enrolled_user_can_access_assessment_and_submit(): void
    {
        $this->seed(PsychologySeeder::class);
        $user = \App\Models\User::factory()->create();
        $course = Course::where('slug', 'tes-asesmen-psikologi-temukan-karir-idealmu')->first();

        // Enroll user
        \App\Models\Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'active',
        ]);

        // Get test take page
        $response = $this->actingAs($user)->get("/assessments/{$course->slug}/take");
        $response->assertStatus(200);
        $response->assertViewIs('assessments.take');

        // Prepare mock answers (let's pick Options that map to categories: 6 HR, 4 Trainer)
        $answers = [];
        foreach ($course->questions as $index => $question) {
            if ($index < 6) {
                // Option corresponding to 'hr'
                $option = $question->options->where('category_result', 'hr')->first();
            } else {
                // Option corresponding to 'trainer'
                $option = $question->options->where('category_result', 'trainer')->first();
            }
            $answers[$question->id] = $option->id;
        }

        $submitResponse = $this->actingAs($user)->post("/assessments/{$course->slug}/submit", [
            'answers' => $answers
        ]);

        $submitResponse->assertRedirect("/assessments/{$course->slug}/result");

        // Verify result in database
        $this->assertDatabaseHas('assessment_results', [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'top_category' => 'hr',
        ]);

        // View result page
        $resultResponse = $this->actingAs($user)->get("/assessments/{$course->slug}/result");
        $resultResponse->assertStatus(200);
        $resultResponse->assertViewIs('assessments.result');
        $resultResponse->assertSee('HR & Talent Acquisition Specialist');
        $resultResponse->assertSee('60%');
        $resultResponse->assertSee('40%');
    }

    public function test_enrolled_user_can_download_pdf_report(): void
    {
        $this->seed(PsychologySeeder::class);
        $user = \App\Models\User::factory()->create(['name' => 'John Doe']);
        $course = Course::where('slug', 'tes-asesmen-psikologi-temukan-karir-idealmu')->first();

        // Enroll user
        \App\Models\Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'active',
        ]);

        // Create dummy assessment result
        \App\Models\AssessmentResult::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'top_category' => 'hr',
            'answers_payload' => [
                [
                    'question_id' => 1,
                    'question_text' => 'Q1',
                    'selected_option_id' => 1,
                    'selected_option_text' => 'O1',
                    'category' => 'hr'
                ]
            ],
            'percentages_payload' => [
                'hr' => 100,
                'konselor' => 0,
                'ux_researcher' => 0,
                'trainer' => 0
            ]
        ]);

        $response = $this->actingAs($user)->get("/assessments/{$course->slug}/export-pdf");

        $response->assertStatus(200);
        $response->assertHeader('Content-Disposition', 'attachment; filename="Sertifikat-Asesmen-Psikologi-John Doe.pdf"');
    }
}
