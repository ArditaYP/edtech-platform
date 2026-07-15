<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_student_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_student_can_access_dashboard_and_see_stats(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        
        $category = Category::create([
            'name' => 'Tech',
            'slug' => 'tech',
            'icon' => 'code',
        ]);

        $course1 = Course::create([
            'category_id' => $category->id,
            'title' => 'Course One',
            'slug' => 'course-one',
            'description' => 'Test',
            'level' => 'Pemula',
            'duration_hours' => 5,
            'rating' => 4.5,
            'price' => 50000,
        ]);

        $course2 = Course::create([
            'category_id' => $category->id,
            'title' => 'Course Two',
            'slug' => 'course-two',
            'description' => 'Test',
            'level' => 'Pemula',
            'duration_hours' => 5,
            'rating' => 4.5,
            'price' => 50000,
        ]);

        // Enroll in course 1 (active)
        Enrollment::create([
            'user_id' => $student->id,
            'course_id' => $course1->id,
            'status' => 'active',
        ]);

        // Enroll in course 2 (completed)
        Enrollment::create([
            'user_id' => $student->id,
            'course_id' => $course2->id,
            'status' => 'completed',
        ]);

        $response = $this->actingAs($student)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Course One');
        $response->assertSee('Course Two');
        $response->assertSee('Selamat Datang Kembali');
        
        // Assert stats in view context
        $response->assertViewHas('totalCourses', 2);
        $response->assertViewHas('completedCourses', 1);
        $response->assertViewHas('totalCertificates', 0);
    }

    public function test_login_redirects_student_to_student_dashboard(): void
    {
        $student = User::factory()->create([
            'email' => 'siswa@example.com',
            'password' => 'password123',
            'role' => 'student',
        ]);

        $response = $this->post('/login', [
            'email' => 'siswa@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
    }

    public function test_login_redirects_admin_to_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/admin/dashboard');
    }
}
