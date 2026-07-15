<header x-data="{ open: false }" class="border-b border-slate-200/60 backdrop-blur-md sticky top-0 z-50 bg-white/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <!-- Left: Logo -->
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 via-indigo-600 to-sky-400 flex items-center justify-center shadow-md shadow-indigo-500/10">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <a href="/" class="font-outfit font-bold text-xl tracking-tight bg-gradient-to-r from-slate-900 via-slate-800 to-slate-600 bg-clip-text text-transparent">
                Edtech<span class="text-indigo-600">Platform</span>
            </a>
        </div>

        <!-- Middle: Navigation Links (Desktop) -->
        <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
            <a href="#" class="hover:text-indigo-600 transition-colors">Jalur Belajar</a>
            <a href="#" class="hover:text-indigo-600 transition-colors">Kelas</a>
            <a href="#" class="hover:text-indigo-600 transition-colors">Langganan</a>
            <a href="#" class="hover:text-indigo-600 transition-colors">Tentang Kami</a>
        </nav>

        <!-- Right: Actions (Desktop) -->
        <div class="hidden md:flex items-center gap-4">
            @auth
                <!-- Dropdown Profil -->
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-2 text-slate-700 hover:text-indigo-600 transition-colors focus:outline-none py-1">
                        <!-- Simple Avatar representation -->
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-indigo-500 to-sky-400 flex items-center justify-center text-white font-extrabold text-xs shadow-sm">
                            {{ substr(auth()->user()->name, 0, 2) }}
                        </div>
                        <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>
                        <!-- Down Arrow Icon -->
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white border border-slate-200/80 rounded-2xl shadow-xl py-2 z-50">
                        <div class="px-4 py-2 border-b border-slate-100 mb-1">
                            <p class="text-xs text-slate-400 font-medium">Masuk sebagai</p>
                            <p class="text-xs text-slate-800 font-bold truncate">{{ auth()->user()->email }}</p>
                        </div>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-indigo-600 hover:bg-indigo-50 transition-colors font-bold">Dashboard Admin</a>
                        @endif
                        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}" class="block px-4 py-2 text-sm text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors font-medium">Dashboard Saya</a>
                        
                        <!-- Logout form -->
                        <form action="{{ route('logout') }}" method="POST" class="border-t border-slate-100 mt-1">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-semibold">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 px-4 py-2 border border-slate-200 hover:border-slate-300 rounded-xl transition-colors">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/20 transition-all hover:-translate-y-0.5">
                    Daftar
                </a>
            @endauth
        </div>
 
         <!-- Hamburger Icon (Mobile) -->
         <div class="flex items-center md:hidden">
             <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-slate-900 hover:bg-slate-100 focus:outline-none transition-colors" aria-controls="mobile-menu" aria-expanded="false">
                 <span class="sr-only">Open main menu</span>
                 <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                 </svg>
                 <svg x-show="open" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                 </svg>
             </button>
         </div>
     </div>
 
     <!-- Mobile Menu -->
     <div x-show="open" x-cloak @click.away="open = false" class="md:hidden border-t border-slate-200/60 bg-white/95 backdrop-blur-lg" id="mobile-menu">
         <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
             <a href="#" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">Jalur Belajar</a>
             <a href="#" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">Kelas</a>
             <a href="#" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">Langganan</a>
             <a href="#" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">Tentang Kami</a>
         </div>
         <div class="pt-4 pb-4 border-t border-slate-200/60 px-5 flex flex-col gap-3">
             @auth
                 <div class="flex items-center gap-3 px-3 py-2">
                     <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-sky-400 flex items-center justify-center text-white font-extrabold text-sm shadow-sm">
                         {{ substr(auth()->user()->name, 0, 2) }}
                     </div>
                     <div class="text-left">
                         <h4 class="font-bold text-sm text-slate-800 leading-none mb-1">{{ auth()->user()->name }}</h4>
                         <p class="text-xs text-slate-400">{{ auth()->user()->email }}</p>
                     </div>
                 </div>
                 @if(auth()->user()->isAdmin())
                     <a href="{{ route('admin.dashboard') }}" class="w-full text-center px-4 py-2.5 bg-indigo-50 border border-indigo-200 text-indigo-600 rounded-xl text-sm font-bold transition-colors">
                         Dashboard Admin
                     </a>
                 @endif
                 <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}" class="w-full text-center px-4 py-2.5 border border-slate-200 text-slate-600 rounded-xl text-sm font-medium transition-colors">
                     Dashboard Saya
                 </a>
                 <form action="{{ route('logout') }}" method="POST" class="w-full">
                     @csrf
                     <button type="submit" class="w-full text-center bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors">
                         Keluar
                     </button>
                 </form>
             @else
                 <a href="{{ route('login') }}" class="w-full text-center px-4 py-2 border border-slate-200 hover:border-slate-300 text-slate-600 hover:text-slate-900 rounded-xl text-base font-medium transition-colors">
                     Masuk
                 </a>
                 <a href="{{ route('register') }}" class="w-full text-center bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-xl text-base font-semibold transition-all">
                     Daftar
                 </a>
             @endauth
         </div>
     </div>
 </header>
