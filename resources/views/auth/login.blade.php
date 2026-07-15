<x-layouts.app>
    <div class="min-h-[calc(100vh-4rem)] flex flex-col lg:flex-row bg-white">
        
        <!-- Sisi Kiri (Branding & Motivasi - Hanya tampil di Desktop) -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-slate-900 via-slate-950 to-blue-950 text-white p-16 flex-col justify-between relative overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-500/10 rounded-full blur-[100px] pointer-events-none"></div>
            <div class="absolute bottom-10 left-10 w-[400px] h-[400px] bg-blue-500/10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute inset-0 bg-grid-pattern opacity-5 pointer-events-none"></div>

            <!-- Header: Logo -->
            <div class="flex items-center gap-3 relative z-10">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 via-indigo-600 to-sky-400 flex items-center justify-center shadow-md shadow-indigo-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <span class="font-outfit font-bold text-xl tracking-tight text-white">Edtech<span class="text-indigo-400">Platform</span></span>
            </div>

            <!-- Middle: Quote -->
            <div class="max-w-lg my-auto relative z-10">
                <span class="text-indigo-400 text-xs font-bold tracking-widest uppercase mb-4 block">Kutipan Hari Ini</span>
                <blockquote class="font-outfit text-3xl font-extrabold text-white leading-relaxed mb-8">
                    "Belajar coding bukan tentang menghafal sintaks, tapi tentang memecahkan masalah masa depan."
                </blockquote>
                <div class="w-16 h-1.5 bg-indigo-500 rounded-full"></div>
            </div>

            <!-- Bottom: Community stats -->
            <div class="flex items-center gap-3 relative z-10 text-slate-300 text-sm font-semibold">
                <span class="flex h-3 w-3 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-indigo-500"></span>
                </span>
                <span>🚀 Bergabung dengan &gt;100.000 developer lainnya.</span>
            </div>
        </div>

        <!-- Sisi Kanan (Form Login) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-16 lg:p-20 relative">
            <div class="max-w-md w-full">
                
                <!-- Header -->
                <div class="mb-8">
                    <h2 class="font-outfit text-3xl font-extrabold text-slate-900 leading-tight">Selamat Datang Kembali! 👋</h2>
                    <p class="text-slate-500 text-sm mt-2">Masuk ke akunmu untuk melanjutkan belajar.</p>
                </div>

                <!-- Error Badges / Alert -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200/80 rounded-2xl flex gap-3 text-red-700 text-sm font-medium">
                        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <p class="font-bold text-red-800">Ada kendala masuk:</p>
                            <ul class="list-disc pl-4 mt-1 text-xs text-red-600 space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                                class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none text-sm transition-all"
                                placeholder="nama@email.com">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Kata Sandi</label>
                        </div>
                        <div x-data="{ show: false }" class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input :type="show ? 'text' : 'password'" name="password" id="password" required
                                class="w-full pl-12 pr-12 py-3.5 bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none text-sm transition-all"
                                placeholder="••••••••">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                <svg x-show="!show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="show" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="flex items-center justify-between text-xs sm:text-sm font-semibold">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded cursor-pointer">
                            <label for="remember" class="ml-2 text-slate-500 cursor-pointer select-none">
                                Ingat Saya
                            </label>
                        </div>
                        <a href="#" class="text-indigo-600 hover:text-indigo-500 transition-colors">Lupa Kata Sandi?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-slate-900 hover:bg-indigo-600 text-white font-extrabold py-4 rounded-2xl text-sm transition-all shadow-md shadow-slate-900/10 hover:shadow-indigo-600/20 hover:-translate-y-0.5 active:translate-y-0">
                        Masuk ke Akun
                    </button>
                </form>

                <!-- Social Login Separator -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-slate-200/60"></div>
                    </div>
                    <div class="relative flex justify-center text-xs font-bold uppercase tracking-wider">
                        <span class="bg-white px-4 text-slate-400">Atau masuk dengan</span>
                    </div>
                </div>

                <!-- Google Sign In Button -->
                <a href="#" class="flex items-center justify-center gap-3 w-full py-3.5 px-4 rounded-2xl border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-sm transition-all">
                    <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24">
                        <path fill="#ea4335" d="M12 5.04c1.66 0 3.2.57 4.38 1.69l3.27-3.27C17.67 1.58 14.98 1 12 1 7.35 1 3.39 3.65 1.5 7.5l3.92 3.04c.92-2.76 3.5-4.5 6.58-4.5z"/>
                        <path fill="#4285f4" d="M23.49 12.27c0-.81-.07-1.59-.2-2.36H12v4.51h6.46c-.28 1.48-1.12 2.73-2.38 3.58l3.69 2.87c2.16-1.99 3.72-4.92 3.72-8.6z"/>
                        <path fill="#fbbc05" d="M5.42 10.54A7.22 7.22 0 005 12c0 .51.08 1.01.24 1.49l-3.92 3.04A11.956 11.956 0 011 12c0-1.63.32-3.18.9-4.62l3.52 3.16z"/>
                        <path fill="#34a853" d="M12 23c3.24 0 5.97-1.07 7.96-2.92l-3.69-2.87c-1.02.68-2.33 1.09-3.97 1.09-3.08 0-5.66-1.74-6.58-4.5H1.26l3.92 3.04c1.89 3.85 5.85 6.5 10.82 6.5z"/>
                    </svg>
                    <span>Masuk dengan Google</span>
                </a>

                <!-- Footer Link -->
                <div class="mt-8 text-center text-xs sm:text-sm font-semibold">
                    <p class="text-slate-500">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-500 transition-colors font-extrabold">Daftar sekarang</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
