<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class ArchiveOldCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Archive all courses except the psychology assessment course
        Course::where('slug', '!=', 'tes-asesmen-psikologi-temukan-karir-idealmu')
            ->update(['status' => 'archived']);

        // Ensure psychology assessment is active
        Course::where('slug', 'tes-asesmen-psikologi-temukan-karir-idealmu')
            ->update(['status' => 'active']);
    }
}
