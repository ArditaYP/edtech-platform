<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Aggregate calculations
        $totalStudents = User::count();
        $totalCourses = Course::count();
        
        // Sum of price * total_students for a realistic monthly revenue mock estimation
        $totalRevenueThisMonth = Course::sum(DB::raw('price * (total_students / 12)'));
        if ($totalRevenueThisMonth <= 0) {
            $totalRevenueThisMonth = 42500000; // fallback default
        }
        
        // Certificates Issued mockup
        $totalCertificatesIssued = max(24, intval($totalStudents * 0.4));

        // 2. Chart 1: Student Registration Trend (last 30 days)
        $studentTrendLabels = [];
        $studentTrendData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $studentTrendLabels[] = $date->format('d M');
            // Mock daily registration count based on seeders & logic
            $studentTrendData[] = rand(8, 28);
        }

        // 3. Chart 2: Course Category Distribution (Category Name & Students Count)
        $categoryDistributionLabels = [];
        $categoryDistributionData = [];
        $categories = Category::with('courses')->get();
        foreach ($categories as $cat) {
            $categoryDistributionLabels[] = $cat->name;
            $categoryDistributionData[] = $cat->courses->sum('total_students');
        }

        // 4. Chart 3: Monthly Revenue (Jan - Dec)
        $monthlyRevenueLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $monthlyRevenueData = [
            18500000, 22000000, 24800000, 31000000, 35000000, 39500000, 
            $totalRevenueThisMonth, 
            intval($totalRevenueThisMonth * 1.15), 
            intval($totalRevenueThisMonth * 1.2), 
            intval($totalRevenueThisMonth * 1.1), 
            intval($totalRevenueThisMonth * 1.25), 
            intval($totalRevenueThisMonth * 1.4)
        ];

        // Package all chart data as JSON strings for frontend consumption
        $charts = [
            'studentTrend' => json_encode([
                'labels' => $studentTrendLabels,
                'data' => $studentTrendData,
            ]),
            'categoryDistribution' => json_encode([
                'labels' => $categoryDistributionLabels,
                'data' => $categoryDistributionData,
            ]),
            'monthlyRevenue' => json_encode([
                'labels' => $monthlyRevenueLabels,
                'data' => $monthlyRevenueData,
            ]),
        ];

        $coursesList = Course::with('category')->get();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalCourses',
            'totalRevenueThisMonth',
            'totalCertificatesIssued',
            'charts',
            'coursesList'
        ));
    }

    /**
     * Toggle status of a course (active/archived).
     */
    public function toggleStatus(Course $course)
    {
        $newStatus = $course->status === 'active' ? 'archived' : 'active';
        $course->update(['status' => $newStatus]);

        return redirect()->back()->with('success', 'Status kelas "' . $course->title . '" berhasil diubah menjadi ' . $newStatus . '.');
    }
}
