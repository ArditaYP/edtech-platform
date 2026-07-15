<?php

namespace App\Livewire;

use Livewire\Component;

class WelcomeShowcase extends Component
{
    public $search = '';
    public $joinedCount = 1240;
    public $isJoined = false;

    public $courses = [
        ['title' => 'Advanced Laravel 11 & Livewire 3 Masterclass', 'category' => 'Backend', 'level' => 'Advanced', 'price' => '$99', 'students' => 450],
        ['title' => 'Tailwind CSS v3 Responsive Web Design', 'category' => 'Frontend', 'level' => 'Beginner', 'price' => '$49', 'students' => 780],
        ['title' => 'Building Reactive UIs with Alpine.js & Tailwind', 'category' => 'Frontend', 'level' => 'Intermediate', 'price' => '$59', 'students' => 310],
    ];

    public function joinPlatform()
    {
        if (!$this->isJoined) {
            $this->joinedCount++;
            $this->isJoined = true;
            session()->flash('message', 'Selamat! Anda berhasil bergabung ke platform pembelajaran.');
        }
    }

    public function render()
    {
        $filteredCourses = array_filter($this->courses, function ($course) {
            return empty($this->search) || stripos($course['title'], $this->search) !== false;
        });

        return view('livewire.welcome-showcase', [
            'filteredCourses' => $filteredCourses
        ]);
    }
}
