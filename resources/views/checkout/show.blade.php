<x-layouts.app>
    <div class="relative bg-gradient-to-b from-white via-sky-50/20 to-slate-50 text-slate-800 pt-32 pb-24 overflow-hidden min-h-[85vh] flex items-center justify-center">
        <!-- Decorative glowing backgrounds -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-indigo-100/50 rounded-full blur-[100px] pointer-events-none -z-10"></div>
        <div class="absolute bottom-10 left-1/4 w-[500px] h-[500px] bg-sky-100/40 rounded-full blur-[120px] pointer-events-none -z-10"></div>

        <div class="max-w-xl w-full mx-auto px-4 relative z-10">
            <!-- Checkout Card Wrapper -->
            <div class="bg-white border border-slate-200/80 rounded-3xl p-8 sm:p-10 shadow-xl shadow-slate-100/60">
                
                <!-- Heading -->
                <div class="text-center mb-8 border-b border-slate-100 pb-6">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-xs font-bold text-indigo-600 mb-3">
                        Langkah Terakhir Pembayaran
                    </span>
                    <h2 class="font-outfit text-2xl font-extrabold text-slate-900 leading-tight">Konfirmasi Pemesanan</h2>
                    <p class="text-xs text-slate-400 mt-1">Selesaikan pembayaran Anda untuk langsung membuka akses materi kelas.</p>
                </div>

                <!-- Order Details -->
                <div class="space-y-4 mb-8">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-start gap-4">
                        <!-- Thumbnail Mock -->
                        <div class="w-16 h-16 rounded-xl bg-gradient-to-tr from-indigo-500 to-sky-400 flex items-center justify-center text-white flex-shrink-0 font-extrabold font-outfit text-xl shadow-md">
                            {{ substr($course->title, 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-bold text-slate-800 text-sm sm:text-base truncate">{{ $course->title }}</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Tingkat: {{ $course->level }} • {{ $course->duration_hours }} Jam Belajar</p>
                        </div>
                    </div>

                    <!-- Payment Details Table -->
                    <div class="border border-slate-100 rounded-2xl p-5 space-y-3.5 text-sm font-medium">
                        <div class="flex justify-between items-center text-slate-400">
                            <span>ID Transaksi (Order ID)</span>
                            <span class="text-slate-700 font-bold select-all">{{ $transaction->order_id }}</span>
                        </div>
                        <div class="flex justify-between items-center text-slate-400">
                            <span>Metode Pembayaran</span>
                            <span class="text-slate-700 font-bold">Midtrans Snap (Secure Gateway)</span>
                        </div>
                        <div class="border-t border-slate-100 pt-3.5 flex justify-between items-center text-slate-800">
                            <span class="font-bold">Total Pembayaran</span>
                            <span class="text-indigo-600 font-extrabold text-lg">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Pay Button & Security Label -->
                <div class="space-y-4">
                    @if(config('midtrans.bypass') || $course->price == 0)
                        <form action="{{ route('checkout.process-bypass', $course->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $transaction->order_id }}">
                            <button type="submit" 
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold py-4 rounded-2xl text-sm transition-all shadow-md shadow-emerald-600/10 hover:shadow-emerald-600/25 hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                                <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                </svg>
                                ⚡ Simulasi Bayar &amp; Lanjut ke Tes (Bypass Mode)
                            </button>
                        </form>
                        
                        <p class="text-[10px] text-center text-rose-500 font-bold leading-normal max-w-xs mx-auto">
                            ⚠️ Mode Pengujian Aktif: Transaksi akan otomatis dicatat sebagai Lunas tanpa memotong saldo.
                        </p>
                    @else
                        <button id="pay-button" 
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold py-4 rounded-2xl text-sm transition-all shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/25 hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                            <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                            Bayar Sekarang via Midtrans
                        </button>
                        
                        <p class="text-[10px] text-center text-slate-400 font-medium leading-normal max-w-xs mx-auto">
                            🔒 Pembayaran Anda diproses secara aman menggunakan enkripsi SSL 256-bit berstandar internasional.
                        </p>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- Snap JS Integration -->
    @if(config('midtrans.is_production'))
        <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    @endif

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            const payButton = document.getElementById('pay-button');
            if (payButton) {
                payButton.addEventListener('click', function () {
                    // Trigger Snap Modal Popup
                    window.snap.pay('{{ $snapToken }}', {
                        onSuccess: function(result){
                            console.log('success', result);
                            alert("Pembayaran berhasil!");

                            // Call local endpoint to record success because webhook cannot call localhost
                            fetch("{{ route('checkout.simulate-success') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({
                                    order_id: "{{ $transaction->order_id }}"
                                })
                            }).then(response => {
                                window.location.href = "{{ $course->is_assessment ? route('assessments.take', $course->slug) : '/' }}";
                            });
                        },
                        onPending: function(result){
                            console.log('pending', result);
                            alert("Menunggu pembayaran Anda.");
                            window.location.reload();
                        },
                        onError: function(result){
                            console.log('error', result);
                            alert("Pembayaran gagal!");
                            window.location.reload();
                        },
                        onClose: function(){
                            console.log('customer closed the popup without finishing the payment');
                        }
                    });
                });
            }
        });
    </script>
</x-layouts.app>
