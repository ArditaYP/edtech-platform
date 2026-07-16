<x-layouts.app>
    <div class="relative bg-gradient-to-b from-white via-sky-50/20 to-slate-50 text-slate-800 pt-32 pb-24 overflow-hidden min-h-screen">
        <!-- Decorative glowing backgrounds -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-indigo-100/50 rounded-full blur-[100px] pointer-events-none -z-10"></div>
        <div class="absolute bottom-10 left-1/4 w-[500px] h-[500px] bg-sky-100/40 rounded-full blur-[120px] pointer-events-none -z-10"></div>

        <div x-data="{ 
            currentQuestion: 1, 
            totalQuestions: {{ $questions->count() }},
            answers: {},
            get progressPercent() {
                let count = 0;
                for (let i = 1; i <= this.totalQuestions; i++) {
                    if (this.answers[i]) count++;
                }
                return Math.round((count / this.totalQuestions) * 100);
            },
            get answeredCount() {
                let count = 0;
                for (let i = 1; i <= this.totalQuestions; i++) {
                    if (this.answers[i]) count++;
                }
                return count;
            }
        }" class="max-w-3xl mx-auto px-4 relative z-10">
            
            <!-- Header Card -->
            <div class="bg-white border border-slate-200/80 rounded-3xl p-8 sm:p-10 shadow-xl shadow-slate-100/60 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-xs font-bold text-indigo-600 uppercase tracking-wider">
                            Interactive Career Assessment
                        </span>
                        <h1 class="font-outfit text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight mt-2">{{ $course->title }}</h1>
                    </div>
                    <div class="shrink-0 text-left sm:text-right">
                        <span class="text-xs font-bold text-slate-400 block uppercase">Progress</span>
                        <span class="font-outfit font-extrabold text-indigo-600 text-lg sm:text-xl" x-text="answeredCount + ' / ' + totalQuestions + ' Soal'">
                            0 / 50 Soal
                        </span>
                    </div>
                </div>
                
                <p class="text-sm text-slate-500">
                    Jawablah pertanyaan situasi kerja riil berikut secara jujur sesuai kepribadianmu. Tidak ada jawaban benar atau salah.
                </p>

                <!-- Progress Bar -->
                <div class="w-full bg-slate-100 rounded-full h-3 mt-6 overflow-hidden">
                    <div class="bg-indigo-600 h-3 rounded-full transition-all duration-300" :style="'width: ' + progressPercent + '%'"></div>
                </div>
                <div class="flex justify-between items-center mt-2 text-xs font-semibold text-slate-400">
                    <span x-text="progressPercent + '% Selesai'">0% Selesai</span>
                    <span>Komprehensif (50 Soal)</span>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('assessments.submit', $course->slug) }}" method="POST" class="space-y-6">
                @csrf

                @foreach($questions as $index => $question)
                    <div x-show="currentQuestion === {{ $index + 1 }}" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-md">
                        
                        <div class="flex items-start gap-4 mb-6">
                            <span class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center font-extrabold text-base shrink-0">
                                {{ $index + 1 }}
                            </span>
                            <h3 class="font-outfit font-bold text-slate-800 text-base sm:text-lg leading-relaxed mt-1">
                                {{ $question->question_text }}
                            </h3>
                        </div>

                        <!-- 4 Options Grid -->
                        <div class="grid grid-cols-1 gap-3.5">
                            @foreach($question->options as $option)
                                <label :class="answers[{{ $index + 1 }}] == '{{ $option->id }}' ? 'border-indigo-500 ring-2 ring-indigo-500/20 bg-indigo-50/20' : 'border-slate-200 bg-slate-50/50 hover:bg-slate-100/50'"
                                    class="relative flex items-start gap-3.5 p-4 border rounded-2xl cursor-pointer select-none transition-all group active:scale-[0.99]">
                                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" required
                                        @change="answers[{{ $index + 1 }}] = '{{ $option->id }}'; setTimeout(() => { if(currentQuestion < totalQuestions) currentQuestion++ }, 300)"
                                        :checked="answers[{{ $index + 1 }}] == '{{ $option->id }}'"
                                        class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded-full cursor-pointer mt-0.5 accent-indigo-600">
                                    <span class="text-sm font-semibold text-slate-600 group-hover:text-slate-900 transition-colors leading-relaxed">
                                        {{ $option->option_text }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- Navigation Buttons Area -->
                <div class="flex items-center justify-between pt-4">
                    <!-- Prev Button -->
                    <button type="button" 
                        x-show="currentQuestion > 1" 
                        @click="currentQuestion--"
                        class="px-6 py-3 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold rounded-2xl text-sm transition-all inline-flex items-center gap-2 shadow-sm">
                        ← Sebelumnya
                    </button>
                    <div x-show="currentQuestion === 1"></div> <!-- Spacer -->

                    <!-- Next Button -->
                    <button type="button" 
                        x-show="currentQuestion < totalQuestions" 
                        @click="currentQuestion++"
                        :disabled="!answers[currentQuestion]"
                        :class="!answers[currentQuestion] ? 'opacity-50 cursor-not-allowed bg-slate-100 text-slate-400' : 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-md shadow-indigo-600/10'"
                        class="px-6 py-3 font-bold rounded-2xl text-sm transition-all inline-flex items-center gap-2">
                        Selanjutnya →
                    </button>

                    <!-- Submit Button (only on last question) -->
                    <button type="submit"
                        x-show="currentQuestion === totalQuestions"
                        :disabled="answeredCount < totalQuestions"
                        :class="answeredCount < totalQuestions ? 'opacity-50 cursor-not-allowed bg-slate-800 text-slate-400' : 'bg-slate-900 hover:bg-emerald-600 text-white shadow-md'"
                        class="px-8 py-3.5 font-extrabold rounded-2xl text-sm transition-all inline-flex items-center gap-2">
                        Selesai & Lihat Hasil Karirku 🚀
                    </button>
                </div>
                
                <!-- Answer Warning for Submit -->
                <div x-show="currentQuestion === totalQuestions && answeredCount < totalQuestions" class="text-center mt-3 text-xs text-rose-500 font-semibold">
                    ⚠️ Harap jawab seluruh 50 pertanyaan sebelum menyelesaikan tes. (Baru menjawab <span x-text="answeredCount"></span> soal)
                </div>
            </form>

        </div>
    </div>
</x-layouts.app>
