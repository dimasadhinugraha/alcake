@extends('layouts.app')

@section('title', 'Laporan Operasional - Tsabita Alcake')

@section('content')
<!-- Premium Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<div class="flex-1 overflow-auto relative z-10 bg-transparent min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 py-6">
        <div class="space-y-8" style="font-family: 'DM Sans', sans-serif;">
            
            <!-- Banner Header: Purple Pink Gradient Box -->
            <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-purple-500 via-pink-500 to-rose-400 p-8 sm:p-10 shadow-2xl">
                <div class="absolute inset-0">
                    <div class="absolute -top-20 -right-20 w-96 h-96 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                </div>
                <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-white/20 backdrop-blur-xl rounded-[1.2rem] flex items-center justify-center shadow-2xl border border-white/30 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 sm:w-10 sm:h-10 text-white"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M8 18v-2"></path><path d="M12 18v-4"></path><path d="M16 18v-6"></path></svg>
                        </div>
                        <div>
                            <h1 class="text-3xl sm:text-5xl font-extrabold text-white drop-shadow-lg mb-2" style="font-family: 'Outfit', sans-serif;">Laporan Operasional</h1>
                            <p class="text-white/90 text-sm sm:text-lg font-medium">Analisis Lengkap Penjualan &amp; Stok Bahan Baku</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Segment Tab Selector Container -->
            <div class="flex flex-col gap-2 space-y-6">
                <div role="tablist" class="text-muted-foreground items-center justify-center grid grid-cols-2 md:grid-cols-4 w-full bg-gradient-to-r from-pink-100 to-purple-100 p-2 rounded-2xl h-auto min-h-14 gap-2">
                    <button type="button" onclick="switchTab('harian')" id="btn-harian" class="tab-btn flex items-center justify-center gap-1.5 py-3 text-sm font-semibold rounded-xl transition duration-300">📅 Penjualan Harian</button>
                    <button type="button" onclick="switchTab('bulanan')" id="btn-bulanan" class="tab-btn flex items-center justify-center gap-1.5 py-3 text-sm font-semibold rounded-xl transition duration-300">📊 Laporan Bulanan</button>
                    <button type="button" onclick="switchTab('stok')" id="btn-stok" class="tab-btn flex items-center justify-center gap-1.5 py-3 text-sm font-semibold rounded-xl transition duration-300">📦 Stok Bahan Baku</button>
                    <button type="button" onclick="switchTab('rekap')" id="btn-rekap" class="tab-btn flex items-center justify-center gap-1.5 py-3 text-sm font-semibold rounded-xl transition duration-300">🧾 Rekap Transaksi</button>
                </div>

                <!-- ============================================================== -->
                <!-- 1. TAB CONTENT: PENJUALAN HARIAN                               -->
                <!-- ============================================================== -->
                <div id="tab-harian" class="tab-content space-y-6">
                    <div class="bg-white border-2 border-pink-200 rounded-2xl flex flex-col gap-6">
                        <div class="px-6 py-4 bg-gradient-to-r from-pink-50 to-purple-50 border-b border-pink-100 rounded-t-2xl">
                            <h4 class="text-lg font-bold flex items-center gap-2 text-pink-900">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>Pilih Tanggal
                            </h4>
                        </div>
                        <div class="px-6 pb-6">
                            <div class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-end">
                                <div class="flex-1">
                                    <label class="text-sm font-bold mb-2 block text-gray-800">Tanggal</label>
                                    <input type="date" id="daily_date_picker" onchange="changeDailyDate(this.value)" class="w-full px-3 py-1 border-2 border-pink-200 rounded-xl h-12 outline-none focus:border-pink-400 font-semibold text-gray-700" value="{{ $selectedDailyDateStr }}">
                                </div>
                                <button onclick="downloadPDF('harian')" class="inline-flex items-center justify-center gap-2 text-white bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-700 hover:to-purple-700 font-bold rounded-xl h-12 px-6 shadow-md transition duration-250 cursor-pointer w-full sm:w-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>Export PDF
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Daily KPI Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="bg-gradient-to-br from-blue-400 to-cyan-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                            <div>
                                <p class="text-white/80 text-sm mb-1 font-semibold">Total Transaksi</p>
                                <p class="text-4xl font-extrabold">{{ $dailyStats['total_trx'] }}</p>
                            </div>
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-emerald-400 to-teal-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                            <div>
                                <p class="text-white/80 text-sm mb-1 font-semibold">Total Penjualan</p>
                                <p class="text-3xl font-extrabold">Rp {{ number_format($dailyStats['total_sales'], 0, ',', '.') }}</p>
                            </div>
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7"><line x1="12" x2="12" y1="2" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-yellow-400 to-orange-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                            <div>
                                <p class="text-white/80 text-sm mb-1 font-semibold">Status DP</p>
                                <p class="text-4xl font-extrabold">{{ $dailyStats['dp_count'] }}</p>
                            </div>
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-green-400 to-emerald-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                            <div>
                                <p class="text-white/80 text-sm mb-1 font-semibold">Status Lunas</p>
                                <p class="text-4xl font-extrabold">{{ $dailyStats['lunas_count'] }}</p>
                            </div>
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Daily Details Card -->
                    <div class="bg-white flex flex-col gap-6 border-4 border-pink-200 shadow-2xl rounded-[2rem] overflow-hidden">
                        <div class="px-6 py-5 bg-gradient-to-r from-pink-100 via-purple-100 to-rose-100 border-b-4 border-pink-200">
                            <h4 class="text-2xl font-extrabold text-pink-900">📋 Detail Transaksi - {{ \Carbon\Carbon::parse($selectedDailyDateStr)->translatedFormat('d F Y') }}</h4>
                        </div>
                        <div class="px-6 pb-6">
                            @if(count($dailyTransactions) == 0)
                                <!-- Empty State Premium Placeholder -->
                                <div class="text-center py-16">
                                    <div class="w-32 h-32 bg-gradient-to-br from-pink-100 to-purple-100 rounded-[2rem] flex items-center justify-center mx-auto mb-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-16 h-16 text-pink-400"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>
                                    </div>
                                    <p class="text-gray-900 font-extrabold text-2xl mb-2">Tidak Ada Transaksi</p>
                                    <p class="text-gray-600 font-medium">Belum ada transaksi pada tanggal ini</p>
                                </div>
                            @else
                                <!-- Dynamic Daily Table -->
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left text-sm font-medium border-collapse">
                                        <thead>
                                            <tr class="bg-gradient-to-r from-pink-50 to-purple-50 border-b border-pink-100 text-pink-900">
                                                <th class="px-6 py-4 font-bold">No</th>
                                                <th class="px-6 py-4 font-bold">Jam</th>
                                                <th class="px-6 py-4 font-bold">Nama Pelanggan</th>
                                                <th class="px-6 py-4 font-bold">Total Transaksi</th>
                                                <th class="px-6 py-4 font-bold text-center">Status</th>
                                                <th class="px-6 py-4 font-bold text-right">Jumlah Dibayar</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100 text-gray-700">
                                            @foreach($dailyTransactions as $idx => $trx)
                                                <tr class="hover:bg-pink-50/30 transition">
                                                    <td class="px-6 py-4 font-bold">{{ $idx + 1 }}</td>
                                                    <td class="px-6 py-4">{{ $trx->created_at->format('H:i') }} WIB</td>
                                                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $trx->customer }}</td>
                                                    <td class="px-6 py-4 font-bold text-pink-600">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
                                                    <td class="px-6 py-4 text-center">
                                                        @if($trx->status == 'Lunas')
                                                            <span class="inline-flex items-center gap-1 rounded-md px-2 py-1 text-xs font-semibold bg-green-50 text-green-700 border border-green-200">✓ Lunas</span>
                                                        @else
                                                            <span class="inline-flex items-center gap-1 rounded-md px-2 py-1 text-xs font-semibold bg-yellow-50 text-yellow-700 border border-yellow-200">DP</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 text-right font-extrabold text-emerald-600">Rp {{ number_format($trx->paid, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- 2. TAB CONTENT: LAPORAN BULANAN                                -->
                <!-- ============================================================== -->
                <div id="tab-bulanan" class="tab-content hidden space-y-6">
                    <!-- Monthly Filter Box -->
                    <div class="bg-white border-2 border-purple-200 rounded-2xl flex flex-col gap-6">
                        <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-100 rounded-t-2xl">
                            <h4 class="text-lg font-bold flex items-center gap-2 text-purple-900">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z"></path></svg>Filter Laporan
                            </h4>
                        </div>
                        <div class="px-6 pb-6">
                            <div class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-end">
                                <div class="flex-1">
                                    <label class="text-sm font-bold mb-2 block text-gray-800">Bulan</label>
                                    <select id="filter_month" onchange="changeMonthlyFilter()" class="w-full border-2 border-purple-200 rounded-xl h-12 px-3 outline-none focus:border-purple-400 font-semibold text-gray-700 bg-white">
                                        <option value="1" {{ $selectedMonth == 1 ? 'selected' : '' }}>Januari</option>
                                        <option value="2" {{ $selectedMonth == 2 ? 'selected' : '' }}>Februari</option>
                                        <option value="3" {{ $selectedMonth == 3 ? 'selected' : '' }}>Maret</option>
                                        <option value="4" {{ $selectedMonth == 4 ? 'selected' : '' }}>April</option>
                                        <option value="5" {{ $selectedMonth == 5 ? 'selected' : '' }}>Mei</option>
                                        <option value="6" {{ $selectedMonth == 6 ? 'selected' : '' }}>Juni</option>
                                        <option value="7" {{ $selectedMonth == 7 ? 'selected' : '' }}>Juli</option>
                                        <option value="8" {{ $selectedMonth == 8 ? 'selected' : '' }}>Agustus</option>
                                        <option value="9" {{ $selectedMonth == 9 ? 'selected' : '' }}>September</option>
                                        <option value="10" {{ $selectedMonth == 10 ? 'selected' : '' }}>Oktober</option>
                                        <option value="11" {{ $selectedMonth == 11 ? 'selected' : '' }}>November</option>
                                        <option value="12" {{ $selectedMonth == 12 ? 'selected' : '' }}>Desember</option>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <label class="text-sm font-bold mb-2 block text-gray-800">Tahun</label>
                                    <select id="filter_year" onchange="changeMonthlyFilter()" class="w-full border-2 border-purple-200 rounded-xl h-12 px-3 outline-none focus:border-purple-400 font-semibold text-gray-700 bg-white">
                                        <option value="2025" {{ $selectedYear == 2025 ? 'selected' : '' }}>2025</option>
                                        <option value="2026" {{ $selectedYear == 2026 ? 'selected' : '' }}>2026</option>
                                        <option value="2027" {{ $selectedYear == 2027 ? 'selected' : '' }}>2027</option>
                                    </select>
                                </div>
                                <button onclick="downloadPDF('bulanan')" class="inline-flex items-center justify-center gap-2 text-white bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 font-bold rounded-xl h-12 px-6 shadow-md transition duration-250 cursor-pointer w-full sm:w-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>Export PDF
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly KPI Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="border-2 border-purple-200 rounded-2xl bg-gradient-to-br from-purple-50 to-pink-50 p-6 flex flex-col items-center justify-center shadow-sm">
                            <p class="text-sm text-gray-600 mb-2 font-bold">Total Transaksi Bulan Ini</p>
                            <p class="text-4xl font-extrabold text-purple-700">{{ $monthlyStats['total_trx'] }}</p>
                        </div>
                        <div class="border-2 border-purple-200 rounded-2xl bg-gradient-to-br from-yellow-50 to-orange-50 p-6 flex flex-col items-center justify-center shadow-sm">
                            <p class="text-sm text-gray-600 mb-2 font-bold">Status DP</p>
                            <p class="text-4xl font-extrabold text-yellow-700">{{ $monthlyStats['dp_count'] }}</p>
                        </div>
                        <div class="border-2 border-purple-200 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-50 p-6 flex flex-col items-center justify-center shadow-sm">
                            <p class="text-sm text-gray-600 mb-2 font-bold">Status Lunas</p>
                            <p class="text-4xl font-extrabold text-green-700">{{ $monthlyStats['lunas_count'] }}</p>
                        </div>
                    </div>

                    <!-- Bar Chart Grid (Recharts style) -->
                    <div class="bg-card text-card-foreground flex flex-col gap-6 border-4 border-purple-200 shadow-2xl rounded-[2rem] overflow-hidden">
                        <div class="px-6 py-5 bg-gradient-to-r from-purple-100 via-pink-100 to-rose-100 border-b-4 border-purple-200">
                            <h4 class="text-2xl font-extrabold text-purple-900">📊 Grafik Penjualan Tahun {{ $selectedYear }}</h4>
                        </div>
                        <div class="p-6">
                            <div class="h-96 w-full relative">
                                <canvas id="barSalesChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Line Chart Grid (Recharts style) -->
                    <div class="bg-card text-card-foreground flex flex-col gap-6 border-4 border-purple-200 shadow-2xl rounded-[2rem] overflow-hidden">
                        <div class="px-6 py-5 bg-gradient-to-r from-purple-100 via-pink-100 to-rose-100 border-b-4 border-purple-200">
                            <h4 class="text-2xl font-extrabold text-purple-900">📈 Trend Transaksi Tahun {{ $selectedYear }}</h4>
                        </div>
                        <div class="p-6">
                            <div class="h-96 w-full relative">
                                <canvas id="lineTrendChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Detail Report Card -->
                    <div class="bg-card text-card-foreground flex flex-col gap-6 border-4 border-purple-200 shadow-2xl rounded-[2rem] overflow-hidden">
                        <div class="px-6 py-5 bg-gradient-to-r from-purple-100 via-pink-100 to-rose-100 border-b-4 border-purple-200">
                            <h4 class="text-2xl font-extrabold text-purple-900">📋 Detail Total Penjualan Bulanan {{ $selectedYear }}</h4>
                        </div>
                        <div class="p-6">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm font-medium border-collapse">
                                    <thead>
                                        <tr class="bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-100 text-purple-900">
                                            <th class="px-6 py-4 font-extrabold">Bulan</th>
                                            <th class="px-6 py-4 font-extrabold">Jumlah Transaksi</th>
                                            <th class="px-6 py-4 font-extrabold">Transaksi DP</th>
                                            <th class="px-6 py-4 font-extrabold">Transaksi Lunas</th>
                                            <th class="px-6 py-4 font-extrabold text-right">Total Penjualan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 text-gray-700">
                                        @foreach($monthlyData as $idx => $row)
                                            <tr class="transition hover:bg-purple-50/40 {{ $row['month_num'] == $selectedMonth ? 'bg-purple-100/50 border-2 border-purple-300 font-bold' : '' }}">
                                                <td class="px-6 py-4 font-bold text-purple-900">
                                                    {{ $row['label'] }}
                                                    @if($row['month_num'] == $selectedMonth)
                                                        <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-semibold ml-2 bg-purple-500 text-white border-transparent">Dipilih</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 font-bold text-gray-900">{{ $row['total_trx'] }}</td>
                                                <td class="px-6 py-4">
                                                    <span class="inline-flex items-center justify-center rounded-md border px-2.5 py-0.5 text-xs font-semibold bg-yellow-100 text-yellow-800 border-yellow-300">{{ $row['dp_count'] }} DP</span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span class="inline-flex items-center justify-center rounded-md border px-2.5 py-0.5 text-xs font-semibold bg-green-100 text-green-800 border-green-300">{{ $row['lunas_count'] }} Lunas</span>
                                                </td>
                                                <td class="px-6 py-4 text-right font-extrabold text-lg text-purple-700">Rp {{ number_format($row['total_sales'], 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                        <!-- Yearly Total Row -->
                                        <tr class="bg-gradient-to-r from-purple-200 to-pink-200 font-bold">
                                            <td class="px-6 py-5 font-extrabold text-lg text-purple-900">TOTAL TAHUNAN</td>
                                            <td class="px-6 py-5 font-extrabold text-lg text-purple-900">{{ collect($monthlyData)->sum('total_trx') }}</td>
                                            <td class="px-6 py-5 font-extrabold text-gray-800">{{ collect($monthlyData)->sum('dp_count') }} DP</td>
                                            <td class="px-6 py-5 font-extrabold text-gray-800">{{ collect($monthlyData)->sum('lunas_count') }} Lunas</td>
                                            <td class="px-6 py-5 text-right font-extrabold text-2xl text-purple-900">Rp {{ number_format($totalYearlySales, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Highlights fact cards -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 pt-6 border-t-2 border-purple-200">
                                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-4 border-2 border-purple-200">
                                    <p class="text-sm text-gray-600 mb-1 font-bold">Rata-rata Penjualan per Bulan</p>
                                    <p class="text-2xl font-extrabold text-purple-700">Rp {{ number_format($averageMonthlySales, 2, ',', '.') }}</p>
                                </div>
                                <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-xl p-4 border-2 border-pink-200">
                                    <p class="text-sm text-gray-600 mb-1 font-bold">Bulan Tertinggi</p>
                                    <p class="text-2xl font-extrabold text-pink-700">{{ $highestSalesMonth }}</p>
                                </div>
                                <div class="bg-gradient-to-br from-rose-50 to-orange-50 rounded-xl p-4 border-2 border-rose-200">
                                    <p class="text-sm text-gray-600 mb-1 font-bold">Penjualan Tertinggi</p>
                                    <p class="text-2xl font-extrabold text-rose-700">Rp {{ number_format($highestSalesValue, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- 3. TAB CONTENT: STOK BAHAN BAKU                                -->
                <!-- ============================================================== -->
                <div id="tab-stok" class="tab-content hidden space-y-6">
                    <!-- Stock History Filter Card -->
                    <div class="bg-white border-2 border-purple-200 rounded-2xl flex flex-col gap-6">
                        <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-100 rounded-t-2xl">
                            <h4 class="text-lg font-bold flex items-center gap-2 text-purple-900">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z"></path></svg>Filter Riwayat Stok Bahan Baku
                            </h4>
                        </div>
                        <div class="px-6 pb-6">
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div class="space-y-2">
                                        <label class="text-sm font-bold text-gray-800">Dari Tanggal</label>
                                        <input type="date" id="stock_start_date" onchange="filterStockLogs()" class="w-full px-3 py-1 border-2 border-purple-200 rounded-xl h-12 outline-none focus:border-purple-400 font-semibold text-gray-700 bg-white">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-sm font-bold text-gray-800">Sampai Tanggal</label>
                                        <input type="date" id="stock_end_date" onchange="filterStockLogs()" class="w-full px-3 py-1 border-2 border-purple-200 rounded-xl h-12 outline-none focus:border-purple-400 font-semibold text-gray-700 bg-white">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-sm font-bold text-gray-800">Tipe Transaksi</label>
                                        <select id="stock_type" onchange="filterStockLogs()" class="w-full border-2 border-purple-200 rounded-xl h-12 px-3 outline-none focus:border-purple-400 font-semibold text-gray-700 bg-white">
                                            <option value="all">Semua Tipe</option>
                                            <option value="inbound">↗ Masuk (Inbound)</option>
                                            <option value="outbound">↘ Keluar (Outbound)</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-sm font-bold text-gray-800">Nama Bahan Baku</label>
                                        <input type="text" id="stock_search_input" oninput="filterStockLogs(); filterStockGrid();" placeholder="Cari bahan baku..." class="w-full px-3 py-1 border-2 border-purple-200 rounded-xl h-12 outline-none focus:border-purple-400 font-semibold text-gray-700 bg-white">
                                    </div>
                                </div>
                                <div class="flex gap-3 justify-end">
                                    <button type="button" onclick="resetStockFilters()" class="inline-flex items-center justify-center gap-2 text-purple-700 border-2 border-purple-200 hover:bg-purple-50/50 font-bold rounded-xl h-12 px-6 shadow-sm transition duration-250 cursor-pointer">
                                        Reset Filter
                                    </button>
                                    <button onclick="downloadPDF('stok')" class="inline-flex items-center justify-center gap-2 text-white bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 font-bold rounded-xl h-12 px-6 shadow-md transition duration-250 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>Export PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stock Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gradient-to-br from-blue-400 to-cyan-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                            <div>
                                <p class="text-white/80 text-sm mb-1 font-semibold">Total Bahan Baku</p>
                                <p class="text-4xl font-extrabold">{{ count($materials) }}</p>
                            </div>
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-red-400 to-rose-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                            <div>
                                <p class="text-white/80 text-sm mb-1 font-semibold">Stok Kurang</p>
                                <p class="text-4xl font-extrabold">{{ $stokKurang }}</p>
                            </div>
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-green-400 to-emerald-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                            <div>
                                <p class="text-white/80 text-sm mb-1 font-semibold">Stok Aman</p>
                                <p class="text-4xl font-extrabold">{{ $stokAman }}</p>
                            </div>
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Material Stocks Grid Table -->
                    <div class="bg-card text-card-foreground flex flex-col gap-6 border-4 border-pink-200 shadow-2xl rounded-[2rem] overflow-hidden">
                        <div class="px-6 py-5 bg-gradient-to-r from-pink-100 via-purple-100 to-rose-100 border-b-4 border-pink-200">
                            <h4 class="text-2xl font-extrabold text-pink-900">📦 Status Stok Bahan Baku</h4>
                        </div>
                        <div class="p-6">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm font-medium border-collapse">
                                    <thead>
                                        <tr class="bg-gradient-to-r from-pink-50 to-purple-50 border-b border-pink-100 text-pink-900">
                                            <th class="px-6 py-4 font-bold">No</th>
                                            <th class="px-6 py-4 font-bold">Nama Bahan</th>
                                            <th class="px-6 py-4 font-bold">Jumlah Stok</th>
                                            <th class="px-6 py-4 font-bold">Satuan</th>
                                            <th class="px-6 py-4 font-bold">Stok Minimal</th>
                                            <th class="px-6 py-4 font-bold">Stok Maksimal</th>
                                            <th class="px-6 py-4 font-bold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="materials_grid_tbody" class="divide-y divide-gray-100 text-gray-700">
                                        @foreach($materials as $idx => $mat)
                                            <tr class="hover:bg-pink-50/30 transition material-grid-row" data-name="{{ strtolower($mat->name) }}">
                                                <td class="px-6 py-4 font-bold">{{ $idx + 1 }}</td>
                                                <td class="px-6 py-4 font-bold text-gray-900">{{ $mat->name }}</td>
                                                <td class="px-6 py-4 font-extrabold text-xl {{ $mat->stock <= $mat->min_stock ? 'text-rose-600' : 'text-green-600' }}">{{ $mat->stock }}</td>
                                                <td class="px-6 py-4 font-semibold text-gray-500">{{ $mat->unit }}</td>
                                                <td class="px-6 py-4 text-gray-600">{{ $mat->min_stock }} {{ $mat->unit }}</td>
                                                <td class="px-6 py-4 text-gray-600">{{ $mat->max_stock ?? '-' }} {{ $mat->unit }}</td>
                                                <td class="px-6 py-4">
                                                    @if($mat->stock <= $mat->min_stock)
                                                        <span class="inline-flex items-center gap-1 rounded-md px-2.5 py-1 text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                                            Stok Kurang
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center gap-1 rounded-md px-2.5 py-1 text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
                                                            Stok Aman
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Material Logs Card -->
                    <div class="bg-white border-2 border-purple-200 rounded-2xl shadow-sm overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-purple-100 flex items-center justify-between">
                            <h3 class="font-bold text-purple-900 flex items-center gap-2">📊 Riwayat Keluar/Masuk Bahan Baku</h3>
                            <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-3 py-1 rounded-full border border-purple-100">Live Client-Side Filter</span>
                        </div>
                        <div class="overflow-x-auto max-h-96">
                            <table class="w-full text-left text-sm font-medium border-collapse">
                                <thead class="sticky top-0 bg-gray-50 border-b border-gray-100 text-purple-900 font-bold z-10">
                                    <tr>
                                        <th class="px-6 py-4">Tanggal &amp; Waktu</th>
                                        <th class="px-6 py-4">Nama Bahan</th>
                                        <th class="px-6 py-4">Jumlah</th>
                                        <th class="px-6 py-4 text-center">Tipe</th>
                                        <th class="px-6 py-4">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="stock_logs_tbody" class="divide-y divide-gray-100 text-gray-700">
                                    @forelse($materialHistories as $hist)
                                        <tr class="hover:bg-purple-50/30 transition stock-log-row" data-date="{{ $hist->created_at->toDateString() }}" data-type="{{ $hist->type }}" data-name="{{ strtolower($hist->material_name) }}">
                                            <td class="px-6 py-4 text-gray-500 font-semibold">{{ $hist->created_at->format('d M Y, H:i') }} WIB</td>
                                            <td class="px-6 py-4 font-bold text-purple-800">{{ $hist->material_name }}</td>
                                            <td class="px-6 py-4 font-extrabold {{ $hist->type == 'inbound' ? 'text-green-600' : 'text-rose-600' }}">
                                                {{ $hist->type == 'inbound' ? '+' : '-' }}{{ $hist->qty }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if($hist->type == 'inbound')
                                                    <span class="inline-flex items-center gap-1 rounded-md px-2.5 py-0.5 text-xs font-semibold bg-green-50 text-green-700 border border-green-200">↗ Masuk</span>
                                                @else
                                                    <span class="inline-flex items-center gap-1 rounded-md px-2.5 py-0.5 text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">↘ Keluar</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-gray-500 text-xs font-medium">{{ $hist->notes }}</td>
                                        </tr>
                                    @empty
                                        <tr id="stock-logs-original-empty"><td colspan="5" class="text-center py-8 text-gray-400 font-bold">Belum ada riwayat stok.</td></tr>
                                    @endforelse
                                    <!-- Dynamic Stock Logs JS Empty State -->
                                    <tr id="stock-logs-js-empty" class="hidden">
                                        <td colspan="5" class="py-16 text-center">
                                            <div class="flex flex-col items-center justify-center gap-2">
                                                <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center border border-purple-100 shadow-sm mx-auto">
                                                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                                                </div>
                                                <h4 class="text-lg font-bold text-purple-600">Tidak ada riwayat stok</h4>
                                                <p class="text-sm text-purple-400 font-semibold">Untuk filter yang dipilih</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- 4. TAB CONTENT: REKAP TRANSAKSI                                -->
                <!-- ============================================================== -->
                <div id="tab-rekap" class="tab-content hidden space-y-6">
                    <div class="bg-white border-2 border-pink-200 rounded-2xl flex flex-col gap-6">
                        <div class="px-6 py-4 bg-gradient-to-r from-pink-50 to-purple-50 border-b border-pink-100 rounded-t-2xl">
                            <h4 class="text-lg font-bold flex items-center gap-2 text-pink-900">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z"></path></svg>Filter Rekap Transaksi
                            </h4>
                        </div>
                        <div class="px-6 pb-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                                <div>
                                    <label class="text-sm font-bold mb-2 block text-gray-800">Dari Tanggal</label>
                                    <input type="date" id="rekap_start_date" onchange="filterRekapTable()" class="w-full px-3 py-1 border-2 border-pink-200 rounded-xl h-12 outline-none focus:border-pink-400 font-semibold text-gray-700 bg-white">
                                </div>
                                <div>
                                    <label class="text-sm font-bold mb-2 block text-gray-800">Sampai Tanggal</label>
                                    <input type="date" id="rekap_end_date" onchange="filterRekapTable()" class="w-full px-3 py-1 border-2 border-pink-200 rounded-xl h-12 outline-none focus:border-pink-400 font-semibold text-gray-700 bg-white">
                                </div>
                                <div class="flex gap-2">
                                    <button onclick="resetRekapFilters()" class="flex-1 border-2 border-gray-200 hover:bg-gray-50 text-gray-700 font-bold rounded-xl h-12 shadow-sm transition">Reset</button>
                                    <button onclick="downloadPDF('rekap')" class="flex-1 inline-flex items-center justify-center gap-2 text-white bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-700 hover:to-purple-700 font-bold rounded-xl h-12 px-6 shadow-md transition duration-250 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>Export PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rekap KPI Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="bg-gradient-to-br from-blue-400 to-cyan-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                            <div>
                                <p class="text-white/80 text-sm mb-1 font-semibold">Total Transaksi</p>
                                <p id="rekap_total_trx_val" class="text-4xl font-extrabold">{{ $rekapStats['total_trx'] }}</p>
                            </div>
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-emerald-400 to-teal-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                            <div>
                                <p class="text-white/80 text-sm mb-1 font-semibold">Total Pendapatan</p>
                                <p id="rekap_total_sales_val" class="text-3xl font-extrabold">Rp {{ number_format($rekapStats['total_sales'], 0, ',', '.') }}</p>
                            </div>
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7"><line x1="12" x2="12" y1="2" y2="22"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-yellow-400 to-orange-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                            <div>
                                <p class="text-white/80 text-sm mb-1 font-semibold">Status DP</p>
                                <p id="rekap_dp_count_val" class="text-4xl font-extrabold">{{ $rekapStats['dp_count'] }}</p>
                            </div>
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-green-400 to-emerald-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                            <div>
                                <p class="text-white/80 text-sm mb-1 font-semibold">Status Lunas</p>
                                <p id="rekap_lunas_count_val" class="text-4xl font-extrabold">{{ $rekapStats['lunas_count'] }}</p>
                            </div>
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Rekap Table Detail -->
                    <div data-slot="card" class="bg-card text-card-foreground flex flex-col gap-6 border-4 border-pink-200 shadow-2xl rounded-[2rem]">
                        <div data-slot="card-header" class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6 bg-gradient-to-r from-pink-100 via-purple-100 to-rose-100 border-b-4 border-pink-200">
                            <h4 data-slot="card-title" class="text-2xl font-extrabold text-pink-900">🧾 Rekap Semua Transaksi</h4>
                        </div>
                        <div data-slot="card-content" class="px-6 [&:last-child]:pb-6 pt-6">
                            <div class="overflow-x-auto">
                                <div data-slot="table-container" class="relative w-full overflow-x-auto">
                                    <table data-slot="table" class="w-full caption-bottom text-sm">
                                        <thead data-slot="table-header" class="[&_tr]:border-b">
                                            <tr data-slot="table-row" class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors bg-gradient-to-r from-pink-50 to-purple-50">
                                                <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap font-extrabold">No</th>
                                                <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap font-extrabold">Tanggal</th>
                                                <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap font-extrabold">Nama Pelanggan</th>
                                                <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap font-extrabold">Jenis Pembayaran</th>
                                                <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap font-extrabold">Total Pesanan</th>
                                                <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap font-extrabold">Jumlah Dibayar</th>
                                                <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap font-extrabold">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rekap_tbody" data-slot="table-body" class="[&_tr:last-child]:border-0">
                                            @forelse($allTransactions as $idx => $trx)
                                                <tr data-slot="table-row" class="data-[state=selected]:bg-muted border-b transition-colors hover:bg-pink-50/50 rekap-row" data-date="{{ $trx->created_at->toDateString() }}" data-status="{{ $trx->status }}" data-total="{{ $trx->total }}" data-paid="{{ $trx->paid }}">
                                                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap font-bold">{{ $idx + 1 }}</td>
                                                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap">{{ $trx->created_at->translatedFormat('d F Y') }}</td>
                                                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap font-bold text-gray-900">{{ $trx->customer }}</td>
                                                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap">
                                                        @if($trx->status == 'Lunas')
                                                            <span data-slot="badge" class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 transition-[color,box-shadow] overflow-hidden bg-green-100 text-green-800 border-green-300">✓ Lunas</span>
                                                        @else
                                                            <span data-slot="badge" class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 transition-[color,box-shadow] overflow-hidden bg-yellow-100 text-yellow-800 border-yellow-300">💰 DP</span>
                                                        @endif
                                                    </td>
                                                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap font-extrabold text-lg text-pink-700">Rp&nbsp;{{ number_format($trx->total, 0, ',', '.') }}</td>
                                                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap font-bold text-emerald-700">Rp&nbsp;{{ number_format($trx->paid, 0, ',', '.') }}</td>
                                                    <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap">
                                                        @if($trx->status == 'Lunas')
                                                            <span data-slot="badge" class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 transition-[color,box-shadow] overflow-hidden bg-green-100 text-green-800 border-green-300">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 mr-1"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>Lunas
                                                            </span>
                                                        @else
                                                            <span data-slot="badge" class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 transition-[color,box-shadow] overflow-hidden bg-orange-100 text-orange-800 border-orange-300">Belum Lunas</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr id="rekap-original-empty"><td colspan="7" class="text-center py-8 text-gray-400 font-bold">Belum ada data transaksi.</td></tr>
                                            @endforelse
                                            
                                            <!-- Dynamic JS Empty State -->
                                            <tr id="rekap-js-empty" class="hidden">
                                                <td colspan="7" class="py-16 text-center">
                                                    <div class="flex flex-col items-center justify-center gap-2">
                                                        <div class="w-16 h-16 bg-pink-50 rounded-2xl flex items-center justify-center border border-pink-100 shadow-sm mx-auto">
                                                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2z" /></svg>
                                                        </div>
                                                        <h4 class="text-lg font-bold text-pink-600">Tidak ada rekap transaksi</h4>
                                                        <p class="text-sm text-pink-400 font-semibold">Untuk rentang filter yang dipilih</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <!-- Total Row -->
                                            <tr data-slot="table-row" class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors bg-gradient-to-r from-pink-100 to-purple-100 font-bold">
                                                <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap text-right font-extrabold text-lg" colspan="4">TOTAL:</td>
                                                <td data-slot="table-cell" id="rekap_total_order_sum" class="p-2 align-middle whitespace-nowrap font-extrabold text-xl text-pink-700">Rp&nbsp;{{ number_format($allTransactions->sum('total'), 0, ',', '.') }}</td>
                                                <td data-slot="table-cell" id="rekap_filtered_sum" class="p-2 align-middle whitespace-nowrap font-extrabold text-xl text-emerald-700">Rp&nbsp;{{ number_format($allTransactions->sum('paid'), 0, ',', '.') }}</td>
                                                <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Tab switching routing & URL state sync
    function switchTab(tabName) {
        // Hide all tab views
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));

        // Reset all buttons to default grey segments
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.className = "tab-btn flex-1 py-3 text-sm font-bold text-purple-700 hover:bg-white/40 hover:text-purple-900 transition rounded-xl";
        });

        // Show matching content
        const targetView = document.getElementById('tab-' + tabName);
        if (targetView) targetView.classList.remove('hidden');

        // Style the active tab button with white background & deep color text + shadow
        const targetBtn = document.getElementById('btn-' + tabName);
        if (targetBtn) {
            targetBtn.className = "tab-btn flex-1 py-3 text-sm font-extrabold text-pink-900 bg-white rounded-xl shadow-lg transition";
        }
    }

    // Dynamic Date change trigger for Daily tab
    function changeDailyDate(val) {
        window.location.href = `?daily_date=${val}&tab=harian`;
    }

    // Dynamic dropdown filters for Monthly tab
    function changeMonthlyFilter() {
        const m = document.getElementById('filter_month').value;
        const y = document.getElementById('filter_year').value;
        window.location.href = `?month=${m}&year=${y}&tab=bulanan`;
    }

    // ==========================================
    // CLIENT SIDE LIVE SEARCH FOR STOCK GRID
    // ==========================================
    function filterStockGrid() {
        const query = document.getElementById('stock_search_input').value.toLowerCase();
        const rows = document.querySelectorAll('.material-grid-row');
        
        rows.forEach(row => {
            const matName = row.getAttribute('data-name');
            if (matName.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // ==========================================
    // CLIENT SIDE LIVE FILTER FOR STOCK HISTORIES
    // ==========================================
    function filterStockLogs() {
        const startDateVal = document.getElementById('stock_start_date').value;
        const endDateVal = document.getElementById('stock_end_date').value;
        const typeFilter = document.getElementById('stock_type').value;
        const searchVal = document.getElementById('stock_search_input').value.toLowerCase();

        const start = startDateVal ? new Date(startDateVal) : null;
        const end = endDateVal ? new Date(endDateVal) : null;

        const rows = document.querySelectorAll('.stock-log-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const rowDateStr = row.getAttribute('data-date');
            const rowType = row.getAttribute('data-type');
            const rowName = row.getAttribute('data-name');

            const rowDate = rowDateStr ? new Date(rowDateStr) : null;

            let matches = true;

            // 1. Filter Date
            if (rowDate) {
                if (start && rowDate < start) matches = false;
                if (end && rowDate > end) matches = false;
            } else if (start || end) {
                matches = false;
            }

            // 2. Filter Type
            if (typeFilter !== 'all' && rowType !== typeFilter) {
                matches = false;
            }

            // 3. Filter Search Material Name
            if (searchVal && !rowName.includes(searchVal)) {
                matches = false;
            }

            row.style.display = matches ? '' : 'none';
            if (matches) visibleCount++;
        });

        // Toggle Dynamic JS Empty State
        const emptyState = document.getElementById('stock-logs-js-empty');
        if (emptyState) {
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
    }

    // Reset stock filters
    function resetStockFilters() {
        document.getElementById('stock_start_date').value = '';
        document.getElementById('stock_end_date').value = '';
        document.getElementById('stock_type').value = 'all';
        document.getElementById('stock_search_input').value = '';
        
        filterStockLogs();
        filterStockGrid();
    }

    // ==========================================
    // CLIENT SIDE LIVE FILTER FOR REKAP TABLE
    // ==========================================
    function filterRekapTable() {
        const startVal = document.getElementById('rekap_start_date').value;
        const endVal = document.getElementById('rekap_end_date').value;

        const start = startVal ? new Date(startVal) : null;
        const end = endVal ? new Date(endVal) : null;

        const rows = document.querySelectorAll('.rekap-row');
        let visibleCount = 0;
        let sumSales = 0;
        let sumTotal = 0;
        let visibleDpCount = 0;
        let visibleLunasCount = 0;

        rows.forEach(row => {
            const rowDateStr = row.getAttribute('data-date');
            const rowStatus = row.getAttribute('data-status');
            const rowPaid = parseFloat(row.getAttribute('data-paid') || 0);
            const rowTotal = parseFloat(row.getAttribute('data-total') || 0);

            const rowDate = rowDateStr ? new Date(rowDateStr) : null;

            let matches = true;

            if (rowDate) {
                if (start && rowDate < start) matches = false;
                if (end && rowDate > end) matches = false;
            } else if (start || end) {
                matches = false;
            }

            row.style.display = matches ? '' : 'none';

            if (matches) {
                visibleCount++;
                sumSales += rowPaid;
                sumTotal += rowTotal;
                if (rowStatus === 'Lunas') {
                    visibleLunasCount++;
                } else {
                    visibleDpCount++;
                }
            }
        });

        // Update aggregations dynamically
        document.getElementById('rekap_total_trx_val').innerText = visibleCount;
        document.getElementById('rekap_total_sales_val').innerText = 'Rp ' + sumSales.toLocaleString('id-ID');
        document.getElementById('rekap_dp_count_val').innerText = visibleDpCount;
        document.getElementById('rekap_lunas_count_val').innerText = visibleLunasCount;
        document.getElementById('rekap_total_order_sum').innerHTML = 'Rp&nbsp;' + sumTotal.toLocaleString('id-ID');
        document.getElementById('rekap_filtered_sum').innerHTML = 'Rp&nbsp;' + sumSales.toLocaleString('id-ID');

        // Toggle empty state
        const emptyState = document.getElementById('rekap-js-empty');
        if (emptyState) {
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
    }

    function resetRekapFilters() {
        document.getElementById('rekap_start_date').value = '';
        document.getElementById('rekap_end_date').value = '';
        filterRekapTable();
    }

    // Chart.js render engine pas halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        // Sync URL Tab routing parameter
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab') || 'harian';
        switchTab(activeTab);

        // =========================================================
        // A. MONTHLY SALES BAR CHART (Recharts Style)
        // =========================================================
        const barCanvas = document.getElementById('barSalesChart');
        if (barCanvas) {
            const ctx = barCanvas.getContext('2d');
            const salesData = @json($chartSalesData);

            // Recharts Gradient color fill
            const purplePinkGradient = ctx.createLinearGradient(0, 0, 0, 400);
            purplePinkGradient.addColorStop(0, '#a855f7');
            purplePinkGradient.addColorStop(1, '#ec4899');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Oct', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Total Penjualan',
                        data: salesData,
                        backgroundColor: purplePinkGradient,
                        hoverBackgroundColor: '#ec4899',
                        borderRadius: 8,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#a855f7',
                                font: {
                                    size: 14,
                                    weight: 'bold',
                                    family: 'DM Sans'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#ffffff',
                            titleColor: '#111827',
                            bodyColor: '#a855f7',
                            bodyFont: { weight: 'bold' },
                            borderColor: '#e9d5ff',
                            borderWidth: 2,
                            borderRadius: 12,
                            padding: 10,
                            callbacks: {
                                label: function(context) {
                                    return 'Total Penjualan: Rp ' + context.raw.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            grid: {
                                color: '#e9d5ff',
                                strokeDashArray: [3, 3]
                            },
                            ticks: {
                                color: '#a855f7',
                                font: {
                                    weight: 'bold'
                                },
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#a855f7',
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });
        }

        // =========================================================
        // B. MONTHLY TREND LINE CHART (Recharts Style - 3 datasets)
        // =========================================================
        const lineCanvas = document.getElementById('lineTrendChart');
        if (lineCanvas) {
            const ctx = lineCanvas.getContext('2d');
            const trxData = @json($chartTrxData);
            const dpData = @json(collect($monthlyData)->pluck('dp_count')->toArray());
            const lunasData = @json(collect($monthlyData)->pluck('lunas_count')->toArray());

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Oct', 'Nov', 'Des'],
                    datasets: [
                        {
                            label: 'Total Transaksi',
                            data: trxData,
                            borderColor: '#a855f7',
                            borderWidth: 3,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#a855f7',
                            pointBorderWidth: 3,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            tension: 0.4,
                            fill: false
                        },
                        {
                            label: 'DP',
                            data: dpData,
                            borderColor: '#f59e0b',
                            borderWidth: 2,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#f59e0b',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            tension: 0.4,
                            fill: false
                        },
                        {
                            label: 'Lunas',
                            data: lunasData,
                            borderColor: '#10b981',
                            borderWidth: 2,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#10b981',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            tension: 0.4,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: {
                                    size: 13,
                                    weight: 'bold',
                                    family: 'DM Sans'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#ffffff',
                            titleColor: '#111827',
                            bodyColor: '#374151',
                            borderColor: '#e9d5ff',
                            borderWidth: 2,
                            borderRadius: 12,
                            padding: 10
                        }
                    },
                    scales: {
                        y: {
                            grid: {
                                color: '#e9d5ff',
                                strokeDashArray: [3, 3]
                            },
                            ticks: {
                                color: '#a855f7',
                                font: {
                                    weight: 'bold'
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#a855f7',
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });
        }
    });

    // ==========================================
    // HIGH CORRECTNESS HTML2PDF EXPORTER
    // ==========================================
    function downloadPDF(tabName) {
        const tabEl = document.getElementById('tab-' + tabName);
        if (!tabEl) return;

        // Create a printable wrapper
        const printWrapper = document.createElement('div');
        printWrapper.className = 'p-8 bg-white text-slate-800 font-sans';
        printWrapper.style.width = '100%';
        printWrapper.style.maxWidth = '100%';

        // Custom style overrides for high-quality table print
        const styleBlock = document.createElement('style');
        styleBlock.innerHTML = `
            table { width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 25px; font-size: 12px; font-family: 'DM Sans', sans-serif; }
            th, td { border: 1px solid #cbd5e1; padding: 10px 12px; text-align: left; }
            th { background-color: #f1f5f9; color: #1e293b; font-weight: 700; text-transform: uppercase; font-size: 11px; }
            tr:nth-child(even) { background-color: #f8fafc; }
            .text-right { text-align: right; }
            .text-center { text-align: center; }
            .font-bold { font-weight: 700; }
            .font-extrabold { font-weight: 800; }
            .text-lg { font-size: 14px; }
            .text-xl { font-size: 16px; }
            .text-2xl { font-size: 18px; }
            .text-pink-600 { color: #db2777; }
            .text-emerald-600, .text-emerald-700 { color: #059669; }
            .text-rose-600 { color: #e11d48; }
            .text-purple-700, .text-purple-900 { color: #6d28d9; }
            .text-orange-600 { color: #ea580c; }
            .bg-green-100 { background-color: #dcfce7; }
            .text-green-800 { color: #166534; }
            .bg-yellow-100 { background-color: #fef9c3; }
            .text-yellow-800 { color: #854d0e; }
            .bg-orange-100 { background-color: #ffedd5; }
            .text-orange-800 { color: #9a3412; }
            .bg-rose-50 { background-color: #fff1f2; }
            .text-rose-700 { color: #be123c; }
            .bg-green-50 { background-color: #f0fdf4; }
            .text-green-700 { color: #15803d; }
            .inline-flex { display: inline-flex; align-items: center; justify-content: center; }
            .rounded-md { border-radius: 4px; }
            .px-2 { padding-left: 6px; padding-right: 6px; }
            .py-0.5, .py-1 { padding-top: 2px; padding-bottom: 2px; }
            .text-xs { font-size: 10px; }
            .font-semibold { font-weight: 600; }
            .ml-2 { margin-left: 6px; }
            .bg-purple-500 { background-color: #a855f7; }
            .text-white { color: #ffffff; }
            .hidden, #stock-logs-js-empty.hidden, #rekap-js-empty.hidden { display: none !important; }
        `;
        printWrapper.appendChild(styleBlock);

        // Add Brand & Report Header
        let reportTitle = '';
        let reportPeriod = '';
        
        if (tabName === 'harian') {
            reportTitle = 'LAPORAN PENJUALAN HARIAN';
            const dateVal = document.getElementById('daily_date_picker').value;
            let d = new Date(dateVal);
            reportPeriod = 'Tanggal: ' + d.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
        } else if (tabName === 'bulanan') {
            reportTitle = 'LAPORAN PENJUALAN BULANAN';
            const m = document.getElementById('filter_month');
            const y = document.getElementById('filter_year');
            reportPeriod = 'Bulan: ' + m.options[m.selectedIndex].text + ' ' + y.value;
        } else if (tabName === 'stok') {
            reportTitle = 'LAPORAN STOK & RIWAYAT BAHAN BAKU';
            reportPeriod = 'Tanggal Cetak: ' + new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
        } else if (tabName === 'rekap') {
            reportTitle = 'LAPORAN REKAP TRANSAKSI PENJUALAN';
            const startVal = document.getElementById('rekap_start_date').value;
            const endVal = document.getElementById('rekap_end_date').value;
            if (startVal && endVal) {
                let s = new Date(startVal).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                let e = new Date(endVal).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                reportPeriod = `Periode: ${s} s/d ${e}`;
            } else {
                reportPeriod = 'Periode: Semua Transaksi';
            }
        }

        printWrapper.innerHTML += `
            <div style="text-align: center; border-bottom: 3px double #e2e8f0; padding-bottom: 15px; margin-bottom: 25px;">
                <h1 style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 900; color: #db2777; margin: 0; letter-spacing: 1px;">ALCAKE</h1>
                <p style="font-size: 12px; color: #64748b; margin: 5px 0 0 0;">Premium Bakery & Custom Cake</p>
                <h2 style="font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: #1e1b4b; margin: 15px 0 5px 0; text-transform: uppercase;">${reportTitle}</h2>
                <p style="font-size: 14px; font-weight: 600; color: #475569; margin: 0;">${reportPeriod}</p>
            </div>
        `;

        // Add KPI summary if present (in a neat, print-friendly table)
        let kpis = [];
        if (tabName === 'harian') {
            kpis = [
                { label: 'Total Transaksi', value: tabEl.querySelectorAll('.grid p')[1]?.innerText || '0' },
                { label: 'Total Penjualan', value: tabEl.querySelectorAll('.grid p')[3]?.innerText || 'Rp 0' },
                { label: 'Status DP', value: tabEl.querySelectorAll('.grid p')[5]?.innerText || '0' },
                { label: 'Status Lunas', value: tabEl.querySelectorAll('.grid p')[7]?.innerText || '0' }
            ];
        } else if (tabName === 'rekap') {
            kpis = [
                { label: 'Total Transaksi', value: document.getElementById('rekap_total_trx_val').innerText },
                { label: 'Total Pendapatan', value: document.getElementById('rekap_total_sales_val').innerText },
                { label: 'Status DP', value: document.getElementById('rekap_dp_count_val').innerText },
                { label: 'Status Lunas', value: document.getElementById('rekap_lunas_count_val').innerText }
            ];
        } else if (tabName === 'bulanan') {
            kpis = [
                { label: 'Total Transaksi Bulan Ini', value: tabEl.querySelectorAll('.grid p')[1]?.innerText || '0' },
                { label: 'Status DP', value: tabEl.querySelectorAll('.grid p')[3]?.innerText || '0' },
                { label: 'Status Lunas', value: tabEl.querySelectorAll('.grid p')[5]?.innerText || '0' }
            ];
        } else if (tabName === 'stok') {
            kpis = [
                { label: 'Total Bahan Baku', value: tabEl.querySelectorAll('.grid p')[1]?.innerText || '0' },
                { label: 'Stok Kurang', value: tabEl.querySelectorAll('.grid p')[3]?.innerText || '0' },
                { label: 'Stok Aman', value: tabEl.querySelectorAll('.grid p')[5]?.innerText || '0' }
            ];
        }

        if (kpis.length > 0) {
            let kpiHtml = `<div style="margin-bottom: 25px;"><table style="width: 100%; border-collapse: collapse; background-color: #f8fafc; border: 1px solid #e2e8f0;"><tr>`;
            kpis.forEach(kpi => {
                kpiHtml += `
                    <td style="padding: 12px; text-align: center; border: 1px solid #cbd5e1;">
                        <span style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; display: block; margin-bottom: 4px;">${kpi.label}</span>
                        <span style="font-size: 18px; font-weight: 800; color: #0f172a;">${kpi.value}</span>
                    </td>
                `;
            });
            kpiHtml += `</tr></table></div>`;
            printWrapper.innerHTML += kpiHtml;
        }

        // Add Tables
        if (tabName === 'stok') {
            const tables = tabEl.querySelectorAll('table');
            if (tables[0]) {
                const table1Clone = tables[0].cloneNode(true);
                
                const title1 = document.createElement('h3');
                title1.innerText = '1. Status Stok Bahan Baku';
                title1.style.fontFamily = "'Outfit', sans-serif";
                title1.style.fontSize = '16px';
                title1.style.fontWeight = '700';
                title1.style.marginBottom = '10px';
                title1.style.color = '#1e1b4b';
                
                printWrapper.appendChild(title1);
                printWrapper.appendChild(table1Clone);
            }

            if (tables[1]) {
                const table2Clone = tables[1].cloneNode(true);
                
                const originalRows = tabEl.querySelectorAll('.stock-log-row');
                const clonedRows = table2Clone.querySelectorAll('.stock-log-row');
                clonedRows.forEach((row, idx) => {
                    if (originalRows[idx] && originalRows[idx].style.display === 'none') {
                        row.remove();
                    }
                });

                const originalJsEmpty = document.getElementById('stock-logs-js-empty');
                if (originalJsEmpty && !originalJsEmpty.classList.contains('hidden')) {
                    const clonedJsEmpty = table2Clone.querySelector('#stock-logs-js-empty');
                    if (clonedJsEmpty) clonedJsEmpty.classList.remove('hidden');
                }

                const title2 = document.createElement('h3');
                title2.innerText = '2. Riwayat Keluar/Masuk Bahan Baku';
                title2.style.fontFamily = "'Outfit', sans-serif";
                title2.style.fontSize = '16px';
                title2.style.fontWeight = '700';
                title2.style.marginTop = '25px';
                title2.style.marginBottom = '10px';
                title2.style.color = '#1e1b4b';

                printWrapper.appendChild(title2);
                printWrapper.appendChild(table2Clone);
            }
        } else {
            const tableEl = tabEl.querySelector('table');
            if (tableEl) {
                const tableClone = tableEl.cloneNode(true);

                if (tabName === 'rekap') {
                    const originalRows = document.querySelectorAll('.rekap-row');
                    const clonedRows = tableClone.querySelectorAll('.rekap-row');
                    clonedRows.forEach((row, idx) => {
                        if (originalRows[idx] && originalRows[idx].style.display === 'none') {
                            row.remove();
                        }
                    });
                    
                    const clonedTotalOrderSum = tableClone.querySelector('#rekap_total_order_sum');
                    const clonedFilteredSum = tableClone.querySelector('#rekap_filtered_sum');
                    if (clonedTotalOrderSum) clonedTotalOrderSum.innerHTML = document.getElementById('rekap_total_order_sum').innerHTML;
                    if (clonedFilteredSum) clonedFilteredSum.innerHTML = document.getElementById('rekap_filtered_sum').innerHTML;

                    const originalJsEmpty = document.getElementById('rekap-js-empty');
                    if (originalJsEmpty && !originalJsEmpty.classList.contains('hidden')) {
                        const clonedJsEmpty = tableClone.querySelector('#rekap-js-empty');
                        if (clonedJsEmpty) clonedJsEmpty.classList.remove('hidden');
                    }
                }

                printWrapper.appendChild(tableClone);
            }
        }

        // Add Footer
        const footer = document.createElement('div');
        footer.style.textAlign = 'right';
        footer.style.fontSize = '10px';
        footer.style.color = '#64748b';
        footer.style.marginTop = '30px';
        footer.style.borderTop = '1px solid #e2e8f0';
        footer.style.paddingTop = '10px';
        footer.innerText = `Dokumen ini diunduh secara otomatis dari Laporan Alcake pada ${new Date().toLocaleString('id-ID')}`;
        printWrapper.appendChild(footer);

        // PDF Options
        const dateStr = new Date().toISOString().split('T')[0];
        const filename = `Laporan_Alcake_${tabName}_${dateStr}.pdf`;

        const opt = {
            margin:       0.3,
            filename:     filename,
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, useCORS: true },
            jsPDF:        { unit: 'in', format: 'a4', orientation: 'landscape' }
        };

        alert('Menyiapkan dokumen PDF Laporan Operasional (Tabel Format), mohon tunggu sebentar...');
        html2pdf().set(opt).from(printWrapper).save();
    }
</script>
@endsection
