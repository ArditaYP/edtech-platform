<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Transaksi & Kas - Edtech Platform</title>

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
    
    <div class="flex h-screen overflow-hidden bg-slate-50" x-data="{ showModal: false, activeTx: {} }">
        
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
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/10' : 'hover:bg-slate-800 hover:text-white text-slate-300 font-medium' }}">
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

                    <!-- Transaksi (Aktif) -->
                    <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.transactions.index') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/10' : 'hover:bg-slate-800 hover:text-white text-slate-300 font-medium' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.transactions.index') ? 'text-white' : 'text-slate-400 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Transaksi
                    </a>
                </nav>
            </div>

            <!-- Sidebar Footer: User Profil & Keluar -->
            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-slate-800 text-slate-300 flex items-center justify-center font-bold text-sm flex-shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="font-bold text-white text-sm truncate">{{ auth()->user()->name }}</h4>
                        <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-red-500/20 text-red-400 hover:bg-red-500/10 hover:text-red-300 font-semibold text-xs transition-colors">
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- 2. Main Content Wrapper -->
        <div class="flex-grow flex flex-col min-w-0">
            <!-- Topbar (Mobile Toggle & Title) -->
            <header class="h-16 bg-white border-b border-slate-200/80 px-6 flex items-center justify-between lg:justify-end flex-shrink-0">
                <div class="flex items-center gap-3 lg:hidden">
                    <span class="font-outfit font-extrabold text-lg text-slate-900 tracking-wide">Edtech<span class="text-indigo-600">Admin</span></span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-xs px-2.5 py-1 bg-indigo-50 border border-indigo-100 text-indigo-600 font-bold rounded-lg">Admin Mode</span>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-grow overflow-y-auto p-6 sm:p-8 bg-slate-50">
                
                <!-- Session Flash Messages -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center gap-3 shadow-sm">
                        <svg class="w-5 h-5 flex-shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-bold">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Page Title & Description -->
                <div class="mb-8">
                    <h1 class="font-outfit text-2xl font-extrabold text-slate-900">Manajemen Transaksi & Kas</h1>
                    <p class="text-xs text-slate-400 mt-1">Pantau arus kas dan riwayat pembayaran siswa secara real-time dari Midtrans</p>
                </div>

                <!-- KPI Summary Widgets -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                    <!-- KPI 1: Pendapatan Lunas -->
                    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm flex items-center gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center flex-shrink-0">
                            <!-- SVG Cash Icon -->
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider mb-0.5">Total Pendapatan Lunas</span>
                            <span class="font-outfit text-xl font-extrabold text-slate-900">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- KPI 2: Transaksi Hari Ini -->
                    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm flex items-center gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center flex-shrink-0">
                            <!-- SVG Calendar Icon -->
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider mb-0.5">Transaksi Hari Ini</span>
                            <span class="font-outfit text-xl font-extrabold text-slate-900">{{ $todayTransactionsCount }}</span>
                        </div>
                    </div>

                    <!-- KPI 3: Menunggu Pembayaran -->
                    <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm flex items-center gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center flex-shrink-0">
                            <!-- SVG Hourglass Icon -->
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider mb-0.5">Menunggu Pembayaran</span>
                            <span class="font-outfit text-xl font-extrabold text-slate-900">{{ $pendingTransactionsCount }}</span>
                        </div>
                    </div>
                </div>

                <!-- Search and Filter Panel -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm mb-8">
                    <form action="{{ route('admin.transactions.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end justify-between">
                        <!-- Left: Filters -->
                        <div class="w-full md:w-auto flex flex-col sm:flex-row gap-4 flex-grow max-w-3xl">
                            <!-- Search -->
                            <div class="flex-grow">
                                <label for="search" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Cari Transaksi</label>
                                <div class="relative">
                                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari Order ID, Nama, atau Email Siswa..." class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 focus:bg-white transition-colors">
                                </div>
                            </div>

                            <!-- Status Filter -->
                            <div class="w-full sm:w-64">
                                <label for="status" class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Status</label>
                                <select name="status" id="status" class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500 focus:bg-white transition-colors">
                                    <option value="all" {{ request('status') === 'all' || !request()->has('status') ? 'selected' : '' }}>Semua Status</option>
                                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>✅ Lunas / Paid</option>
                                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                    <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>❌ Gagal / Kadaluarsa (Failed)</option>
                                    <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>❌ Gagal / Kadaluarsa (Expired)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Right: Actions -->
                        <div class="w-full md:w-auto flex gap-2">
                            <a href="{{ route('admin.transactions.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-extrabold text-sm rounded-xl transition-colors text-center">
                                Reset
                            </a>
                            <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-sm rounded-xl transition-colors shadow-md shadow-indigo-600/10 text-center">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Transaction Records Table -->
                <div class="bg-white border border-slate-200/80 rounded-3xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                    <th class="p-6 pb-4 w-12 text-center">No</th>
                                    <th class="pb-4">Order ID & Tanggal</th>
                                    <th class="pb-4">Siswa</th>
                                    <th class="pb-4">Kelas yang Dibeli</th>
                                    <th class="pb-4">Metode Bayar</th>
                                    <th class="pb-4">Nominal</th>
                                    <th class="pb-4">Status</th>
                                    <th class="pb-4 pr-6 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-600 font-medium">
                                @forelse($transactions as $t)
                                    <tr class="hover:bg-slate-50/55 transition-colors">
                                        <td class="p-6 text-center font-bold text-slate-400">
                                            {{ ($transactions->currentPage() - 1) * $transactions->perPage() + $loop->iteration }}
                                        </td>
                                        <td>
                                            <p class="font-mono text-xs font-bold text-slate-800 leading-snug">{{ $t->order_id }}</p>
                                            <p class="text-[11px] text-slate-400 mt-1">{{ $t->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</p>
                                        </td>
                                        <td>
                                            <p class="font-bold text-slate-800 leading-snug">{{ $t->user->name ?? 'User Terhapus' }}</p>
                                            <p class="text-xs text-slate-400 mt-0.5">{{ $t->user->email ?? '-' }}</p>
                                        </td>
                                        <td>
                                            <p class="font-semibold text-slate-800 line-clamp-1 max-w-[200px]">{{ $t->course->title ?? 'Kelas Terhapus' }}</p>
                                        </td>
                                        <td>
                                            @if($t->payment_type)
                                                <span class="text-[10px] uppercase px-2 py-0.5 rounded bg-slate-50 border border-slate-200 text-slate-500 font-extrabold tracking-wider">
                                                    {{ str_replace('_', ' ', $t->payment_type) }}
                                                </span>
                                            @else
                                                <span class="text-xs italic text-slate-400">Menunggu Dipilih</span>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="font-extrabold text-slate-900">Rp{{ number_format($t->amount, 0, ',', '.') }}</p>
                                        </td>
                                        <td>
                                            @if($t->status === 'paid')
                                                <span class="inline-flex items-center gap-1 text-[11px] px-2.5 py-1 bg-emerald-50 border border-emerald-100 text-emerald-600 font-bold rounded-lg">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Lunas
                                                </span>
                                            @elseif($t->status === 'pending')
                                                <span class="inline-flex items-center gap-1 text-[11px] px-2.5 py-1 bg-amber-50 border border-amber-100 text-amber-600 font-bold rounded-lg animate-pulse">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Menunggu
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 text-[11px] px-2.5 py-1 bg-red-50 border border-red-100 text-red-600 font-bold rounded-lg">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Gagal / Kadaluarsa
                                                </span>
                                            @endif
                                        </td>
                                        <td class="pr-6 text-right">
                                            <button @click="showModal = true; activeTx = {
                                                id: '{{ $t->id }}',
                                                order_id: '{{ $t->order_id }}',
                                                snap_token: '{{ $t->snap_token ?? '-' }}',
                                                created_at: '{{ $t->created_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB',
                                                updated_at: '{{ $t->updated_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB',
                                                student_id: '{{ $t->user->id ?? '-' }}',
                                                student_name: '{{ addslashes($t->user->name ?? '') }}',
                                                student_email: '{{ addslashes($t->user->email ?? '') }}',
                                                student_status: '{{ $t->user && $t->user->role === 'student' ? 'Aktif' : 'Non-Aktif' }}',
                                                course_title: '{{ addslashes($t->course->title ?? '') }}',
                                                course_price: 'Rp{{ number_format($t->course->price ?? 0, 0, ',', '.') }}',
                                                amount: 'Rp{{ number_format($t->amount, 0, ',', '.') }}',
                                                payment_type: '{{ str_replace('_', ' ', $t->payment_type ?? 'Menunggu Dipilih') }}',
                                                status: '{{ $t->status }}',
                                                approve_url: '{{ route('admin.transactions.approve', $t->id) }}',
                                                cancel_url: '{{ route('admin.transactions.cancel', $t->id) }}'
                                            }" class="px-3.5 py-1.5 border border-indigo-200 text-indigo-600 hover:bg-indigo-50 font-bold text-xs rounded-xl transition-all">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="p-12 text-center text-slate-400 font-bold">Tidak ada transaksi yang cocok.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    @if($transactions->hasPages())
                        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                            {{ $transactions->links() }}
                        </div>
                    @endif
                </div>

            </main>
        </div>

        <!-- 3. Transaction Detail Modal -->
        <div x-show="showModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6" 
             style="display: none;">
            
            <!-- Modal Container -->
            <div x-show="showModal"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="scale-95 translate-y-4"
                 x-transition:enter-end="scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="scale-100 translate-y-0"
                 x-transition:leave-end="scale-95 translate-y-4"
                 @click.away="showModal = false"
                 class="bg-white rounded-3xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6 sm:p-8 shadow-2xl relative">
                
                <!-- Header -->
                <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                    <div>
                        <h3 class="font-outfit font-extrabold text-lg text-slate-900">Rincian Transaksi</h3>
                        <p class="text-xs text-slate-400 mt-1">ID Pemesanan: <span class="font-mono font-bold text-slate-800" x-text="activeTx.order_id"></span></p>
                    </div>
                    <button @click="showModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Info Sections -->
                <div class="space-y-6">
                    <!-- section 1: Pemesanan & Pembayaran -->
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Pemesanan & Midtrans</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                            <div>
                                <span class="text-slate-400 block mb-0.5">Snap Token</span>
                                <span class="font-mono font-bold text-slate-800" x-text="activeTx.snap_token"></span>
                            </div>
                            <div>
                                <span class="text-slate-400 block mb-0.5">Metode Bayar</span>
                                <span class="font-bold text-slate-800 uppercase" x-text="activeTx.payment_type"></span>
                            </div>
                            <div>
                                <span class="text-slate-400 block mb-0.5">Waktu Dibuat</span>
                                <span class="font-bold text-slate-800" x-text="activeTx.created_at"></span>
                            </div>
                            <div>
                                <span class="text-slate-400 block mb-0.5">Waktu Terupdate</span>
                                <span class="font-bold text-slate-800" x-text="activeTx.updated_at"></span>
                            </div>
                        </div>
                    </div>

                    <!-- section 2: Info Siswa -->
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Info Siswa / Pembeli</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                            <div>
                                <span class="text-slate-400 block mb-0.5">ID Siswa</span>
                                <span class="font-bold text-slate-800" x-text="'#' + activeTx.student_id"></span>
                            </div>
                            <div>
                                <span class="text-slate-400 block mb-0.5">Status Akun</span>
                                <span class="inline-flex items-center gap-1 font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100" x-text="activeTx.student_status"></span>
                            </div>
                            <div class="col-span-1 sm:col-span-2">
                                <span class="text-slate-400 block mb-0.5">Nama Lengkap</span>
                                <span class="font-bold text-slate-800 text-sm" x-text="activeTx.student_name"></span>
                            </div>
                            <div class="col-span-1 sm:col-span-2">
                                <span class="text-slate-400 block mb-0.5">Email</span>
                                <span class="font-bold text-slate-800" x-text="activeTx.student_email"></span>
                            </div>
                        </div>
                    </div>

                    <!-- section 3: Rincian Kelas -->
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Rincian Kelas</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                            <div class="col-span-1 sm:col-span-2">
                                <span class="text-slate-400 block mb-0.5">Judul Kelas</span>
                                <span class="font-bold text-slate-800 text-sm" x-text="activeTx.course_title"></span>
                            </div>
                            <div>
                                <span class="text-slate-400 block mb-0.5">Harga Asli</span>
                                <span class="font-bold text-slate-800" x-text="activeTx.course_price"></span>
                            </div>
                            <div>
                                <span class="text-slate-400 block mb-0.5">Nominal Bayar</span>
                                <span class="font-extrabold text-slate-900 text-sm" x-text="activeTx.amount"></span>
                            </div>
                        </div>
                    </div>

                    <!-- section 4: Webhook Status History -->
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Riwayat Webhook Midtrans</h4>
                        
                        <!-- Timeline -->
                        <div class="relative pl-6 border-l-2 border-slate-200/80 space-y-4 ml-2 text-xs">
                            <div class="relative">
                                <div class="absolute -left-[31px] top-0.5 w-3.5 h-3.5 rounded-full bg-indigo-600 border-2 border-white shadow-sm"></div>
                                <span class="font-bold text-slate-800 block">Transaksi Dibuat</span>
                                <span class="text-slate-400 text-[10px]" x-text="activeTx.created_at"></span>
                            </div>
                            
                            <!-- If pending / paid -->
                            <div class="relative" x-show="activeTx.status === 'pending' || activeTx.status === 'paid'">
                                <div class="absolute -left-[31px] top-0.5 w-3.5 h-3.5 rounded-full border-2 border-white shadow-sm"
                                     :class="activeTx.status === 'pending' ? 'bg-amber-500 animate-pulse' : 'bg-slate-400'"></div>
                                <span class="font-bold text-slate-800 block">Menunggu Pembayaran (Notification Pending)</span>
                                <span class="text-slate-400 text-[10px]" x-text="activeTx.updated_at"></span>
                            </div>

                            <!-- If paid -->
                            <div class="relative" x-show="activeTx.status === 'paid'">
                                <div class="absolute -left-[31px] top-0.5 w-3.5 h-3.5 rounded-full bg-emerald-500 border-2 border-white shadow-sm"></div>
                                <span class="font-bold text-emerald-600 block">Lunas (Notification Settlement)</span>
                                <span class="text-slate-400 text-[10px]" x-text="activeTx.updated_at"></span>
                            </div>

                            <!-- If failed / expired -->
                            <div class="relative" x-show="activeTx.status !== 'pending' && activeTx.status !== 'paid'">
                                <div class="absolute -left-[31px] top-0.5 w-3.5 h-3.5 rounded-full bg-red-500 border-2 border-white shadow-sm"></div>
                                <span class="font-bold text-red-600 block" x-text="'Transaksi Gagal / Kadaluarsa (' + activeTx.status + ')'"></span>
                                <span class="text-slate-400 text-[10px]" x-text="activeTx.updated_at"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hidden Override Forms -->
                <form id="approve-form" method="POST" :action="activeTx.approve_url" class="hidden">
                    @csrf
                </form>
                <form id="cancel-form" method="POST" :action="activeTx.cancel_url" class="hidden">
                    @csrf
                </form>

                <!-- Actions / Overrides -->
                <div x-show="activeTx.status === 'pending'" class="flex gap-3 justify-end border-t border-slate-100 pt-6 mt-6">
                    <button type="button" @click="if (confirm('Apakah Anda yakin ingin membatalkan transaksi ini?')) { document.getElementById('cancel-form').submit(); }" class="px-5 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 font-extrabold text-sm rounded-xl transition-colors">
                        Batalkan Transaksi
                    </button>
                    <button type="button" @click="if (confirm('Apakah Anda yakin ingin memverifikasi transaksi ini secara manual dan otomatis mendaftarkan siswa ke kelas?')) { document.getElementById('approve-form').submit(); }" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-sm rounded-xl transition-colors shadow-md shadow-emerald-600/10">
                        Verifikasi Manual (Set Lunas)
                    </button>
                </div>

                <div x-show="activeTx.status !== 'pending'" class="flex justify-end border-t border-slate-100 pt-6 mt-6">
                    <button type="button" @click="showModal = false" class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-extrabold text-sm rounded-xl transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
