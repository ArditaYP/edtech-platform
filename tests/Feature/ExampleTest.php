<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Course;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_course_detail_page_returns_a_successful_response(): void
    {
        $category = Category::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
            'icon' => 'code-bracket',
        ]);

        $course = Course::create([
            'category_id' => $category->id,
            'title' => 'Laravel Masterclass',
            'slug' => 'laravel-masterclass',
            'description' => 'Description test',
            'level' => 'Pemula',
            'duration_hours' => 10,
            'rating' => 4.5,
            'total_students' => 100,
            'price' => 100000,
        ]);

        $response = $this->get('/kelas/' . $course->slug);
        $response->assertStatus(200);
        $response->assertSee($course->title);
    }
}
