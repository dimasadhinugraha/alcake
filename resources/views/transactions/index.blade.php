@extends('layouts.app')

@section('title', 'Transaksi Pembayaran - Alva Cake')

@section('content')
<div class="p-8 bg-[#FFFBFD] min-h-full font-sans relative space-y-8">

    @if(session('success'))
    <div class="bg-green-50 text-green-700 p-4 rounded-2xl font-bold border border-green-100 flex items-center gap-3 shadow-sm">
        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>✨ {{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-gradient-to-r from-[#10B981] to-[#06B6D4] rounded-[2rem] p-8 shadow-md flex justify-between items-center relative overflow-hidden">
        <div class="relative z-10 flex items-start gap-5">
            <div class="bg-white/20 w-14 h-14 rounded-2xl flex items-center justify-center text-white shadow-inner mt-1 backdrop-blur-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <h1 class="text-4xl font-extrabold text-white mb-2">Transaksi Pembayaran</h1>
                <p class="text-emerald-50 font-medium text-sm">Sistem DP & Pelunasan Otomatis</p>
            </div>
        </div>
        <button onclick="openTransactionModal()" class="relative z-10 bg-white hover:bg-gray-50 text-[#059669] px-6 py-3 rounded-xl text-sm font-bold shadow-lg transition duration-300 flex items-center gap-2 cursor-pointer">
            <span class="text-lg leading-none">+</span> Buat Transaksi
        </button>
        <div class="absolute -right-10 -top-10 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-[#10B981] rounded-[2rem] p-6 shadow-md flex justify-between items-center text-white">
            <div><p class="text-emerald-100 text-sm font-bold mb-1">Total Pendapatan</p><h3 class="text-4xl font-extrabold">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h3></div>
            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm text-2xl font-bold">$</div>
        </div>
        <div class="bg-[#F59E0B] rounded-[2rem] p-6 shadow-md flex justify-between items-center text-white">
            <div><p class="text-orange-100 text-sm font-bold mb-1">Belum Lunas (Sisa)</p><h3 class="text-4xl font-extrabold">Rp {{ number_format($totalBelumLunas ?? 0, 0, ',', '.') }}</h3></div>
            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg></div>
        </div>
        <div class="bg-[#10B981] rounded-[2rem] p-6 shadow-md flex justify-between items-center text-white">
            <div><p class="text-emerald-100 text-sm font-bold mb-1">Lunas</p><h3 class="text-4xl font-extrabold">Rp {{ number_format($totalLunas ?? 0, 0, ',', '.') }}</h3></div>
            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg></div>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-emerald-100 overflow-hidden mt-8">
        <div class="bg-[#E6FFFA] p-6 border-b border-emerald-100 flex items-center gap-3">
            <div class="bg-[#10B981] w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            </div>
            <h2 class="text-xl font-bold text-[#047857]">Riwayat Transaksi</h2>
        </div>
        <div class="overflow-x-auto p-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[#059669] text-xs font-extrabold tracking-wider border-b-2 border-emerald-50">
                        <th class="py-5 pl-6">ID</th><th class="py-5">Tanggal</th><th class="py-5">Pelanggan</th><th class="py-5 text-center">Jenis</th><th class="py-5 text-center">Status</th><th class="py-5 w-56">Progress</th><th class="py-5 pr-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-bold text-gray-700">
                    @forelse($transactions ?? [] as $trx)
                    <tr class="border-b border-gray-50 hover:bg-emerald-50/30 transition">
                        <td class="py-5 pl-6 text-[#10B981]">#{{ $trx->id }}</td>
                        <td class="py-5">{{ $trx->payment_date ?? $trx->created_at->format('d M Y') }}</td>
                        <td class="py-5">{{ $trx->customer }}</td>
                        <td class="py-5 text-center">
                            @if($trx->type == 'Lunas') <span class="border border-emerald-200 text-emerald-600 bg-emerald-50 px-3 py-1 rounded-md text-xs flex items-center justify-center gap-1 w-fit mx-auto"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Lunas</span>
                            @else <span class="border border-orange-200 text-orange-500 bg-orange-50 px-3 py-1 rounded-md text-xs flex items-center justify-center gap-1 w-fit mx-auto"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> DP</span> @endif
                        </td>
                        <td class="py-5 text-center">
                            @if($trx->status == 'Lunas') <span class="border border-emerald-200 text-emerald-600 bg-emerald-50 px-3 py-1 rounded-md text-xs flex items-center justify-center gap-1 w-fit mx-auto"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Lunas</span>
                            @else <span class="border border-red-200 text-red-500 bg-red-50 px-3 py-1 rounded-md text-xs w-fit mx-auto block">Belum Lunas</span> @endif
                        </td>
                        <td class="py-5 pr-4">
                            <div class="flex justify-between text-xs font-extrabold mb-1.5">
                                <span class="text-gray-900">Rp {{ number_format($trx->paid, 0, ',', '.') }}</span>
                                <span class="text-gray-400">/ Rp {{ number_format($trx->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                @php $percent = $trx->total > 0 ? ($trx->paid / $trx->total) * 100 : 0; @endphp
                                <div class="bg-gray-900 h-1.5 rounded-full" style="width: {{ $percent }}%"></div>
                            </div>
                            @if($trx->paid < $trx->total)
                            <p class="text-[10px] text-orange-500 mt-1 font-extrabold">Sisa: Rp {{ number_format($trx->total - $trx->paid, 0, ',', '.') }}</p>
                            @endif
                        </td>
                        <td class="py-5 pr-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="openReceiptModal({{ json_encode($trx) }})" class="border border-gray-300 text-gray-600 hover:bg-gray-50 px-3 py-1.5 rounded-lg text-xs transition flex items-center justify-center gap-1.5 cursor-pointer font-bold">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg> Lihat
                                </button>
                                @if($trx->status == 'Belum Lunas')
                                <button onclick="openSettlementModal({{ json_encode($trx) }})" class="bg-[#10B981] hover:bg-[#059669] text-white border border-[#059669] px-3 py-1.5 rounded-lg text-xs transition flex items-center justify-center gap-1.5 cursor-pointer font-bold">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Lunasi
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-gray-400">Belum ada riwayat transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="trxModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900/50 backdrop-blur-sm py-10 transition-opacity">
    <div class="bg-white rounded-[2rem] w-full max-w-xl mx-4 shadow-2xl flex flex-col relative max-h-[95vh] overflow-hidden border-4 border-[#F0FDF4]">
        <div class="px-8 pt-8 pb-4 shrink-0 flex justify-between items-center relative z-10 bg-white">
            <div class="flex items-center gap-3">
                <span class="text-3xl">💳</span>
                <h2 class="text-2xl font-extrabold text-[#047857]">Buat Transaksi Pembayaran</h2>
            </div>
            <button onclick="closeTransactionModal()" class="w-8 h-8 rounded-full border border-gray-200 text-gray-400 hover:text-red-500 hover:border-red-200 hover:bg-red-50 flex items-center justify-center transition cursor-pointer">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <form action="{{ route('transactions.store') }}" method="POST" class="p-8 pt-2 overflow-y-auto custom-scrollbar">
            @csrf
            <div class="bg-[#F0FDF4] border border-emerald-200 rounded-2xl p-5 mb-6">
                <label class="block text-xs font-bold text-[#059669] mb-2 flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg> Pilih Pesanan</label>
                <div class="relative">
                    <select id="select_order" name="order_id" onchange="showOrderDetails()" required class="w-full bg-white border border-emerald-200 rounded-xl px-4 py-3.5 text-sm focus:ring-2 focus:ring-emerald-400 outline-none appearance-none cursor-pointer font-bold text-gray-800 shadow-sm">
                        <option value="">Pilih pesanan yang akan dibayar...</option>
                        @foreach($pendingOrders ?? [] as $order)
                            <option value="{{ $order->id }}" data-full="{{ json_encode($order) }}">{{ $order->id }} - {{ $order->customer }} - Rp {{ number_format($order->total, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-4 top-4 text-emerald-500 pointer-events-none"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg></div>
                </div>
            </div>

            <div id="payment_form_section" class="hidden space-y-6">
                <div class="border border-emerald-200 rounded-2xl p-6 relative">
                    <h3 class="absolute -top-3 left-4 bg-white px-2 text-sm font-bold text-[#047857] flex items-center gap-1"><span class="text-lg">📦</span> Detail Pesanan</h3>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div><p class="text-xs text-gray-400 font-bold mb-0.5">Pelanggan</p><p id="detail_customer" class="font-extrabold text-gray-900 text-lg">-</p></div>
                        <div><p class="text-xs text-gray-400 font-bold mb-0.5">Total Harga</p><p id="detail_total" class="font-extrabold text-[#059669] text-xl">-</p></div>
                        <div><p class="text-xs text-gray-400 font-bold mb-0.5">Tanggal Pesanan</p><p id="detail_order_date" class="font-bold text-gray-800">-</p></div>
                        <div><p class="text-xs text-orange-400 font-bold mb-0.5">Deadline</p><p id="detail_deadline" class="font-bold text-orange-600">-</p></div>
                    </div>
                    <div class="border-t border-gray-100 pt-3">
                        <p class="text-xs font-bold text-gray-800 mb-2">Produk:</p>
                        <div id="detail_products" class="space-y-1"></div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Tanggal Transaksi</label>
                        <input type="date" name="payment_date" id="input_trx_date" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-400 outline-none font-bold text-gray-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Jenis Pembayaran</label>
                        <select name="type" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-400 outline-none cursor-pointer font-bold text-gray-700 appearance-none">
                            <option value="Lunas">✓ Lunas</option>
                            <option value="DP">⏳ DP (Down Payment)</option>
                        </select>
                    </div>
                </div>

                <div class="bg-[#E6FFFA] border border-[#A7F3D0] rounded-2xl p-6">
                    <p class="text-[#047857] font-bold text-sm mb-3 flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Pembayaran</p>
                    <label class="block text-xs font-bold text-[#059669] mb-1.5">Jumlah Dibayar</label>
                    <input type="number" name="paid" min="0" required placeholder="0" class="w-full bg-white border border-emerald-200 rounded-xl px-4 py-3 text-lg focus:ring-2 focus:ring-emerald-400 outline-none mb-4 font-bold text-gray-800">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-800 font-bold">Total Pesanan:</span>
                        <span id="display_big_total" class="text-3xl font-extrabold text-[#059669]">Rp 0</span>
                    </div>
                </div>

                <div class="pt-2 flex gap-3">
                    <button type="submit" class="flex-1 bg-[#10B981] hover:bg-[#059669] text-white font-extrabold py-3.5 rounded-xl shadow-lg shadow-emerald-200 transition flex items-center justify-center gap-2 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg> Proses Pembayaran
                    </button>
                    <button type="button" onclick="closeTransactionModal()" class="w-1/3 bg-white border-2 border-gray-200 text-gray-600 hover:bg-gray-50 font-bold py-3.5 rounded-xl transition cursor-pointer">
                        Batal
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="receiptModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900/60 backdrop-blur-sm py-10 transition-opacity">
    <div class="bg-white rounded-[2rem] w-full max-w-md mx-4 shadow-2xl flex flex-col relative max-h-[95vh] overflow-hidden">
        <div class="px-7 pt-7 pb-4 shrink-0 flex justify-between items-center relative z-10 bg-white">
            <div class="flex items-center gap-3">
                <span class="text-2xl">🧾</span>
                <h2 class="text-xl font-extrabold text-[#047857]">Nota Pembayaran</h2>
            </div>
            <button onclick="closeReceiptModal()" class="w-8 h-8 rounded-full border border-gray-200 text-gray-400 hover:text-red-500 hover:border-red-200 hover:bg-red-50 flex items-center justify-center transition cursor-pointer">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <div class="p-7 pt-0 overflow-y-auto custom-scrollbar flex flex-col gap-6">
            <div class="border border-[#A7F3D0] rounded-2xl p-5 bg-[#F9FAFB]">
                <div class="grid grid-cols-2 gap-4">
                    <div><p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Nomor Transaksi</p><p id="rcpt_id" class="text-sm font-extrabold text-gray-900">-</p></div>
                    <div><p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Tanggal</p><p id="rcpt_date" class="text-sm font-extrabold text-gray-900">-</p></div>
                    <div><p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Pelanggan</p><p id="rcpt_customer" class="text-base font-extrabold text-[#059669]">-</p></div>
                    <div><p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Admin</p><p id="rcpt_admin" class="text-sm font-bold text-gray-700">-</p></div>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-extrabold text-gray-900 mb-3">Produk:</h3>
                <div id="rcpt_products" class="space-y-3"></div>
            </div>

            <div class="border-t-2 border-dashed border-gray-200 pt-4 flex justify-between items-center">
                <p class="text-lg font-extrabold text-gray-900">Total:</p>
                <p id="rcpt_total" class="text-lg font-extrabold text-gray-900">-</p>
            </div>

            <div class="bg-[#E6FFFA] border border-[#A7F3D0] rounded-2xl p-5 flex flex-col gap-3">
                <div id="rcpt_status_badge" class="w-fit text-xs font-bold px-3 py-1.5 rounded-lg flex items-center gap-1.5"></div>
                <div>
                    <p class="text-xs font-bold text-[#047857] mb-0.5">Total Dibayar:</p>
                    <p id="rcpt_paid" class="text-3xl font-black text-[#059669]">-</p>
                </div>
                <div><p class="text-[10px] text-emerald-600 font-medium">Tanggal Pembayaran: <span id="rcpt_pay_date" class="font-bold">-</span></p></div>
            </div>

            <button type="button" onclick="window.print()" class="w-full bg-[#059669] hover:bg-[#047857] text-white font-extrabold py-3.5 rounded-xl shadow-md transition flex items-center justify-center gap-2 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg> Cetak Nota
            </button>
        </div>
    </div>
</div>

<div id="settlementModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900/60 backdrop-blur-sm py-10 transition-opacity">
    <div class="bg-white rounded-[2rem] w-full max-w-md mx-4 shadow-2xl flex flex-col relative max-h-[95vh] overflow-hidden">
        <div class="px-7 pt-7 pb-2 shrink-0 flex justify-between items-center relative z-10 bg-white">
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-[#059669]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <h2 class="text-xl font-extrabold text-[#047857]">Pelunasan Pembayaran</h2>
                    <p class="text-xs text-[#059669] font-medium">Proses pelunasan sisa pembayaran DP</p>
                </div>
            </div>
            <button type="button" onclick="closeSettlementModal()" class="w-8 h-8 rounded-full text-gray-400 hover:text-red-500 transition cursor-pointer">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <form id="settlementForm" method="POST" class="p-7 overflow-y-auto custom-scrollbar flex flex-col gap-4">
            @csrf
            @method('PUT')

            <div class="bg-[#FFF9F5] border border-yellow-200 rounded-2xl p-5 relative">
                <h3 class="text-sm font-bold text-[#B45309] mb-3 flex items-center gap-1.5"><span class="text-lg">📦</span> Detail DP Sebelumnya</h3>
                <div class="grid grid-cols-2 gap-y-3">
                    <div><p class="text-[10px] text-gray-400 font-bold uppercase">Pelanggan</p><p id="stl_customer" class="text-sm font-extrabold text-gray-900">-</p></div>
                    <div><p class="text-[10px] text-gray-400 font-bold uppercase">Total Pesanan</p><p id="stl_total" class="text-sm font-extrabold text-gray-900">-</p></div>
                    <div><p class="text-[10px] text-gray-400 font-bold uppercase">DP Dibayar</p><p id="stl_dp_paid" class="text-sm font-extrabold text-[#059669]">-</p></div>
                    <div><p class="text-[10px] text-gray-400 font-bold uppercase">Tanggal DP</p><p id="stl_dp_date" class="text-sm font-bold text-gray-700">-</p></div>
                    <div class="col-span-2"><p class="text-[10px] text-gray-400 font-bold uppercase">Nota DP</p><p id="stl_dp_nota" class="text-sm font-bold text-gray-700">-</p></div>
                </div>
            </div>

            <div class="bg-white border-2 border-emerald-100 rounded-2xl p-5 relative">
                <h3 class="text-sm font-bold text-[#047857] mb-3 flex items-center gap-1.5"><span class="text-lg">💰</span> Detail Pelunasan</h3>
                <div class="mb-4">
                    <p class="text-sm font-bold text-gray-700 mb-1">Sisa Tagihan:</p>
                    <p id="stl_sisa" class="text-3xl font-black text-[#059669]">-</p>
                    <p class="text-[10px] text-gray-400 font-medium">Jumlah yang harus dibayar untuk melunasi pesanan ini</p>
                </div>
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-[#059669] mb-1">Tanggal Pelunasan <span class="text-red-500">*</span></label>
                        <input type="date" name="payment_date" id="stl_input_date" required class="w-full bg-gray-50 border border-emerald-200 rounded-xl px-3 py-2.5 text-sm outline-none font-bold text-gray-700 focus:ring-2 focus:ring-emerald-400">
                    </div>
                </div>
            </div>

            <div class="bg-[#F0F5FF] border border-blue-100 rounded-2xl p-4">
                <h3 class="text-xs font-bold text-blue-800 mb-2 flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg> Ringkasan Pembayaran:</h3>
                <div class="flex justify-between items-center text-xs mb-1"><span class="text-gray-600 font-medium">DP Sebelumnya:</span><span id="stl_sum_dp" class="font-bold text-gray-800">-</span></div>
                <div class="flex justify-between items-center text-xs mb-2 pb-2 border-b border-blue-200"><span class="text-gray-600 font-medium">Pelunasan Sekarang:</span><span id="stl_sum_now" class="font-bold text-gray-800">-</span></div>
                <div class="flex justify-between items-center text-sm"><span class="text-blue-900 font-extrabold">Total Pesanan:</span><span id="stl_sum_total" class="font-black text-blue-900">-</span></div>
            </div>

            <div class="bg-[#FFFBEB] border border-yellow-200 rounded-xl p-4">
                <p class="text-xs font-bold text-yellow-800 flex items-center gap-1 mb-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg> Perhatian:</p>
                <ul class="list-disc list-inside text-[10px] text-yellow-700 pl-1 space-y-1">
                    <li>Pastikan pelanggan telah melakukan pembayaran.</li>
                    <li>Status transaksi akan berubah menjadi LUNAS.</li>
                </ul>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeSettlementModal()" class="flex-1 bg-white border-2 border-gray-200 text-gray-600 hover:bg-gray-50 font-bold py-3.5 rounded-xl transition cursor-pointer">Batal</button>
                <button type="submit" class="w-[60%] bg-[#10B981] hover:bg-[#059669] text-white font-extrabold py-3.5 rounded-xl shadow-md transition flex items-center justify-center gap-2 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Proses Pelunasan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const formatRp = (num) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num);

    // --- JS MODAL 1: BUAT TRANSAKSI ---
    function openTransactionModal() {
        document.getElementById('trxModal').classList.remove('hidden');
        document.getElementById('input_trx_date').value = new Date().toISOString().split('T')[0];
    }
    function closeTransactionModal() {
        document.getElementById('trxModal').classList.add('hidden');
        document.getElementById('select_order').value = '';
        document.getElementById('payment_form_section').classList.add('hidden');
    }
    function showOrderDetails() {
        const select = document.getElementById('select_order');
        const formSection = document.getElementById('payment_form_section');

        if(select.value) {
            const orderData = JSON.parse(select.options[select.selectedIndex].getAttribute('data-full'));
            const formattedTotal = formatRp(orderData.total);

            document.getElementById('detail_customer').innerText = orderData.customer;
            document.getElementById('detail_total').innerText = formattedTotal;
            document.getElementById('detail_order_date').innerText = orderData.order_date;
            document.getElementById('detail_deadline').innerText = orderData.deadline;
            document.getElementById('display_big_total').innerText = formattedTotal;

            let productsHtml = '';
            orderData.products.forEach(p => {
                productsHtml += `<div class="flex justify-between items-center text-sm"><p class="font-bold text-gray-700 flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> ${p.name} ×${p.qty}</p><p class="text-[#059669] font-bold">${formatRp(p.price || p.subtotal)}</p></div>`;
            });
            document.getElementById('detail_products').innerHTML = productsHtml;
            formSection.classList.remove('hidden');
        } else {
            formSection.classList.add('hidden');
        }
    }

    // --- JS MODAL 2: NOTA PEMBAYARAN ---
    function openReceiptModal(trx) {
        document.getElementById('receiptModal').classList.remove('hidden');

        document.getElementById('rcpt_id').innerText = trx.id;
        document.getElementById('rcpt_date').innerText = trx.payment_date || trx.created_at || '-';
        document.getElementById('rcpt_customer').innerText = trx.customer;
        document.getElementById('rcpt_admin').innerText = trx.admin || 'Admin';
        document.getElementById('rcpt_total').innerText = formatRp(trx.total);
        document.getElementById('rcpt_paid').innerText = formatRp(trx.paid);
        document.getElementById('rcpt_pay_date').innerText = trx.payment_date || trx.created_at || '-';

        const badge = document.getElementById('rcpt_status_badge');
        if(trx.status === 'Lunas') {
            badge.className = 'w-fit text-xs font-bold px-3 py-1.5 rounded-lg flex items-center gap-1.5 bg-emerald-100 text-emerald-700 border border-emerald-200';
            badge.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Pembayaran Lunas';
        } else {
            badge.className = 'w-fit text-xs font-bold px-3 py-1.5 rounded-lg flex items-center gap-1.5 bg-orange-100 text-orange-700 border border-orange-200';
            badge.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Pembayaran DP (Down Payment)';
        }

        let productsHtml = '';
        if(trx.products && trx.products.length > 0) {
            trx.products.forEach(p => {
                productsHtml += `<div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl border border-gray-100"><p class="font-bold text-gray-700 text-sm">${p.name} <span class="text-gray-400 ml-1">×${p.qty}</span></p><p class="font-bold text-gray-900">${formatRp(p.subtotal || p.price)}</p></div>`;
            });
        } else {
            productsHtml = '<p class="text-xs text-gray-400 italic">Rincian produk tidak tersedia.</p>';
        }
        document.getElementById('rcpt_products').innerHTML = productsHtml;
    }
    function closeReceiptModal() {
        document.getElementById('receiptModal').classList.add('hidden');
    }

    // --- JS MODAL 3: PELUNASAN PEMBAYARAN ---
    function openSettlementModal(trx) {
        document.getElementById('settlementModal').classList.remove('hidden');
        document.getElementById('stl_input_date').value = new Date().toISOString().split('T')[0];

        // MENGUBAH ACTION FORM OTOMATIS SESUAI ID TRANSAKSI
        document.getElementById('settlementForm').action = '/transactions/' + trx.id + '/settle';

        const sisa = trx.total - trx.paid;

        document.getElementById('stl_customer').innerText = trx.customer;
        document.getElementById('stl_total').innerText = formatRp(trx.total);
        document.getElementById('stl_dp_paid').innerText = formatRp(trx.paid);
        document.getElementById('stl_dp_date').innerText = trx.payment_date || '-';
        document.getElementById('stl_dp_nota').innerText = trx.dp_nota || '-';

        document.getElementById('stl_sisa').innerText = formatRp(sisa);

        document.getElementById('stl_sum_dp').innerText = formatRp(trx.paid);
        document.getElementById('stl_sum_now').innerText = formatRp(sisa);
        document.getElementById('stl_sum_total').innerText = formatRp(trx.total);
    }
    function closeSettlementModal() {
        document.getElementById('settlementModal').classList.add('hidden');
    }
</script>
@endsection
