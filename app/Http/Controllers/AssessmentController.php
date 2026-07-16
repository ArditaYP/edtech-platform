<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\QuestionOption;
use App\Models\AssessmentResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AssessmentController extends Controller
{
    /**
     * Display the assessment form.
     */
    public function take(Course $course)
    {
        $user = Auth::user();

        // Check if user is enrolled
        $isEnrolled = $user->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->exists();

        if (!$isEnrolled) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Anda harus berlangganan kelas ini terlebih dahulu untuk mengikuti tes.');
        }

        $questions = $course->questions()->with('options')->orderBy('order_number')->get();

        return view('assessments.take', compact('course', 'questions'));
    }

    /**
     * Process assessment submission.
     */
    public function submit(Request $request, Course $course)
    {
        $user = Auth::user();

        // Check if user is enrolled
        $isEnrolled = $user->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->exists();

        if (!$isEnrolled) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Anda harus berlangganan kelas ini terlebih dahulu.');
        }

        $request->validate([
            'answers' => 'required|array',
        ]);

        $answers = $request->input('answers', []);
        
        $categoriesCount = [
            'konselor' => 0,
            'hr' => 0,
            'ux_researcher' => 0,
            'trainer' => 0,
        ];
        
        $answersPayload = [];

        // Fetch options and calculate counts
        $options = QuestionOption::whereIn('id', array_values($answers))->with('question')->get();

        foreach ($options as $option) {
            $cat = $option->category_result;
            if (isset($categoriesCount[$cat])) {
                $categoriesCount[$cat]++;
            }

            $answersPayload[] = [
                'question_id' => $option->question_id,
                'question_text' => $option->question->question_text,
                'selected_option_id' => $option->id,
                'selected_option_text' => $option->option_text,
                'category' => $cat
            ];
        }

        $totalQuestions = count($answersPayload);
        $percentages = [];

        foreach ($categoriesCount as $cat => $count) {
            $percentages[$cat] = $totalQuestions > 0 ? round(($count / $totalQuestions) * 100, 2) : 0;
        }

        // Determine top category (career result)
        arsort($percentages);
        $topCategory = array_key_first($percentages);
        
        // Find lowest category
        $lowestCategory = array_key_last($percentages);

        // Generate weakness analysis data
        $blindSpots = [
            'konselor' => 'Cenderung memprioritaskan harmoni emosional hingga sering menghindari konflik penting dan kesulitan mengambil keputusan tegas yang tidak populer.',
            'hr' => 'Cenderung terlalu dominan dalam mengatur tim dan terkadang kurang sabar terhadap proses teknis yang lambat.',
            'ux_researcher' => 'Cenderung terjebak dalam kelumpuhan analisis (analysis paralysis) dan kurang responsif terhadap eksekusi taktis yang cepat.',
            'trainer' => 'Cenderung mendominasi komunikasi kelompok dan kurang memberikan ruang atau porsi mendengarkan yang cukup bagi orang lain.'
        ];

        $developmentAreas = [
            'konselor' => 'Perlu meningkatkan empati antarpribadi dan kemampuan mendengarkan aktif secara mendalam untuk membangun iklim kerja yang harmonis.',
            'hr' => 'Perlu melatih ketegasan kepemimpinan, pemahaman struktur operasional, dan kepatuhan sistem tata kelola organisasi.',
            'ux_researcher' => 'Perlu meningkatkan kesabaran dalam mengolah data analitis, melakukan riset pengguna, dan membiasakan diri dengan root-cause analysis.',
            'trainer' => 'Perlu mengasah kemampuan berbicara di depan umum, teknik penyampaian presentasi, dan memandu kelompok dengan cara komunikatif.'
        ];

        $actionableAdvices = [
            'konselor' => [
                'Latihlah menyampaikan kebenaran yang jujur (radical candor) secara asertif tanpa takut merusak hubungan.',
                'Buatlah keputusan tegas berdasarkan data objektif, bukan semata-mata karena kenyamanan emosional.'
            ],
            'hr' => [
                'Delegasikan tugas teknis mendetail kepada rekan yang memiliki kompetensi analitis tinggi.',
                'Sediakan waktu hening untuk mendengarkan masukan tim secara saksama sebelum mengambil keputusan strategis.'
            ],
            'ux_researcher' => [
                'Batasi waktu riset Anda dengan membuat batas akhir (deadline) eksplisit agar bisa segera beralih ke tahap eksekusi.',
                'Kurangi keraguan dengan meluncurkan versi awal (prototype) dan belajar dari kesalahan nyata di lapangan.'
            ],
            'trainer' => [
                'Terapkan aturan "mendengarkan 60% dan berbicara 40%" saat melakukan koordinasi tim.',
                'Gunakan media visual terstruktur untuk mendukung penjelasan verbal Anda agar lebih terarah.'
            ]
        ];

        $weaknessAnalysis = [
            'top_blind_spot' => $blindSpots[$topCategory] ?? '',
            'lowest_category' => $lowestCategory,
            'development_area' => $developmentAreas[$lowestCategory] ?? '',
            'actionable_advice' => $actionableAdvices[$topCategory] ?? []
        ];

        // Save result
        $result = AssessmentResult::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'answers_payload' => $answersPayload,
            'top_category' => $topCategory,
            'percentages_payload' => $percentages,
            'weakness_analysis' => $weaknessAnalysis,
        ]);

        return redirect()->route('assessments.result', $course->slug);
    }

    /**
     * Show assessment results.
     */
    public function result(Course $course)
    {
        $user = Auth::user();

        // Check if user is enrolled
        $isEnrolled = $user->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->exists();

        if (!$isEnrolled) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Anda harus berlangganan kelas ini terlebih dahulu.');
        }

        // Get latest assessment result
        $result = AssessmentResult::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->latest()
            ->first();

        if (!$result) {
            return redirect()->route('assessments.take', $course->slug)
                ->with('error', 'Anda belum mengikuti asesmen ini.');
        }

        return view('assessments.result', compact('course', 'result'));
    }

    /**
     * Download assessment result PDF.
     */
    public function downloadPdf(Course $course)
    {
        $user = Auth::user();

        $isEnrolled = $user->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->exists();

        if (!$isEnrolled) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Anda harus berlangganan kelas ini terlebih dahulu.');
        }

        $result = AssessmentResult::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->latest()
            ->first();

        if (!$result) {
            return redirect()->route('assessments.take', $course->slug)
                ->with('error', 'Anda belum mengikuti asesmen ini.');
        }

        // Category Details mapping for top category recommendation
        $categoryDetails = [
            'konselor' => [
                'title' => 'Konselor / Psikolog Kerja',
                'desc' => 'Memiliki tingkat empati tinggi untuk membantu individu mengurai hambatan emosional dan kejenuhan kerja.',
                'insight' => 'Kekuatan empati Anda sangat menonjol. Tetapkan batasan emosional yang sehat dalam mendengarkan keluhan orang lain.'
            ],
            'hr' => [
                'title' => 'HR & Talent Acquisition Specialist',
                'desc' => 'Unggul dalam penataan staf yang adil, rekrutmen, serta penyelarasan talenta dengan arah bisnis.',
                'insight' => 'Kemampuan manajerial Anda sangat kuat. Berikan sentuhan pendekatan personal yang hangat di samping SOP yang tegas.'
            ],
            'ux_researcher' => [
                'title' => 'UI/UX Behavior Researcher',
                'desc' => 'Didorong oleh rasa ingin tahu ilmiah untuk menganalisis perilaku pengguna di depan sistem kerja.',
                'insight' => 'Ketajaman analisis Anda luar biasa. Seimbangkan analisis data Anda dengan tindakan eksekusi yang responsif dan taktis.'
            ],
            'trainer' => [
                'title' => 'Trainer & People Developer',
                'desc' => 'Senang memandu forum, melatih kelompok besar, dan menyederhanakan konsep rumit menjadi materi praktis.',
                'insight' => 'Gaya komunikasi Anda sangat inspiratif. Sediakan porsi mendengarkan yang lebih besar bagi audiens Anda.'
            ]
        ];

        $percentages = $result->percentages_payload;
        $topCategory = $result->top_category;
        $top = $categoryDetails[$topCategory] ?? $categoryDetails['hr'];

        // Fallback for weakness analysis if it was not created (backward compatibility)
        $weaknessAnalysis = $result->weakness_analysis;
        if (empty($weaknessAnalysis)) {
            $sortedPercentages = $percentages;
            arsort($sortedPercentages);
            $topCat = array_key_first($sortedPercentages) ?: $topCategory;
            $lowestCat = array_key_last($sortedPercentages) ?: 'konselor';

            $blindSpots = [
                'konselor' => 'Cenderung memprioritaskan harmoni emosional hingga sering menghindari konflik penting dan kesulitan mengambil keputusan tegas yang tidak populer.',
                'hr' => 'Cenderung terlalu dominan dalam mengatur tim dan terkadang kurang sabar terhadap proses teknis yang lambat.',
                'ux_researcher' => 'Cenderung terjebak dalam kelumpuhan analisis (analysis paralysis) dan kurang responsif terhadap eksekusi taktis yang cepat.',
                'trainer' => 'Cenderung mendominasi komunikasi kelompok dan kurang memberikan ruang atau porsi mendengarkan yang cukup bagi orang lain.'
            ];

            $developmentAreas = [
                'konselor' => 'Perlu meningkatkan empati antarpribadi dan kemampuan mendengarkan aktif secara mendalam untuk membangun iklim kerja yang harmonis.',
                'hr' => 'Perlu melatih ketegasan kepemimpinan, pemahaman struktur operasional, dan kepatuhan sistem tata kelola organisasi.',
                'ux_researcher' => 'Perlu meningkatkan kesabaran dalam mengolah data analitis, melakukan riset pengguna, dan membiasakan diri dengan root-cause analysis.',
                'trainer' => 'Perlu mengasah kemampuan berbicara di depan umum, teknik penyampaian presentasi, dan memandu kelompok dengan cara komunikatif.'
            ];

            $actionableAdvices = [
                'konselor' => [
                    'Latihlah menyampaikan kebenaran yang jujur (radical candor) secara asertif tanpa takut merusak hubungan.',
                    'Buatlah keputusan tegas berdasarkan data objektif, bukan semata-mata karena kenyamanan emosional.'
                ],
                'hr' => [
                    'Delegasikan tugas teknis mendetail kepada rekan yang memiliki kompetensi analitis tinggi.',
                    'Sediakan waktu hening untuk mendengarkan masukan tim secara saksama sebelum mengambil keputusan strategis.'
                ],
                'ux_researcher' => [
                    'Batasi waktu riset Anda dengan membuat batas akhir (deadline) eksplisit agar bisa segera beralih ke tahap eksekusi.',
                    'Kurangi keraguan dengan meluncurkan versi awal (prototype) dan belajar dari kesalahan nyata di lapangan.'
                ],
                'trainer' => [
                    'Terapkan aturan "mendengarkan 60% dan berbicara 40%" saat melakukan koordinasi tim.',
                    'Gunakan media visual terstruktur untuk mendukung penjelasan verbal Anda agar lebih terarah.'
                ]
            ];

            $weaknessAnalysis = [
                'top_blind_spot' => $blindSpots[$topCat] ?? '',
                'lowest_category' => $lowestCat,
                'development_area' => $developmentAreas[$lowestCat] ?? '',
                'actionable_advice' => $actionableAdvices[$topCat] ?? []
            ];
        }

        // Radar chart via QuickChart API for the 4 categories
        $radarChartUrl = $this->getRadarChartUrl($percentages);
        $radarChartBase64 = '';
        try {
            $ctx = stream_context_create([
                'http' => [
                    'timeout' => 5,
                ]
            ]);
            $chartImageContent = @file_get_contents($radarChartUrl, false, $ctx);
            if ($chartImageContent !== false) {
                $radarChartBase64 = 'data:image/png;base64,' . base64_encode($chartImageContent);
            } else {
                $radarChartBase64 = $radarChartUrl;
            }
        } catch (\Exception $e) {
            $radarChartBase64 = $radarChartUrl;
        }

        // Digital Signature SVG Base64
        $sigSvg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 80" width="200" height="80">'
            . '<path d="M 20 40 Q 50 10, 80 50 T 140 30 T 180 50" fill="none" stroke="#D97706" stroke-width="3"/>'
            . '<text x="100" y="70" font-family="Helvetica, Arial" font-size="10" fill="#94A3B8" text-anchor="middle">Secure Digital Signature</text>'
            . '</svg>';
        $signatureBase64 = 'data:image/svg+xml;base64,' . base64_encode($sigSvg);

        $pdf = Pdf::loadView('assessments.pdf', compact(
            'user', 
            'course', 
            'result', 
            'percentages', 
            'radarChartBase64', 
            'signatureBase64',
            'top',
            'categoryDetails',
            'weaknessAnalysis'
        ));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download("Sertifikat-Asesmen-Psikologi-" . $user->name . ".pdf");
    }

    /**
     * Generate QuickChart radar chart URL for the 4 assessment categories.
     */
    public function getRadarChartUrl(array $percentages): string
    {
        $chartConfig = [
            'type' => 'radar',
            'data' => [
                'labels' => ['Konselor', 'HR', 'UX Researcher', 'Trainer'],
                'datasets' => [[
                    'label' => 'Persentase Kecocokan',
                    'data' => [
                        $percentages['konselor'] ?? 25,
                        $percentages['hr'] ?? 25,
                        $percentages['ux_researcher'] ?? 25,
                        $percentages['trainer'] ?? 25
                    ],
                    'borderColor' => '#D97706',
                    'backgroundColor' => 'rgba(217, 119, 6, 0.1)',
                    'borderWidth' => 2,
                    'pointBackgroundColor' => '#D97706',
                    'pointBorderColor' => '#FFFFFF',
                    'pointBorderWidth' => 1.5,
                    'pointRadius' => 4.5
                ]]
            ],
            'options' => [
                'scale' => [
                    'ticks' => [
                        'min' => 0,
                        'max' => 100,
                        'stepSize' => 20,
                        'display' => false
                    ],
                    'pointLabels' => [
                        'fontSize' => 11,
                        'fontColor' => '#0F172A',
                        'fontStyle' => 'bold'
                    ],
                    'gridLines' => [
                        'color' => '#E2E8F0'
                    ],
                    'angleLines' => [
                        'color' => '#E2E8F0'
                    ]
                ],
                'legend' => [
                    'display' => false
                ]
            ]
        ];

        return 'https://quickchart.io/chart?c=' . urlencode(json_encode($chartConfig)) . '&w=350&h=350';
    }
}
