<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'level',
        'duration_hours',
        'rating',
        'total_students',
        'image_path',
        'price',
        'learning_paths',
        'topics',
        'benefits',
        'promo_title',
        'promo_end_date',
        'is_assessment',
        'status',
    ];

    protected $casts = [
        'learning_paths' => 'array',
        'topics' => 'array',
        'benefits' => 'array',
        'promo_end_date' => 'date',
        'is_assessment' => 'boolean',
    ];

    /**
     * Get the category that owns the course.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the questions for this course (if it is an assessment).
     */
    public function questions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Question::class)->orderBy('order_number');
    }

    /**
     * Get the assessment results for this course.
     */
    public function assessmentResults(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AssessmentResult::class);
    }

    /**
     * Get the transactions for the course.
     */
    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the enrollments for the course.
     */
    public function enrollments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get the students enrolled in this course.
     */
    public function enrolledUsers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments')->withPivot('status')->withTimestamps();
    }

    /**
     * Scope a query to only include active courses.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
