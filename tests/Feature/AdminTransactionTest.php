<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_transactions(): void
    {
        $response = $this->get('/admin/transactions');
        $response->assertRedirect('/login');
    }

    public function test_student_cannot_access_admin_transactions(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $response = $this->actingAs($student)->get('/admin/transactions');
        $response->assertRedirect('/');
    }

    public function test_admin_can_access_transactions_list_and_see_stats(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $student = User::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com']);
        
        $category = Category::create([
            'name' => 'Marketing',
            'slug' => 'marketing',
            'icon' => 'globe',
        ]);

        $course = Course::create([
            'category_id' => $category->id,
            'title' => 'Digital Marketing',
            'slug' => 'digital-marketing',
            'description' => 'Test course',
            'level' => 'Pemula',
            'duration_hours' => 12,
            'rating' => 4.6,
            'price' => 150000,
        ]);

        // Create transaction 1 (paid)
        Transaction::create([
            'order_id' => 'EDU-111111',
            'user_id' => $student->id,
            'course_id' => $course->id,
            'amount' => 150000,
            'status' => 'paid',
            'payment_type' => 'qris',
        ]);

        // Create transaction 2 (pending)
        Transaction::create([
            'order_id' => 'EDU-222222',
            'user_id' => $student->id,
            'course_id' => $course->id,
            'amount' => 150000,
            'status' => 'pending',
            'payment_type' => 'bank_transfer',
        ]);

        $response = $this->actingAs($admin)->get('/admin/transactions');

        $response->assertStatus(200);
        $response->assertSee('Manajemen Transaksi');
        $response->assertSee('EDU-111111');
        $response->assertSee('EDU-222222');
        $response->assertSee('John Doe');

        // Verify summary statistics
        $response->assertViewHas('totalRevenue', 150000);
        $response->assertViewHas('todayTransactionsCount', 2);
        $response->assertViewHas('pendingTransactionsCount', 1);
    }

    public function test_admin_can_filter_transactions_by_search_query(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $student1 = User::factory()->create(['name' => 'Alice Smith', 'email' => 'alice@example.com']);
        $student2 = User::factory()->create(['name' => 'Bob Builder', 'email' => 'bob@example.com']);
        
        $category = Category::create(['name' => 'Tech', 'slug' => 'tech', 'icon' => 'code']);
        $course = Course::create([
            'category_id' => $category->id,
            'title' => 'Web Dev',
            'slug' => 'web-dev',
            'description' => 'Test',
            'level' => 'Pemula',
            'duration_hours' => 5,
            'rating' => 4.5,
            'price' => 50000,
        ]);

        Transaction::create([
            'order_id' => 'EDU-AAAAAA',
            'user_id' => $student1->id,
            'course_id' => $course->id,
            'amount' => 50000,
            'status' => 'paid',
        ]);

        Transaction::create([
            'order_id' => 'EDU-BBBBBB',
            'user_id' => $student2->id,
            'course_id' => $course->id,
            'amount' => 50000,
            'status' => 'paid',
        ]);

        // Search for Alice
        $response = $this->actingAs($admin)->get('/admin/transactions?search=Alice');
        $response->assertSee('EDU-AAAAAA');
        $response->assertDontSee('EDU-BBBBBB');

        // Search for Bob
        $response = $this->actingAs($admin)->get('/admin/transactions?search=bob@example.com');
        $response->assertSee('EDU-BBBBBB');
        $response->assertDontSee('EDU-AAAAAA');

        // Search for specific Order ID
        $response = $this->actingAs($admin)->get('/admin/transactions?search=EDU-AAAAAA');
        $response->assertSee('EDU-AAAAAA');
        $response->assertDontSee('EDU-BBBBBB');
    }

    public function test_admin_can_filter_transactions_by_status(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $student = User::factory()->create();
        $category = Category::create(['name' => 'Tech', 'slug' => 'tech', 'icon' => 'code']);
        $course = Course::create([
            'category_id' => $category->id,
            'title' => 'Web Dev',
            'slug' => 'web-dev',
            'description' => 'Test',
            'level' => 'Pemula',
            'duration_hours' => 5,
            'rating' => 4.5,
            'price' => 50000,
        ]);

        Transaction::create([
            'order_id' => 'EDU-PAID',
            'user_id' => $student->id,
            'course_id' => $course->id,
            'amount' => 50000,
            'status' => 'paid',
        ]);

        Transaction::create([
            'order_id' => 'EDU-PEND',
            'user_id' => $student->id,
            'course_id' => $course->id,
            'amount' => 50000,
            'status' => 'pending',
        ]);

        // Filter Paid status
        $response = $this->actingAs($admin)->get('/admin/transactions?status=paid');
        $response->assertSee('EDU-PAID');
        $response->assertDontSee('EDU-PEND');

        // Filter Pending status
        $response = $this->actingAs($admin)->get('/admin/transactions?status=pending');
        $response->assertSee('EDU-PEND');
        $response->assertDontSee('EDU-PAID');
    }
}
