<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\StudentDashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/kelas/{slug}', [CourseController::class, 'show'])->name('courses.show');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated Student Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::post('/checkout/simulate-success', [CheckoutController::class, 'simulateSuccess'])->name('checkout.simulate-success');
    Route::post('/checkout/{course}', [CheckoutController::class, 'process'])->name('checkout.process');
    
    // Psychology Assessment Routes
    Route::prefix('assessments/{course:slug}')->group(function () {
        Route::get('/take', [AssessmentController::class, 'take'])->name('assessments.take');
        Route::post('/submit', [AssessmentController::class, 'submit'])->name('assessments.submit');
        Route::get('/result', [AssessmentController::class, 'result'])->name('assessments.result');
        Route::get('/export-pdf', [AssessmentController::class, 'downloadPdf'])->name('assessments.pdf');
    });
});

// Admin Dashboard Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/courses/{course}/toggle-status', [AdminDashboardController::class, 'toggleStatus'])->name('admin.courses.toggle-status');
});
