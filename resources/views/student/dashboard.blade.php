<x-layouts.app>
    <div class="flex min-h-screen bg-slate-50 relative" x-data="{ sidebarOpen: false }">
        
        <!-- Mobile Header / Topbar (Terlihat di layar < md) -->
        <div class="md:hidden w-full h-16 bg-white border-b border-slate-200/80 flex items-center justify-between px-6 fixed top-16 left-0 right-0 z-30 shadow-sm">
            <button @click="sidebarOpen = true" class="p-2 rounded-xl hover:bg-slate-50 text-slate-600 focus:outline-none transition-colors" id="hamburger-menu-btn">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="flex items-center gap-2">
                <span class="font-outfit font-bold text-sm text-slate-800">Dashboard Saya</span>
            </div>
            <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-xs shadow-sm">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
        </div>

        <!-- Mobile Off-Canvas Drawer Sidebar (Terlihat di layar < md saat sidebarOpen = true) -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm md:hidden" 
             style="display: none;">
            
            <!-- Drawer Body -->
            <div x-show="sidebarOpen"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 @click.away="sidebarOpen = false"
                 class="w-72 bg-slate-900 h-full p-6 pt-20 flex flex-col justify-between text-slate-300 shadow-2xl relative">
                
                <!-- Close Button -->
                <button @click="sidebarOpen = false" class="absolute top-4 right-4 p-2 rounded-xl text-slate-400 hover:text-slate-200 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="flex flex-col gap-8">
                    <!-- Profile -->
                    <div class="flex items-center gap-4 bg-slate-800/40 p-4 rounded-2xl border border-slate-800">
                        <div class="w-11 h-11 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-base flex-shrink-0 shadow-md">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div class="overflow-hidden">
                            <h4 class="font-outfit font-bold text-slate-100 truncate text-sm">{{ $user->name }}</h4>
                            <span class="text-[9px] bg-indigo-500/25 text-indigo-400 font-extrabold px-2 py-0.5 rounded-md uppercase tracking-wider">Siswa</span>
                        </div>
                    </div>

                    <!-- Nav Menu -->
                    <nav class="flex flex-col gap-1.5" id="mobile-sidebar-menu">
                        <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl bg-indigo-600 text-white font-extrabold text-sm transition-all shadow-md">
                            <span class="text-base">🏠</span>
                            Dashboard Saya
                        </a>
                        <a href="#kelas-saya" @click="sidebarOpen = false" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl hover:bg-slate-800/50 text-slate-400 hover:text-slate-100 font-bold text-sm transition-all">
                            <span class="text-base">📚</span>
                            Kelas Saya
                        </a>
                        <a href="#kelas-saya" @click="sidebarOpen = false" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl hover:bg-slate-800/50 text-slate-400 hover:text-slate-100 font-bold text-sm transition-all">
                            <span class="text-base">📄</span>
                            Sertifikat & Hasil Tes
                        </a>
                        <a href="#settings" onclick="alert('Fitur pengaturan akun sedang disiapkan.')" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl hover:bg-slate-800/50 text-slate-400 hover:text-slate-100 font-bold text-sm transition-all">
                            <span class="text-base">⚙️</span>
                            Pengaturan Akun
                        </a>
                    </nav>
                </div>

                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2.5 px-4 py-3 rounded-2xl border border-red-500/20 text-red-400 hover:bg-red-500/10 hover:text-red-300 font-extrabold text-sm transition-all">
                        <span>🚪</span>
                        Keluar Akun
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Sidebar Navigasi Siswa (Kiri - Sticky - Desktop) -->
        <aside class="hidden md:flex w-72 bg-slate-900 text-slate-300 flex-col justify-between flex-shrink-0 min-h-screen sticky top-0 pt-24 pb-8 px-6 shadow-xl border-r border-slate-800">
            <div class="flex flex-col gap-8">
                <!-- Profil Singkat Siswa -->
                <div class="flex items-center gap-4 bg-slate-800/40 p-4 rounded-2xl border border-slate-800/60">
                    <div class="w-11 h-11 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-base flex-shrink-0 shadow-md">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="font-outfit font-bold text-slate-100 truncate text-sm">{{ $user->name }}</h4>
                        <span class="text-[9px] bg-indigo-500/25 text-indigo-400 font-extrabold px-2 py-0.5 rounded-md uppercase tracking-wider">Siswa</span>
                    </div>
                </div>

                <!-- Menu Navigasi -->
                <nav class="flex flex-col gap-1.5">
                    <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl bg-indigo-600 text-white font-extrabold text-sm transition-all shadow-md shadow-indigo-600/10">
                        <span class="text-base">🏠</span>
                        Dashboard Saya
                    </a>
                    <a href="#kelas-saya" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl hover:bg-slate-800/50 text-slate-400 hover:text-slate-100 font-bold text-sm transition-all">
                        <span class="text-base">📚</span>
                        Kelas Saya
                    </a>
                    <a href="#kelas-saya" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl hover:bg-slate-800/50 text-slate-400 hover:text-slate-100 font-bold text-sm transition-all">
                        <span class="text-base">📄</span>
                        Sertifikat & Hasil Tes
                    </a>
                    <a href="#settings" onclick="alert('Fitur pengaturan akun sedang disiapkan.')" class="flex items-center gap-3.5 px-4 py-3 rounded-2xl hover:bg-slate-800/50 text-slate-400 hover:text-slate-100 font-bold text-sm transition-all">
                        <span class="text-base">⚙️</span>
                        Pengaturan Akun
                    </a>
                </nav>
            </div>

            <!-- Tombol Keluar (Logout) -->
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2.5 px-4 py-3 rounded-2xl border border-red-500/20 text-red-400 hover:bg-red-500/10 hover:text-red-300 font-extrabold text-sm transition-all">
                    <span>🚪</span>
                    Keluar Akun
                </button>
            </form>
        </aside>

        <!-- Main Content Area (Kanan) -->
        <main class="flex-1 p-6 sm:p-10 pt-40 md:pt-28 overflow-y-auto">
            
            <!-- Welcome Banner (Gradasi Biru-Indigo Elegan) -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-6 sm:p-8 text-white shadow-lg shadow-indigo-700/15 mb-10 relative overflow-hidden">
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-indigo-500/20 rounded-full blur-[80px]"></div>
                <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-blue-500/20 rounded-full blur-[80px]"></div>

                <div class="relative z-10 max-w-2xl">
                    <span class="text-[9px] font-extrabold uppercase tracking-widest bg-white/20 px-3 py-1 rounded-full text-white/90">Dashboard Siswa</span>
                    <h1 class="font-outfit text-2xl sm:text-3xl font-extrabold mt-3">
                        Selamat Datang Kembali, {{ $user->name }}! 🚀
                    </h1>
                    <p class="text-xs sm:text-sm text-blue-100 mt-2 font-medium">
                        Konsistensi adalah kunci. Mari lanjutkan progres belajar dan eksplorasi potensimu hari ini!
                    </p>
                </div>
            </div>

            <!-- Widget Statistik Ringkas (3 Kartu KPI) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
                <!-- KPI 1: Total Kelas -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm hover:shadow-md transition-all flex items-center gap-5">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-0.5">Total Kelas Diikuti</span>
                        <span class="font-outfit text-2xl font-extrabold text-slate-900">{{ $totalCourses }}</span>
                    </div>
                </div>

                <!-- KPI 2: Kelas Selesai -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm hover:shadow-md transition-all flex items-center gap-5">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-0.5">Kelas Selesai</span>
                        <span class="font-outfit text-2xl font-extrabold text-slate-900">{{ $completedCourses }}</span>
                    </div>
                </div>

                <!-- KPI 3: Sertifikat & Laporan -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm hover:shadow-md transition-all flex items-center gap-5">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-0.5">Sertifikat & Laporan</span>
                        <span class="font-outfit text-2xl font-extrabold text-slate-900">{{ $totalCertificates }}</span>
                    </div>
                </div>
            </div>

            <!-- List Kelas Saya Header -->
            <div id="kelas-saya" class="mb-8 border-b border-slate-200/80 pb-4">
                <h2 class="font-outfit text-xl font-extrabold text-slate-900 flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                    Materi & Kelas Saya
                </h2>
                <p class="text-xs text-slate-400 mt-1">Daftar kelas yang sedang dan telah Anda pelajari</p>
            </div>

            @if($myCourses->isEmpty())
                <!-- Empty State Component -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-12 text-center shadow-sm max-w-2xl mx-auto">
                    <div class="w-20 h-20 bg-indigo-50 border border-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6 text-indigo-600 shadow-inner">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="font-outfit font-bold text-slate-800 text-lg">Belum Ada Kelas yang Diikuti</h3>
                    <p class="text-xs sm:text-sm text-slate-500 mt-2 max-w-md mx-auto leading-relaxed">
                        Anda belum mengambil kelas atau tes asesmen apa pun. Jelajahi katalog kami untuk memulai perjalanan belajar Anda!
                    </p>
                    <a href="{{ route('welcome') }}" class="mt-8 inline-flex items-center gap-2 px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-2xl text-xs sm:text-sm transition-all shadow-md shadow-blue-600/10 hover:shadow-blue-600/25">
                        Eksplorasi Katalog Kelas Sekarang ➔
                    </a>
                </div>
            @else
                <!-- Enrolled Courses Grid (1 Mobile, 2 Tablet, 3 Desktop) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($myCourses as $enrollment)
                        @php
                            $c = $enrollment->course;
                            $hasResult = isset($myResults[$c->id]);
                        @endphp
                        <div class="bg-white border border-slate-200/80 rounded-3xl shadow-sm hover:shadow-md transition-all overflow-hidden flex flex-col justify-between">
                            <!-- Thumbnail & Upper Card Info -->
                            <div>
                                <!-- Thumbnail Container -->
                                <div class="relative h-40 bg-gradient-to-tr from-blue-600 to-indigo-700 flex items-center justify-center text-white/95 font-extrabold text-sm p-6 text-center select-none overflow-hidden">
                                    <div class="absolute inset-0 bg-slate-900/10 mix-blend-overlay"></div>
                                    <div class="absolute -right-8 -top-8 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                                    <div class="absolute -left-6 -bottom-6 w-20 h-20 bg-white/10 rounded-full blur-lg"></div>
                                    <span class="font-outfit text-sm sm:text-base font-extrabold line-clamp-2 leading-snug drop-shadow-sm">{{ $c->title }}</span>
                                </div>

                                <!-- Card Content -->
                                <div class="p-6">
                                    <!-- Header: Category & Level -->
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-[9px] font-bold px-2.5 py-1 rounded-full bg-slate-100 border border-slate-200/60 text-slate-500 uppercase tracking-wider">
                                            {{ $c->category->name ?? '-' }}
                                        </span>
                                        <span class="text-[9px] font-bold px-2.5 py-1 rounded-full {{ $enrollment->status === 'completed' ? 'bg-emerald-50 border border-emerald-100 text-emerald-600' : 'bg-blue-50 border border-blue-100 text-blue-600' }} uppercase tracking-wider">
                                            {{ $enrollment->status === 'completed' ? 'Selesai' : 'Aktif' }}
                                        </span>
                                    </div>

                                    <!-- Course Title -->
                                    <h3 class="font-outfit font-extrabold text-slate-800 text-base leading-snug mb-3 hover:text-indigo-600 transition-colors">
                                        {{ $c->title }}
                                    </h3>

                                    <!-- Study Progress Section -->
                                    <div class="mb-4">
                                        <div class="flex justify-between items-center text-[10px] font-bold text-slate-400 mb-1.5 uppercase tracking-wider">
                                            <span>Progres Belajar</span>
                                            <span class="text-indigo-600 font-extrabold">{{ $enrollment->status === 'completed' ? '100%' : '0%' }}</span>
                                        </div>
                                        <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden border border-slate-200/40">
                                            <div class="bg-indigo-600 h-full rounded-full transition-all duration-500" style="width: {{ $enrollment->status === 'completed' ? '100%' : '0%' }}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA Action Buttons -->
                            <div class="p-6 pt-0 border-t border-slate-100/60 mt-auto">
                                <div class="pt-4">
                                    @if($c->is_assessment)
                                        @if($hasResult)
                                            <a href="{{ route('assessments.result', $c->slug) }}" class="block w-full text-center bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold py-3.5 rounded-2xl text-xs transition-colors shadow-md shadow-emerald-600/10 hover:shadow-emerald-600/25">
                                                📄 Lihat Hasil & PDF ➔
                                            </a>
                                        @else
                                            <a href="{{ route('assessments.take', $c->slug) }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold py-3.5 rounded-2xl text-xs transition-colors shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/25">
                                                🧠 Mulai Tes Asesmen ➔
                                            </a>
                                        @endif
                                    @else
                                        <button onclick="alert('Kelas video programming akan segera siap dibuka kembali setelah pembaruan kurikulum!')" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-3.5 rounded-2xl text-xs transition-colors shadow-md shadow-blue-600/10 hover:shadow-blue-600/25">
                                            ▶️ Lanjutkan Belajar ➔
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </main>
    </div>
</x-layouts.app>
