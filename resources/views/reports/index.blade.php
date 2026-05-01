@extends('layouts.app')

@section('title', 'Laporan Operasional - Alva Cake')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<div class="p-8 bg-[#FFFBFD] min-h-full font-sans relative">

    <div class="bg-gradient-to-r from-[#E948C5] to-[#F874A3] rounded-[2rem] p-8 mb-6 shadow-md flex items-center relative overflow-hidden">
        <div class="relative z-10 flex items-center gap-5">
            <div class="bg-white/20 backdrop-blur-md w-16 h-16 rounded-2xl flex items-center justify-center text-white shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            </div>
            <div>
                <h1 class="text-4xl font-extrabold text-white mb-1">Laporan Operasional</h1>
                <p class="text-white/90 font-medium text-sm">Analisis Lengkap Penjualan & Stok Bahan Baku</p>
            </div>
        </div>
        <div class="absolute -right-10 -top-10 w-64 h-64 bg-white/20 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <div class="flex gap-2 mb-6 bg-gray-50/50 p-2 rounded-2xl border border-gray-100">
        <button onclick="switchTab('harian')" id="btn-harian" class="tab-btn active-tab flex-1 py-3 text-sm font-bold text-[#D82A97] bg-white rounded-xl shadow-sm transition">📅 Penjualan Harian</button>
        <button onclick="switchTab('bulanan')" id="btn-bulanan" class="tab-btn flex-1 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition">📊 Laporan Bulanan</button>
        <button onclick="switchTab('stok')" id="btn-stok" class="tab-btn flex-1 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition">📦 Stok Bahan Baku</button>
        <button onclick="switchTab('rekap')" id="btn-rekap" class="tab-btn flex-1 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition">📑 Rekap Transaksi</button>
    </div>

    <div id="tab-harian" class="tab-content space-y-6">
        <div class="bg-[#FFF0F6] border border-pink-100 rounded-2xl p-6 shadow-sm">
            <h3 class="text-[#C1126A] font-bold flex items-center gap-2 mb-4"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg> Pilih Tanggal</h3>
            <div class="flex items-end gap-4">
                <div class="flex-1">
                    <label class="block text-xs font-bold text-[#D82A97] mb-1.5">Tanggal</label>
                    <input type="date" value="{{ date('Y-m-d') }}" class="w-full bg-white border border-pink-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none">
                </div>
                <button onclick="downloadPDF('harian')" class="bg-[#D82A97] hover:bg-[#C1126A] text-white px-8 py-3 rounded-xl font-bold shadow-md transition flex items-center gap-2 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg> Export PDF
                </button>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-4">
            <div class="bg-[#0EA5E9] rounded-2xl p-5 text-white shadow-md relative overflow-hidden"><p class="text-blue-100 text-xs font-bold mb-1">Total Transaksi</p><h3 class="text-4xl font-black">{{ $dailyStats['total_trx'] }}</h3><svg class="absolute right-3 bottom-3 w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg></div>
            <div class="bg-[#10B981] rounded-2xl p-5 text-white shadow-md relative overflow-hidden"><p class="text-emerald-100 text-xs font-bold mb-1">Total Penjualan</p><h3 class="text-3xl font-black">Rp {{ number_format($dailyStats['total_sales'], 0, ',', '.') }}</h3><span class="absolute right-3 bottom-3 text-5xl font-black text-white/20">$</span></div>
            <div class="bg-[#F59E0B] rounded-2xl p-5 text-white shadow-md relative overflow-hidden"><p class="text-orange-100 text-xs font-bold mb-1">Status DP</p><h3 class="text-4xl font-black">{{ $dailyStats['dp_count'] }}</h3><svg class="absolute right-3 bottom-3 w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg></div>
            <div class="bg-[#10B981] rounded-2xl p-5 text-white shadow-md relative overflow-hidden"><p class="text-emerald-100 text-xs font-bold mb-1">Status Lunas</p><h3 class="text-4xl font-black">{{ $dailyStats['lunas_count'] }}</h3><svg class="absolute right-3 bottom-3 w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg></div>
        </div>

        <div class="bg-white rounded-2xl border border-pink-100 shadow-sm overflow-hidden">
            <div class="bg-[#FFF0F6] px-6 py-4 border-b border-pink-100"><h3 class="font-bold text-[#C1126A] flex items-center gap-2">📄 Detail Transaksi - {{ date('d M Y') }}</h3></div>
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 border-b border-gray-100 text-gray-600 font-bold"><tr><th class="py-4 pl-6">No</th><th>Jam</th><th>Nama Pelanggan</th><th>Total Transaksi</th><th class="text-center">Status</th><th>Jumlah Dibayar</th></tr></thead>
                <tbody>
                    @forelse($dailyTransactions as $idx => $trx)
                    <tr class="border-b border-gray-50 font-bold text-gray-800"><td class="py-4 pl-6">{{ $idx+1 }}</td><td class="py-4">{{ $trx->created_at->format('H:i') }}</td><td class="py-4">{{ $trx->customer }}</td><td class="py-4 text-[#D82A97]">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                    <td class="py-4 text-center">
                        @if($trx->status == 'Lunas') <span class="bg-emerald-50 text-emerald-600 border border-emerald-200 px-3 py-1 rounded-md text-[10px] w-fit mx-auto block">✓ Lunas</span>
                        @else <span class="bg-orange-50 text-orange-500 border border-orange-200 px-3 py-1 rounded-md text-[10px] w-fit mx-auto block">DP</span> @endif
                    </td>
                    <td class="py-4 text-[#10B981]">Rp {{ number_format($trx->paid, 0, ',', '.') }}</td></tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-8 text-gray-400">Belum ada transaksi hari ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="tab-bulanan" class="tab-content hidden space-y-6">
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-3 bg-[#F5F3FF] border border-purple-100 rounded-2xl p-6 shadow-sm flex items-end gap-4">
                <div class="flex-1"><label class="block text-xs font-bold text-purple-700 mb-1.5">Bulan</label><select class="w-full bg-white border border-purple-200 rounded-xl px-4 py-3 font-bold text-gray-700 outline-none"><option>April</option></select></div>
                <div class="flex-1"><label class="block text-xs font-bold text-purple-700 mb-1.5">Tahun</label><select class="w-full bg-white border border-purple-200 rounded-xl px-4 py-3 font-bold text-gray-700 outline-none"><option>2026</option></select></div>
                <button onclick="downloadPDF('bulanan')" class="bg-[#A72BEE] hover:bg-purple-700 text-white px-8 py-3 rounded-xl font-bold shadow-md transition flex items-center gap-2 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg> Export PDF
                </button>
            </div>
            <div class="bg-[#FDF4FF] border border-[#E9D5FF] rounded-2xl p-5 text-center shadow-sm"><p class="text-purple-500 text-xs font-bold mb-1">Total Transaksi Bulan Ini</p><h3 class="text-4xl font-black text-[#A72BEE]">{{ $monthlyStats['total_trx'] }}</h3></div>
            <div class="bg-[#FFFBEB] border border-yellow-200 rounded-2xl p-5 text-center shadow-sm"><p class="text-yellow-600 text-xs font-bold mb-1">Status DP</p><h3 class="text-4xl font-black text-[#D97706]">{{ $monthlyStats['dp_count'] }}</h3></div>
            <div class="bg-[#ECFDF5] border border-emerald-200 rounded-2xl p-5 text-center shadow-sm"><p class="text-emerald-600 text-xs font-bold mb-1">Status Lunas</p><h3 class="text-4xl font-black text-[#059669]">{{ $monthlyStats['lunas_count'] }}</h3></div>
        </div>
        <div class="bg-white border border-purple-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="bg-[#F5F3FF] px-6 py-4 border-b border-purple-100"><h3 class="font-bold text-[#A72BEE] flex items-center gap-2">📈 Trend Transaksi Tahun {{ date('Y') }}</h3></div>
            <div class="p-6 h-80 relative w-full">
                <canvas id="trendChart"></canvas>
            </div>
        </div>
    </div>

    <div id="tab-stok" class="tab-content hidden space-y-6">
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-[#0EA5E9] rounded-2xl p-5 text-white shadow-md relative overflow-hidden"><p class="text-blue-100 text-xs font-bold mb-1">Total Bahan Baku</p><h3 class="text-4xl font-black">{{ count($materials) }}</h3><svg class="absolute right-3 bottom-3 w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg></div>
            <div class="bg-[#FB7185] rounded-2xl p-5 text-white shadow-md relative overflow-hidden"><p class="text-pink-100 text-xs font-bold mb-1">Stok Kurang</p><h3 class="text-4xl font-black">{{ $stokKurang }}</h3><svg class="absolute right-3 bottom-3 w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg></div>
            <div class="bg-[#34D399] rounded-2xl p-5 text-white shadow-md relative overflow-hidden"><p class="text-emerald-100 text-xs font-bold mb-1">Stok Aman</p><h3 class="text-4xl font-black">{{ $stokAman }}</h3><svg class="absolute right-3 bottom-3 w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg></div>
        </div>

        <div class="grid grid-cols-1 gap-6">
            <div class="bg-white border border-pink-100 rounded-2xl shadow-sm overflow-hidden">
                <div class="bg-[#FFF0F6] px-6 py-4 border-b border-pink-100"><h3 class="font-bold text-[#C1126A] flex items-center gap-2">📦 Status Stok Bahan Baku</h3></div>
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100 text-gray-600 font-bold"><tr><th class="py-4 pl-6">No</th><th>Nama Bahan</th><th>Jumlah Stok</th><th>Satuan</th><th>Stok Minimal</th><th class="text-center">Status</th></tr></thead>
                    <tbody>
                        @foreach($materials as $idx => $mat)
                        <tr class="border-b border-gray-50 font-bold text-gray-800"><td class="py-4 pl-6">{{ $idx+1 }}</td><td class="py-4">{{ $mat->name }}</td><td class="py-4 text-[#10B981]">{{ $mat->stock }}</td><td class="py-4">{{ $mat->unit }}</td><td class="py-4 text-gray-500">{{ $mat->min_stock }} {{ $mat->unit }}</td>
                        <td class="py-4 text-center">
                            @if($mat->stock <= $mat->min_stock) <span class="bg-red-50 text-red-500 border border-red-200 px-3 py-1 rounded-md text-[10px] w-fit mx-auto block">Stok Kurang</span>
                            @else <span class="bg-emerald-50 text-emerald-600 border border-emerald-200 px-3 py-1 rounded-md text-[10px] w-fit mx-auto block">✓ Stok Aman</span> @endif
                        </td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white border border-purple-100 rounded-2xl shadow-sm overflow-hidden">
                <div class="bg-[#F5F3FF] px-6 py-4 border-b border-purple-100"><h3 class="font-bold text-[#A72BEE] flex items-center gap-2">📊 Riwayat Keluar/Masuk Bahan Baku</h3></div>
                <div class="max-h-80 overflow-y-auto custom-scrollbar">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 border-b border-gray-100 text-gray-600 font-bold sticky top-0"><tr><th class="py-4 pl-6">Tanggal</th><th>Nama Bahan</th><th>Jumlah</th><th class="text-center">Tipe</th><th>Keterangan</th></tr></thead>
                        <tbody>
                            @forelse($materialHistories as $hist)
                            <tr class="border-b border-gray-50 font-bold text-gray-800">
                                <td class="py-4 pl-6">{{ $hist->created_at->format('d M Y, H:i') }}</td>
                                <td class="py-4 text-purple-700">{{ $hist->material_name }}</td>
                                <td class="py-4 {{ $hist->type == 'inbound' ? 'text-emerald-600' : 'text-red-500' }}">{{ $hist->type == 'inbound' ? '+' : '-' }}{{ $hist->qty }}</td>
                                <td class="py-4 text-center">
                                    @if($hist->type == 'inbound') <span class="bg-emerald-50 text-emerald-600 border border-emerald-200 px-3 py-1 rounded-md text-[10px] w-fit mx-auto block">↗ Masuk</span>
                                    @else <span class="bg-red-50 text-red-500 border border-red-200 px-3 py-1 rounded-md text-[10px] w-fit mx-auto block">↘ Keluar</span> @endif
                                </td>
                                <td class="py-4 text-gray-500 text-xs">{{ $hist->notes }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center py-8 text-gray-400">Belum ada riwayat.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="tab-rekap" class="tab-content hidden space-y-6">
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-4 bg-[#FFF0F6] border border-pink-100 rounded-2xl p-6 shadow-sm flex items-end gap-4">
                <div class="flex-1"><label class="block text-xs font-bold text-[#D82A97] mb-1.5">Dari Tanggal</label><input type="date" class="w-full bg-white border border-pink-200 rounded-xl px-4 py-3 font-bold text-gray-700 outline-none"></div>
                <div class="flex-1"><label class="block text-xs font-bold text-[#D82A97] mb-1.5">Sampai Tanggal</label><input type="date" class="w-full bg-white border border-pink-200 rounded-xl px-4 py-3 font-bold text-gray-700 outline-none"></div>
                <div class="flex-1"><label class="block text-xs font-bold text-[#D82A97] mb-1.5">Jenis Pembayaran</label><select class="w-full bg-white border border-pink-200 rounded-xl px-4 py-3 font-bold text-gray-700 outline-none"><option>Semua</option></select></div>
                <button class="bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 px-6 py-3 rounded-xl font-bold transition">Reset</button>
                <button onclick="downloadPDF('rekap')" class="bg-[#D82A97] hover:bg-[#C1126A] text-white px-8 py-3 rounded-xl font-bold shadow-md transition flex items-center gap-2 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg> PDF
                </button>
            </div>

            <div class="bg-[#F0F9FF] border border-blue-200 rounded-2xl p-5 text-center shadow-sm"><p class="text-blue-500 text-xs font-bold mb-1">Total Transaksi</p><h3 class="text-4xl font-black text-blue-600">{{ $rekapStats['total_trx'] }}</h3></div>
            <div class="bg-[#ECFDF5] border border-emerald-200 rounded-2xl p-5 text-center shadow-sm"><p class="text-emerald-600 text-xs font-bold mb-1">Total Pendapatan</p><h3 class="text-3xl font-black text-emerald-600">Rp {{ number_format($rekapStats['total_sales'], 0, ',', '.') }}</h3></div>
            <div class="bg-[#FFFBEB] border border-yellow-200 rounded-2xl p-5 text-center shadow-sm"><p class="text-yellow-600 text-xs font-bold mb-1">Status DP</p><h3 class="text-4xl font-black text-[#D97706]">{{ $rekapStats['dp_count'] }}</h3></div>
            <div class="bg-[#ECFDF5] border border-emerald-200 rounded-2xl p-5 text-center shadow-sm"><p class="text-emerald-600 text-xs font-bold mb-1">Status Lunas</p><h3 class="text-4xl font-black text-[#059669]">{{ $rekapStats['lunas_count'] }}</h3></div>
        </div>

        <div class="bg-white border border-pink-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="bg-[#FFF0F6] px-6 py-4 border-b border-pink-100"><h3 class="font-bold text-[#C1126A] flex items-center gap-2">📑 Rekap Semua Transaksi</h3></div>
            <div class="max-h-96 overflow-y-auto custom-scrollbar">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100 text-gray-600 font-bold sticky top-0"><tr><th class="py-4 pl-6">No</th><th>Tanggal</th><th>Nama Pelanggan</th><th class="text-center">Jenis</th><th>Total Pesanan</th><th>Jumlah Dibayar</th><th class="text-center">Status</th></tr></thead>
                    <tbody>
                        @forelse($allTransactions as $idx => $trx)
                        <tr class="border-b border-gray-50 font-bold text-gray-800">
                            <td class="py-4 pl-6">{{ $idx+1 }}</td><td class="py-4">{{ $trx->created_at->format('d M Y') }}</td><td class="py-4">{{ $trx->customer }}</td>
                            <td class="py-4 text-center">
                                @if($trx->type == 'Lunas') <span class="bg-emerald-50 text-emerald-600 border border-emerald-200 px-3 py-1 rounded-md text-[10px] w-fit mx-auto block">✓ Lunas</span>
                                @else <span class="bg-orange-50 text-orange-500 border border-orange-200 px-3 py-1 rounded-md text-[10px] w-fit mx-auto block">DP</span> @endif
                            </td>
                            <td class="py-4 text-[#D82A97]">Rp {{ number_format($trx->total, 0, ',', '.') }}</td><td class="py-4 text-[#10B981]">Rp {{ number_format($trx->paid, 0, ',', '.') }}</td>
                            <td class="py-4 text-center">
                                @if($trx->status == 'Lunas') <span class="bg-emerald-50 text-emerald-600 border border-emerald-200 px-3 py-1 rounded-md text-[10px] w-fit mx-auto block">✓ Lunas</span>
                                @else <span class="bg-orange-50 text-orange-500 border border-orange-200 px-3 py-1 rounded-md text-[10px] w-fit mx-auto block">Belum Lunas</span> @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center py-8 text-gray-400">Belum ada data transaksi.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-end gap-12 font-black text-lg text-gray-800 border-t border-gray-200">
                <p>TOTAL:</p><p class="text-[#D82A97]">Rp {{ number_format($rekapStats['total_sales'], 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Logika Tab Switching
    function switchTab(tabName) {
        // Sembunyikan semua tab content
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));

        // Reset warna semua tombol tab ke default (abu-abu)
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.className = "tab-btn flex-1 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition";
        });

        // Tampilkan tab yang diklik
        document.getElementById('tab-' + tabName).classList.remove('hidden');

        // Ubah warna tombol yang aktif (Putih + Pink)
        document.getElementById('btn-' + tabName).className = "tab-btn active-tab flex-1 py-3 text-sm font-bold text-[#D82A97] bg-white rounded-xl shadow-sm transition";
    }

    // Render Grafik Chart.js pas halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('trendChart').getContext('2d');
        const dataChart = @json($chartData); // Ambil data array dari controller

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Oct', 'Nov', 'Des'],
                datasets: [{
                    label: 'Total Transaksi',
                    data: dataChart,
                    borderColor: '#A72BEE',
                    backgroundColor: 'rgba(167, 43, 238, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#A72BEE',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    fill: true,
                    tension: 0.4 // Bikin garisnya melengkung halus
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [4, 4] } },
                    x: { grid: { display: false } }
                }
            }
        });
    });

    // FUNGSI UNTUK EXPORT PDF
    function downloadPDF(tabName) {
        // Ambil elemen tab yang lagi aktif
        const element = document.getElementById('tab-' + tabName);

        // Bikin nama file otomatis ada tanggalnya
        const today = new Date().toISOString().split('T')[0];
        const filename = `Laporan_AlvaCake_${tabName}_${today}.pdf`;

        // Konfigurasi PDF
        const opt = {
            margin:       0.3,
            filename:     filename,
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, useCORS: true }, // scale 2 biar hasilnya gak burem
            jsPDF:        { unit: 'in', format: 'a4', orientation: 'landscape' } // Landscape biar tabelnya muat
        };

        // Ganti teks tombol bentar biar user tau lagi proses (Opsional)
        alert('Sedang menyiapkan PDF, tunggu sebentar ya...');

        // Eksekusi render ke PDF
        html2pdf().set(opt).from(element).save();
    }
</script>
@endsection
