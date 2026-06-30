@extends('layouts.app')

@section('title', 'Transaksi Pembayaran - Alva Cake')

@section('content')
<style>
    @media print {
        /* Hide all page content */
        body * {
            visibility: hidden;
        }
        /* Show only the modal content and its children */
        #receiptModal, #receiptModalContent, #receiptModalContent * {
            visibility: visible !important;
        }
        /* Override absolute/fixed positioning for clean standard print flow */
        #receiptModal {
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            height: auto !important;
            background: transparent !important;
            backdrop-filter: none !important;
            display: block !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        #receiptModalContent {
            position: relative !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            max-h: none !important;
            overflow: visible !important;
        }
        /* Hide buttons when printing */
        .print-hide {
            display: none !important;
        }
    }
</style>
<div class="p-4 sm:p-8 bg-transparent min-h-full font-sans relative space-y-8">

    @if(session('success'))
    <div class="bg-green-50 text-green-700 p-4 rounded-2xl font-bold border border-green-100 flex items-center gap-3 shadow-sm">
        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>✨ {{ session('success') }}</span>
    </div>
    @endif

    <!-- Modal: Buat Transaksi -->
    <div id="trxModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-md py-10 transition-opacity animate-fade-in !mt-0">
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
    <div id="receiptModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-md animate-fade-in !mt-0">
        <div id="receiptModalContent" class="relative w-full max-w-3xl bg-white p-8 rounded-3xl border-4 border-slate-300 shadow-2xl max-h-[90vh] overflow-y-auto" style="font-family: 'Courier New', Courier, monospace; color: #1e293b;">
            <!-- Top Row: Logo/Address, Title, Metadata -->
            <div class="flex justify-between items-start border-b-2 border-slate-800 pb-4 mb-4">
                <!-- Left: Company Info -->
                <div class="space-y-1">
                    <h2 class="text-2xl font-black tracking-wider text-pink-600 font-outfit">ALCAKE</h2>
                    <p class="text-[10px] text-slate-600 font-bold">PREMIUM BAKERY & CUSTOM CAKE</p>
                    <p class="text-[9px] text-slate-500 leading-tight">Jl. Pedongkelan Belakang RT 03 RW 14 No. 121,<br>Cengkareng Timur, Jakarta Barat<br>WhatsApp: 085280024001</p>
                </div>
                
                <!-- Center: Doc Title -->
                <div class="text-center self-center px-4">
                    <h1 id="receipt_doc_title" class="text-2xl font-black tracking-widest text-slate-900 font-outfit uppercase">INVOICE PEMBAYARAN</h1>
                    <div id="receipt_badge" class="hidden"></div>
                </div>

                <!-- Right: Metadata Info -->
                <div class="text-right text-[11px] space-y-1 text-slate-700">
                    <div class="flex justify-end gap-2">
                        <span class="text-slate-500">Tgl Transaksi:</span>
                        <span id="rcpt_date" class="font-bold text-slate-900"></span>
                    </div>
                    <div class="flex justify-end gap-2">
                        <span class="text-slate-500">No. Nota:</span>
                        <span id="rcpt_id" class="font-mono font-bold text-slate-900"></span>
                    </div>
                    <div class="flex justify-end gap-2">
                        <span class="text-slate-500">Pelanggan:</span>
                        <span id="rcpt_customer" class="font-bold text-slate-900"></span>
                    </div>
                    <div class="flex justify-end gap-2">
                        <span class="text-slate-500">Admin/Kasir:</span>
                        <span id="rcpt_admin" class="font-bold text-slate-900"></span>
                    </div>
                </div>
            </div>

            <!-- Middle Section: Telah terima dari, Sejumlah uang, Terbilang -->
            <div id="rcpt_middle_section" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm border-b border-dashed border-slate-300 pb-4">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="text-slate-500 w-32 shrink-0">Telah terima dari :</span>
                        <span id="rcpt_received_from" class="font-bold text-slate-800 border-b border-dotted border-slate-400 flex-1"></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-slate-500 w-32 shrink-0">Sejumlah uang   :</span>
                        <span id="rcpt_amount_numeric" class="font-extrabold text-slate-950 border-b border-dotted border-slate-400 flex-1 text-lg"></span>
                    </div>
                </div>
                <!-- Right: Terbilang Box -->
                <div class="flex items-center justify-center border-2 border-dashed border-slate-400 bg-slate-50 rounded-xl p-4">
                    <span class="text-xs text-slate-400 uppercase tracking-wider font-bold mr-2">Terbilang:</span>
                    <span id="rcpt_amount_words" class="italic font-bold text-slate-800 text-center leading-relaxed"></span>
                </div>
            </div>

            <!-- Table Section -->
            <div class="mb-6">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-t-2 border-b-2 border-slate-800 font-extrabold text-slate-900">
                            <th class="py-2 w-12 text-center">NO</th>
                            <th class="py-2">KETERANGAN / NAMA KUE</th>
                            <th class="py-2 text-right pr-4">HARGA SATUAN</th>
                            <th class="py-2 text-center w-20">QTY</th>
                            <th class="py-2 text-right w-32">JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody id="rcpt_table_body" class="divide-y divide-slate-100">
                        <!-- Products injected here -->
                    </tbody>
                    <tfoot>
                        <tr class="border-t-2 border-slate-800 font-extrabold text-sm text-slate-900">
                            <td colspan="4" class="py-3 text-right pr-4">TOTAL :</td>
                            <td id="rcpt_total_amount" class="py-3 text-right"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Bottom Section: Summary, Notes, Signature -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-dashed border-slate-300 max-w-2xl mx-auto w-full">
                <!-- Left: Summary Details -->
                <div class="text-[11px] space-y-1.5 text-slate-700 bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <div class="flex justify-between">
                        <span>Total Belanja:</span>
                        <span id="rcpt_summary_total" class="font-bold"></span>
                    </div>
                    <div class="flex justify-between text-green-700">
                        <span id="rcpt_summary_paid_label">Jumlah Dibayar:</span>
                        <span id="rcpt_summary_paid" class="font-bold"></span>
                    </div>
                    <div id="rcpt_summary_remaining_row" class="flex justify-between text-red-600 border-t border-slate-200 pt-1.5 mt-1">
                        <span>Sisa Tagihan:</span>
                        <span id="rcpt_summary_remaining" class="font-bold"></span>
                    </div>
                    <div class="flex justify-between pt-1 border-t border-slate-200">
                        <span>Status:</span>
                        <span id="rcpt_summary_status" class="font-extrabold uppercase text-indigo-700"></span>
                    </div>
                </div>

                <!-- Center: Attention/Warning Box -->
                <div class="text-[10px] text-slate-600 p-4 rounded-xl border border-amber-200 bg-amber-50/50">
                    <p class="font-bold text-amber-800 mb-1 flex items-center gap-1">
                        ⚠️ Perhatian:
                    </p>
                    <ul class="list-disc list-inside space-y-1 leading-relaxed">
                        <li>Simpan dokumen ini sebagai bukti transaksi sah.</li>
                        <li>Pesanan yang sudah diproses tidak dapat dibatalkan secara sepihak.</li>
                        <li>Untuk pesanan DP, pelunasan wajib diselesaikan saat pengambilan kue.</li>
                    </ul>
                </div>


            </div>

            <!-- Print Hide Buttons Section -->
            <div class="print-hide flex gap-3 mt-8 border-t border-slate-200 pt-4">
                <button onclick="printReceipt()" class="flex-1 inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm border-2 border-emerald-300 text-emerald-700 hover:bg-emerald-50 px-4 py-2 rounded-2xl h-12 font-bold cursor-pointer transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-printer"><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><path d="M6 9V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6"></path><rect x="6" y="14" width="12" height="8" rx="1"></rect></svg>
                    Cetak Nota
                </button>
                <button onclick="downloadReceiptPDF()" class="flex-1 inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 px-4 py-2 rounded-2xl h-12 font-bold cursor-pointer transition shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>
                    Download PDF
                </button>
            </div>
            
            <button type="button" onclick="closeReceiptModal()" class="print-hide ring-offset-background focus:ring-ring data-[state=open]:bg-accent data-[state=open]:text-muted-foreground absolute top-4 right-4 rounded-xs opacity-70 transition-opacity hover:opacity-100 focus:ring-2 focus:ring-offset-2 focus:outline-hidden disabled:pointer-events-none [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
                <span class="sr-only">Close</span>
            </button>
        </div>
    </div>

    <!-- Modal: Pelunasan -->
    <div id="settlementModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-md animate-fade-in !mt-0">
        <div class="bg-white rounded-3xl border-4 border-green-200 shadow-2xl p-0 max-h-[85vh] flex flex-col w-full max-w-2xl relative overflow-hidden">
            <div data-slot="dialog-header" class="flex flex-col gap-2 text-center sm:text-left px-6 py-5 border-b-4 border-green-200 bg-gradient-to-r from-green-50 to-emerald-50">
                <h2 class="text-2xl font-extrabold text-green-900 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-7 h-7">
                        <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                        <path d="m9 11 3 3L22 4"></path>
                    </svg>
                    💚 Pelunasan Pembayaran
                </h2>
                <p class="text-sm text-green-700 mt-1">Proses pelunasan sisa pembayaran DP</p>
            </div>
            
            <form id="settlementForm" method="POST" class="flex flex-col flex-1 min-h-0">
                @csrf
                @method('PUT')
                <div class="flex-1 overflow-y-auto px-6 py-6 space-y-6">
                    <div class="p-6 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl border-2 border-yellow-200">
                        <h4 class="font-bold text-yellow-900 mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-5 h-5">
                                <path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path>
                                <path d="M12 22V12"></path>
                                <polyline points="3.29 7 12 12 20.71 7"></polyline>
                                <path d="m7.5 4.27 9 5.15"></path>
                            </svg>
                            📋 Detail DP Sebelumnya
                        </h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Pelanggan</p>
                                <p id="stl_customer" class="font-bold text-lg text-emerald-950">-</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Pesanan</p>
                                <p id="stl_total" class="font-bold text-lg text-emerald-950">Rp 0</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">DP Dibayar</p>
                                <p id="stl_dp_paid" class="font-bold text-green-700">Rp 0</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Tanggal DP</p>
                                <p id="stl_dp_date" class="font-semibold">-</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm text-gray-600">Nota DP</p>
                                <p id="stl_dp_nota" class="font-mono font-semibold text-emerald-900">-</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border-2 border-green-200">
                        <h4 class="font-bold text-green-900 mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dollar-sign w-5 h-5">
                                <line x1="12" x2="12" y1="2" y2="22"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                            💰 Detail Pelunasan
                        </h4>
                        
                        <div class="mb-4 p-4 bg-white rounded-xl border-2 border-green-300">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-lg font-semibold text-gray-900">Sisa Tagihan:</span>
                                <span id="stl_sisa" class="font-extrabold text-3xl text-green-700">Rp 0</span>
                            </div>
                            <p class="text-sm text-gray-600">Jumlah yang harus dibayar untuk melunasi pesanan ini</p>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-bold text-green-900">Tanggal Pelunasan <span class="text-red-500">*</span></label>
                                <input type="date" id="stl_input_date" name="payment_date" class="w-full px-3 py-1 bg-white border-2 border-green-300 rounded-xl h-12 mt-2 focus:outline-none focus:ring-2 focus:ring-green-400 font-medium" required>
                            </div>
                            <div>
                                <label class="text-sm font-bold text-green-900">Nomor Nota Pelunasan (Opsional)</label>
                                <input type="text" id="stl_input_nota" name="settlement_nota" class="w-full px-3 py-1 bg-white border-2 border-green-300 rounded-xl h-12 mt-2 focus:outline-none focus:ring-2 focus:ring-green-400 font-medium" placeholder="e.g., NOTA-LUNAS-001">
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ada nomor nota khusus</p>
                            </div>
                            
                            <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-4">
                                <p class="text-sm font-bold text-blue-900 mb-2">📝 Ringkasan Pembayaran:</p>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-700">DP Sebelumnya:</span>
                                        <span id="stl_sum_dp" class="font-semibold text-gray-900">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-700">Pelunasan Sekarang:</span>
                                        <span id="stl_sum_now" class="font-semibold text-gray-900">Rp 0</span>
                                    </div>
                                    <div class="border-t-2 border-blue-300 pt-2 flex justify-between">
                                        <span class="font-bold text-blue-900">Total Pesanan:</span>
                                        <span id="stl_sum_total" class="font-extrabold text-xl text-blue-900">Rp 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-4">
                        <div class="flex items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5">
                                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"></path>
                                <path d="M12 9v4"></path>
                                <path d="M12 17h.01"></path>
                            </svg>
                            <div class="text-sm text-yellow-800">
                                <p class="font-bold mb-1">Perhatian:</p>
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Pastikan pelanggan telah melakukan pembayaran</li>
                                    <li>Status transaksi akan berubah menjadi LUNAS</li>
                                    <li>Data pembayaran tidak dapat diubah setelah diproses</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-6 py-5 border-t-4 border-green-200 bg-gradient-to-r from-green-50 to-emerald-50 flex gap-4">
                    <button type="button" onclick="closeSettlementModal()" class="flex-1 rounded-2xl h-14 text-lg font-bold border-2 border-gray-300 bg-white hover:bg-gray-100 text-gray-700 transition cursor-pointer">Batal</button>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] flex-1 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 rounded-2xl h-14 text-lg font-extrabold text-white shadow-lg cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-5 h-5 mr-2">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                        Proses Pelunasan
                    </button>
                </div>
            </form>
            
            <button type="button" onclick="closeSettlementModal()" class="ring-offset-background focus:ring-ring data-[state=open]:bg-accent data-[state=open]:text-muted-foreground absolute top-4 right-4 rounded-xs opacity-70 transition-opacity hover:opacity-100 focus:ring-2 focus:ring-offset-2 focus:outline-hidden disabled:pointer-events-none [&amp;_svg]:pointer-events-none [&amp;_svg]:shrink-0 [&amp;_svg:not([class*='size-'])]:size-4 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
                <span class="sr-only">Close</span>
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-8 py-6">
        <div class="space-y-8" style="font-family: &quot;DM Sans&quot;, sans-serif;">
            <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-400 p-8 sm:p-10 shadow-2xl" style="opacity: 1; transform: none;">
                <div class="absolute inset-0">
                    <div class="absolute -top-20 -right-20 w-96 h-96 bg-white/10 rounded-full blur-3xl" style="transform: scale(1.11046) rotate(49.7055deg);"></div>
                </div>
                <div class="relative flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-white/20 backdrop-blur-xl rounded-[1.2rem] flex items-center justify-center shadow-2xl border border-white/30 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-receipt w-8 h-8 sm:w-10 sm:h-10 text-white"><path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z"></path><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"></path><path d="M12 17.5v-11"></path></svg>
                        </div>
                        <div>
                            <h1 class="text-3xl sm:text-5xl font-extrabold text-white drop-shadow-lg mb-2" style="font-family: Outfit, sans-serif;">Transaksi Pembayaran</h1>
                            <p class="text-white/90 text-sm sm:text-lg font-medium">Sistem DP &amp; Pelunasan Otomatis</p>
                        </div>
                    </div>
                    <div type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="radix-:r2a:" data-state="closed" data-slot="dialog-trigger" tabindex="0" class="w-full lg:w-auto">
                        <button onclick="openTransactionModal()" data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive h-9 has-[&gt;svg]:px-3 bg-white text-emerald-700 hover:bg-black/50 shadow-2xl rounded-2xl px-8 py-7 text-base sm:text-lg font-bold cursor-pointer w-full lg:w-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-6 h-6 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>Buat Transaksi
                        </button>
                    </div>
                </div>
            </div><div class="grid grid-cols-1 md:grid-cols-3 gap-6"><div class="bg-gradient-to-br from-emerald-400 to-teal-400 rounded-2xl p-6 text-white shadow-xl" style="opacity: 1; transform: none;"><div class="flex justify-between items-center"><div><p class="text-white/80 text-sm mb-1">Total Pendapatan</p><p class="text-4xl font-extrabold">{{ 'Rp ' . number_format($totalPendapatan, 0, ',', '.') }}</p></div><div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dollar-sign w-8 h-8"><line x1="12" x2="12" y1="2" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg></div></div></div><div class="bg-gradient-to-br from-yellow-400 to-orange-400 rounded-2xl p-6 text-white shadow-xl" style="opacity: 1; transform: none;"><div class="flex justify-between items-center"><div><p class="text-white/80 text-sm mb-1">Belum Lunas (DP)</p><p class="text-4xl font-extrabold">{{ 'Rp ' . number_format($totalBelumLunas, 0, ',', '.') }}</p></div><div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card w-8 h-8"><rect width="20" height="14" x="2" y="5" rx="2"></rect><line x1="2" x2="22" y1="10" y2="10"></line></svg></div></div></div><div class="bg-gradient-to-br from-green-400 to-emerald-400 rounded-2xl p-6 text-white shadow-xl" style="opacity: 1; transform: none;"><div class="flex justify-between items-center"><div><p class="text-white/80 text-sm mb-1">Lunas</p><p class="text-4xl font-extrabold">{{ 'Rp ' . number_format($totalLunas, 0, ',', '.') }}</p></div><div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-8 h-8"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg></div></div></div></div><div data-slot="card" class="bg-card text-card-foreground flex flex-col gap-6 border-2 border-emerald-200 rounded-2xl shadow-xl"><div data-slot="card-header" class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6 bg-gradient-to-r from-emerald-50 to-teal-50"><h4 data-slot="card-title" class="leading-none flex items-center gap-2 text-emerald-900"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-5 h-5"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>Filter Transaksi</h4></div><div data-slot="card-content" class="px-6 [&amp;:last-child]:pb-6 pt-6"><div class="grid grid-cols-1 md:grid-cols-4 gap-4"><div class="space-y-2"><label data-slot="label" class="flex items-center gap-2 select-none text-sm font-bold text-emerald-900">Dari Tanggal</label><input type="date" id="filter_from_date" onchange="filterTransactions()" class="w-full bg-white border-2 border-emerald-200 rounded-xl h-10 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 font-medium" value=""></div><div class="space-y-2"><label data-slot="label" class="flex items-center gap-2 select-none text-sm font-bold text-emerald-900">Sampai Tanggal</label><input type="date" id="filter_to_date" onchange="filterTransactions()" class="w-full bg-white border-2 border-emerald-200 rounded-xl h-10 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 font-medium" value=""></div><div class="space-y-2"><label data-slot="label" class="flex items-center gap-2 select-none text-sm font-bold text-emerald-900">Status Pembayaran</label><select id="filter_status" onchange="filterTransactions()" class="w-full bg-white border-2 border-emerald-200 rounded-xl h-10 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 font-medium"><option value="Semua">🔑 Semua Status</option><option value="Lunas">✓ Lunas</option><option value="Belum Lunas">💰 Belum Lunas</option></select></div><div class="flex items-end"><button onclick="resetFilters()" class="inline-flex items-center justify-center gap-2 w-full h-10 border-2 border-emerald-200 rounded-xl text-sm font-bold text-emerald-800 bg-white hover:bg-emerald-50 transition cursor-pointer">Reset Filter</button></div></div></div></div><div data-slot="card" class="bg-card text-card-foreground flex flex-col gap-6 border-4 border-emerald-200 shadow-2xl rounded-[2rem]"><div data-slot="card-header" class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6 bg-gradient-to-r from-emerald-100 via-teal-100 to-cyan-100 border-b-4 border-emerald-200"><h4 data-slot="card-title" class="text-2xl font-extrabold text-emerald-900">📊 Riwayat Transaksi</h4></div><div data-slot="card-content" class="px-6 [&amp;:last-child]:pb-6 pt-6"><div class="overflow-x-auto"><div data-slot="table-container" class="relative w-full overflow-x-auto"><table data-slot="table" class="w-full caption-bottom text-sm"><thead data-slot="table-header" class="[&amp;_tr]:border-b"><tr data-slot="table-row" class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors bg-gradient-to-r from-emerald-50 to-teal-50"><th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">ID</th><th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Tanggal</th><th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Pelanggan</th><th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Jenis</th><th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Status</th><th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Progress</th><th data-slot="table-head" class="text-foreground h-10 px-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] text-right font-extrabold">Aksi</th></tr></thead><tbody data-slot="table-body" class="[&amp;_tr:last-child]:border-0">
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
                            <button data-trx="{{ json_encode($trx) }}" onclick="openReceiptModal(this.getAttribute('data-trx'))" data-slot="button" class="inline-flex items-center justify-center whitespace-nowrap text-sm transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-background hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 h-8 gap-1.5 px-3 has-[&gt;svg]:px-2.5 border-2 border-emerald-300 text-emerald-700 rounded-xl font-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-4 h-4 mr-1"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path><circle cx="12" cy="12" r="3"></circle></svg>Lihat
                            </button>
                            @if($trx->status === 'Belum Lunas')
                            <button data-trx="{{ json_encode($trx) }}" onclick="openSettlementModal(this.getAttribute('data-trx'))" data-slot="button" class="inline-flex items-center justify-center whitespace-nowrap text-sm transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive text-white hover:bg-primary/90 h-8 gap-1.5 px-3 has-[>svg]:px-2.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 rounded-xl font-bold cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-4 h-4 mr-1 text-white"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>Lunasi
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
    var formatRp = formatRp || ((num) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num));

    function openTransactionModal() {
        document.getElementById('trxModal').classList.remove('hidden');
        document.getElementById('input_trx_date').value = new Date().toISOString().split('T')[0];
        document.body.style.overflow = 'hidden';
        const mainEl = document.querySelector('main');
        if (mainEl) mainEl.style.overflow = 'hidden';
    }
    function closeTransactionModal() {
        document.getElementById('trxModal').classList.add('hidden');
        document.getElementById('select_order').value = '';
        document.getElementById('payment_form_section').classList.add('hidden');
        document.body.style.overflow = '';
        const mainEl = document.querySelector('main');
        if (mainEl) mainEl.style.overflow = '';
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

    function terbilang(nilai) {
        nilai = Math.floor(Math.abs(nilai));
        const huruf = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
        let temp = "";
        
        if (nilai < 12) {
            temp = " " + huruf[nilai];
        } else if (nilai < 20) {
            temp = terbilang(nilai - 10) + " belas";
        } else if (nilai < 100) {
            temp = terbilang(nilai / 10) + " puluh" + terbilang(nilai % 10);
        } else if (nilai < 200) {
            temp = " seratus" + terbilang(nilai - 100);
        } else if (nilai < 1000) {
            temp = terbilang(nilai / 100) + " ratus" + terbilang(nilai % 100);
        } else if (nilai < 2000) {
            temp = " seribu" + terbilang(nilai - 1000);
        } else if (nilai < 1000000) {
            temp = terbilang(nilai / 1000) + " ribu" + terbilang(nilai % 1000);
        } else if (nilai < 1000000000) {
            temp = terbilang(nilai / 1000000) + " juta" + terbilang(nilai % 1000000);
        } else if (nilai < 1000000000000) {
            temp = terbilang(nilai / 1000000000) + " milyar" + terbilang(nilai % 1000000000);
        } else if (nilai < 1000000000000000) {
            temp = terbilang(nilai / 1000000000000) + " trilyun" + terbilang(nilai % 1000000000000);
        }
        
        return temp.trim();
    }

    function formatTerbilang(nilai) {
        if (nilai === 0) return "Nol rupiah";
        let hasil = terbilang(nilai);
        hasil = hasil.charAt(0).toUpperCase() + hasil.slice(1) + " rupiah";
        return hasil;
    }

    function openReceiptModal(trx) {
        if (typeof trx === 'string') {
            trx = JSON.parse(trx);
        }
        document.getElementById('receiptModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        const mainEl = document.querySelector('main');
        if (mainEl) mainEl.style.overflow = 'hidden';

        document.getElementById('rcpt_id').innerText = '#' + trx.id;
        
        // Format payment_date
        let dateObj = new Date(trx.payment_date || trx.created_at);
        let options = { day: '2-digit', month: 'long', year: 'numeric' };
        let formattedDate = dateObj.toLocaleDateString('id-ID', options);
        document.getElementById('rcpt_date').innerText = formattedDate;
        
        document.getElementById('rcpt_customer').innerText = trx.customer;
        document.getElementById('rcpt_received_from').innerText = trx.customer;
        document.getElementById('rcpt_admin').innerText = trx.admin || 'Admin Alcake';
        const sigDate = document.getElementById('rcpt_signature_date');
        if (sigDate) {
            sigDate.innerText = 'Malang, ' + formattedDate;
        }

        // Dynamic Document Title
        const docTitle = document.getElementById('receipt_doc_title');
        const badge = document.getElementById('receipt_badge');
        const middleSection = document.getElementById('rcpt_middle_section');
        if (docTitle) {
            docTitle.innerText = trx.status === 'Lunas' ? 'KWITANSI PEMBAYARAN' : 'INVOICE PEMBAYARAN';
            if (badge) badge.innerText = trx.status === 'Lunas' ? 'Kwitansi' : 'Invoice';
        }
        if (middleSection) {
            if (trx.status === 'Lunas') {
                middleSection.classList.remove('hidden');
            } else {
                middleSection.classList.add('hidden');
            }
        }

        // Numeric and Words amount representation
        document.getElementById('rcpt_amount_numeric').innerText = formatRp(trx.paid);
        document.getElementById('rcpt_amount_words').innerText = formatTerbilang(trx.paid);

        // Products details list in Table
        let productsHtml = '';
        let productsArr = [];
        if (trx.products) {
            productsArr = typeof trx.products === 'string' ? JSON.parse(trx.products) : trx.products;
        }
        
        if (Array.isArray(productsArr) && productsArr.length > 0) {
            productsArr.forEach((p, idx) => {
                let subtotal = Number(p.subtotal || (p.price * p.qty));
                productsHtml += `
                <tr class="text-slate-800">
                    <td class="py-2.5 text-center">${idx + 1}</td>
                    <td class="py-2.5 font-bold">${p.name}</td>
                    <td class="py-2.5 text-right pr-4">${formatRp(p.price)}</td>
                    <td class="py-2.5 text-center font-bold">${p.qty} Pcs</td>
                    <td class="py-2.5 text-right font-bold">${formatRp(subtotal)}</td>
                </tr>`;
            });
        } else {
            productsHtml = '<tr><td colspan="5" class="py-4 text-center text-slate-500 italic">Rincian produk tidak tersedia.</td></tr>';
        }
        
        document.getElementById('rcpt_table_body').innerHTML = productsHtml;
        document.getElementById('rcpt_total_amount').innerText = formatRp(trx.total);

        // Bottom Left: Summary Card info
        document.getElementById('rcpt_summary_total').innerText = formatRp(trx.total);
        
        const summaryPaidLabel = document.getElementById('rcpt_summary_paid_label');
        if (summaryPaidLabel) {
            summaryPaidLabel.innerText = trx.status === 'Lunas' ? 'Total Dibayar:' : 'DP Dibayar:';
        }
        document.getElementById('rcpt_summary_paid').innerText = formatRp(trx.paid);
        document.getElementById('rcpt_summary_status').innerText = trx.status;

        const remainingRow = document.getElementById('rcpt_summary_remaining_row');
        if (remainingRow) {
            if (trx.status === 'Lunas') {
                remainingRow.classList.add('hidden');
            } else {
                remainingRow.classList.remove('hidden');
                let sisaVal = Number(trx.total) - Number(trx.paid);
                document.getElementById('rcpt_summary_remaining').innerText = formatRp(sisaVal);
            }
        }

        // Catatan:
        const notesSection = document.getElementById('rcpt_notes_section');
        const notesText = document.getElementById('rcpt_notes');
        if (notesText) {
            if (trx.notes) {
                notesSection.classList.remove('hidden');
                notesText.innerText = trx.notes;
            } else {
                notesSection.classList.add('hidden');
            }
        }
    }

    function printReceipt() {
        window.print();
    }

    function downloadReceiptPDF() {
        const element = document.getElementById('receiptModalContent');
        if (!element) return;

        // Clone the element to remove action buttons before downloading
        const clone = element.cloneNode(true);
        clone.querySelectorAll('.print-hide').forEach(el => el.remove());
        clone.querySelector('button[type="button"]')?.remove(); // Remove close button

        // Apply printable styling to the cloned element
        clone.style.border = 'none';
        clone.style.boxShadow = 'none';
        clone.style.padding = '40px';
        clone.style.borderRadius = '0px';
        clone.style.backgroundColor = '#ffffff';
        clone.style.maxHeight = 'none';
        clone.style.height = 'auto';
        clone.style.overflow = 'visible';

        // Extract ID
        const trxIdText = document.getElementById('rcpt_id').innerText;
        const cleanTrxId = trxIdText.replace('#', '');
        const isLunas = document.getElementById('receipt_badge')?.innerText.includes('Kwitansi');
        const filenamePrefix = isLunas ? 'Kwitansi_Alcake' : 'Invoice_Alcake';

        const opt = {
            margin:       0.3,
            filename:     `${filenamePrefix}_#${cleanTrxId}.pdf`,
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2.5, useCORS: true, scrollY: 0, scrollX: 0 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        alert('Menyiapkan dokumen PDF, mohon tunggu sebentar...');
        html2pdf().set(opt).from(clone).save();
    }

    function closeReceiptModal() {
        document.getElementById('receiptModal').classList.add('hidden');
        document.body.style.overflow = '';
        const mainEl = document.querySelector('main');
        if (mainEl) mainEl.style.overflow = '';
    }

    function openSettlementModal(trx) {
        if (typeof trx === 'string') {
            trx = JSON.parse(trx);
        }
        document.getElementById('settlementModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        const mainEl = document.querySelector('main');
        if (mainEl) mainEl.style.overflow = 'hidden';
        
        // Set local timezone date YYYY-MM-DD
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        document.getElementById('stl_input_date').value = `${year}-${month}-${day}`;

        document.getElementById('settlementForm').action = '/transactions/' + trx.id + '/settle';

        const sisa = trx.total - trx.paid;

        document.getElementById('stl_customer').innerText = trx.customer;
        document.getElementById('stl_total').innerText = formatRp(trx.total);
        document.getElementById('stl_dp_paid').innerText = formatRp(trx.paid);
        
        // Format payment_date
        let dateObj = new Date(trx.payment_date || trx.created_at);
        let options = { day: '2-digit', month: 'long', year: 'numeric' };
        let formattedDate = dateObj.toLocaleDateString('id-ID', options);
        document.getElementById('stl_dp_date').innerText = formattedDate;
        
        const stlDpNota = document.getElementById('stl_dp_nota');
        if (stlDpNota) {
            stlDpNota.innerText = trx.dp_nota || '-';
        }

        document.getElementById('stl_sisa').innerText = formatRp(sisa);

        document.getElementById('stl_sum_dp').innerText = formatRp(trx.paid);
        document.getElementById('stl_sum_now').innerText = formatRp(sisa);
        document.getElementById('stl_sum_total').innerText = formatRp(trx.total);
        
        // Clear input nota
        document.getElementById('stl_input_nota').value = '';
    }
    function closeSettlementModal() {
        document.getElementById('settlementModal').classList.add('hidden');
        document.body.style.overflow = '';
        const mainEl = document.querySelector('main');
        if (mainEl) mainEl.style.overflow = '';
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

    window.openTransactionModal = openTransactionModal;
    window.closeTransactionModal = closeTransactionModal;
    window.showOrderDetails = showOrderDetails;
    window.togglePaymentTypeDetails = togglePaymentTypeDetails;
    window.openReceiptModal = openReceiptModal;
    window.printReceipt = printReceipt;
    window.downloadReceiptPDF = downloadReceiptPDF;
    window.closeReceiptModal = closeReceiptModal;
    window.openSettlementModal = openSettlementModal;
    window.closeSettlementModal = closeSettlementModal;
    window.filterTransactions = filterTransactions;
    window.resetFilters = resetFilters;
</script>
@endsection
