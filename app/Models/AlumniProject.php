<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'student_name',
        'description',
        'thumbnail_path',
        'demo_url',
    ];
}
