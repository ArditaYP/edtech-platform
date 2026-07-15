<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Edtech Platform</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets & Livewire -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen selection:bg-indigo-500 selection:text-white">
    
    <div class="flex h-screen overflow-hidden bg-slate-50">
        
        <!-- 1. Sidebar Navigasi (Kiri) - Sticky/Fixed -->
        <aside class="hidden lg:flex lg:flex-col lg:w-64 bg-slate-900 text-slate-300 flex-shrink-0 justify-between">
            <div>
                <!-- Sidebar Header: Logo -->
                <div class="h-16 px-6 border-b border-slate-800 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-indigo-500 to-sky-400 flex items-center justify-center shadow-md">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="font-outfit font-extrabold text-lg text-white tracking-wide">Edtech<span class="text-indigo-400">Admin</span></span>
                </div>

                <!-- Navigation Menu Links -->
                <nav class="p-4 space-y-1.5">
                    <!-- Dashboard (Aktif) -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-indigo-600 text-white font-semibold text-sm shadow-md shadow-indigo-600/10 transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                        </svg>
                        Dashboard
                    </a>
                    
                    <!-- Kelola Kelas -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white font-medium text-sm transition-colors">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Kelola Kelas
                    </a>

                    <!-- Kelola Siswa -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white font-medium text-sm transition-colors">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Kelola Siswa
                    </a>

                    <!-- Transaksi -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white font-medium text-sm transition-colors">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Transaksi
                    </a>

                    <!-- Pengaturan -->
                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 hover:text-white font-medium text-sm transition-colors">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Pengaturan
                    </a>
                </nav>
            </div>

            <!-- Sidebar Footer: User Profil & Keluar -->
            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-500 to-sky-400 flex items-center justify-center text-white font-extrabold text-xs shadow-sm">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-500 font-semibold truncate">{{ auth()->user()->role }}</p>
                    </div>
                </div>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-center py-2.5 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white font-bold rounded-xl text-xs transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Right Side Panel (Topbar + Scrollable Main Content) -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            <!-- 2. Topbar Area (Atas) - Fixed Height -->
            <header class="h-16 border-b border-slate-200 bg-white flex items-center justify-between px-6 flex-shrink-0 z-10">
                <!-- Search bar -->
                <div class="relative w-80">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Pencarian global admin..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200/80 rounded-xl focus:outline-none focus:border-indigo-500 focus:bg-white text-xs transition-colors">
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-4">
                    <!-- Notification Icon -->
                    <button class="relative p-2 rounded-xl bg-slate-50 border border-slate-200/60 hover:bg-slate-100 transition-colors text-slate-400 hover:text-slate-600">
                        <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-indigo-600"></span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                    </button>

                    <!-- User Name & Avatar -->
                    <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-bold text-slate-800 leading-none">{{ auth()->user()->name }}</p>
                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Administrator</span>
                        </div>
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-500 to-sky-400 flex items-center justify-center text-white font-extrabold text-xs shadow-sm">
                            {{ substr(auth()->user()->name, 0, 2) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- 3. Main Content - Independent Scrollable Content Area -->
            <main class="flex-1 overflow-y-auto p-6 sm:p-8 bg-slate-50">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200/80 rounded-2xl flex gap-3 text-emerald-700 text-sm font-medium">
                        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                
                <!-- KPI Summary Cards (Grid 4 Kolom) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    <!-- Kartu 1: Total Siswa -->
                    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm hover:shadow-md transition-all flex items-center gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center flex-shrink-0">
                            <!-- Student Icon -->
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Total Siswa</span>
                            <span class="font-outfit text-2xl font-extrabold text-slate-900">{{ number_format($totalStudents) }}</span>
                        </div>
                    </div>

                    <!-- Kartu 2: Total Kelas -->
                    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm hover:shadow-md transition-all flex items-center gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center flex-shrink-0">
                            <!-- Course Icon -->
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Total Kelas</span>
                            <span class="font-outfit text-2xl font-extrabold text-slate-900">{{ number_format($totalCourses) }}</span>
                        </div>
                    </div>

                    <!-- Kartu 3: Pendapatan -->
                    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm hover:shadow-md transition-all flex items-center gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center flex-shrink-0">
                            <!-- Currency Icon -->
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16c1.22 0 2.22-.73 2.582-1.755M14 11.75A2.625 2.625 0 0012.75 9.5h-1.5A2.625 2.625 0 008.625 12c0 1.38 1.12 2.5 2.5 2.5h1.5a2.625 2.625 0 012.5 2.5c0 .93-.728 1.707-1.662 1.95L12 19" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Pendapatan Bulan Ini</span>
                            <span class="font-outfit text-xl sm:text-2xl font-extrabold text-slate-900">Rp{{ number_format($totalRevenueThisMonth, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Kartu 4: Sertifikat -->
                    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm hover:shadow-md transition-all flex items-center gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-600 flex items-center justify-center flex-shrink-0">
                            <!-- Certificate Icon -->
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Sertifikat Terbit</span>
                            <span class="font-outfit text-2xl font-extrabold text-slate-900">{{ number_format($totalCertificatesIssued) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Charts Panels Area (Grid 2 Kolom Responsif) -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Kolom Kiri (Tren Pertumbuhan Siswa Baru) -->
                    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm">
                        <h3 class="font-outfit text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-blue-500 rounded-full"></span>
                            Tren Pertumbuhan Siswa Baru (30 Hari Terakhir)
                        </h3>
                        <div id="userRegistrationChart"></div>
                    </div>

                    <!-- Kolom Kanan (Laporan Finansial & Penjualan) -->
                    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm">
                        <h3 class="font-outfit text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                            Pendapatan & Penjualan Kelas (Bulanan)
                        </h3>
                        <div id="revenueChart"></div>
                    </div>
                </div>

                <!-- Baris Ketiga: Kategori Populer & Log Aktivitas (Grid 12 Kolom) -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-8">
                    <!-- Kolom Kiri: Kategori Kelas Populer (4 Kolom) -->
                    <div class="lg:col-span-4 bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm flex flex-col justify-between">
                        <h3 class="font-outfit text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
                            Kategori Kelas Populer
                        </h3>
                        <div id="categoryDonutChart" class="flex-grow flex items-center justify-center min-h-[280px]"></div>
                    </div>

                    <!-- Kolom Rencana: Tabel Aktivitas & Proyek Terbaru (8 Kolom) -->
                    <div class="lg:col-span-8 bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm overflow-hidden">
                        <h3 class="font-outfit text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                            Aktivitas Belajar & Pengajuan Tugas Terbaru
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                        <th class="pb-4">Nama Siswa</th>
                                        <th class="pb-4">Kelas yang Diikuti</th>
                                        <th class="pb-4">Aktivitas</th>
                                        <th class="pb-4 text-right">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm text-slate-600 font-medium">
                                    <tr>
                                        <td class="py-4 flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                                BS
                                            </div>
                                            <span class="truncate">Budi Santoso</span>
                                        </td>
                                        <td class="py-4">Kuasai Laravel 11 & Livewire 3</td>
                                        <td class="py-4 text-slate-500">Mengumpulkan Proyek Akhir</td>
                                        <td class="py-4 text-right text-xs text-slate-400">2 menit yang lalu</td>
                                    </tr>
                                    <tr>
                                        <td class="py-4 flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                                SR
                                            </div>
                                            <span class="truncate">Siti Rahma</span>
                                        </td>
                                        <td class="py-4">Aplikasi Mobile Flutter</td>
                                        <td class="py-4 text-slate-500">Menyelesaikan Kuis Dasar Dart</td>
                                        <td class="py-4 text-right text-xs text-slate-400">12 menit yang lalu</td>
                                    </tr>
                                    <tr>
                                        <td class="py-4 flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                                AP
                                            </div>
                                            <span class="truncate">Aditya Pratama</span>
                                        </td>
                                        <td class="py-4">Kubernetes DevOps</td>
                                        <td class="py-4 text-slate-500">Menyelesaikan Lab CI/CD</td>
                                        <td class="py-4 text-right text-xs text-slate-400">25 menit yang lalu</td>
                                    </tr>
                                    <tr>
                                        <td class="py-4 flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                                DL
                                            </div>
                                            <span class="truncate">Dewi Lestari</span>
                                        </td>
                                        <td class="py-4">Deep Learning PyTorch</td>
                                        <td class="py-4 text-slate-500">Menyelesaikan Kuis Neural Networks</td>
                                        <td class="py-4 text-right text-xs text-slate-400">1 jam yang lalu</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Kelola Kelas Section (Full Width Table) -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm overflow-hidden mt-8">
                    <h3 class="font-outfit text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                        Kelola Kelas & Status Publikasi
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                    <th class="pb-4">Judul Kelas</th>
                                    <th class="pb-4">Kategori</th>
                                    <th class="pb-4">Tipe</th>
                                    <th class="pb-4">Status</th>
                                    <th class="pb-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-600 font-medium">
                                @forelse($coursesList as $c)
                                    <tr>
                                        <td class="py-4">
                                            <p class="font-bold text-slate-800 leading-snug">{{ $c->title }}</p>
                                            <p class="text-xs text-slate-400 mt-0.5">Rp{{ number_format($c->price, 0, ',', '.') }}</p>
                                        </td>
                                        <td class="py-4">{{ $c->category->name ?? '-' }}</td>
                                        <td class="py-4">
                                            @if($c->is_assessment)
                                                <span class="text-xs px-2.5 py-1 bg-purple-50 border border-purple-100 text-purple-600 font-bold rounded-lg">Asesmen</span>
                                            @else
                                                <span class="text-xs px-2.5 py-1 bg-blue-50 border border-blue-100 text-blue-600 font-bold rounded-lg">Materi Video</span>
                                            @endif
                                        </td>
                                        <td class="py-4">
                                            @if($c->status === 'active')
                                                <span class="text-xs px-2.5 py-1 bg-emerald-50 border border-emerald-100 text-emerald-600 font-bold rounded-lg">Active</span>
                                            @elseif($c->status === 'archived')
                                                <span class="text-xs px-2.5 py-1 bg-slate-50 border border-slate-100 text-slate-500 font-bold rounded-lg">Archived</span>
                                            @else
                                                <span class="text-xs px-2.5 py-1 bg-amber-50 border border-amber-100 text-amber-600 font-bold rounded-lg">Draft</span>
                                            @endif
                                        </td>
                                        <td class="py-4 text-right">
                                            <form action="{{ route('admin.courses.toggle-status', $c->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-xs px-3 py-1.5 rounded-lg border transition-all font-bold {{ $c->status === 'active' ? 'bg-red-50 hover:bg-red-500 border-red-200 text-red-600 hover:text-white' : 'bg-indigo-50 hover:bg-indigo-600 border-indigo-200 text-indigo-600 hover:text-white' }}">
                                                    {{ $c->status === 'active' ? 'Arsipkan' : 'Aktifkan Kembali' }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-slate-400">Tidak ada kelas yang ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>

    </div>

    <!-- ApexCharts Script Integration -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Retrieve JSON data from controller
            const studentTrendData = JSON.parse('{!! $charts['studentTrend'] !!}');
            const monthlyRevenueData = JSON.parse('{!! $charts['monthlyRevenue'] !!}');
            const categoryDistributionData = JSON.parse('{!! $charts['categoryDistribution'] !!}');

            // 1. Tren Pertumbuhan Siswa Baru (Area Chart)
            const registrationOptions = {
                chart: {
                    type: 'area',
                    height: 320,
                    toolbar: { show: false },
                    fontFamily: 'Plus Jakarta Sans, sans-serif'
                },
                series: [{
                    name: 'Siswa Baru',
                    data: studentTrendData.data
                }],
                xaxis: {
                    categories: studentTrendData.labels,
                    labels: {
                        style: { colors: '#94a3b8', fontSize: '10px' }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    labels: {
                        style: { colors: '#94a3b8', fontSize: '10px' }
                    }
                },
                colors: ['#3b82f6'],
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: { enabled: false },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4
                }
            };
            const registrationChart = new ApexCharts(document.querySelector("#userRegistrationChart"), registrationOptions);
            registrationChart.render();

            // 2. Laporan Finansial & Penjualan (Column Bar Chart)
            const revenueOptions = {
                chart: {
                    type: 'bar',
                    height: 320,
                    toolbar: { show: false },
                    fontFamily: 'Plus Jakarta Sans, sans-serif'
                },
                series: [{
                    name: 'Pendapatan',
                    data: monthlyRevenueData.data
                }],
                xaxis: {
                    categories: monthlyRevenueData.labels,
                    labels: {
                        style: { colors: '#94a3b8', fontSize: '11px', fontWeight: 600 }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            return "Rp " + (value / 1000000).toFixed(0) + " Jt";
                        },
                        style: { colors: '#94a3b8', fontSize: '10px' }
                    }
                },
                colors: ['#4f46e5'],
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    }
                },
                dataLabels: { enabled: false },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "Rp " + val.toLocaleString('id-ID');
                        }
                    }
                }
            };
            const revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
            revenueChart.render();

            // 3. Distribusi Kategori Kelas (Donut Chart)
            const donutOptions = {
                chart: {
                    type: 'donut',
                    height: 320,
                    fontFamily: 'Plus Jakarta Sans, sans-serif'
                },
                series: categoryDistributionData.data,
                labels: categoryDistributionData.labels,
                colors: ['#4f46e5', '#10b981', '#f59e0b', '#8b5cf6'],
                legend: {
                    position: 'bottom',
                    fontSize: '11px',
                    fontWeight: 600,
                    labels: { colors: '#475569' }
                },
                dataLabels: { enabled: true },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: { position: 'bottom' }
                    }
                }]
            };
            const donutChart = new ApexCharts(document.querySelector("#categoryDonutChart"), donutOptions);
            donutChart.render();
        });
    </script>

    @livewireScripts
</body>
</html>
