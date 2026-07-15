<div class="my-16">
    <!-- Header & Interactive Search -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
        <div>
            <span class="text-xs font-semibold text-indigo-600 tracking-wider uppercase">Katalog Program</span>
            <h2 class="font-outfit text-3xl font-extrabold text-slate-900 mt-1">Jelajahi Kelas Spesialisasi</h2>
            <p class="text-sm text-slate-500 mt-1">Temukan kurikulum standar industri dunia yang dirancang oleh praktisi ahli.</p>
        </div>

        <!-- Real-Time Search Bar -->
        <div class="relative w-full md:max-w-md group">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input wire:model.live="search" type="text" placeholder="Cari nama atau topik kelas..." class="w-full pl-11 pr-10 py-3 bg-white border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/20 text-sm shadow-sm transition-all">
            
            <!-- Livewire Loading Spinner -->
            <div wire:loading class="absolute inset-y-0 right-0 pr-3.5 flex items-center">
                <svg class="animate-spin h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Horizontal Category Filter Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-10 border-b border-slate-100 scrollbar-thin">
        <button wire:click="selectCategory(null)" 
            class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all whitespace-nowrap {{ is_null($selectedCategory) ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/10' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
            Semua Kelas
        </button>

        @foreach ($categories as $cat)
            <button wire:click="selectCategory({{ $cat->id }})" 
                class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all whitespace-nowrap flex items-center gap-2 {{ $selectedCategory == $cat->id ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/10' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                <!-- Category Icon dynamically rendered -->
                @if ($cat->icon === 'code-bracket')
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" /></svg>
                @elseif ($cat->icon === 'device-phone-mobile')
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-6 18.75h12" /></svg>
                @elseif ($cat->icon === 'cloud')
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z" /></svg>
                @elseif ($cat->icon === 'cpu-chip')
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m1.5 7.5H3m15-7.5h1.5m-1.5 7.5h1.5m-11.25.75v1.5m6-9v1.5m-6 6v1.5m6-7.5v1.5m-9-3h12a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0018 4.5H6a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 006 18.75zm3-10.5h6a1.5 1.5 0 011.5 1.5v6a1.5 1.5 0 01-1.5 1.5H9a1.5 1.5 0 01-1.5-1.5v-6a1.5 1.5 0 011.5-1.5z" /></svg>
                @endif
                {{ $cat->name }}
            </button>
        @endforeach
    </div>

    <!-- Course Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse ($courses as $course)
            <div class="bg-white border border-slate-200/80 rounded-3xl p-6 flex flex-col justify-between hover:shadow-xl hover:shadow-slate-100 hover:-translate-y-1 transition-all duration-300 group">
                <div>
                    <!-- Card Top: Category Icon & Level Badge -->
                    <div class="flex items-center justify-between gap-2 mb-5">
                        <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center">
                            @if ($course->category->icon === 'code-bracket')
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" /></svg>
                            @elseif ($course->category->icon === 'device-phone-mobile')
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-6 18.75h12" /></svg>
                            @elseif ($course->category->icon === 'cloud')
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z" /></svg>
                            @elseif ($course->category->icon === 'cpu-chip')
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m1.5 7.5H3m15-7.5h1.5m-1.5 7.5h1.5m-11.25.75v1.5m6-9v1.5m-6 6v1.5m6-7.5v1.5m-9-3h12a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0018 4.5H6a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 006 18.75zm3-10.5h6a1.5 1.5 0 011.5 1.5v6a1.5 1.5 0 01-1.5 1.5H9a1.5 1.5 0 01-1.5-1.5v-6a1.5 1.5 0 011.5-1.5z" /></svg>
                            @endif
                        </div>

                        <!-- Level Badge dynamic colors -->
                        @if ($course->level === 'Pemula')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">Pemula</span>
                        @elseif ($course->level === 'Menengah')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-600 border border-sky-100">Menengah</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-50 text-purple-600 border border-purple-100">Mahir</span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h3 class="font-outfit text-xl font-bold text-slate-800 mb-2 leading-snug group-hover:text-indigo-600 transition-colors">
                        {{ $course->title }}
                    </h3>

                    <!-- Description -->
                    <p class="text-sm text-slate-500 line-clamp-3 mb-6 leading-relaxed">
                        {{ $course->description }}
                    </p>
                </div>

                <!-- Card Bottom Info -->
                <div class="pt-5 border-t border-slate-100">
                    <div class="flex items-center justify-between gap-4 mb-5">
                        <!-- Duration -->
                        <div class="flex items-center gap-1.5 text-xs font-semibold text-slate-500">
                            <svg class="w-4.5 h-4.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ $course->duration_hours }} Jam Belajar
                        </div>

                        <!-- Rating SVG Stars -->
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-amber-500 fill-amber-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-xs font-extrabold text-slate-800">{{ $course->rating }}</span>
                            <span class="text-xs text-slate-400 font-medium">({{ number_format($course->total_students) }} siswa)</span>
                        </div>
                    </div>

                    <!-- CTA Action Button -->
                    <a href="{{ route('courses.show', $course->slug) }}" class="block w-full text-center bg-slate-900 hover:bg-indigo-600 text-white font-bold py-3 rounded-2xl text-sm transition-all shadow-sm group-hover:shadow-md shadow-indigo-600/5 group-hover:shadow-indigo-600/10">
                        Lihat Detail Kelas
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-3 text-center py-16 bg-white border border-slate-100 rounded-3xl">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                </svg>
                <h4 class="text-lg font-bold text-slate-800 mb-1">Kelas Tidak Ditemukan</h4>
                <p class="text-sm text-slate-400 max-w-sm mx-auto">Kami tidak dapat menemukan kelas dengan filter atau kata kunci "{{ $search }}". Coba cari kata kunci lainnya.</p>
            </div>
        @endforelse
    </div>
</div>
