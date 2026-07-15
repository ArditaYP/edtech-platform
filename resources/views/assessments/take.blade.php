<x-layouts.app>
    <div class="relative bg-gradient-to-b from-white via-sky-50/20 to-slate-50 text-slate-800 pt-32 pb-24 overflow-hidden min-h-screen">
        <!-- Decorative glowing backgrounds -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-indigo-100/50 rounded-full blur-[100px] pointer-events-none -z-10"></div>
        <div class="absolute bottom-10 left-1/4 w-[500px] h-[500px] bg-sky-100/40 rounded-full blur-[120px] pointer-events-none -z-10"></div>

        <div class="max-w-3xl mx-auto px-4 relative z-10">
            <!-- Header Card -->
            <div class="bg-white border border-slate-200/80 rounded-3xl p-8 sm:p-10 shadow-xl shadow-slate-100/60 mb-10">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-xs font-bold text-indigo-600 mb-4 uppercase tracking-wider">
                    Interactive Assessment
                </span>
                <h1 class="font-outfit text-3xl font-extrabold text-slate-900 leading-tight">{{ $course->title }}</h1>
                <p class="text-sm text-slate-500 mt-2">
                    Jawablah 10 pertanyaan berikut secara jujur sesuai kepribadianmu. Tidak ada jawaban benar atau salah.
                </p>
                <div class="w-full bg-slate-100 rounded-full h-2 mt-6">
                    <div class="bg-indigo-600 h-2 rounded-full" style="width: 10%"></div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('assessments.submit', $course->slug) }}" method="POST" class="space-y-8">
                @csrf

                @foreach($questions as $index => $question)
                    <div x-data="{ selectedOption: null }" class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm transition-all duration-300">
                        <div class="flex items-start gap-4 mb-6">
                            <span class="w-8 h-8 rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center font-extrabold text-sm shrink-0">
                                {{ $index + 1 }}
                            </span>
                            <h3 class="font-outfit font-bold text-slate-800 text-base sm:text-lg leading-relaxed mt-0.5">
                                {{ $question->question_text }}
                            </h3>
                        </div>

                        <!-- 4 Options Grid -->
                        <div class="grid grid-cols-1 gap-3">
                            @foreach($question->options as $option)
                                <label :class="selectedOption == '{{ $option->id }}' ? 'border-indigo-500 ring-2 ring-indigo-500/20 bg-indigo-50/20' : 'border-slate-200 bg-slate-50/50 hover:bg-slate-100/50'"
                                    class="relative flex items-start gap-3.5 p-4 border rounded-2xl cursor-pointer select-none transition-all group active:scale-[0.99]">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" required
                                        @change="selectedOption = '{{ $option->id }}'"
                                        class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded-full cursor-pointer mt-0.5 accent-indigo-600">
                                    <span class="text-sm font-semibold text-slate-600 group-hover:text-slate-900 transition-colors leading-relaxed">
                                        {{ $option->option_text }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- Submit Button Area -->
                <div class="text-center pt-4">
                    <button type="submit"
                        class="px-10 py-4 bg-slate-900 hover:bg-indigo-600 text-white font-extrabold rounded-2xl text-sm transition-all shadow-md shadow-indigo-600/5 hover:shadow-indigo-600/20 hover:-translate-y-0.5 active:translate-y-0 inline-flex items-center gap-2">
                        Selesai & Lihat Hasil Karirku 🚀
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-layouts.app>
