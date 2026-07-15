<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Seeder;

class RestoreTechCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Restore all categories to active status
        Category::query()->update(['status' => 'active']);

        // 2. Restore all courses to active status
        Course::query()->update(['status' => 'active']);
    }
}
