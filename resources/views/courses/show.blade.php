<x-layouts.app>
    <div class="relative bg-gradient-to-b from-white via-sky-50/20 to-slate-50 text-slate-800 pt-24 pb-20 overflow-hidden">
        <!-- Decorative glowing backgrounds -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-indigo-100/50 rounded-full blur-[100px] pointer-events-none -z-10"></div>
        <div class="absolute bottom-10 left-1/4 w-[500px] h-[500px] bg-sky-100/40 rounded-full blur-[120px] pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200/80 rounded-2xl flex gap-3 text-red-700 text-sm font-medium">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200/80 rounded-2xl flex gap-3 text-emerald-700 text-sm font-medium">
                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            <!-- Breadcrumbs -->
            <nav class="flex mb-8 text-xs sm:text-sm font-semibold tracking-wide text-slate-500 gap-2 items-center" aria-label="Breadcrumb">
                <a href="/" class="hover:text-indigo-600 transition-colors">Beranda</a>
                <span class="text-slate-400">/</span>
                <a href="/" class="hover:text-indigo-600 transition-colors">Kelas</a>
                <span class="text-slate-400">/</span>
                <span class="text-slate-700 font-bold">{{ $course->category->name }}</span>
            </nav>

            <!-- Responsive 2-Column Grid (12 Columns on Desktop) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                
                <!-- Left Column (8 Columns in Desktop): Course Info -->
                <div class="lg:col-span-8">
                    <div class="flex flex-col md:flex-row gap-6 mb-8 items-start">
                        <!-- Thumbnail Image Mockup -->
                        <div class="w-full md:w-56 h-36 md:h-36 shrink-0 bg-gradient-to-tr from-slate-900 via-indigo-950 to-indigo-900 rounded-2xl overflow-hidden relative shadow-md flex flex-col justify-between p-4">
                            <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
                            <span class="text-[9px] text-indigo-400 font-extrabold uppercase tracking-widest relative z-10">Interactive Course</span>
                            <h4 class="font-outfit font-extrabold text-xs text-white leading-snug relative z-10 select-none">{{ $course->title }}</h4>
                            <div class="flex justify-between items-center relative z-10">
                                <span class="text-[9px] text-white/50">{{ $course->category->name }}</span>
                                <div class="w-6 h-6 rounded-lg bg-white/10 flex items-center justify-center text-white">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Header Metadata -->
                        <div class="flex-grow">
                            <!-- Rating & Learning Path Link -->
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                <span class="flex items-center gap-1 text-amber-500 font-extrabold text-sm">
                                    ★ {{ $course->rating }}
                                </span>
                                <span class="text-slate-300">|</span>
                                @if(!empty($course->learning_paths))
                                    <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-500 transition-colors uppercase tracking-wider">
                                        Learning Path: {{ implode(', ', $course->learning_paths) }}
                                    </a>
                                @else
                                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider">Spesialisasi Teknologi</span>
                                @endif
                            </div>

                            <!-- Big Bold Class Title -->
                            <h1 class="font-outfit text-3xl sm:text-4xl font-extrabold text-slate-900 mb-4 leading-tight">
                                {{ $course->title }}
                            </h1>

                            <!-- Topic Pill Badges -->
                            <div class="flex flex-wrap gap-2 mb-5">
                                @if(!empty($course->topics))
                                    @foreach($course->topics as $index => $topic)
                                        @if($index < 2)
                                            <span class="px-3 py-1 bg-indigo-50 border border-indigo-100/80 rounded-full text-indigo-600 text-xs font-semibold">
                                                {{ $topic }}
                                            </span>
                                        @endif
                                    @endforeach
                                    @if(count($course->topics) > 2)
                                        <span class="px-3 py-1 bg-slate-100 border border-slate-200 rounded-full text-slate-500 text-xs font-semibold">
                                            +{{ count($course->topics) - 2 }} lainnya
                                        </span>
                                    @endif
                                @else
                                    <span class="px-3 py-1 bg-indigo-50 border border-indigo-100/80 rounded-full text-indigo-600 text-xs font-semibold">
                                        {{ $course->category->name }}
                                    </span>
                                @endif
                            </div>

                            <!-- Metadata Row (Level, Duration, Registered Students) -->
                            <div class="flex flex-wrap items-center gap-y-2 gap-x-6 text-slate-500 text-xs font-bold border-t border-slate-200/60 pt-4">
                                <span class="flex items-center gap-1.5">
                                    <!-- Level Icon -->
                                    <svg class="w-4.5 h-4.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                    </svg>
                                    {{ $course->level }}
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <!-- Duration Icon -->
                                    <svg class="w-4.5 h-4.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $course->duration_hours }} Jam Belajar
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <!-- Students Icon -->
                                    <svg class="w-4.5 h-4.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A2.25 2.25 0 0112.75 21.5h-1.5a2.25 2.25 0 01-2.25-2.263V19.13M8.12 16.058a9.38 9.38 0 00-2.625.372 9.337 9.337 0 00-4.121-.952 4.125 4.125 0 007.533-2.493M8.12 16.058a9.38 9.38 0 012.625-.372 9.337 9.337 0 014.121.952 4.125 4.125 0 01-7.533 2.493M11.25 7.5a3 3 0 11-6 0 3 3 0 016 0zM18.75 7.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ number_format($course->total_students, 0, ',', '.') }} Siswa Terdaftar
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Short Description -->
                    <div class="mb-10">
                        <h3 class="text-lg font-bold text-slate-800 mb-3 font-outfit">Tentang Kelas</h3>
                        <p class="text-slate-600 text-base leading-relaxed">
                            {{ $course->description }}
                        </p>
                    </div>

                    <!-- Benefits Section -->
                    @if(!empty($course->benefits))
                        <div class="mb-10 pt-8 border-t border-slate-200/80">
                            <h3 class="text-lg font-bold text-slate-800 mb-6 font-outfit">Apa yang akan Anda dapatkan?</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($course->benefits as $benefit)
                                    <div class="flex gap-3">
                                        <div class="w-5 h-5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                        </div>
                                        <span class="text-sm text-slate-600 font-medium leading-relaxed">{{ $benefit }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column (4 Columns in Desktop): Floating Price Card -->
                <div class="lg:col-span-4 lg:sticky lg:top-24">
                    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-xl shadow-slate-100/50">
                        <!-- Label "Harga" -->
                        <span class="block text-slate-400 text-xs font-extrabold tracking-wider uppercase mb-1">Harga Kelas</span>
                        
                        <!-- nominal harga -->
                        <div class="mb-6">
                            <div class="flex items-baseline gap-1">
                                <span class="font-outfit text-3xl font-extrabold text-slate-900">
                                    Rp{{ number_format($course->price, 0, ',', '.') }}
                                </span>
                                <span class="text-sm text-slate-500 font-semibold">/ bulan</span>
                            </div>
                            @if($course->promo_title)
                                <div class="mt-2 flex items-center gap-2">
                                    <span class="px-2 py-0.5 bg-red-500/10 text-red-600 text-[10px] font-extrabold rounded-md border border-red-500/20 uppercase tracking-wider">
                                        Promo
                                    </span>
                                    <span class="text-xs text-slate-400 line-through">
                                        Rp{{ number_format($course->price * 2, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- CTA Button Utama (Blue / Slate pekat) -->
                        <form action="{{ route('checkout.process', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-center bg-slate-900 hover:bg-indigo-600 text-white font-extrabold py-4 rounded-2xl text-sm transition-all shadow-md shadow-indigo-600/5 hover:shadow-indigo-600/15 hover:-translate-y-0.5 active:translate-y-0 mb-3">
                                Berlangganan sekarang
                            </button>
                        </form>

                        <!-- CTA Button Sekunder (Outline) -->
                        <a href="#" class="block w-full text-center bg-transparent border border-slate-200 hover:border-slate-300 text-slate-600 hover:text-slate-800 font-bold py-4 rounded-2xl text-sm transition-all mb-6">
                            Lihat langganan lainnya
                        </a>

                        <!-- Guarantee Points -->
                        <ul class="space-y-3 text-xs text-slate-400 border-t border-slate-100 pt-6">
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Akses penuh ke semua materi pembelajaran
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Sertifikat Kompetensi terverifikasi industri
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Bimbingan karir & review kode langsung
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
