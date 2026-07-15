<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Seeder;

class FocusPsychologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Archive old categories
        Category::whereIn('name', [
            'Web Development',
            'Mobile Development',
            'Cloud Computing',
            'Artificial Intelligence'
        ])->update(['status' => 'archived']);

        // 2. Ensure Psychology Category is active
        $psychologyCategory = Category::where('slug', 'psikologi-karir')->first();
        if ($psychologyCategory) {
            $psychologyCategory->update(['status' => 'active']);
        }

        // 3. Archive courses under archived categories
        $archivedCategoryIds = Category::where('status', 'archived')->pluck('id')->toArray();
        Course::whereIn('category_id', $archivedCategoryIds)->update(['status' => 'archived']);

        // 4. Ensure the psychology assessment course is active
        Course::where('slug', 'tes-asesmen-psikologi-temukan-karir-idealmu')
            ->update(['status' => 'active']);
    }
}
