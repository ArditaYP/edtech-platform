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
     * Get the master mapping of the 12 professions with rich psychometric details.
     */
    private function getCategoryDetails(): array
    {
        return [
            'dokter_medis' => [
                'title' => 'THE LIFE PROTECTOR & HEALTHCARE SPECIALIST™',
                'desc' => 'Anda memiliki kepedulian kemanusiaan yang tinggi, ketahanan mental di bawah tekanan, dan kemampuan diagnosis klinis yang prima.',
                'insight' => 'Dedikasi Anda luar biasa. Seimbangkan pengabdian profesi dengan menjaga kesehatan fisik dan mental Anda sendiri.',
                'quote' => 'Menyembuhkan orang lain adalah bentuk pengabdian tertinggi kemanusiaan.',
                'blind_spot' => 'Cenderung memikul beban emosional pasien secara berlebihan sehingga rentan terhadap kompas emosional/burnout.',
                'dev_area' => 'Perlu melatih teknik coping stress, menjaga batasan emosional profesional, dan manajemen waktu istirahat.',
                'advices' => [
                    'Sediakan waktu jeda dekompresi mental setelah menangani kasus kritis.',
                    'Delegasikan tugas administratif kepada staf pendukung agar fokus pada tindakan medis.'
                ]
            ],
            'guru_pendidik' => [
                'title' => 'THE KNOWLEDGE ENABLER & CHARACTER BUILDER™',
                'desc' => 'Anda memiliki bakat mendidik yang mendalam, kesabaran interpersonal yang tinggi, dan kemampuan memfasilitasi pemahaman kelompok.',
                'insight' => 'Kemampuan komunikasi edukatif Anda sangat kuat. Berikan kebebasan eksplorasi kreatif bagi siswa didik Anda.',
                'quote' => 'Pendidikan bukanlah mengisi wadah, melainkan menyalakan api inspirasi.',
                'blind_spot' => 'Cenderung bersikap terlalu perfeksionis terhadap kurikulum dan kurang sabar dengan perbedaan ritme belajar siswa.',
                'dev_area' => 'Perlu melatih metode pembelajaran interaktif berbasis proyek dan pendekatan psikologi anak/remaja.',
                'advices' => [
                    'Gunakan ragam media audio-visual interaktif untuk mengakomodasi berbagai gaya belajar.',
                    'Lakukan sesi refleksi berkala bersama siswa untuk mendengarkan umpan balik mereka.'
                ]
            ],
            'software_engineer' => [
                'title' => 'THE ARCHITECT OF SYSTEMS & CODE BUILDER™',
                'desc' => 'Anda didorong oleh logika pemecahan masalah algoritma, ketepatan detail penulisan kode, dan efisiensi arsitektur digital.',
                'insight' => 'Kemampuan berpikir analitis Anda luar biasa. Seimbangkan waktu ngoding dengan diskusi kolaboratif tim bisnis.',
                'quote' => 'Kode yang bagus adalah kode yang mudah dipahami manusia lain, bukan cuma komputer.',
                'blind_spot' => 'Cenderung tenggelam dalam detail baris kode (hyper-focus) hingga melupakan tenggat waktu rilis fitur taktis.',
                'dev_area' => 'Perlu melatih keterampilan komunikasi bisnis, kepemimpinan tim teknis (tech lead), dan manajemen waktu.',
                'advices' => [
                    'Terapkan batasan waktu riset solusi teknis maksimal 2 jam sebelum berkonsultasi dengan rekan senior.',
                    'Biasakan melakukan peer review kode secara asertif dan terbuka terhadap kritik arsitektur.'
                ]
            ],
            'hr_talent' => [
                'title' => 'THE TALENT STRATEGIST & ORGANIZATIONAL DESIGNER™',
                'desc' => 'Anda memiliki kepemimpinan alami dalam merancang alur kerja, merekrut bakat terbaik, dan menyelaraskan budaya kerja organisasi.',
                'insight' => 'Ketegasan manajerial Anda sangat kuat. Berikan sentuhan pendekatan personal yang hangat di samping regulasi yang kaku.',
                'quote' => 'SDM bukanlah sekadar aset bisnis, melainkan nyawa utama dari keberlangsungan organisasi.',
                'blind_spot' => 'Cenderung bersikap terlalu kaku pada kebijakan tertulis (SOP) sehingga kurang fleksibel menghadapi situasi darurat staf.',
                'dev_area' => 'Perlu mengasah empati antarpribadi, teknik negosiasi mediatif, dan analisis data retensi karyawan.',
                'advices' => [
                    'Sediakan waktu khusus tatap muka informal (1-on-1) untuk mendengar keluhan non-teknis karyawan.',
                    'Rancang kebijakan fleksibel (discretionary policy) untuk kasus kesejahteraan mendesak.'
                ]
            ],
            'konselor_psikolog' => [
                'title' => 'THE EMPOWERING SOUL MENTOR & EMPATHETIC PATHFINDER™',
                'desc' => 'Anda unggul dalam mendengarkan aktif, membangun rasa aman emosional, dan memandu orang lain memecahkan konflik batin mereka.',
                'insight' => 'Kekuatan empati Anda sangat menonjol. Tetapkan batasan emosional yang sehat agar tidak menyerap burnout orang lain.',
                'quote' => 'Mendengarkan adalah tindakan penerimaan tanpa syarat yang menyembuhkan.',
                'blind_spot' => 'Cenderung menghindari konfrontasi langsung demi menjaga keharmonisan hubungan interpersonal.',
                'dev_area' => 'Perlu meningkatkan ketegasan (assertiveness), teknik terapi perilaku kognitif, dan pengambilan keputusan berbasis data.',
                'advices' => [
                    'Latihlah menyampaikan kebenaran yang jujur secara asertif tanpa takut merusak hubungan.',
                    'Gunakan lembar penilaian objektif dalam mendiagnosis masalah mentalitas klien.'
                ]
            ],
            'financial_analyst' => [
                'title' => 'THE STRATEGIC WEALTH NAVIGATOR & RISK ANALYST™',
                'desc' => 'Anda unggul dalam memetakan tren pasar uang, menganalisis laporan keuangan, dan memitigasi risiko investasi bisnis.',
                'insight' => 'Ketajaman logika angka Anda sangat tinggi. Jelaskan konsep keuangan rumit dengan bahasa awam kepada klien.',
                'quote' => 'Risiko datang dari ketidaktahuan atas apa yang sedang Anda lakukan.',
                'blind_spot' => 'Cenderung terlalu konservatif dalam mengambil peluang pertumbuhan bisnis karena protektif terhadap risiko.',
                'dev_area' => 'Perlu mempelajari metodologi bisnis modern (startup valuation), serta public speaking penyajian presentasi.',
                'advices' => [
                    'Gunakan skenario simulasi risiko moderat untuk mendukung keputusan investasi agresif.',
                    'Latihlah menyajikan ringkasan eksekutif 1 halaman yang mudah dibaca oleh non-keuangan.'
                ]
            ],
            'arsitek_desainer' => [
                'title' => 'THE CREATIVE SPATIAL ARCHITECT & AESTHETIC DESIGNER™',
                'desc' => 'Anda memiliki kepekaan visual yang estetis, imajinasi spasial yang kuat, dan perhatian mendalam pada pengalaman pengguna.',
                'insight' => 'Kreativitas visual Anda sangat bernilai. Seimbangkan idealisme estetika dengan fungsionalitas dan anggaran konstruksi.',
                'quote' => 'Desain yang baik adalah gabungan sempurna antara keindahan visual dan fungsi guna.',
                'blind_spot' => 'Cenderung terlalu idealis terhadap konsep desain pribadi dan sulit menerima kritik teknis dari kontraktor.',
                'dev_area' => 'Perlu melatih komunikasi teknis konstruksi, estimasi biaya material, dan kolaborasi multidisiplin.',
                'advices' => [
                    'Lakukan kunjungan lapangan berkala untuk menyelaraskan desain dengan kendala fisik di area proyek.',
                    'Buat beberapa alternatif variasi material alternatif yang lebih ramah anggaran.'
                ]
            ],
            'entrepreneur' => [
                'title' => 'THE VISIONARY VENTURE BUILDER & BUSINESS PIONEER™',
                'desc' => 'Anda memiliki insting melihat peluang pasar, keberanian mengambil risiko terukur, dan kemampuan menggerakkan sumber daya.',
                'insight' => 'Jiwa kepemimpinan bisnis Anda sangat menonjol. Perkuat kontrol manajemen operasional agar roda bisnis berjalan stabil.',
                'quote' => 'Satu-satunya kegagalan dalam bisnis adalah ketika Anda berhenti mencoba.',
                'blind_spot' => 'Cenderung terburu-buru mengambil ekspansi bisnis baru sebelum fondasi operasional internal kuat.',
                'dev_area' => 'Perlu mengasah kemampuan manajemen keuangan arus kas (cashflow), dan tata kelola kepatuhan hukum bisnis.',
                'advices' => [
                    'Tunda keputusan ekspansi besar hingga cadangan kas operasional aman minimal untuk 6 bulan.',
                    'Delegasikan tugas teknis harian kepada manajer agar Anda fokus pada arah strategis.'
                ]
            ],
            'legal_lawyer' => [
                'title' => 'THE ADVOCATE OF JUSTICE & COMPLIANCE GUARDIAN™',
                'desc' => 'Anda memiliki kemampuan analisis dokumen hukum yang tajam, argumentasi logis yang kuat, dan komitmen menegakkan kepatuhan.',
                'insight' => 'Ketelitian hukum Anda luar biasa. Gunakan pendekatan persuasif dalam penyelesaian sengketa di luar pengadilan.',
                'quote' => 'Keadilan tidak melulu tentang memenangkan argumen, melainkan tentang menegakkan hak secara adil.',
                'blind_spot' => 'Cenderung bersikap konfrontatif dalam komunikasi sehari-hari dan sulit mempercayai niat baik orang lain.',
                'dev_area' => 'Perlu mempelajari keterampilan mediasi konflik alternatif, hukum digital, dan komunikasi diplomatis.',
                'advices' => [
                    'Gunakan teknik mendengarkan aktif sebelum menyodorkan pasal-pasal tuntutan hukum.',
                    'Latih diri melihat masalah hukum dari perspektif bisnis dan win-win solution.'
                ]
            ],
            'digital_marketer' => [
                'title' => 'THE GROWTH CAMPAIGN STRATEGIST & MARKETING ENGINE™',
                'desc' => 'Anda unggul dalam menganalisis perilaku konsumen digital, merancang promosi kreatif, dan memaksimalkan konversi penjualan.',
                'insight' => 'Kreativitas kampanye Anda sangat adaptif. Selaraskan kreativitas konten dengan analisis data analitik yang objektif.',
                'quote' => 'Pemasaran terbaik adalah pemasaran yang tidak terasa seperti jualan.',
                'blind_spot' => 'Cenderung mengutamakan tren viral sesaat dibanding membangun nilai merek jangka panjang yang loyal.',
                'dev_area' => 'Perlu mendalami analisis statistik performa periklanan, optimasi mesin pencari (SEO), dan retensi konsumen.',
                'advices' => [
                    'Lakukan pengujian variasi konten (A/B testing) berbasis data sebelum mengalokasikan anggaran iklan besar.',
                    'Rancang peta perjalanan konsumen (customer journey) yang konsisten di semua saluran media.'
                ]
            ],
            'content_creator' => [
                'title' => 'THE DYNAMIC STORYTELLER & MULTIMEDIA PRODUCER™',
                'desc' => 'Anda memiliki kemampuan bercerita yang memikat, kreativitas pembuatan media visual, dan adaptabilitas tinggi pada tren audiens.',
                'insight' => 'Gaya bercerita Anda sangat menghibur. Jaga konsistensi jadwal tayang dan keaslian isi pesan Anda.',
                'quote' => 'Konten adalah raja, tetapi interaksi emosional dengan audiens adalah kunci kerajaan.',
                'blind_spot' => 'Cenderung mudah mengalami kelelahan kreatif (creative burnout) karena terus-menerus mengejar algoritma media sosial.',
                'dev_area' => 'Perlu menguasai manajemen proyek kreatif, lisensi hak cipta, dan strategi monetisasi berkelanjutan.',
                'advices' => [
                    'Buat kalender konten bulanan terstruktur untuk mengurangi kepanikan ide di menit-menit akhir.',
                    'Sediakan waktu detoks media sosial secara berkala untuk memulihkan energi kreatif Anda.'
                ]
            ],
            'data_scientist' => [
                'title' => 'THE DATA INTELLIGENCE SPECIALIST & PATTERN ANALYST™',
                'desc' => 'Anda ahli dalam memproses data besar, membangun model prediksi matematika, dan menerjemahkan angka menjadi keputusan bisnis.',
                'insight' => 'Ketajaman analisis pola data Anda sangat tinggi. Latihlah menyajikan temuan data ke dalam visualisasi sederhana bagi tim non-teknis.',
                'quote' => 'Tanpa data, Anda hanyalah orang lain yang memiliki opini.',
                'blind_spot' => 'Cenderung terlalu teoritis dalam pemodelan data dan mengabaikan kendala praktis operasional di lapangan.',
                'dev_area' => 'Perlu meningkatkan pemahaman strategi bisnis, keterampilan bercerita lewat data (data storytelling), dan kolaborasi lintas tim.',
                'advices' => [
                    'Validasi model prediksi Anda secara langsung dengan wawancara pengguna/tim lapangan.',
                    'Gunakan analogi sederhana untuk menjelaskan formula rumit saat rapat dengan jajaran direksi.'
                ]
            ],
        ];
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
        
        $details = $this->getCategoryDetails();
        $categoriesCount = [];
        foreach ($details as $key => $val) {
            $categoriesCount[$key] = 0;
        }
        
        $answersPayload = [];

        // Fetch options and calculate counts
        $options = QuestionOption::whereIn('id', array_values($answers))->with('question')->get();

        foreach ($options as $option) {
            $cat = $option->category_result;
            if (isset($categoriesCount[$cat])) {
                $categoriesCount[$cat]++;
            } else {
                $categoriesCount[$cat] = 1;
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

        // Sort percentages descending
        arsort($percentages);

        // Take Top 4 Careers
        $top4Careers = array_slice($percentages, 0, 4, true);
        $topCategory = array_key_first($percentages);
        $lowestCategory = array_key_last($percentages);

        // Compile top careers formatted array
        $topCareersFormatted = [];
        foreach ($top4Careers as $key => $score) {
            $topCareersFormatted[] = [
                'key' => $key,
                'label' => str_replace(['THE ', '™'], '', $details[$key]['title'] ?? ucfirst(str_replace('_', ' ', $key))),
                'score' => $score
            ];
        }

        // Calculate 5 Dimensions for deficit analysis
        $dokterVal = $percentages['dokter_medis'] ?? 0;
        $guruVal = $percentages['guru_pendidik'] ?? 0;
        $softwareVal = $percentages['software_engineer'] ?? 0;
        $hrVal = $percentages['hr_talent'] ?? 0;
        $konselorVal = $percentages['konselor_psikolog'] ?? 0;
        $financialVal = $percentages['financial_analyst'] ?? 0;
        $arsitekVal = $percentages['arsitek_desainer'] ?? 0;
        $entrepreneurVal = $percentages['entrepreneur'] ?? 0;
        $legalVal = $percentages['legal_lawyer'] ?? 0;
        $marketingVal = $percentages['digital_marketer'] ?? 0;
        $creatorVal = $percentages['content_creator'] ?? 0;
        $dataVal = $percentages['data_scientist'] ?? 0;

        $scores = [
            'Security' => (int) min(100, max(30, round(30 + ($legalVal * 1.5) + ($dokterVal * 0.8) + ($hrVal * 0.7)))),
            'Contribution' => (int) min(100, max(30, round(30 + ($entrepreneurVal * 1.5) + ($hrVal * 1.0) + ($financialVal * 0.5)))),
            'Growth' => (int) min(100, max(30, round(30 + ($softwareVal * 1.2) + ($dataVal * 1.2) + ($financialVal * 0.6)))),
            'Significance' => (int) min(100, max(30, round(30 + ($creatorVal * 1.2) + ($guruVal * 1.0) + ($marketingVal * 0.8)))),
            'Connection' => (int) min(100, max(30, round(30 + ($konselorVal * 1.5) + ($guruVal * 0.8) + ($dokterVal * 0.7)))),
        ];

        // Find the lowest dimension
        $sortedScores = $scores;
        asort($sortedScores);
        $lowestDimensionName = array_key_first($sortedScores);

        $deficitAnalysisMap = [
            'Security' => 'Kurang teliti terhadap keteraturan SOP, manajemen risiko hukum, dan administrasi detail yang berulang.',
            'Contribution' => 'Kurang dominan dalam kepemimpinan asertif, pendelegasian tugas tim, dan pengambilan keputusan taktis.',
            'Growth' => 'Kurang terbiasa dalam analisis data angka/statistik, riset kognitif mendalam, dan pemecahan masalah teknis yang kompleks.',
            'Significance' => 'Kurang percaya diri dalam public speaking, persuasi audiens massal, dan membangun branding wawasan di forum terbuka.',
            'Connection' => 'Kurang sensitif terhadap dinamika emosional tim, mediasi konflik interpersonal, dan kesabaran dalam konseling.',
        ];

        $deficitText = $deficitAnalysisMap[$lowestDimensionName] ?? 'Kurang terbiasa dalam pendelegasian tugas dan regulasi formal.';

        $topDetail = $details[$topCategory] ?? $details['hr_talent'];
        $lowestDetail = $details[$lowestCategory] ?? $details['konselor_psikolog'];

        $weaknessAnalysis = [
            'top_blind_spot' => $topDetail['blind_spot'],
            'lowest_category' => $lowestCategory,
            'development_area' => $lowestDetail['dev_area'],
            'actionable_advice' => $topDetail['advices'],
            'top_careers' => $topCareersFormatted,
            'lowest_dimension' => $lowestDimensionName,
            'deficit_text' => $deficitText
        ];

        // Save result
        AssessmentResult::create([
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

        $categoryDetails = $this->getCategoryDetails();
        $percentages = $result->percentages_payload;
        $topCategory = $result->top_category;
        $top = $categoryDetails[$topCategory] ?? $categoryDetails['hr_talent'];

        // Retrieve or dynamically rebuild top_careers for backward compatibility
        $weaknessAnalysis = $result->weakness_analysis;
        $topCareers = $weaknessAnalysis['top_careers'] ?? null;

        if (empty($topCareers)) {
            $sortedPercentages = $percentages;
            arsort($sortedPercentages);
            $top4 = array_slice($sortedPercentages, 0, 4, true);
            $topCareers = [];
            foreach ($top4 as $key => $score) {
                $topCareers[] = [
                    'key' => $key,
                    'label' => str_replace(['THE ', '™'], '', $categoryDetails[$key]['title'] ?? ucfirst(str_replace('_', ' ', $key))),
                    'score' => $score
                ];
            }
        }

        // Backward compatibility fallback for blind spot analysis
        if (!isset($weaknessAnalysis['top_blind_spot']) || empty($weaknessAnalysis['top_blind_spot'])) {
            $lowestCat = $weaknessAnalysis['lowest_category'] ?? array_key_last($percentages) ?: 'dokter_medis';
            $lowestDetail = $categoryDetails[$lowestCat] ?? $categoryDetails['konselor_psikolog'];
            
            $weaknessAnalysis = [
                'top_blind_spot' => $top['blind_spot'],
                'lowest_category' => $lowestCat,
                'development_area' => $lowestDetail['dev_area'],
                'actionable_advice' => $top['advices'],
                'top_careers' => $topCareers
            ];
        }

        // Calculate/retrieve lowest deficit text
        $deficitText = $weaknessAnalysis['deficit_text'] ?? null;
        if (empty($deficitText)) {
            $dokterVal = $percentages['dokter_medis'] ?? 0;
            $guruVal = $percentages['guru_pendidik'] ?? 0;
            $softwareVal = $percentages['software_engineer'] ?? 0;
            $hrVal = $percentages['hr_talent'] ?? 0;
            $konselorVal = $percentages['konselor_psikolog'] ?? 0;
            $financialVal = $percentages['financial_analyst'] ?? 0;
            $arsitekVal = $percentages['arsitek_desainer'] ?? 0;
            $entrepreneurVal = $percentages['entrepreneur'] ?? 0;
            $legalVal = $percentages['legal_lawyer'] ?? 0;
            $marketingVal = $percentages['digital_marketer'] ?? 0;
            $creatorVal = $percentages['content_creator'] ?? 0;
            $dataVal = $percentages['data_scientist'] ?? 0;

            $tempScores = [
                'Security' => (int) min(100, max(30, round(30 + ($legalVal * 1.5) + ($dokterVal * 0.8) + ($hrVal * 0.7)))),
                'Contribution' => (int) min(100, max(30, round(30 + ($entrepreneurVal * 1.5) + ($hrVal * 1.0) + ($financialVal * 0.5)))),
                'Growth' => (int) min(100, max(30, round(30 + ($softwareVal * 1.2) + ($dataVal * 1.2) + ($financialVal * 0.6)))),
                'Significance' => (int) min(100, max(30, round(30 + ($creatorVal * 1.2) + ($guruVal * 1.0) + ($marketingVal * 0.8)))),
                'Connection' => (int) min(100, max(30, round(30 + ($konselorVal * 1.5) + ($guruVal * 0.8) + ($dokterVal * 0.7)))),
            ];
            asort($tempScores);
            $lowName = array_key_first($tempScores);
            
            $deficitAnalysisMap = [
                'Security' => 'Kurang teliti terhadap keteraturan SOP, manajemen risiko hukum, dan administrasi detail yang berulang.',
                'Contribution' => 'Kurang dominan dalam kepemimpinan asertif, pendelegasian tugas tim, dan pengambilan keputusan taktis.',
                'Growth' => 'Kurang terbiasa dalam analisis data angka/statistik, riset kognitif mendalam, dan pemecahan masalah teknis yang kompleks.',
                'Significance' => 'Kurang percaya diri dalam public speaking, persuasi audiens massal, dan membangun branding wawasan di forum terbuka.',
                'Connection' => 'Kurang sensitif terhadap dinamika emosional tim, mediasi konflik interpersonal, dan kesabaran dalam konseling.',
            ];
            $deficitText = $deficitAnalysisMap[$lowName] ?? 'Kurang terbiasa dalam pendelegasian tugas dan regulasi formal.';
        }

        // Generate radar chart for top careers
        $radarChartUrl = $this->getRadarChartUrl($topCareers);
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
            'topCareers',
            'radarChartBase64', 
            'signatureBase64',
            'top',
            'categoryDetails',
            'weaknessAnalysis',
            'deficitText'
        ));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download("Sertifikat-Asesmen-Psikologi-" . $user->name . ".pdf");
    }

    /**
     * Generate QuickChart radar chart URL for the student's top careers.
     */
    public function getRadarChartUrl(array $topCareers): string
    {
        $labels = [];
        $data = [];
        foreach ($topCareers as $career) {
            $labels[] = $career['label'];
            $data[] = $career['score'];
        }

        $chartConfig = [
            'type' => 'radar',
            'data' => [
                'labels' => $labels,
                'datasets' => [[
                    'label' => 'Kecocokan Karir',
                    'data' => $data,
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
                        'fontSize' => 9,
                        'fontColor' => '#1E293B',
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

        return 'https://quickchart.io/chart?c=' . urlencode(json_encode($chartConfig)) . '&w=380&h=280';
    }
}
