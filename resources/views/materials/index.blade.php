@extends('layouts.app')

@section('title', 'Stok Bahan Baku - Alva Cake')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-8 py-6">
    <div class="space-y-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-pink-100 via-rose-100 to-pink-50 p-8 shadow-xl border border-pink-200/50">
            <div class="absolute top-0 right-0 w-64 h-64 bg-pink-200/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-rose-200/30 rounded-full blur-3xl"></div>
            <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-rose-400 rounded-2xl flex items-center justify-center shadow-lg transform rotate-3 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-8 h-8 text-white"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent">Stok Bahan Baku</h1>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 mt-2">
                            <p class="text-pink-600 flex items-center gap-2 text-sm sm:text-base">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-4 h-4"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>
                                Kelola stok bahan baku untuk produksi kue
                            </p>
                            <span data-slot="badge" class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden [a&amp;]:hover:bg-primary/90 bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border-green-300 font-semibold text-xs">✓ Sinkron dengan Order Management</span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3 w-full md:w-auto">
                    <button data-slot="dialog-trigger" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive hover:bg-primary/90 h-9 has-[&gt;svg]:px-3 bg-gradient-to-r from-pink-400 to-rose-400 hover:from-pink-500 hover:to-rose-500 text-white shadow-2xl rounded-2xl px-6 py-6 transform hover:scale-105 transition-all w-full md:w-auto" type="button" onclick="openNewMaterialModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-5 h-5 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg><span class="font-semibold">Tambah Bahan Baku Baru</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-green-400 to-emerald-400 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-center justify-between">
                    <div><p class="text-green-100 text-sm font-medium mb-1">Stok Aman</p><p class="text-4xl font-bold">{{ $stokAman ?? 0 }}</p></div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-8 h-8"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg></div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-orange-400 to-amber-400 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-center justify-between">
                    <div><p class="text-orange-100 text-sm font-medium mb-1">Stok Rendah</p><p class="text-4xl font-bold">{{ $stokRendah ?? 0 }}</p></div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-down w-8 h-8"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"></polyline><polyline points="16 17 22 17 22 11"></polyline></svg></div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-pink-400 to-rose-400 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-center justify-between">
                    <div><p class="text-pink-100 text-sm font-medium mb-1">Total Bahan</p><p class="text-4xl font-bold">{{ $totalBahan ?? 0 }}</p></div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-8 h-8"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg></div>
                </div>
            </div>
        </div>

        <div class="bg-white/90 backdrop-blur-xl rounded-3xl border-2 border-pink-100 overflow-hidden shadow-2xl">
            <div class="px-8 py-6 bg-gradient-to-r from-pink-100 via-rose-100 to-pink-100 border-b-2 border-pink-200">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-500 rounded-xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-5 h-5 text-white"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg></div><h3 class="text-xl font-bold text-pink-900">Stok Bahan Baku Saat Ini</h3>
                    </div>
                    <div class="flex items-center gap-2 bg-white/80 backdrop-blur-sm rounded-xl px-4 py-2 border-2 border-pink-200 w-full sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-5 h-5 text-pink-500"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>
                        <input type="text" id="material_search_input" data-slot="input" class="border-0 bg-transparent focus-visible:ring-0 focus-visible:ring-offset-0 text-sm font-medium w-full sm:w-64 outline-none" placeholder="Cari nama bahan baku..." value="">
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-pink-50 via-rose-50 to-pink-50">
                        <tr>
                            <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Nama Bahan</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Stok Saat Ini</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Satuan</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Stok Minimal</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Stok Maksimal</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Status</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Terakhir Update</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-pink-100">
                        @forelse($materials ?? [] as $mat)
                            <tr class="hover:bg-gradient-to-r hover:from-pink-50/50 hover:to-transparent transition-all group material-row" data-material-name="{{ strtolower($mat->name) }}">
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                        <span class="text-base font-bold text-pink-900">{{ $mat->name }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap"><span class="text-2xl font-bold text-blue-600">{{ $mat->stock }}</span></td>
                                <td class="px-8 py-5 whitespace-nowrap"><span data-slot="badge" class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden [a&amp;]:hover:bg-primary/90 bg-pink-100 text-pink-700 border-pink-200">{{ $mat->unit }}</span></td>
                                <td class="px-8 py-5 whitespace-nowrap"><div class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-down w-4 h-4 text-orange-500"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"></polyline><polyline points="16 17 22 17 22 11"></polyline></svg><span class="text-sm font-semibold text-orange-600">{{ $mat->min_stock }} {{ $mat->unit }}</span></div></td>
                                <td class="px-8 py-5 whitespace-nowrap"><div class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-4 h-4 text-green-500"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg><span class="text-sm font-semibold text-green-600">{{ $mat->max_stock ?? '-' }} {{ $mat->unit }}</span></div></td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    @if($mat->status == 'Stok Rendah')
                                        <span data-slot="badge" class="inline-flex items-center justify-center rounded-md px-2 py-0.5 text-xs w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden [a&amp;]:hover:bg-primary/90 bg-red-100 text-red-700 border border-red-200 font-semibold">{{ $mat->status }}</span>
                                    @else
                                        <span data-slot="badge" class="inline-flex items-center justify-center rounded-md px-2 py-0.5 text-xs w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden [a&amp;]:hover:bg-primary/90 bg-blue-100 text-blue-700 border border-blue-200 font-semibold">{{ $mat->status }}</span>
                                    @endif
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm text-pink-600 font-medium">{{ optional($mat->updated_at)->translatedFormat('d M Y') }}</td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <button data-slot="button" type="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive hover:bg-primary/90 py-2 has-[&gt;svg]:px-3 bg-gradient-to-r from-purple-500 to-violet-500 hover:from-purple-600 hover:to-violet-600 text-white shadow-lg rounded-xl h-10 px-4 font-semibold text-sm cursor-pointer" onclick="openEditMaterialModal({{ $mat->id }}, '{{ addslashes($mat->name) }}', '{{ $mat->unit }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pen w-4 h-4 mr-1"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"></path></svg>Edit
                                        </button>
                                        <button data-slot="button" type="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive hover:bg-primary/90 py-2 has-[&gt;svg]:px-3 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white shadow-lg rounded-xl h-10 px-4 font-semibold text-sm cursor-pointer" onclick="openEditStockModal({{ $mat->id }}, '{{ addslashes($mat->name) }}', {{ $mat->stock }}, {{ $mat->min_stock }}, {{ $mat->max_stock ?? 'null' }}, '{{ $mat->unit }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4 mr-1"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>Tambah Stok
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="py-10 text-gray-400 text-center">Belum ada data stok bahan baku.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <div class="relative z-20 bg-gradient-to-r from-purple-100 via-pink-100 to-rose-100 rounded-3xl p-6 border-2 border-pink-200/50 shadow-xl">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-5 h-5 text-white"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg></div>
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Riwayat Stok Masuk</h3>
                </div>
                <div class="flex items-center gap-3 flex-wrap bg-white/60 backdrop-blur-sm p-5 rounded-2xl border border-pink-200">
                    <div class="flex items-center gap-2 flex-1 min-w-[200px]"><label data-slot="label" class="select-none text-sm font-semibold text-pink-700 whitespace-nowrap flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-4 h-4"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>Dari:</label><input type="date" id="history_start_date" data-slot="input" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 flex w-full min-w-0 px-3 py-1 text-base transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive flex-1 bg-white border-2 border-pink-200 rounded-xl h-11 font-medium focus:border-pink-400" value=""></div>
                    <div class="flex items-center gap-2 flex-1 min-w-[200px]"><label data-slot="label" class="select-none text-sm font-semibold text-pink-700 whitespace-nowrap flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-4 h-4"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>Sampai:</label><input type="date" id="history_end_date" data-slot="input" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 flex w-full min-w-0 px-3 py-1 text-base transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive flex-1 bg-white border-2 border-pink-200 rounded-xl h-11 font-medium focus:border-pink-400" value=""></div>
                    
                    <!-- Popover Wrapper -->
                    <div class="relative">
                        <button id="calendarPopoverBtn" onclick="toggleCalendarPopover()" data-slot="popover-trigger" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive text-foreground hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 py-2 has-[&gt;svg]:px-3 bg-gradient-to-r from-purple-50 to-pink-50 border-2 border-purple-200 rounded-xl shadow-md hover:from-purple-100 hover:to-pink-100 h-11 px-5" type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="calendarPopover" data-state="closed">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4 mr-2 text-purple-600"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg><span class="text-purple-900 font-semibold">Kalender</span>
                        </button>
                        
                        <!-- Popover Calendar Popup -->
                        <div id="calendarPopover" class="hidden absolute right-0 mt-2 z-50 bg-white border border-gray-100 rounded-3xl shadow-2xl p-6 min-w-[320px] sm:w-[600px] overflow-hidden" style="transform-origin: top right;">
                            <!-- Header: Chevrons & Month Labels -->
                            <div class="flex items-center justify-between mb-4 w-full px-2">
                                <button type="button" class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-100 text-gray-400 hover:bg-gray-50 hover:text-gray-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polyline points="15 18 9 12 15 6"></polyline></svg>
                                </button>
                                <div class="flex-1 flex justify-between px-16">
                                    <div class="text-sm font-semibold text-gray-800">Mei 2026</div>
                                    <div class="text-sm font-semibold text-gray-800">Juni 2026</div>
                                </div>
                                <button type="button" class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-100 text-gray-400 hover:bg-gray-50 hover:text-gray-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                </button>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-6">
                                <!-- Month 1: Mei 2026 -->
                                <div class="flex-1">
                                    <!-- Weekdays -->
                                    <div class="grid grid-cols-7 gap-1 text-center text-xs font-semibold text-gray-400 mb-2">
                                        <div>Sen</div>
                                        <div>Sel</div>
                                        <div>Rab</div>
                                        <div>Kam</div>
                                        <div>Jum</div>
                                        <div>Sab</div>
                                        <div>Min</div>
                                    </div>
                                    <!-- Days -->
                                    <div class="grid grid-cols-7 gap-1 text-center">
                                        <!-- Previous Month Days (Muted) -->
                                        <span class="w-8 h-8 flex items-center justify-center text-sm text-gray-300">27</span>
                                        <span class="w-8 h-8 flex items-center justify-center text-sm text-gray-300">28</span>
                                        <span class="w-8 h-8 flex items-center justify-center text-sm text-gray-300">29</span>
                                        <span class="w-8 h-8 flex items-center justify-center text-sm text-gray-300">30</span>
                                        <!-- Active Days -->
                                        <button type="button" onclick="selectCalendarDate('2026-05-01')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">1</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-02')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">2</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-03')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">3</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-04')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">4</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-05')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">5</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-06')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">6</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-07')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">7</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-08')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">8</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-09')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">9</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-10')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">10</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-11')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">11</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-12')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">12</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-13')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">13</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-14')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">14</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-15')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">15</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-16')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">16</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-17')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">17</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-18')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">18</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-19')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">19</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-20')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">20</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-21')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">21</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-22')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">22</button>
                                        <!-- Selected default active day 23 -->
                                        <button type="button" onclick="selectCalendarDate('2026-05-23')" id="day-2026-05-23" class="w-8 h-8 rounded-xl text-sm font-semibold bg-gray-100 text-gray-800 transition">23</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-24')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">24</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-25')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">25</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-26')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">26</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-27')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">27</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-28')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">28</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-29')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">29</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-30')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">30</button>
                                        <button type="button" onclick="selectCalendarDate('2026-05-31')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">31</button>
                                    </div>
                                </div>

                                <!-- Month 2: Juni 2026 -->
                                <div class="flex-1">
                                    <!-- Weekdays -->
                                    <div class="grid grid-cols-7 gap-1 text-center text-xs font-semibold text-gray-400 mb-2">
                                        <div>Sen</div>
                                        <div>Sel</div>
                                        <div>Rab</div>
                                        <div>Kam</div>
                                        <div>Jum</div>
                                        <div>Sab</div>
                                        <div>Min</div>
                                    </div>
                                    <!-- Days -->
                                    <div class="grid grid-cols-7 gap-1 text-center">
                                        <!-- Active Days -->
                                        <button type="button" onclick="selectCalendarDate('2026-06-01')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">1</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-02')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">2</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-03')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">3</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-04')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">4</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-05')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">5</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-06')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">6</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-07')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">7</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-08')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">8</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-09')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">9</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-10')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">10</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-11')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">11</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-12')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">12</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-13')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">13</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-14')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">14</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-15')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">15</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-16')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">16</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-17')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">17</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-18')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">18</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-19')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">19</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-20')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">20</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-21')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">21</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-22')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">22</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-23')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">23</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-24')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">24</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-25')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">25</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-26')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">26</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-27')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">27</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-28')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">28</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-29')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">29</button>
                                        <button type="button" onclick="selectCalendarDate('2026-06-30')" class="w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium">30</button>
                                        <!-- Next Month Days (Muted) -->
                                        <span class="w-8 h-8 flex items-center justify-center text-sm text-gray-300">1</span>
                                        <span class="w-8 h-8 flex items-center justify-center text-sm text-gray-300">2</span>
                                        <span class="w-8 h-8 flex items-center justify-center text-sm text-gray-300">3</span>
                                        <span class="w-8 h-8 flex items-center justify-center text-sm text-gray-300">4</span>
                                        <span class="w-8 h-8 flex items-center justify-center text-sm text-gray-300">5</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Reset Button -->
                    <button type="button" onclick="resetHistoryFilter()" class="inline-flex items-center justify-center px-4 py-2 font-bold text-red-600 hover:text-red-700 hover:bg-red-50/50 rounded-xl transition-all text-sm h-11">
                        Reset
                    </button>
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-xl rounded-3xl border-2 border-pink-100 overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-purple-50 via-pink-50 to-rose-50">
                            <tr>
                                <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Tanggal</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Waktu</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Nama Bahan</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Jumlah Masuk</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pink-100">
                            @forelse($inboundHistory ?? [] as $in)
                                <tr class="hover:bg-gradient-to-r hover:from-purple-50/30 hover:to-pink-50/30 transition-all inbound-row" data-date="{{ $in->raw_date }}">
                                    <td class="px-8 py-5 whitespace-nowrap"><div class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4 text-pink-500"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg><span class="text-base font-bold text-pink-900">{{ $in->date }}</span></div></td>
                                    <td class="px-8 py-5 whitespace-nowrap"><span data-slot="badge" class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden [a&amp;]:hover:bg-primary/90 bg-purple-100 text-purple-700 border-purple-200 font-semibold">{{ $in->time }}</span></td>
                                    <td class="px-8 py-5 whitespace-nowrap text-base font-bold text-pink-900">{{ $in->name }}</td>
                                    <td class="px-8 py-5 whitespace-nowrap"><div class="inline-flex items-center gap-2 bg-gradient-to-r from-green-100 to-emerald-100 px-4 py-2 rounded-xl border-2 border-green-200"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-4 h-4 text-green-600"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg><span class="text-lg font-bold text-green-700">{{ $in->qty }} </span></div></td>
                                    <td class="px-8 py-5"><p class="text-sm text-gray-700 font-medium">{{ $in->notes }}</p></td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="py-10 text-gray-400 text-center font-semibold">Belum ada riwayat masuk.</td></tr>
                            @endforelse
                            <!-- Empty State Row -->
                            <tr id="inbound-empty-state" class="hidden">
                                <td colspan="5" class="py-16 text-center">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div class="w-16 h-16 bg-pink-50 rounded-2xl flex items-center justify-center border border-pink-100 shadow-sm mx-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-pink-500"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path><path d="m3.3 7 8.7 5 8.7-5"></path><path d="M12 22V12"></path></svg>
                                        </div>
                                        <h4 class="text-lg font-bold text-pink-600">Tidak ada data riwayat</h4>
                                        <p class="text-sm text-pink-400 font-medium">Untuk periode yang dipilih</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl border-2 border-pink-200/50 shadow-md">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-400 rounded-xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-5 h-5 text-white"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg></div>
                    <div><p class="text-sm text-pink-600 font-medium">Total Riwayat Stok Masuk</p><p class="text-xl font-bold text-pink-900">{{ count($inboundHistory ?? []) }} dari {{ count($inboundHistory ?? []) }} transaksi</p></div>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-gradient-to-r from-orange-100 via-red-100 to-pink-100 rounded-3xl p-6 border-2 border-orange-200/50 shadow-xl">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-down w-5 h-5 text-white"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"></polyline><polyline points="16 17 22 17 22 11"></polyline></svg></div>
                    <div><h3 class="text-2xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">Riwayat Penggunaan Bahan Baku</h3><p class="text-orange-600 text-sm mt-1 flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert w-4 h-4"><circle cx="12" cy="12" r="10"></circle><line x1="12" x2="12" y1="8" y2="12"></line><line x1="12" x2="12.01" y1="16" y2="16"></line></svg>Pengurangan stok dari pesanan produksi (Order Management)</p></div>
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-xl rounded-3xl border-2 border-orange-100 overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-orange-50 via-red-50 to-pink-50">
                            <tr>
                                <th class="px-8 py-5 text-left text-xs font-bold text-orange-900 uppercase tracking-wide">Tanggal</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-orange-900 uppercase tracking-wide">Waktu</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-orange-900 uppercase tracking-wide">Nama Bahan</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-orange-900 uppercase tracking-wide">Jumlah Keluar</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-orange-900 uppercase tracking-wide">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-orange-100">
                            @forelse($outboundHistory ?? [] as $out)
                                <tr class="hover:bg-gradient-to-r hover:from-orange-50/30 hover:to-red-50/30 transition-all outbound-row" data-date="{{ $out->raw_date }}">
                                    <td class="px-8 py-5 whitespace-nowrap"><div class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4 text-orange-500"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg><span class="text-base font-bold text-orange-900">{{ $out->date }}</span></div></td>
                                    <td class="px-8 py-5 whitespace-nowrap"><span data-slot="badge" class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden [a&amp;]:hover:bg-primary/90 bg-orange-100 text-orange-700 border-orange-200 font-semibold">{{ $out->time }}</span></td>
                                    <td class="px-8 py-5 whitespace-nowrap text-base font-bold text-orange-900">{{ $out->name }}</td>
                                    <td class="px-8 py-5 whitespace-nowrap"><div class="inline-flex items-center gap-2 bg-gradient-to-r from-red-100 to-orange-100 px-4 py-2 rounded-xl border-2 border-red-200"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-down w-4 h-4 text-red-600"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"></polyline><polyline points="16 17 22 17 22 11"></polyline></svg><span class="text-lg font-bold text-red-700">{{ $out->qty }} </span></div></td>
                                    <td class="px-8 py-5 text-left pr-6">
                                        <p class="text-sm text-gray-700 font-medium mb-1">{{ $out->notes }}</p>
                                        @if(isset($out->product) && $out->product != null)
                                            <span class="inline-flex items-center gap-1.5 bg-[#FFF0F6] text-[#D82A97] px-2.5 py-1 rounded-md text-xs font-bold">🍰 Produk: {{ $out->product }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="py-10 text-gray-400 text-center font-semibold">Belum ada riwayat penggunaan.</td></tr>
                            @endforelse
                            <!-- Empty State Row -->
                            <tr id="outbound-empty-state" class="hidden">
                                <td colspan="5" class="py-16 text-center">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div class="w-16 h-16 bg-orange-50 rounded-2xl flex items-center justify-center border border-orange-100 shadow-sm mx-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-orange-500"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path><path d="m3.3 7 8.7 5 8.7-5"></path><path d="M12 22V12"></path></svg>
                                        </div>
                                        <h4 class="text-lg font-bold text-orange-600">Tidak ada data riwayat</h4>
                                        <p class="text-sm text-orange-400 font-medium">Untuk periode yang dipilih</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-orange-50 to-red-50 rounded-2xl border-2 border-orange-200/50 shadow-md">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-red-400 rounded-xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-down w-5 h-5 text-white"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"></polyline><polyline points="16 17 22 17 22 11"></polyline></svg></div>
                    <div><p class="text-sm text-orange-600 font-medium">Total Penggunaan Bahan</p><p class="text-xl font-bold text-orange-900">{{ count($outboundHistory ?? []) }} transaksi</p></div>
                </div>
                <span data-slot="badge" class="inline-flex items-center justify-center rounded-md w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden [a&amp;]:hover:bg-primary/90 bg-gradient-to-r from-purple-100 to-pink-100 text-purple-700 border-2 border-purple-200 px-4 py-2 text-sm font-semibold">✓ Sinkron dengan Order Management</span>
            </div>
        </div>
    </div>
</div>



<div id="newMaterialModal" class="fixed inset-0 z-50 hidden flex items-center justify-center py-10 animate-fade-in">
    <div onclick="closeNewMaterialModal()" data-state="open" data-slot="dialog-overlay" class="data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 fixed inset-0 z-50 bg-black/40 backdrop-blur-md" style="pointer-events: auto;" data-aria-hidden="true" aria-hidden="true"></div>
    <div class="bg-white rounded-3xl w-full max-w-md mx-4 shadow-2xl flex flex-col relative max-h-[95vh] overflow-hidden z-50">
        <div class="px-7 pt-7 pb-4 flex justify-between items-center border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="bg-[#FF4B8B] w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-xl leading-none">+</div>
                <h2 class="text-xl font-bold text-[#D82A97]">Tambah Bahan Baku Baru</h2>
            </div>
            <button onclick="closeNewMaterialModal()" class="text-gray-400 hover:text-red-500 transition cursor-pointer"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
        </div>

        <div class="p-7 overflow-y-auto custom-scrollbar">
            <form action="{{ route('materials.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="bg-[#FFF0F6] border border-pink-100 rounded-2xl p-4">
                    <label class="block text-xs font-bold text-[#D82A97] mb-1.5">Nama Bahan Baku</label>
                    <input type="text" name="name" required placeholder="Nama bahan baku..." class="w-full bg-white border border-pink-50 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-pink-300 outline-none text-gray-800 font-medium shadow-sm">
                </div>

                <div class="bg-[#FFF0F6] border border-pink-100 rounded-2xl p-4">
                    <label class="block text-xs font-bold text-[#D82A97] mb-1.5">Satuan</label>
                    <select name="unit" required class="w-full bg-white border border-pink-50 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-pink-300 outline-none text-gray-800 font-medium shadow-sm">
                        <option value="kg">⚖️ kg (Kilogram)</option>
                        <option value="gr">⚖️ gr (Gram)</option>
                        <option value="pcs">📦 pcs (Butir / Biji)</option>
                        <option value="liter">🥛 liter (Liter)</option>
                        <option value="ml">🥛 ml (Mililiter)</option>
                        <option value="pack">🛍️ pack (Pak)</option>
                        <option value="bungkus">🛍️ bungkus (Bungkus)</option>
                    </select>
                </div>

                <div class="bg-[#FFF0F6] border border-pink-100 rounded-2xl p-4">
                    <label class="block text-xs font-bold text-[#D82A97] mb-1.5">Stok Awal</label>
                    <input type="number" name="stock" step="0.1" min="0" required placeholder="0" class="w-full bg-white border border-pink-50 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-pink-300 outline-none text-gray-800 font-bold shadow-sm">
                </div>

                <div class="bg-[#FFF0F6] border border-pink-100 rounded-2xl p-4">
                    <label class="block text-xs font-bold text-[#D82A97] mb-1.5">Stok Minimal</label>
                    <input type="number" name="min_stock" step="0.1" min="0" required placeholder="0" class="w-full bg-white border border-pink-50 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-pink-300 outline-none text-gray-800 font-bold shadow-sm">
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="submit" class="flex-1 bg-[#FF4B8B] hover:bg-[#E11D48] text-white font-bold py-3.5 rounded-xl shadow-md transition cursor-pointer">+ Tambah Bahan Baku</button>
                    <button type="button" onclick="closeNewMaterialModal()" class="flex-1 bg-white border-2 border-gray-200 text-gray-600 hover:bg-gray-50 font-bold py-3.5 rounded-xl transition cursor-pointer">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Nama & Satuan Bahan Baku -->
<div id="editMaterialModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40 backdrop-blur-md animate-fade-in">
    <div onclick="closeEditMaterialModal()" data-state="open" data-slot="dialog-overlay" class="data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 fixed inset-0 z-50 bg-transparent" style="pointer-events: auto;" data-aria-hidden="true" aria-hidden="true"></div>
    <div role="dialog" id="radix-:r4l:" aria-describedby="radix-:r4n:" aria-labelledby="radix-:r4m:" data-state="open" data-slot="dialog-content" class="data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 relative w-full max-w-[calc(100%-2rem)] z-50 gap-4 p-6 duration-200 sm:max-w-[500px] bg-white backdrop-blur-xl rounded-3xl border-2 border-purple-200/50 shadow-2xl max-h-[90vh] flex flex-col" tabindex="-1" style="pointer-events: auto;">
        <div data-slot="dialog-header" class="flex flex-col gap-2 text-center sm:text-left">
            <div class="flex items-center gap-3 pb-2">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-violet-400 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pen w-6 h-6 text-white"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"></path></svg>
                </div>
                <div>
                    <h2 id="radix-:r4m:" data-slot="dialog-title" class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-violet-600 bg-clip-text text-transparent">Edit Nama &amp; Satuan Bahan Baku</h2>
                    <p id="edit-material-name" class="text-sm text-gray-600 mt-1">Nama Bahan</p>
                </div>
            </div>
        </div>
        <form id="editMaterialForm" method="POST" class="space-y-5 pt-4 overflow-y-auto pr-2" style="max-height: calc(-180px + 90vh);">
            @csrf
            @method('PUT')
            <div class="space-y-3 p-5 bg-gradient-to-br from-purple-50 to-violet-50 rounded-2xl border border-purple-100">
                <label data-slot="label" class="select-none text-sm font-semibold text-purple-900 flex items-center gap-1" for="edit-name">Nama Bahan Baku <span class="text-red-600">*</span></label>
                <input type="text" id="edit-name" name="name" data-slot="input" class="w-full bg-white rounded-xl h-12 text-lg font-semibold border-2 border-purple-200 px-3 outline-none focus:ring-2 focus:ring-purple-300" placeholder="Nama bahan baku..." value="" required>
            </div>
            <div class="space-y-3 p-5 bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl border border-pink-100">
                <label data-slot="label" class="select-none text-sm font-semibold text-pink-900 flex items-center gap-1" for="edit-unit">Satuan <span class="text-red-600">*</span></label>
                <input type="text" id="edit-unit" name="unit" data-slot="input" class="w-full bg-white rounded-xl h-12 text-lg font-semibold border-2 border-pink-200 px-3 outline-none focus:ring-2 focus:ring-pink-300" placeholder="kg, gram, pcs, dll..." value="" required>
            </div>
            <div class="flex gap-3 pt-2">
                <button data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] hover:bg-primary/90 px-4 py-2 flex-1 bg-gradient-to-r from-purple-500 to-violet-500 hover:from-purple-600 hover:to-violet-600 text-white shadow-xl rounded-xl h-12 font-semibold text-base cursor-pointer" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save w-5 h-5 mr-2"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"></path><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"></path><path d="M7 3v4a1 1 0 0 0 1 1h7"></path></svg>Simpan Perubahan
                </button>
                <button type="button" onclick="closeEditMaterialModal()" data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] bg-background text-foreground hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 px-4 py-2 flex-1 rounded-xl border-2 border-pink-200 hover:bg-pink-50 h-12 font-semibold cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5 mr-2"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>Batal
                </button>
            </div>
        </form>
        <button type="button" onclick="closeEditMaterialModal()" class="ring-offset-background focus:ring-ring data-[state=open]:bg-accent data-[state=open]:text-muted-foreground absolute top-4 right-4 rounded-xs opacity-70 transition-opacity hover:opacity-100 focus:ring-2 focus:ring-offset-2 focus:outline-hidden disabled:pointer-events-none [&amp;_svg]:pointer-events-none [&amp;_svg]:shrink-0 [&amp;_svg:not([class*='size-'])]:size-4 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
            <span class="sr-only">Close</span>
        </button>
    </div>
</div>

<!-- Modal Pengaturan Stok Bahan Baku -->
<div id="editStockModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40 backdrop-blur-md animate-fade-in">
    <div onclick="closeEditStockModal()" data-state="open" data-slot="dialog-overlay" class="data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 fixed inset-0 z-50 bg-transparent" style="pointer-events: auto;" data-aria-hidden="true" aria-hidden="true"></div>
    <div role="dialog" id="radix-:r4o:" aria-describedby="radix-:r4q:" aria-labelledby="radix-:r4p:" data-state="open" data-slot="dialog-content" class="data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 relative w-full max-w-[calc(100%-2rem)] z-50 gap-4 p-6 duration-200 sm:max-w-[600px] bg-white backdrop-blur-xl rounded-3xl border-2 border-green-200/50 shadow-2xl max-h-[90vh] flex flex-col mx-auto" style="pointer-events: auto;">
        <div data-slot="dialog-header" class="flex flex-col gap-2 text-center sm:text-left">
            <div class="flex items-center gap-3 pb-2">
                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-400 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-6 h-6 text-white"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                </div>
                <div>
                    <h2 id="radix-:r4p:" data-slot="dialog-title" class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">Pengaturan Stok Bahan Baku</h2>
                    <p id="stock-material-name" class="text-sm text-gray-600 mt-1">Nama Bahan</p>
                </div>
            </div>
        </div>
        <div class="overflow-y-auto pr-2" style="max-height: calc(-180px + 90vh);">
            <div class="p-4 bg-yellow-50 border-2 border-yellow-200 rounded-2xl mb-5">
                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert w-5 h-5 text-yellow-700 flex-shrink-0 mt-0.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" x2="12" y1="8" y2="12"></line><line x1="12" x2="12.01" y1="16" y2="16"></line></svg>
                    <div>
                        <p class="text-sm font-bold text-yellow-900">Perhatian: Field Wajib Diisi</p>
                        <p class="text-xs text-yellow-700 mt-1">Semua field bertanda <span class="text-red-600 font-bold">*</span> wajib diisi dengan angka yang valid</p>
                    </div>
                </div>
            </div>
            <form id="editStockForm" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                <div class="space-y-3 p-5 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl border border-blue-100">
                    <label data-slot="label" class="select-none text-sm font-semibold text-blue-900 flex items-center gap-1" for="edit-stock">Stok Saat Ini <span class="text-red-600">*</span></label>
                    <div class="flex gap-3">
                        <input type="number" name="stock" data-slot="input" class="w-full bg-white rounded-xl h-12 text-lg font-semibold border-2 border-blue-200 px-3 outline-none focus:ring-2 focus:ring-blue-300 flex-1" id="edit-stock" placeholder="0" min="0.01" step="0.01" required>
                        <div class="w-28 flex items-center justify-center bg-white border-2 border-blue-200 rounded-xl px-4 font-bold text-blue-700 edit-unit-display">kg</div>
                    </div>
                </div>
                <div class="space-y-3 p-5 bg-gradient-to-br from-orange-50 to-amber-50 rounded-2xl border border-orange-100">
                    <label data-slot="label" class="select-none text-sm font-semibold text-orange-900 flex items-center gap-1" for="edit-minStock">Stok Minimal <span class="text-red-600">*</span></label>
                    <div class="flex gap-3">
                        <input type="number" name="min_stock" data-slot="input" class="w-full bg-white rounded-xl h-12 text-lg font-semibold border-2 border-orange-200 px-3 outline-none focus:ring-2 focus:ring-orange-300 flex-1" id="edit-minStock" placeholder="0" min="0.01" step="0.01" required>
                        <div class="w-28 flex items-center justify-center bg-white border-2 border-orange-200 rounded-xl px-4 font-bold text-orange-700 edit-unit-display">kg</div>
                    </div>
                </div>
                <div class="space-y-3 p-5 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-100">
                    <label data-slot="label" class="select-none text-sm font-semibold text-green-900 flex items-center gap-1" for="edit-maxStock">Stok Maksimal <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                    <div class="flex gap-3">
                        <input type="number" name="max_stock" data-slot="input" class="w-full bg-white rounded-xl h-12 text-lg font-semibold border-2 border-green-200 px-3 outline-none focus:ring-2 focus:ring-green-300 flex-1" id="edit-maxStock" placeholder="0" min="0.01" step="0.01">
                        <div class="w-28 flex items-center justify-center bg-white border-2 border-green-200 rounded-xl px-4 font-bold text-green-700 edit-unit-display">kg</div>
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] hover:bg-primary/90 px-4 py-2 flex-1 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white shadow-xl rounded-xl h-12 font-semibold text-base cursor-pointer" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save w-5 h-5 mr-2"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"></path><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"></path><path d="M7 3v4a1 1 0 0 0 1 1h7"></path></svg>Simpan Perubahan
                    </button>
                    <button type="button" onclick="closeEditStockModal()" data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] bg-background text-foreground hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 px-4 py-2 flex-1 rounded-xl border-2 border-pink-200 hover:bg-pink-50 h-12 font-semibold cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5 mr-2"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>Batal
                    </button>
                </div>
            </form>
        </div>
        <button type="button" onclick="closeEditStockModal()" class="ring-offset-background focus:ring-ring data-[state=open]:bg-accent data-[state=open]:text-muted-foreground absolute top-4 right-4 rounded-xs opacity-70 transition-opacity hover:opacity-100 focus:ring-2 focus:ring-offset-2 focus:outline-hidden disabled:pointer-events-none [&amp;_svg]:pointer-events-none [&amp;_svg]:shrink-0 [&amp;_svg:not([class*='size-'])]:size-4 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
            <span class="sr-only">Close</span>
        </button>
    </div>
</div>

<script>
    let selectedStartDate = null;
    let selectedEndDate = null;

    function toggleCalendarPopover() {
        const popover = document.getElementById('calendarPopover');
        const btn = document.getElementById('calendarPopoverBtn');
        if (popover.classList.contains('hidden')) {
            popover.classList.remove('hidden');
            btn.setAttribute('aria-expanded', 'true');
            btn.setAttribute('data-state', 'open');
        } else {
            popover.classList.add('hidden');
            btn.setAttribute('aria-expanded', 'false');
            btn.setAttribute('data-state', 'closed');
        }
    }

    function selectCalendarDate(dateStr) {
        const startInput = document.getElementById('history_start_date');
        const endInput = document.getElementById('history_end_date');
        
        if (!selectedStartDate || (selectedStartDate && selectedEndDate)) {
            // First click or reset
            selectedStartDate = dateStr;
            selectedEndDate = null;
            startInput.value = dateStr;
            endInput.value = '';
            highlightCalendarDays();
        } else {
            // Second click
            if (new Date(dateStr) < new Date(selectedStartDate)) {
                selectedStartDate = dateStr;
                startInput.value = dateStr;
                highlightCalendarDays();
            } else {
                selectedEndDate = dateStr;
                endInput.value = dateStr;
                highlightCalendarDays();
                // Close popover after range selection with subtle delay for great UX
                setTimeout(() => {
                    const popover = document.getElementById('calendarPopover');
                    const btn = document.getElementById('calendarPopoverBtn');
                    if (popover) popover.classList.add('hidden');
                    if (btn) btn.setAttribute('data-state', 'closed');
                }, 300);
            }
        }
        
        filterHistoryByDate();
    }

    function highlightCalendarDays() {
        const allButtons = document.querySelectorAll('#calendarPopover button[onclick^="selectCalendarDate"]');
        allButtons.forEach(btn => {
            const onclickAttr = btn.getAttribute('onclick');
            if (onclickAttr) {
                const match = onclickAttr.match(/'([^']+)'/);
                if (match) {
                    const dateVal = match[1];
                    
                    // Reset class
                    btn.className = "w-8 h-8 rounded-lg text-sm text-gray-800 hover:bg-gray-100 transition font-medium";
                    
                    if (selectedStartDate === dateVal || selectedEndDate === dateVal) {
                        btn.className = "w-8 h-8 rounded-xl text-sm font-semibold bg-gray-100 text-gray-800 shadow-sm transition";
                    } else if (selectedStartDate && selectedEndDate && new Date(dateVal) > new Date(selectedStartDate) && new Date(dateVal) < new Date(selectedEndDate)) {
                        btn.className = "w-8 h-8 rounded-lg text-sm font-semibold bg-gray-50 text-gray-600 transition";
                    }
                }
            }
        });
    }

    function filterHistoryByDate() {
        const startDateVal = document.getElementById('history_start_date').value;
        const endDateVal = document.getElementById('history_end_date').value;
        
        const start = startDateVal ? new Date(startDateVal) : null;
        const end = endDateVal ? new Date(endDateVal) : null;
        
        let inboundVisibleCount = 0;
        // Filter inbound rows
        const inboundRows = document.querySelectorAll('.inbound-row');
        inboundRows.forEach(row => {
            const dateStr = row.getAttribute('data-date');
            const rowDate = dateStr ? new Date(dateStr) : null;
            
            let show = true;
            if (rowDate) {
                if (start && rowDate < start) show = false;
                if (end && rowDate > end) show = false;
            }
            row.style.display = show ? '' : 'none';
            if (show) inboundVisibleCount++;
        });

        // Toggle Inbound Empty State
        const inboundEmptyState = document.getElementById('inbound-empty-state');
        if (inboundEmptyState) {
            if (inboundVisibleCount === 0) {
                inboundEmptyState.classList.remove('hidden');
            } else {
                inboundEmptyState.classList.add('hidden');
            }
        }

        let outboundVisibleCount = 0;
        // Filter outbound rows
        const outboundRows = document.querySelectorAll('.outbound-row');
        outboundRows.forEach(row => {
            const dateStr = row.getAttribute('data-date');
            const rowDate = dateStr ? new Date(dateStr) : null;
            
            let show = true;
            if (rowDate) {
                if (start && rowDate < start) show = false;
                if (end && rowDate > end) show = false;
            }
            row.style.display = show ? '' : 'none';
            if (show) outboundVisibleCount++;
        });

        // Toggle Outbound Empty State
        const outboundEmptyState = document.getElementById('outbound-empty-state');
        if (outboundEmptyState) {
            if (outboundVisibleCount === 0) {
                outboundEmptyState.classList.remove('hidden');
            } else {
                outboundEmptyState.classList.add('hidden');
            }
        }
    }

    function resetHistoryFilter() {
        // Clear inputs
        document.getElementById('history_start_date').value = '';
        document.getElementById('history_end_date').value = '';
        
        // Reset calendar selected variables
        selectedStartDate = null;
        selectedEndDate = null;
        
        // Reset highlights
        highlightCalendarDays();
        
        // Re-run filter
        filterHistoryByDate();
    }

    function initCalendarPopover() {
        const startInput = document.getElementById('history_start_date');
        const endInput = document.getElementById('history_end_date');
        
        if (startInput && endInput) {
            // Listen to direct manual input changes
            startInput.addEventListener('change', () => {
                selectedStartDate = startInput.value || null;
                highlightCalendarDays();
                filterHistoryByDate();
            });
            endInput.addEventListener('change', () => {
                selectedEndDate = endInput.value || null;
                highlightCalendarDays();
                filterHistoryByDate();
            });
        }
        
        // Document click to close popover when clicked outside
        document.removeEventListener('click', handleOutsideCalendarClick);
        document.addEventListener('click', handleOutsideCalendarClick);
    }
    
    function handleOutsideCalendarClick(event) {
        const popover = document.getElementById('calendarPopover');
        const btn = document.getElementById('calendarPopoverBtn');
        if (popover && btn) {
            if (!popover.contains(event.target) && !btn.contains(event.target)) {
                popover.classList.add('hidden');
                btn.setAttribute('data-state', 'closed');
            }
        }
    }

    // Initialize calendar hook on load
    document.addEventListener('turbo:load', initCalendarPopover);
    document.addEventListener('DOMContentLoaded', initCalendarPopover);


    function openNewMaterialModal() {
        document.getElementById('newMaterialModal').classList.remove('hidden');
    }

    function closeNewMaterialModal() {
        document.getElementById('newMaterialModal').classList.add('hidden');
    }

    // Modal 1: Edit Name & Unit (Purple Theme)
    function openEditMaterialModal(id, name, unit) {
        document.getElementById('editMaterialModal').classList.remove('hidden');
        document.getElementById('edit-material-name').innerText = name;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-unit').value = unit;
        document.getElementById('editMaterialForm').action = `/materials/${id}`;
    }

    function closeEditMaterialModal() {
        document.getElementById('editMaterialModal').classList.add('hidden');
    }

    // Modal 2: Edit Stock Settings (Green Theme)
    function openEditStockModal(id, name, stock, minStock, maxStock, unit) {
        document.getElementById('editStockModal').classList.remove('hidden');
        document.getElementById('stock-material-name').innerText = name;
        document.getElementById('edit-stock').value = stock;
        document.getElementById('edit-minStock').value = minStock;
        document.getElementById('edit-maxStock').value = maxStock !== null ? maxStock : '';
        
        // Update unit displays
        const unitDisplays = document.querySelectorAll('.edit-unit-display');
        unitDisplays.forEach(el => el.innerText = unit);
        
        // Dynamic action URL for form
        document.getElementById('editStockForm').action = `/materials/${id}`;
    }

    function closeEditStockModal() {
        document.getElementById('editStockModal').classList.add('hidden');
    }

    // Search filter logic
    document.addEventListener('turbo:load', function() {
        const searchInput = document.getElementById('material_search_input');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const query = e.target.value.toLowerCase().trim();
                const rows = document.querySelectorAll('.material-row');
                rows.forEach(row => {
                    const name = row.getAttribute('data-material-name');
                    if (name.includes(query)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });

    // Fallback for non-turbo page loads
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('material_search_input');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const query = e.target.value.toLowerCase().trim();
                const rows = document.querySelectorAll('.material-row');
                rows.forEach(row => {
                    const name = row.getAttribute('data-material-name');
                    if (name.includes(query)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });

    window.resetHistoryFilter = resetHistoryFilter;
    window.toggleHistoryDetails = toggleHistoryDetails;
    window.initCalendarPopover = initCalendarPopover;
    window.handleOutsideCalendarClick = handleOutsideCalendarClick;
    window.openNewMaterialModal = openNewMaterialModal;
    window.closeNewMaterialModal = closeNewMaterialModal;
    window.openEditMaterialModal = openEditMaterialModal;
    window.closeEditMaterialModal = closeEditMaterialModal;
    window.openEditStockModal = openEditStockModal;
    window.closeEditStockModal = closeEditStockModal;
</script>
@endsection
