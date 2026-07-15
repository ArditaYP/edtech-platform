<x-layouts.app>
    <div class="relative bg-gradient-to-b from-white via-sky-50/20 to-slate-50 text-slate-800 pt-32 pb-24 overflow-hidden min-h-[80vh] flex items-center justify-center">
        <!-- Decorative glowing backgrounds -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-indigo-100/50 rounded-full blur-[100px] pointer-events-none -z-10"></div>
        <div class="absolute bottom-10 left-1/4 w-[500px] h-[500px] bg-sky-100/40 rounded-full blur-[120px] pointer-events-none -z-10"></div>

        <div class="max-w-md w-full mx-auto px-4 relative z-10">
            <!-- Card Wrapper -->
            <div class="bg-white border border-slate-200/80 rounded-3xl p-8 sm:p-10 shadow-xl shadow-slate-100/60">
                
                <!-- Logo & Heading -->
                <div class="text-center mb-8">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-500 via-indigo-600 to-sky-400 flex items-center justify-center shadow-md shadow-indigo-500/10 mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h2 class="font-outfit text-2xl font-extrabold text-slate-900 leading-tight mb-2">Buat Akun Baru</h2>
                    <p class="text-xs text-slate-500">Mulai langkah pertamamu menguasai keahlian digital masa depan secara terarah.</p>
                </div>

                <!-- Form -->
                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                            class="w-full px-4 py-3 bg-slate-50 border @error('name') border-red-500 focus:border-red-500 focus:ring-red-500/20 @else border-slate-200 focus:border-indigo-500 focus:ring-indigo-500/20 @enderror rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 text-sm transition-all"
                            placeholder="John Doe">
                        @error('name')
                            <p class="mt-1.5 text-xs text-red-500 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 bg-slate-50 border @error('email') border-red-500 focus:border-red-500 focus:ring-red-500/20 @else border-slate-200 focus:border-indigo-500 focus:ring-indigo-500/20 @enderror rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 text-sm transition-all"
                            placeholder="nama@email.com">
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-500 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kata Sandi</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 bg-slate-50 border @error('password') border-red-500 focus:border-red-500 focus:ring-red-500/20 @else border-slate-200 focus:border-indigo-500 focus:ring-indigo-500/20 @enderror rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 text-sm transition-all"
                            placeholder="Min. 8 Karakter">
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-500 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 focus:border-indigo-500 focus:ring-indigo-500/20 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 text-sm transition-all"
                            placeholder="Ulangi Kata Sandi">
                    </div>

                    <!-- Terms checkbox -->
                    <div class="flex items-start">
                        <input id="terms" name="terms" type="checkbox" required checked
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded cursor-pointer mt-0.5">
                        <label for="terms" class="ml-2 block text-xs text-slate-500 font-medium cursor-pointer select-none">
                            Saya menyetujui <a href="#" class="text-indigo-600 hover:text-indigo-500 font-bold transition-colors">Ketentuan Layanan</a> dan <a href="#" class="text-indigo-600 hover:text-indigo-500 font-bold transition-colors">Kebijakan Privasi</a> platform.
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                        class="w-full bg-slate-900 hover:bg-indigo-600 text-white font-extrabold py-3.5 rounded-2xl text-sm transition-all shadow-md shadow-indigo-600/5 hover:shadow-indigo-600/15 hover:-translate-y-0.5 active:translate-y-0">
                        Daftar Akun Baru
                    </button>
                </form>

                <!-- Footer Link -->
                <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                    <p class="text-xs text-slate-500 font-medium">
                        Sudah memiliki akun? 
                        <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-500 transition-colors">Masuk di sini</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
