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

        // Assert 50 questions are seeded
        $this->assertCount(50, $course->questions);

        $professions = [
            'dokter_medis',
            'guru_pendidik',
            'software_engineer',
            'hr_talent',
            'konselor_psikolog',
            'financial_analyst',
            'arsitek_desainer',
            'entrepreneur',
            'legal_lawyer',
            'digital_marketer',
            'content_creator',
            'data_scientist'
        ];

        // Assert each question has 4 options and they map to the 12 professions
        foreach ($course->questions as $question) {
            $this->assertCount(4, $question->options);
            foreach ($question->options as $option) {
                $this->assertContains($option->category_result, $professions);
            }
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

        // Prepare mock answers (pick the first option for all questions to get Dokter & Medis top)
        $answers = [];
        foreach ($course->questions as $question) {
            $option = $question->options->first();
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
            'top_category' => 'dokter_medis',
        ]);

        // View result page
        $resultResponse = $this->actingAs($user)->get("/assessments/{$course->slug}/result");
        $resultResponse->assertStatus(200);
        $resultResponse->assertViewIs('assessments.result');
        $resultResponse->assertSee('Dokter & Tenaga Medis');
        $resultResponse->assertSee('34%');
        $resultResponse->assertSee('32%');
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
            'top_category' => 'hr_talent',
            'answers_payload' => [
                [
                    'question_id' => 1,
                    'question_text' => 'Q1',
                    'selected_option_id' => 1,
                    'selected_option_text' => 'O1',
                    'category' => 'hr_talent'
                ]
            ],
            'percentages_payload' => [
                'hr_talent' => 100,
                'dokter_medis' => 0,
                'guru_pendidik' => 0,
                'software_engineer' => 0
            ]
        ]);

        $response = $this->actingAs($user)->get("/assessments/{$course->slug}/export-pdf");

        $response->assertStatus(200);
        $response->assertHeader('Content-Disposition', 'attachment; filename="Sertifikat-Asesmen-Psikologi-John Doe.pdf"');
    }
}
