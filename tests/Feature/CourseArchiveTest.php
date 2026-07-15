<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseArchiveTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_only_shows_active_courses(): void
    {
        $category = Category::create([
            'name' => 'Tech',
            'slug' => 'tech',
            'icon' => 'code',
        ]);

        $activeCourse = Course::create([
            'category_id' => $category->id,
            'title' => 'Active Course',
            'slug' => 'active-course',
            'description' => 'Visible',
            'level' => 'Pemula',
            'duration_hours' => 5,
            'rating' => 4.5,
            'price' => 50000,
            'status' => 'active',
        ]);

        $archivedCourse = Course::create([
            'category_id' => $category->id,
            'title' => 'Archived Course',
            'slug' => 'archived-course',
            'description' => 'Hidden',
            'level' => 'Pemula',
            'duration_hours' => 5,
            'rating' => 4.5,
            'price' => 50000,
            'status' => 'archived',
        ]);

        // Access catalog welcome page which includes the livewire course catalog component
        $response = $this->get('/');

        $response->assertStatus(200);
        
        // Assert scope returns only active
        $activeCourses = Course::active()->get();
        $this->assertTrue($activeCourses->contains($activeCourse));
        $this->assertFalse($activeCourses->contains($archivedCourse));
    }

    public function test_accessing_archived_course_directly_redirects_home_with_alert(): void
    {
        $category = Category::create([
            'name' => 'Tech',
            'slug' => 'tech',
            'icon' => 'code',
        ]);

        $archivedCourse = Course::create([
            'category_id' => $category->id,
            'title' => 'Archived Course',
            'slug' => 'archived-course',
            'description' => 'Hidden',
            'level' => 'Pemula',
            'duration_hours' => 5,
            'rating' => 4.5,
            'price' => 50000,
            'status' => 'archived',
        ]);

        $response = $this->get('/kelas/' . $archivedCourse->slug);

        $response->assertRedirect('/');
        $response->assertSessionHas('error', 'Kelas ini sedang diarsipkan untuk pembaruan kurikulum.');
    }

    public function test_admin_can_toggle_course_status(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create([
            'name' => 'Tech',
            'slug' => 'tech',
            'icon' => 'code',
        ]);

        $course = Course::create([
            'category_id' => $category->id,
            'title' => 'Test Course',
            'slug' => 'test-course',
            'description' => 'Visible',
            'level' => 'Pemula',
            'duration_hours' => 5,
            'rating' => 4.5,
            'price' => 50000,
            'status' => 'active',
        ]);

        // Toggle to archived
        $response = $this->actingAs($admin)->post("/admin/courses/{$course->id}/toggle-status");
        $response->assertRedirect();
        $this->assertEquals('archived', $course->fresh()->status);

        // Toggle back to active
        $response = $this->actingAs($admin)->post("/admin/courses/{$course->id}/toggle-status");
        $response->assertRedirect();
        $this->assertEquals('active', $course->fresh()->status);
    }

    public function test_focus_psychology_seeder_archives_categories_and_preselects_psychology(): void
    {
        // Seed default database state
        $this->seed(\Database\Seeders\DatabaseSeeder::class);

        // Run focus psychology seeder
        $this->seed(\Database\Seeders\FocusPsychologySeeder::class);

        // Verify tech categories are archived
        $this->assertEquals(0, \App\Models\Category::whereIn('name', [
            'Web Development',
            'Mobile Development',
            'Cloud Computing',
            'Artificial Intelligence'
        ])->where('status', 'active')->count());

        // Verify psychology category is active
        $psychologyCategory = \App\Models\Category::where('slug', 'psikologi-karir')->first();
        $this->assertEquals('active', $psychologyCategory->status);

        // Mount livewire component and assert selected category defaults to psychology
        \Livewire\Livewire::test(\App\Livewire\CourseCatalog::class)
            ->assertSet('selectedCategory', $psychologyCategory->id);
    }
}
