<x-layouts.app>
    @php
        $categoryDetails = [
            'konselor' => [
                'title' => 'Konselor / Psikolog Kerja',
                'desc' => 'Anda memiliki empati yang luar biasa tinggi dan sangat suka menolong individu mengurai hambatan emosional maupun kejenuhan kerja. Karir ideal Anda berpusat pada konseling karir, bimbingan akademis, atau psikologi klinis organisasi.',
                'color' => 'bg-emerald-500',
                'text_color' => 'text-emerald-600',
                'border_color' => 'border-emerald-200/80',
                'bg_color' => 'bg-emerald-50/50',
            ],
            'hr' => [
                'title' => 'HR & Talent Acquisition Specialist',
                'desc' => 'Kekuatan Anda terletak pada kemampuan manajerial, penataan staf yang adil, serta penyelarasan talenta dengan arah bisnis organisasi. Karir ideal Anda adalah bidang Rekrutmen (Talent Acquisition), Generalist HR, maupun Hubungan Industrial.',
                'color' => 'bg-blue-500',
                'text_color' => 'text-blue-600',
                'border_color' => 'border-blue-200/80',
                'bg_color' => 'bg-blue-50/50',
            ],
            'ux_researcher' => [
                'title' => 'UI/UX Behavior Researcher',
                'desc' => 'Anda didorong oleh rasa ingin tahu ilmiah tentang mengapa manusia berperilaku demikian di depan sistem kerja. Karir ideal Anda adalah sebagai UX Researcher, Analis Perilaku Pengguna, atau Konsultan Riset Pasar.',
                'color' => 'bg-amber-500',
                'text_color' => 'text-amber-600',
                'border_color' => 'border-amber-200/80',
                'bg_color' => 'bg-amber-50/50',
            ],
            'trainer' => [
                'title' => 'Trainer & People Developer',
                'desc' => 'Anda senang memandu forum, mengedukasi kelompok besar, dan menyederhanakan konsep rumit menjadi materi yang menginspirasi. Karir ideal Anda adalah Corporate Trainer, Guru/Dosen Profesional, atau Konsultan People Development.',
                'color' => 'bg-purple-500',
                'text_color' => 'text-purple-600',
                'border_color' => 'border-purple-200/80',
                'bg_color' => 'bg-purple-50/50',
            ]
        ];

        $top = $categoryDetails[$result->top_category] ?? $categoryDetails['hr'];
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
                    Detail Persentase Bidang Karir
                </h3>

                <div class="space-y-6">
                    @foreach($result->percentages_payload as $catKey => $val)
                        @php
                            $catInfo = $categoryDetails[$catKey] ?? $categoryDetails['hr'];
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
