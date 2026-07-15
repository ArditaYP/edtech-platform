<x-layouts.app>
    <!-- 1. Hero Section -->
    <x-hero />

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="p-4 bg-red-50 border border-red-200/80 rounded-2xl flex gap-3 text-red-700 text-sm font-medium">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- 2. Featured Dark Banner -->
        <x-featured-banner />

        <!-- 3. Livewire Course Catalog -->
        <livewire:course-catalog />

        <!-- Fetch testimonials & alumni projects from database -->
        @php
            $testimonials = \App\Models\Testimonial::all();
            $alumniProjects = \App\Models\AlumniProject::all();
        @endphp

        <!-- 4. Alumni Projects Section -->
        @if($alumniProjects->isNotEmpty())
            <div class="my-24">
                <div class="text-center mb-12">
                    <span class="text-xs font-semibold text-indigo-600 tracking-wider uppercase">Portofolio Siswa</span>
                    <h2 class="font-outfit text-3xl font-extrabold text-slate-900 mt-1">Karya Hebat dari Para Alumni</h2>
                    <p class="text-sm text-slate-500 mt-1">Aplikasi dan proyek nyata buatan alumni yang siap bersaing di pasar industri global.</p>
                </div>

                <!-- Responsive horizontal scrolling on mobile, grid layout on desktop -->
                <div class="flex overflow-x-auto md:grid md:grid-cols-3 gap-8 pb-6 md:pb-0 scrollbar-thin snap-x snap-mandatory">
                    @foreach($alumniProjects as $project)
                        <div class="w-[85vw] sm:w-[350px] md:w-auto shrink-0 snap-align-start bg-white border border-slate-200/80 rounded-3xl overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                            <div>
                                <!-- Browser Window Mockup -->
                                <div class="bg-slate-900 border-b border-slate-800 flex items-center p-3 gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-red-500/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500/80"></span>
                                    <div class="ml-3 bg-slate-950/60 rounded-md text-[10px] text-slate-500 px-3 py-0.5 w-full max-w-[180px] truncate select-none">
                                        {{ str_replace('https://', '', $project->demo_url) }}
                                    </div>
                                </div>
                                
                                <!-- Mockup Content Area -->
                                <div class="h-44 w-full bg-gradient-to-tr from-slate-950 to-indigo-900 flex flex-col items-center justify-center p-6 text-center relative overflow-hidden">
                                    <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
                                    <div class="absolute w-20 h-20 bg-indigo-500/25 rounded-full blur-xl"></div>
                                    <span class="text-[10px] text-indigo-400 font-extrabold uppercase tracking-widest mb-1.5">Alumni Showcase</span>
                                    <h4 class="font-outfit font-extrabold text-base text-white leading-snug px-4 select-none">{{ $project->title }}</h4>
                                </div>

                                <div class="p-6">
                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="w-6 h-6 rounded-full bg-indigo-50 flex items-center justify-center text-[10px] font-extrabold text-indigo-600">
                                            {{ substr($project->student_name, 0, 1) }}
                                        </div>
                                        <span class="text-xs text-slate-500 font-semibold">Oleh {{ $project->student_name }}</span>
                                    </div>
                                    <p class="text-sm text-slate-500 leading-relaxed line-clamp-3">
                                        {{ $project->description }}
                                    </p>
                                </div>
                            </div>
                            <div class="p-6 pt-0">
                                <a href="{{ $project->demo_url }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl border border-slate-200 hover:border-indigo-600 hover:text-indigo-600 text-slate-700 font-bold text-xs transition-colors">
                                    Lihat Live Demo
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- 5. Testimonials Section -->
        @if($testimonials->isNotEmpty())
            <div class="my-24">
                <div class="text-center mb-12">
                    <span class="text-xs font-semibold text-indigo-600 tracking-wider uppercase">Ulasan Alumni</span>
                    <h2 class="font-outfit text-3xl font-extrabold text-slate-900 mt-1">Mengapa Mereka Memilih Kami?</h2>
                    <p class="text-sm text-slate-500 mt-1">Cerita sukses dan ulasan jujur dari para siswa yang kini telah merintis karir di industri teknologi.</p>
                </div>

                <!-- Masonry-like grid using 3 columns -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($testimonials as $testimonial)
                        <div class="bg-white border border-slate-200/80 rounded-3xl p-8 hover:shadow-lg hover:border-slate-300 transition-all flex flex-col justify-between">
                            <div>
                                <!-- Star Ratings -->
                                <div class="flex gap-0.5 mb-4">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 text-amber-500 fill-amber-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>

                                <p class="text-slate-600 text-sm leading-relaxed mb-6 font-medium">
                                    "{{ $testimonial->quote }}"
                                </p>
                            </div>

                            <div class="flex items-center gap-4 pt-5 border-t border-slate-100">
                                <!-- Circular Profile Avatar representation -->
                                <div class="w-11 h-11 rounded-full bg-gradient-to-tr from-indigo-500 to-sky-400 flex items-center justify-center text-white font-extrabold text-sm shadow-sm">
                                    {{ substr($testimonial->student_name, 0, 2) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-slate-800 leading-none mb-1">{{ $testimonial->student_name }}</h4>
                                    <p class="text-[11px] text-slate-400 font-semibold tracking-wide uppercase">
                                        {{ $testimonial->role }} <span class="text-indigo-600">@ {{ $testimonial->company }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- 6. Card CTA Penutup -->
        <div class="relative bg-gradient-to-r from-indigo-600 via-indigo-700 to-blue-600 rounded-[2.5rem] p-8 sm:p-16 text-center overflow-hidden my-24 shadow-xl shadow-indigo-600/10">
            <!-- Decorative background elements -->
            <div class="absolute -top-10 -right-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-sky-400/20 rounded-full blur-3xl"></div>

            <div class="relative z-10 max-w-3xl mx-auto">
                <span class="text-xs font-bold text-sky-200 tracking-widest uppercase mb-4 block">Langkah Awal Suksesmu</span>
                <h2 class="font-outfit text-4xl sm:text-5xl font-extrabold text-white mb-6 leading-tight">
                    Siap Menguasai Skill Masa Depan?
                </h2>
                <p class="text-indigo-100 text-base sm:text-lg mb-10 max-w-xl mx-auto leading-relaxed">
                    Dapatkan akses ke materi pemrograman standar global, bimbingan mentor berpengalaman, dan gabung komunitas alumni.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="#" class="w-full sm:w-auto px-8 py-4 bg-white hover:bg-slate-50 text-indigo-600 font-extrabold rounded-2xl shadow-lg transition-all hover:-translate-y-0.5 active:translate-y-0 text-base">
                        Mulai Belajar Sekarang
                    </a>
                    <a href="#" class="w-full sm:w-auto px-8 py-4 bg-transparent border border-white/30 hover:border-white/50 text-white font-bold rounded-2xl transition-all text-base">
                        Konsultasi Karir (Gratis)
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
