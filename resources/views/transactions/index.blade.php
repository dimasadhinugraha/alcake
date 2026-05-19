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

    <!-- Modal: Buat Transaksi -->
    <div id="trxModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm py-10 transition-opacity">
        <div class="bg-white rounded-[2rem] border-4 border-emerald-200 shadow-2xl p-8 w-full max-w-3xl max-h-[95vh] overflow-y-auto relative">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-extrabold text-emerald-900" style="font-family: Outfit, sans-serif;"> Buat Transaksi Pembayaran</h2>
                <button onclick="closeTransactionModal()" class="text-gray-500 hover:text-gray-700 text-3xl font-bold">&times;</button>
            </div>
            <form method="POST" action="{{ route('transactions.store') }}" class="space-y-6">
                @csrf
                <div class="p-6 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl border-2 border-emerald-200">
                    <label class="block text-sm font-bold text-emerald-900 mb-3">📋 Pilih Pesanan</label>
                    <select id="select_order" name="order_id" onchange="showOrderDetails()" required class="bg-white border-2 border-emerald-300 rounded-xl h-12 w-full px-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400">
                        <option value="">-- Pilih Pesanan --</option>
                        @foreach($pendingOrders as $order)
                        <option value="{{ $order->id }}" data-full="{{ json_encode(['customer' => $order->customer, 'total' => $order->total, 'order_date' => $order->order_date, 'deadline' => $order->deadline, 'products' => $order->products]) }}">
                            #{{ $order->id }} - {{ $order->customer }} - Rp {{ number_format($order->total, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Bagian Detail Pesanan (Hidden sampai ada yang dipilih) -->
                <div id="payment_form_section" class="hidden space-y-6">
                    <div class="p-6 bg-white border-2 border-emerald-200 rounded-2xl shadow-lg">
                        <h4 class="font-extrabold text-lg mb-4 text-emerald-900">📦 Detail Pesanan</h4>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-sm text-gray-600">Pelanggan</p>
                                <p id="detail_customer" class="font-bold text-lg">-</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Harga</p>
                                <p id="detail_total" class="font-extrabold text-2xl text-emerald-700">Rp 0</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Tanggal Pesanan</p>
                                <p id="detail_order_date" class="font-semibold">-</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Deadline</p>
                                <p id="detail_deadline" class="font-semibold text-orange-600">-</p>
                            </div>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-4">
                            <p class="font-semibold mb-2">Produk:</p>
                            <div id="detail_products" class="space-y-1"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-gray-900">Tanggal Transaksi</label>
                            <input type="date" name="payment_date" id="input_trx_date" class="bg-white border-2 border-emerald-200 rounded-xl h-12 w-full px-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400" required value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-gray-900">Jenis Pembayaran</label>
                            <select name="type" id="select_type" onchange="togglePaymentTypeDetails()" class="bg-white border-2 border-emerald-200 rounded-xl h-12 w-full px-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400">
                                <option value="Lunas" selected>✓ Lunas</option>
                                <option value="DP">💰 DP (Down Payment)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Lunas Details -->
                    <div id="lunas_details" class="p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border-2 border-green-200">
                        <h4 class="font-bold text-green-900 mb-4">✓ Pembayaran Lunas</h4>
                        <div class="p-4 bg-white rounded-xl border-2 border-green-300">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-900">Total Pembayaran:</span>
                                <span id="lunas_total_text" class="font-extrabold text-3xl text-green-700">Rp 0</span>
                            </div>
                        </div>
                        <input type="hidden" name="paid" id="lunas_paid_input" value="0">
                    </div>

                    <!-- DP Details -->
                    <div id="dp_details" class="hidden p-6 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl border-2 border-yellow-200">
                        <h4 class="font-bold text-yellow-900 mb-4">💰 Pembayaran DP</h4>
                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-yellow-900">Jumlah DP yang Dibayar</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-gray-500 font-bold">Rp</span>
                                <input type="number" id="dp_paid_input" name="paid" placeholder="0" class="w-full pl-12 pr-4 py-3 border-2 border-yellow-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-400 font-bold" min="1" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-2">
                        <button data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] text-primary-foreground hover:bg-primary/90 px-4 py-2 has-[&gt;svg]:px-3 flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 rounded-2xl h-14 text-lg font-extrabold" type="submit">
                            Proses Pembayaran
                        </button>
                        <button data-slot="button" onclick="closeTransactionModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] border bg-background text-foreground hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 px-4 py-2 has-[&gt;svg]:px-3 flex-1 rounded-2xl h-14 text-lg font-bold" type="button">
                            Batal
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Nota Pembayaran -->
    <div id="receiptModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="bg-white rounded-3xl border-2 border-emerald-200 shadow-2xl p-8 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-extrabold text-emerald-900">Nota Pembayaran</h2>
                <button onclick="closeReceiptModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <div class="space-y-4">
                <div id="rcpt_status_badge" class="w-fit text-xs font-bold px-3 py-1.5 rounded-lg"></div>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-xs text-gray-600 mb-1">No. Transaksi</p>
                        <p id="rcpt_id" class="font-bold text-emerald-900"></p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 mb-1">Tanggal Pembayaran</p>
                        <p id="rcpt_date" class="text-sm"></p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 mb-1">Pelanggan</p>
                        <p id="rcpt_customer" class="font-bold"></p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 mb-1">Admin</p>
                        <p id="rcpt_admin" class="text-sm"></p>
                    </div>
                </div>
                <hr class="border-gray-200">
                <div class="space-y-2">
                    <p class="text-xs font-bold text-gray-600 uppercase">Detail Produk</p>
                    <div id="rcpt_products" class="space-y-2"></div>
                </div>
                <hr class="border-gray-200">
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Pesanan:</span>
                        <span id="rcpt_total" class="font-bold"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jumlah Dibayar:</span>
                        <span id="rcpt_paid" class="font-bold text-emerald-600"></span>
                    </div>
                </div>
                <button onclick="closeReceiptModal()" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 rounded-xl mt-4">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Modal: Pelunasan -->
    <div id="settlementModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="bg-white rounded-3xl border-2 border-emerald-200 shadow-2xl p-8 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-extrabold text-emerald-900">Pelunasan Pembayaran</h2>
                <button onclick="closeSettlementModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <form id="settlementForm" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="space-y-3 p-6 bg-yellow-50 rounded-2xl border-2 border-yellow-200">
                    <p class="text-xs font-bold text-yellow-900 uppercase">Data Pembayaran DP</p>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-xs text-gray-600 mb-1">Pelanggan</p>
                            <p id="stl_customer" class="font-bold text-yellow-900"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600 mb-1">Total Pesanan</p>
                            <p id="stl_total" class="font-bold text-yellow-900"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600 mb-1">DP yang Dibayar</p>
                            <p id="stl_dp_paid" class="font-bold text-yellow-600"></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600 mb-1">Tanggal DP</p>
                            <p id="stl_dp_date" class="text-sm"></p>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-emerald-900">Sisa Pembayaran</label>
                    <p id="stl_sisa" class="text-2xl font-extrabold text-emerald-600 p-4 bg-emerald-50 rounded-xl border-2 border-emerald-200"></p>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-emerald-900">Tanggal Pelunasan</label>
                    <input type="date" id="stl_input_date" name="payment_date" class="w-full px-4 py-2 border-2 border-emerald-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-400">
                </div>

                <div class="grid grid-cols-3 gap-4 p-6 bg-emerald-50 rounded-2xl border-2 border-emerald-200 text-center">
                    <div>
                        <p class="text-xs text-gray-600 mb-2">DP (Sudah Bayar)</p>
                        <p id="stl_sum_dp" class="font-bold text-emerald-900"></p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 mb-2">Sekarang</p>
                        <p id="stl_sum_now" class="font-bold text-emerald-600"></p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 mb-2">Total</p>
                        <p id="stl_sum_total" class="font-bold text-emerald-900 text-lg"></p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-3 rounded-xl transition">
                        Lunasi Sekarang
                    </button>
                    <button type="button" onclick="closeSettlementModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 rounded-xl transition">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-8 py-6"><div class="space-y-8" style="font-family: &quot;DM Sans&quot;, sans-serif;"><div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-400 p-10 shadow-2xl" style="opacity: 1; transform: none;"><div class="absolute inset-0"><div class="absolute -top-20 -right-20 w-96 h-96 bg-white/10 rounded-full blur-3xl" style="transform: scale(1.11046) rotate(49.7055deg);"></div></div><div class="relative flex items-center justify-between"><div class="flex items-center gap-6"><div class="w-20 h-20 bg-white/20 backdrop-blur-xl rounded-[1.2rem] flex items-center justify-center shadow-2xl border border-white/30"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-receipt w-10 h-10 text-white"><path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z"></path><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"></path><path d="M12 17.5v-11"></path></svg></div><div><h1 class="text-5xl font-extrabold text-white drop-shadow-lg mb-2" style="font-family: Outfit, sans-serif;">Transaksi Pembayaran</h1><p class="text-white/90 text-lg font-medium">Sistem DP &amp; Pelunasan Otomatis</p></div></div><div type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="radix-:r2a:" data-state="closed" data-slot="dialog-trigger" tabindex="0"><button onclick="openTransactionModal()" data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive h-9 has-[&gt;svg]:px-3 bg-white text-emerald-700 hover:bg-white/90 shadow-2xl rounded-2xl px-8 py-7 text-lg font-bold cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-6 h-6 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>Buat Transaksi</button></div></div></div><div class="grid grid-cols-1 md:grid-cols-3 gap-6"><div class="bg-gradient-to-br from-emerald-400 to-teal-400 rounded-2xl p-6 text-white shadow-xl" style="opacity: 1; transform: none;"><div class="flex justify-between items-center"><div><p class="text-white/80 text-sm mb-1">Total Pendapatan</p><p class="text-4xl font-extrabold">{{ 'Rp ' . number_format($totalPendapatan, 0, ',', '.') }}</p></div><div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dollar-sign w-8 h-8"><line x1="12" x2="12" y1="2" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg></div></div></div><div class="bg-gradient-to-br from-yellow-400 to-orange-400 rounded-2xl p-6 text-white shadow-xl" style="opacity: 1; transform: none;"><div class="flex justify-between items-center"><div><p class="text-white/80 text-sm mb-1">Belum Lunas (DP)</p><p class="text-4xl font-extrabold">{{ 'Rp ' . number_format($totalBelumLunas, 0, ',', '.') }}</p></div><div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card w-8 h-8"><rect width="20" height="14" x="2" y="5" rx="2"></rect><line x1="2" x2="22" y1="10" y2="10"></line></svg></div></div></div><div class="bg-gradient-to-br from-green-400 to-emerald-400 rounded-2xl p-6 text-white shadow-xl" style="opacity: 1; transform: none;"><div class="flex justify-between items-center"><div><p class="text-white/80 text-sm mb-1">Lunas</p><p class="text-4xl font-extrabold">{{ 'Rp ' . number_format($totalLunas, 0, ',', '.') }}</p></div><div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-8 h-8"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg></div></div></div></div><div data-slot="card" class="bg-card text-card-foreground flex flex-col gap-6 border-2 border-emerald-200 rounded-2xl shadow-xl"><div data-slot="card-header" class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6 bg-gradient-to-r from-emerald-50 to-teal-50"><h4 data-slot="card-title" class="leading-none flex items-center gap-2 text-emerald-900"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-5 h-5"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>Filter Transaksi</h4></div><div data-slot="card-content" class="px-6 [&amp;:last-child]:pb-6 pt-6"><div class="grid grid-cols-1 md:grid-cols-4 gap-4"><div class="space-y-2"><label data-slot="label" class="flex items-center gap-2 select-none text-sm font-bold text-emerald-900">Dari Tanggal</label><input type="date" id="filter_from_date" onchange="filterTransactions()" class="w-full bg-white border-2 border-emerald-200 rounded-xl h-10 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 font-medium" value=""></div><div class="space-y-2"><label data-slot="label" class="flex items-center gap-2 select-none text-sm font-bold text-emerald-900">Sampai Tanggal</label><input type="date" id="filter_to_date" onchange="filterTransactions()" class="w-full bg-white border-2 border-emerald-200 rounded-xl h-10 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 font-medium" value=""></div><div class="space-y-2"><label data-slot="label" class="flex items-center gap-2 select-none text-sm font-bold text-emerald-900">Status Pembayaran</label><select id="filter_status" onchange="filterTransactions()" class="w-full bg-white border-2 border-emerald-200 rounded-xl h-10 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 font-medium"><option value="Semua">🔑 Semua Status</option><option value="Lunas">✓ Lunas</option><option value="Belum Lunas">💰 Belum Lunas</option></select></div><div class="flex items-end"><button onclick="resetFilters()" class="inline-flex items-center justify-center gap-2 w-full h-10 border-2 border-emerald-200 rounded-xl text-sm font-bold text-emerald-800 bg-white hover:bg-emerald-50 transition cursor-pointer">Reset Filter</button></div></div></div></div><div data-slot="card" class="bg-card text-card-foreground flex flex-col gap-6 border-4 border-emerald-200 shadow-2xl rounded-[2rem]"><div data-slot="card-header" class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6 bg-gradient-to-r from-emerald-100 via-teal-100 to-cyan-100 border-b-4 border-emerald-200"><h4 data-slot="card-title" class="text-2xl font-extrabold text-emerald-900">📊 Riwayat Transaksi</h4></div><div data-slot="card-content" class="px-6 [&amp;:last-child]:pb-6 pt-6"><div class="overflow-x-auto"><div data-slot="table-container" class="relative w-full overflow-x-auto"><table data-slot="table" class="w-full caption-bottom text-sm"><thead data-slot="table-header" class="[&amp;_tr]:border-b"><tr data-slot="table-row" class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors bg-gradient-to-r from-emerald-50 to-teal-50"><th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">ID</th><th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Tanggal</th><th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Pelanggan</th><th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Jenis</th><th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Status</th><th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Progress</th><th data-slot="table-head" class="text-foreground h-10 px-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] text-right font-extrabold">Aksi</th></tr></thead><tbody data-slot="table-body" class="[&amp;_tr:last-child]:border-0">
                @forelse($transactions as $trx)
                <tr data-slot="table-row" data-date="{{ $trx->payment_date }}" data-status="{{ $trx->status }}" class="data-[state=selected]:bg-muted border-b transition-colors hover:bg-emerald-50/50 transaction-row">
                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-mono text-sm font-bold text-emerald-600">#{{ $trx->id }}</td>
                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]">{{ \Carbon\Carbon::parse($trx->payment_date)->translatedFormat('d F Y') ?? 'N/A' }}</td>
                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-bold">{{ $trx->customer }}</td>
                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]">
                        <span data-slot="badge" class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden [a&amp;]:hover:bg-primary/90 {{ $trx->type === 'Lunas' ? 'bg-green-100 text-green-800 border-green-300' : 'bg-yellow-100 text-yellow-800 border-yellow-300' }}">
                            {{ $trx->type === 'Lunas' ? '✓ Lunas' : '💰 DP' }}
                        </span>
                    </td>
                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]">
                        <span data-slot="badge" class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden [a&amp;]:hover:bg-primary/90 {{ $trx->status === 'Lunas' ? 'bg-green-100 text-green-800 border-green-300' : 'bg-orange-100 text-orange-800 border-orange-300' }}">
                            @if($trx->status === 'Lunas')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-3 h-3 mr-1"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                            @endif
                            {{ $trx->status }}
                        </span>
                    </td>
                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]">
                        <div class="space-y-1 min-w-[150px]">
                            <div class="flex justify-between text-xs">
                                <span class="font-semibold">Rp {{ number_format($trx->paid, 0, ',', '.') }}</span>
                                <span class="text-gray-600">/ Rp {{ number_format($trx->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="w-full bg-gray-300 rounded-full h-2 overflow-hidden">
                                <div class="bg-emerald-500 h-full transition-all" style="width: {{ ($trx->paid / $trx->total) * 100 }}%"></div>
                            </div>
                            @if($trx->status === 'Belum Lunas')
                            <p class="text-xs text-orange-600 font-semibold">Sisa: Rp {{ number_format($trx->total - $trx->paid, 0, ',', '.') }}</p>
                            @endif
                        </div>
                    </td>
                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] text-right">
                        <div class="flex gap-2 justify-end">
                            <button onclick="openReceiptModal({{ json_encode($trx) }})" data-slot="button" class="inline-flex items-center justify-center whitespace-nowrap text-sm transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-background hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 h-8 gap-1.5 px-3 has-[&gt;svg]:px-2.5 border-2 border-emerald-300 text-emerald-700 rounded-xl font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-4 h-4 mr-1"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path><circle cx="12" cy="12" r="3"></circle></svg>Lihat
                            </button>
                            @if($trx->status === 'Belum Lunas')
                            <button onclick="openSettlementModal({{ json_encode($trx) }})" data-slot="button" class="inline-flex items-center justify-center whitespace-nowrap text-sm transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive text-primary-foreground hover:bg-primary/90 h-8 gap-1.5 px-3 has-[&gt;svg]:px-2.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 rounded-xl font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-4 h-4 mr-1"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>Lunasi
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-8 text-center text-gray-500 font-semibold">
                        Belum ada data transaksi
                    </td>
                </tr>
                @endforelse
            </tbody></table></div></div></div></div></div></div>

<script>
    const formatRp = (num) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num);

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
            document.getElementById('lunas_total_text').innerText = formattedTotal;
            document.getElementById('detail_order_date').innerText = orderData.order_date;
            document.getElementById('detail_deadline').innerText = orderData.deadline;

            let productsHtml = '';
            if(orderData.products && Array.isArray(orderData.products)) {
                orderData.products.forEach(p => {
                    productsHtml += `<div class="flex justify-between items-center py-1"><span class="text-sm">• ${p.name} ×${p.qty}</span><span class="font-semibold text-emerald-700">${formatRp(p.price || p.subtotal)}</span></div>`;
                });
            }
            document.getElementById('detail_products').innerHTML = productsHtml;
            formSection.classList.remove('hidden');

            togglePaymentTypeDetails();
        } else {
            formSection.classList.add('hidden');
        }
    }

    function togglePaymentTypeDetails() {
        const selectType = document.getElementById('select_type');
        const selectOrder = document.getElementById('select_order');
        const lunasDetails = document.getElementById('lunas_details');
        const dpDetails = document.getElementById('dp_details');
        const lunasPaidInput = document.getElementById('lunas_paid_input');
        const dpPaidInput = document.getElementById('dp_paid_input');

        let orderTotal = 0;
        if (selectOrder.value) {
            const orderData = JSON.parse(selectOrder.options[selectOrder.selectedIndex].getAttribute('data-full'));
            orderTotal = Number(orderData.total);
        }

        if (selectType.value === 'Lunas') {
            lunasDetails.classList.remove('hidden');
            dpDetails.classList.add('hidden');
            lunasPaidInput.value = orderTotal;
            lunasPaidInput.disabled = false;
            dpPaidInput.disabled = true;
            dpPaidInput.value = '';
        } else {
            lunasDetails.classList.add('hidden');
            dpDetails.classList.remove('hidden');
            lunasPaidInput.disabled = true;
            dpPaidInput.disabled = false;
            dpPaidInput.value = Math.floor(orderTotal / 2);
        }
    }

    function openReceiptModal(trx) {
        document.getElementById('receiptModal').classList.remove('hidden');

        document.getElementById('rcpt_id').innerText = '#' + trx.id;
        document.getElementById('rcpt_date').innerText = trx.payment_date || trx.created_at || '-';
        document.getElementById('rcpt_customer').innerText = trx.customer;
        document.getElementById('rcpt_admin').innerText = trx.admin || 'Admin';
        document.getElementById('rcpt_total').innerText = formatRp(trx.total);
        document.getElementById('rcpt_paid').innerText = formatRp(trx.paid);

        const badge = document.getElementById('rcpt_status_badge');
        if(trx.status === 'Lunas') {
            badge.className = 'w-fit text-xs font-bold px-3 py-1.5 rounded-lg flex items-center gap-1.5 bg-emerald-100 text-emerald-700 border border-emerald-200';
            badge.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Pembayaran Lunas';
        } else {
            badge.className = 'w-fit text-xs font-bold px-3 py-1.5 rounded-lg flex items-center gap-1.5 bg-orange-100 text-orange-700 border border-orange-200';
            badge.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Pembayaran DP (Down Payment)';
        }

        let productsHtml = '';
        if(trx.products && Array.isArray(trx.products)) {
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

    function openSettlementModal(trx) {
        document.getElementById('settlementModal').classList.remove('hidden');
        document.getElementById('stl_input_date').value = new Date().toISOString().split('T')[0];

        document.getElementById('settlementForm').action = '/transactions/' + trx.id + '/settle';

        const sisa = trx.total - trx.paid;

        document.getElementById('stl_customer').innerText = trx.customer;
        document.getElementById('stl_total').innerText = formatRp(trx.total);
        document.getElementById('stl_dp_paid').innerText = formatRp(trx.paid);
        document.getElementById('stl_dp_date').innerText = trx.payment_date || '-';
        
        const stlDpNota = document.getElementById('stl_dp_nota');
        if (stlDpNota) {
            stlDpNota.innerText = trx.dp_nota || '-';
        }

        document.getElementById('stl_sisa').innerText = formatRp(sisa);

        document.getElementById('stl_sum_dp').innerText = formatRp(trx.paid);
        document.getElementById('stl_sum_now').innerText = formatRp(sisa);
        document.getElementById('stl_sum_total').innerText = formatRp(trx.total);
    }
    function closeSettlementModal() {
        document.getElementById('settlementModal').classList.add('hidden');
    }

    function filterTransactions() {
        const fromDate = document.getElementById('filter_from_date').value;
        const toDate = document.getElementById('filter_to_date').value;
        const status = document.getElementById('filter_status').value;

        const rows = document.querySelectorAll('.transaction-row');
        rows.forEach(row => {
            const rowDate = row.getAttribute('data-date');
            const rowStatus = row.getAttribute('data-status');

            let show = true;

            if (fromDate && rowDate && rowDate < fromDate) {
                show = false;
            }
            if (toDate && rowDate && rowDate > toDate) {
                show = false;
            }
            if (status !== 'Semua' && rowStatus !== status) {
                show = false;
            }

            if (show) {
                row.classList.remove('hidden');
            } else {
                row.classList.add('hidden');
            }
        });
    }

    function resetFilters() {
        document.getElementById('filter_from_date').value = '';
        document.getElementById('filter_to_date').value = '';
        document.getElementById('filter_status').value = 'Semua';
        
        const rows = document.querySelectorAll('.transaction-row');
        rows.forEach(row => {
            row.classList.remove('hidden');
        });
    }
</script>
@endsection
