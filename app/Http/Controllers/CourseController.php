<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;

class CourseController extends Controller
{
    public function show($slug)
    {
        $course = Course::with('category')->where('slug', $slug)->firstOrFail();

        if ($course->status === 'archived') {
            return redirect('/')
                ->with('error', 'Kelas ini sedang diarsipkan untuk pembaruan kurikulum.');
        }

        return view('courses.show', compact('course'));
    }
}
