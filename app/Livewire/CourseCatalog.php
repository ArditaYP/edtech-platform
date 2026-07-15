<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Course;
use Livewire\Component;

class CourseCatalog extends Component
{
    public $search = '';
    public $selectedCategory = null; // null means 'Semua'

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => null],
    ];

    public function mount()
    {
        if (is_null($this->selectedCategory)) {
            $psychologyCategory = Category::active()->where('slug', 'psikologi-karir')->first();
            if ($psychologyCategory) {
                $this->selectedCategory = $psychologyCategory->id;
            }
        }
    }

    public function selectCategory($categoryId = null)
    {
        $this->selectedCategory = $categoryId;
    }

    public function updatingSearch()
    {
        // Reset page if we had pagination (optional, but good practice)
    }

    public function render()
    {
        $categories = Category::active()->get();

        $coursesQuery = Course::active()->with('category');

        if ($this->selectedCategory) {
            $coursesQuery->where('category_id', $this->selectedCategory);
        }

        if (!empty($this->search)) {
            $coursesQuery->where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        $courses = $coursesQuery->get();

        return view('livewire.course-catalog', [
            'categories' => $categories,
            'courses' => $courses,
        ]);
    }
}
