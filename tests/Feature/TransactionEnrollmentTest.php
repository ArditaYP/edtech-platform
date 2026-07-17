<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionEnrollmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_transaction_can_be_created_and_relations_work(): void
    {
        $user = User::factory()->create();
        
        $category = Category::create([
            'name' => 'Design',
            'slug' => 'design',
            'icon' => 'pencil',
        ]);

        $course = Course::create([
            'category_id' => $category->id,
            'title' => 'UI/UX Design',
            'slug' => 'ui-ux-design',
            'description' => 'Test course',
            'level' => 'Pemula',
            'duration_hours' => 8,
            'rating' => 4.8,
            'total_students' => 10,
            'price' => 200000,
        ]);

        $transaction = Transaction::create([
            'order_id' => 'EDU-20260715-0001',
            'user_id' => $user->id,
            'course_id' => $course->id,
            'amount' => 200000,
            'status' => 'pending',
            'snap_token' => 'mock_token',
        ]);

        $this->assertDatabaseHas('transactions', [
            'order_id' => 'EDU-20260715-0001',
            'amount' => 200000,
        ]);

        $this->assertEquals($user->id, $transaction->user->id);
        $this->assertEquals($course->id, $transaction->course->id);
        $this->assertCount(1, $user->transactions);
        $this->assertCount(1, $course->transactions);
    }

    public function test_enrollment_can_be_created_and_relations_work(): void
    {
        $user = User::factory()->create();
        
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
            'total_students' => 15,
            'price' => 150000,
        ]);

        $enrollment = Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'active',
        ]);

        $this->assertDatabaseHas('enrollments', [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'active',
        ]);

        $this->assertEquals($user->id, $enrollment->user->id);
        $this->assertEquals($course->id, $enrollment->course->id);
        
        $this->assertCount(1, $user->enrollments);
        $this->assertCount(1, $user->enrolledCourses);
        $this->assertCount(1, $course->enrollments);
        $this->assertCount(1, $course->enrolledUsers);
    }

    public function test_duplicate_enrollment_is_prevented(): void
    {
        $user = User::factory()->create();
        
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
            'total_students' => 15,
            'price' => 150000,
        ]);

        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'active',
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'active',
        ]);
    }

    public function test_guest_cannot_checkout_and_is_redirected(): void
    {
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
            'total_students' => 15,
            'price' => 150000,
        ]);

        $response = $this->post('/checkout/' . $course->id);

        $response->assertRedirect('/login');
    }

    public function test_student_can_checkout_successfully_with_mocked_midtrans(): void
    {
        $user = User::factory()->create();

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
            'total_students' => 15,
            'price' => 150000,
        ]);

        config(['midtrans.bypass' => false]);

        $this->mock(\App\Services\MidtransService::class, function ($mock) {
            $mock->shouldReceive('getSnapToken')->once()->andReturn('mock-snap-token-12345');
        });

        $response = $this->actingAs($user)->post('/checkout/' . $course->id);

        $response->assertStatus(200);
        $response->assertViewIs('checkout.show');
        $response->assertViewHas('snapToken', 'mock-snap-token-12345');
        $response->assertViewHas('course', $course);

        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'amount' => 150000,
            'status' => 'pending',
            'snap_token' => 'mock-snap-token-12345',
        ]);
    }

    public function test_student_cannot_checkout_if_already_enrolled(): void
    {
        $user = User::factory()->create();

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
            'total_students' => 15,
            'price' => 150000,
        ]);

        Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'active',
        ]);

        $response = $this->actingAs($user)->post('/checkout/' . $course->id);

        $response->assertRedirect('/kelas/' . $course->slug);
        $response->assertSessionHas('error', 'Anda sudah memiliki kelas ini.');
    }

    public function test_webhook_returns_403_for_invalid_signature(): void
    {
        $response = $this->postJson('/api/midtrans/callback', [
            'order_id' => 'EDU-12345',
            'status_code' => '200',
            'gross_amount' => '100000',
            'signature_key' => 'invalid_signature_here',
            'transaction_status' => 'settlement',
        ]);

        $response->assertStatus(403);
    }

    public function test_webhook_successfully_updates_transaction_and_enrolls_student_on_settlement(): void
    {
        $user = User::factory()->create();

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
            'total_students' => 15,
            'price' => 150000,
        ]);

        $transaction = Transaction::create([
            'order_id' => 'EDU-12345',
            'user_id' => $user->id,
            'course_id' => $course->id,
            'amount' => 150000,
            'status' => 'pending',
        ]);

        $serverKey = config('midtrans.server_key');
        $validSignature = hash('sha512', 'EDU-12345' . '200' . '150000' . $serverKey);

        $response = $this->postJson('/api/midtrans/callback', [
            'order_id' => 'EDU-12345',
            'status_code' => '200',
            'gross_amount' => '150000',
            'signature_key' => $validSignature,
            'transaction_status' => 'settlement',
            'payment_type' => 'qris',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['status' => 'success']);

        $this->assertDatabaseHas('transactions', [
            'order_id' => 'EDU-12345',
            'status' => 'paid',
            'payment_type' => 'qris',
        ]);

        $this->assertDatabaseHas('enrollments', [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'active',
        ]);
    }

    public function test_simulate_success_works(): void
    {
        $user = User::factory()->create();

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
            'total_students' => 15,
            'price' => 150000,
        ]);

        $transaction = Transaction::create([
            'order_id' => 'EDU-123456',
            'user_id' => $user->id,
            'course_id' => $course->id,
            'amount' => 150000,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($user)->postJson('/checkout/simulate-success', [
            'order_id' => 'EDU-123456',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['status' => 'success']);

        $this->assertDatabaseHas('transactions', [
            'order_id' => 'EDU-123456',
            'status' => 'paid',
        ]);

        $this->assertDatabaseHas('enrollments', [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'active',
        ]);
    }

    public function test_checkout_bypass_mode_for_testing(): void
    {
        // 1. Enable bypass
        config(['midtrans.bypass' => true]);

        $user = User::factory()->create();

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
            'total_students' => 15,
            'price' => 150000,
            'is_assessment' => false,
        ]);

        $response = $this->actingAs($user)->post('/checkout/' . $course->id);
        $response->assertStatus(200);
        $response->assertViewIs('checkout.show');

        $transaction = Transaction::where('user_id', $user->id)->first();
        $this->assertNotNull($transaction);

        $bypassResponse = $this->actingAs($user)->post('/checkout/' . $course->id . '/bypass', [
            'order_id' => $transaction->order_id
        ]);

        $bypassResponse->assertRedirect('/dashboard');
        $bypassResponse->assertSessionHas('success', '✅ Pembayaran disimulasikan berhasil! Selamat belajar.');

        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'amount' => 150000,
            'status' => 'paid',
            'payment_type' => 'bypass_test',
        ]);

        $this->assertDatabaseHas('enrollments', [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => 'active',
        ]);
    }

    public function test_checkout_bypass_mode_for_assessment_course(): void
    {
        // 1. Enable bypass
        config(['midtrans.bypass' => true]);

        $user = User::factory()->create();

        $category = Category::create([
            'name' => 'Psikologi',
            'slug' => 'psikologi',
            'icon' => 'user',
        ]);

        $course = Course::create([
            'category_id' => $category->id,
            'title' => 'Tes Asesmen',
            'slug' => 'tes-asesmen',
            'description' => 'Test course',
            'level' => 'Pemula',
            'duration_hours' => 2,
            'rating' => 4.8,
            'total_students' => 10,
            'price' => 150000,
            'is_assessment' => true,
        ]);

        $response = $this->actingAs($user)->post('/checkout/' . $course->id);
        $response->assertStatus(200);

        $transaction = Transaction::where('user_id', $user->id)->first();
        $this->assertNotNull($transaction);

        $bypassResponse = $this->actingAs($user)->post('/checkout/' . $course->id . '/bypass', [
            'order_id' => $transaction->order_id
        ]);

        $bypassResponse->assertRedirect('/assessments/tes-asesmen/take');
        $bypassResponse->assertSessionHas('success', '✅ Pembayaran disimulasikan berhasil! Selamat mengerjakan asesmen.');
    }
}
