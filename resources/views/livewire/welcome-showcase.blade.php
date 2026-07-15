<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Livewire Join Section (Reactive Interaction) -->
    <div class="text-center max-w-xl mx-auto mb-16 p-8 bg-slate-50 border border-slate-100 rounded-3xl shadow-sm">
        <h3 class="text-lg font-bold text-slate-800 mb-2 font-outfit">Siap Bergabung dengan Edtech?</h3>
        <p class="text-sm text-slate-500 mb-6 leading-relaxed">
            Dapatkan akses penuh ke kurikulum, proyek, dan jaringan karir alumni kami secara instan.
        </p>

        <div class="inline-flex flex-col items-center gap-3">
            @if ($isJoined)
                <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 px-6 py-3 rounded-2xl text-sm font-semibold flex items-center gap-2 shadow-sm transition-all">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('message') }}
                </div>
            @else
                <button wire:click="joinPlatform" class="group relative px-8 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-2xl shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/20 transition-all hover:-translate-y-0.5 active:translate-y-0 overflow-hidden">
                    <span class="relative z-10">Daftar Sekarang</span>
                </button>
            @endif

            <span class="text-xs text-slate-400 font-medium">
                Bergabunglah bersama <strong class="text-slate-600">{{ number_format($joinedCount) }}</strong> developer lainnya
            </span>
        </div>
    </div>

    <!-- Livewire Course Catalog Simulator (Reactivity Demo) -->
    <div class="bg-white border border-slate-200/80 rounded-3xl p-8 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold mb-1 font-outfit text-slate-800">Katalog Kelas Interaktif</h2>
                <p class="text-sm text-slate-500">Gunakan pencarian instan untuk menjelajahi kurikulum berstandar industri.</p>
            </div>
            
            <!-- Search bar -->
            <div class="relative max-w-sm w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input wire:model.live="search" type="text" placeholder="Cari nama kelas..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200/80 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:bg-white text-sm transition-colors">
                
                <!-- Livewire Loading indicator -->
                <div wire:loading class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <svg class="animate-spin h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Course Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($filteredCourses as $course)
                <div class="bg-white border border-slate-200/80 rounded-2xl p-6 flex flex-col justify-between hover:border-indigo-500/40 hover:shadow-md hover:shadow-slate-100/50 transition-all">
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-4">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-indigo-500/10 text-indigo-600 border border-indigo-500/20">
                                {{ $course['category'] }}
                            </span>
                            <span class="text-xs text-slate-400 font-medium">
                                {{ $course['level'] }}
                            </span>
                        </div>
                        <h4 class="font-bold text-lg text-slate-800 mb-2 leading-snug">
                            {{ $course['title'] }}
                        </h4>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-1.5 text-xs text-slate-500">
                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            {{ $course['students'] }} siswa
                        </div>
                        <span class="text-indigo-600 font-extrabold font-outfit">{{ $course['price'] }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-400">
                    <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tidak ada kelas yang cocok dengan pencarian Anda.
                </div>
            @endforelse
        </div>
    </div>
</div>
