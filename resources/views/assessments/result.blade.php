<x-layouts.app>
    @php
        $categoryDetails = [
            'dokter_medis' => [
                'title' => 'Dokter & Tenaga Medis',
                'desc' => 'Anda memiliki kepedulian kemanusiaan yang tinggi, ketahanan mental di bawah tekanan, dan kemampuan diagnosis klinis yang prima.',
                'color' => 'bg-red-500',
                'text_color' => 'text-red-600',
                'border_color' => 'border-red-200/80',
                'bg_color' => 'bg-red-50/50',
            ],
            'guru_pendidik' => [
                'title' => 'Guru & Pendidik',
                'desc' => 'Anda memiliki bakat mendidik yang mendalam, kesabaran interpersonal yang tinggi, dan kemampuan memfasilitasi pemahaman kelompok.',
                'color' => 'bg-emerald-500',
                'text_color' => 'text-emerald-600',
                'border_color' => 'border-emerald-200/80',
                'bg_color' => 'bg-emerald-50/50',
            ],
            'software_engineer' => [
                'title' => 'Software Engineer',
                'desc' => 'Anda didorong oleh logika pemecahan masalah algoritma, ketepatan detail penulisan kode, dan efisiensi arsitektur digital.',
                'color' => 'bg-indigo-500',
                'text_color' => 'text-indigo-600',
                'border_color' => 'border-indigo-200/80',
                'bg_color' => 'bg-indigo-50/50',
            ],
            'hr_talent' => [
                'title' => 'HR & Talent Management Specialist',
                'desc' => 'Anda memiliki kepemimpinan alami dalam merancang alur kerja, merekrut bakat terbaik, dan menyelaraskan budaya kerja organisasi.',
                'color' => 'bg-blue-500',
                'text_color' => 'text-blue-600',
                'border_color' => 'border-blue-200/80',
                'bg_color' => 'bg-blue-50/50',
            ],
            'konselor_psikolog' => [
                'title' => 'Konselor & Psikolog',
                'desc' => 'Anda unggul dalam mendengarkan aktif, membangun rasa aman emosional, dan memandu orang lain memecahkan konflik batin mereka.',
                'color' => 'bg-teal-500',
                'text_color' => 'text-teal-600',
                'border_color' => 'border-teal-200/80',
                'bg_color' => 'bg-teal-50/50',
            ],
            'financial_analyst' => [
                'title' => 'Financial Analyst',
                'desc' => 'Anda unggul dalam memetakan tren pasar uang, menganalisis laporan keuangan, dan memitigasi risiko investasi bisnis.',
                'color' => 'bg-cyan-500',
                'text_color' => 'text-cyan-600',
                'border_color' => 'border-cyan-200/80',
                'bg_color' => 'bg-cyan-50/50',
            ],
            'arsitek_desainer' => [
                'title' => 'Arsitek & Desainer',
                'desc' => 'Anda memiliki kepekaan visual yang estetis, imajinasi spasial yang kuat, dan perhatian mendalam pada pengalaman pengguna.',
                'color' => 'bg-pink-500',
                'text_color' => 'text-pink-600',
                'border_color' => 'border-pink-200/80',
                'bg_color' => 'bg-pink-50/50',
            ],
            'entrepreneur' => [
                'title' => 'Entrepreneur & Bisnis',
                'desc' => 'Anda memiliki insting melihat peluang pasar, keberanian mengambil risiko terukur, dan kemampuan menggerakkan sumber daya.',
                'color' => 'bg-amber-500',
                'text_color' => 'text-amber-600',
                'border_color' => 'border-amber-200/80',
                'bg_color' => 'bg-amber-50/50',
            ],
            'legal_lawyer' => [
                'title' => 'Legal & Pengacara',
                'desc' => 'Anda memiliki kemampuan analisis dokumen hukum yang tajam, argumentasi logis yang kuat, dan komitmen menegakkan kepatuhan.',
                'color' => 'bg-orange-500',
                'text_color' => 'text-orange-600',
                'border_color' => 'border-orange-200/80',
                'bg_color' => 'bg-orange-50/50',
            ],
            'digital_marketer' => [
                'title' => 'Digital Marketer',
                'desc' => 'Anda unggul dalam menganalisis perilaku konsumen digital, merancang promosi kreatif, dan memaksimalkan konversi penjualan.',
                'color' => 'bg-rose-500',
                'text_color' => 'text-rose-600',
                'border_color' => 'border-rose-200/80',
                'bg_color' => 'bg-rose-50/50',
            ],
            'content_creator' => [
                'title' => 'Content Creator',
                'desc' => 'Anda memiliki kemampuan bercerita yang memikat, kreativitas pembuatan media visual, dan adaptabilitas tinggi pada tren audiens.',
                'color' => 'bg-violet-500',
                'text_color' => 'text-violet-600',
                'border_color' => 'border-violet-200/80',
                'bg_color' => 'bg-violet-50/50',
            ],
            'data_scientist' => [
                'title' => 'Data Scientist',
                'desc' => 'Anda ahli dalam memproses data besar, membangun model prediksi matematika, dan menerjemahkan angka menjadi keputusan bisnis.',
                'color' => 'bg-sky-500',
                'text_color' => 'text-sky-600',
                'border_color' => 'border-sky-200/80',
                'bg_color' => 'bg-sky-50/50',
            ],
        ];

        $top = $categoryDetails[$result->top_category] ?? $categoryDetails['hr_talent'];
    @endphp

    <div class="relative bg-gradient-to-b from-white via-sky-50/20 to-slate-50 text-slate-800 pt-32 pb-24 overflow-hidden min-h-screen">
        <!-- Decorative glowing backgrounds -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-indigo-100/50 rounded-full blur-[100px] pointer-events-none -z-10"></div>
        <div class="absolute bottom-10 left-1/4 w-[500px] h-[500px] bg-sky-100/40 rounded-full blur-[120px] pointer-events-none -z-10"></div>

        <div class="max-w-3xl mx-auto px-4 relative z-10">
            <!-- Hero Result Card -->
            <div class="bg-white border {{ $top['border_color'] }} {{ $top['bg_color'] }} rounded-3xl p-8 sm:p-10 shadow-xl shadow-slate-100/40 mb-10 text-center sm:text-left relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-indigo-500/5 rounded-full blur-3xl pointer-events-none"></div>
                
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-600 text-white text-xs font-bold mb-4 uppercase tracking-wider">
                    Hasil Tes Minat Karir Anda
                </span>
                
                <h1 class="font-outfit text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight mb-4">
                    Selamat! Karir Dominan Anda adalah:<br>
                    <span class="{{ $top['text_color'] }} font-outfit text-3xl sm:text-4xl block mt-2">{{ $top['title'] }}</span>
                </h1>
                
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed font-medium">
                    {{ $top['desc'] }}
                </p>
            </div>

            <!-- Profile Percentages Breakdown Card -->
            <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm mb-10">
                <h3 class="font-outfit text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                    Detail Persentase Bidang Karir (Menampilkan Kecocokan Profesi)
                </h3>

                <div class="space-y-6">
                    @php
                        // Sort percentages in descending order for web view as well
                        $percentages = $result->percentages_payload;
                        arsort($percentages);
                        // Take top 4 for the primary view
                        $top4Web = array_slice($percentages, 0, 4, true);
                    @endphp
                    @foreach($top4Web as $catKey => $val)
                        @php
                            $catInfo = $categoryDetails[$catKey] ?? [
                                'title' => ucfirst(str_replace('_', ' ', $catKey)),
                                'color' => 'bg-indigo-500',
                                'text_color' => 'text-indigo-600',
                            ];
                        @endphp
                        <div>
                            <div class="flex justify-between items-center text-sm font-bold text-slate-700 mb-2">
                                <span>{{ $catInfo['title'] }}</span>
                                <span class="{{ $catInfo['text_color'] }}">{{ $val }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                                <div class="h-3 rounded-full {{ $catInfo['color'] }}" style="width: {{ $val }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Answer Recap Card -->
            <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm mb-10">
                <h3 class="font-outfit text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                    Rekap Jawaban Anda
                </h3>
                
                <div class="space-y-5">
                    @foreach($result->answers_payload as $index => $answer)
                        <div class="border-b border-slate-100 pb-4 last:border-0 last:pb-0">
                            <div class="flex items-start gap-3 mb-2">
                                <span class="w-6 h-6 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                                    {{ $index + 1 }}
                                </span>
                                <p class="text-sm font-bold text-slate-800 leading-relaxed">{{ $answer['question_text'] }}</p>
                            </div>
                            <div class="pl-9 flex flex-wrap items-center gap-2">
                                <span class="text-xs font-semibold text-slate-400">Pilihan Anda:</span>
                                <span class="text-xs px-2.5 py-1 bg-indigo-50 text-indigo-600 font-bold rounded-lg leading-snug">{{ $answer['selected_option_text'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="/" class="w-full sm:w-auto text-center px-8 py-4 bg-transparent border border-slate-200 hover:border-slate-300 text-slate-600 hover:text-slate-800 font-bold rounded-2xl text-sm transition-all">
                    Kembali ke Beranda
                </a>
                <a href="{{ route('assessments.pdf', $course->slug) }}" class="w-full sm:w-auto text-center px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold rounded-2xl text-sm transition-all shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/25 hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                    📄 Unduh Sertifikat & Hasil Resmi (PDF)
                </a>
            </div>

        </div>
    </div>
</x-layouts.app>
