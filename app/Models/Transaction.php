<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'course_id',
        'amount',
        'status',
        'snap_token',
        'payment_type',
    ];

    /**
     * Get the user who made the transaction.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course related to this transaction.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
