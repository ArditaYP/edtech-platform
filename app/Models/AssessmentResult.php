<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssessmentResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'answers_payload',
        'top_category',
        'percentages_payload',
        'weakness_analysis',
    ];

    protected $casts = [
        'answers_payload' => 'array',
        'percentages_payload' => 'array',
        'weakness_analysis' => 'array',
    ];

    /**
     * Get the user who took the assessment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course this assessment belongs to.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
