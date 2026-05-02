@extends('layouts.app')

@section('title', 'Stok Bahan Baku - Alva Cake')

@section('content')
<div class="max-w-7xl mx-auto px-8 py-6">
    <div class="space-y-8">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-pink-100 via-rose-100 to-pink-50 p-8 shadow-xl border border-pink-200/50">
            <div class="absolute top-0 right-0 w-64 h-64 bg-pink-200/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-rose-200/30 rounded-full blur-3xl"></div>
            <div class="relative flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-rose-400 rounded-2xl flex items-center justify-center shadow-lg transform rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-8 h-8 text-white"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent">Stok Bahan Baku</h1>
                        <div class="flex items-center gap-3 mt-2">
                            <p class="text-pink-600 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-4 h-4"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>
                                Kelola stok bahan baku untuk produksi kue
                            </p>
                            <span data-slot="badge" class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden [a&amp;]:hover:bg-primary/90 bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border-green-300 font-semibold text-xs">✓ Sinkron dengan Order Management</span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button data-slot="dialog-trigger" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive hover:bg-primary/90 h-9 has-[&gt;svg]:px-3 bg-gradient-to-r from-green-400 to-emerald-400 hover:from-green-500 hover:to-emerald-500 text-white shadow-2xl rounded-2xl px-6 py-6 transform hover:scale-105 transition-all" type="button" onclick="openAddStockModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-5 h-5 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg><span class="font-semibold">Tambah Stok</span>
                    </button>
                    <button data-slot="dialog-trigger" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive hover:bg-primary/90 h-9 has-[&gt;svg]:px-3 bg-gradient-to-r from-pink-400 to-rose-400 hover:from-pink-500 hover:to-rose-500 text-white shadow-2xl rounded-2xl px-6 py-6 transform hover:scale-105 transition-all" type="button" onclick="openNewMaterialModal()">
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
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-500 rounded-xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-5 h-5 text-white"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg></div><h3 class="text-xl font-bold text-pink-900">Stok Bahan Baku Saat Ini</h3>
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
                            <tr class="hover:bg-gradient-to-r hover:from-pink-50/50 hover:to-transparent transition-all group">
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
                                    <button data-slot="button" type="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive hover:bg-primary/90 px-4 py-2 has-[&gt;svg]:px-3 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white shadow-xl rounded-xl h-12 font-semibold text-base" onclick="openAddStockModal()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pen w-5 h-5 mr-2"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"></path></svg>Edit
                                    </button>
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
            <div class="bg-gradient-to-r from-purple-100 via-pink-100 to-rose-100 rounded-3xl p-6 border-2 border-pink-200/50 shadow-xl">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-5 h-5 text-white"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg></div>
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">Riwayat Stok Masuk</h3>
                </div>
                <div class="flex items-center gap-3 flex-wrap bg-white/60 backdrop-blur-sm p-5 rounded-2xl border border-pink-200">
                    <div class="flex items-center gap-2 flex-1 min-w-[200px]"><label data-slot="label" class="select-none text-sm font-semibold text-pink-700 whitespace-nowrap flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-4 h-4"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>Dari:</label><input type="date" data-slot="input" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 flex w-full min-w-0 px-3 py-1 text-base transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive flex-1 bg-white border-2 border-pink-200 rounded-xl h-11 font-medium focus:border-pink-400" value=""></div>
                    <div class="flex items-center gap-2 flex-1 min-w-[200px]"><label data-slot="label" class="select-none text-sm font-semibold text-pink-700 whitespace-nowrap flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-4 h-4"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>Sampai:</label><input type="date" data-slot="input" class="file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 flex w-full min-w-0 px-3 py-1 text-base transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive flex-1 bg-white border-2 border-pink-200 rounded-xl h-11 font-medium focus:border-pink-400" value=""></div>
                    <button data-slot="popover-trigger" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive text-foreground hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 py-2 has-[&gt;svg]:px-3 bg-gradient-to-r from-purple-50 to-pink-50 border-2 border-purple-200 rounded-xl shadow-md hover:from-purple-100 hover:to-pink-100 h-11 px-5" type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="radix-:r22:" data-state="closed">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4 mr-2 text-purple-600"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg><span class="text-purple-900 font-semibold">Kalender</span>
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
                                <tr class="hover:bg-gradient-to-r hover:from-purple-50/30 hover:to-pink-50/30 transition-all">
                                    <td class="px-8 py-5 whitespace-nowrap"><div class="flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4 text-pink-500"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg><span class="text-base font-bold text-pink-900">{{ $in->date }}</span></div></td>
                                    <td class="px-8 py-5 whitespace-nowrap"><span data-slot="badge" class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden [a&amp;]:hover:bg-primary/90 bg-purple-100 text-purple-700 border-purple-200 font-semibold">{{ $in->time }}</span></td>
                                    <td class="px-8 py-5 whitespace-nowrap text-base font-bold text-pink-900">{{ $in->name }}</td>
                                    <td class="px-8 py-5 whitespace-nowrap"><div class="inline-flex items-center gap-2 bg-gradient-to-r from-green-100 to-emerald-100 px-4 py-2 rounded-xl border-2 border-green-200"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-4 h-4 text-green-600"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg><span class="text-lg font-bold text-green-700">{{ $in->qty }} </span></div></td>
                                    <td class="px-8 py-5"><p class="text-sm text-gray-700 font-medium">{{ $in->notes }}</p></td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="py-6 text-gray-400">Belum ada riwayat masuk.</td></tr>
                            @endforelse
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
                                <tr class="hover:bg-gradient-to-r hover:from-orange-50/30 hover:to-red-50/30 transition-all">
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
                                <tr><td colspan="5" class="py-6 text-gray-400">Belum ada riwayat penggunaan.</td></tr>
                            @endforelse
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

<div id="addStockModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900/40 backdrop-blur-sm py-10 transition-opacity">
    <div class="bg-white rounded-3xl w-full max-w-md mx-4 shadow-2xl flex flex-col relative overflow-hidden">
        <div class="px-7 pt-7 pb-4 flex justify-between items-center border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="bg-[#10B981] w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-xl leading-none">+</div>
                <h2 class="text-xl font-bold text-[#059669]">Tambah Stok Bahan Baku</h2>
            </div>
            <button onclick="closeAddStockModal()" class="text-gray-400 hover:text-red-500 transition cursor-pointer"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
        </div>

        <form action="{{ route('materials.update_stock') }}" method="POST" class="p-7 space-y-5">
            @csrf
            <div class="bg-[#FFF5F8] border border-pink-200 rounded-2xl p-4">
                <label class="block text-xs font-bold text-[#80153B] mb-2">Pilih Bahan Baku</label>
                <div class="relative">
                    <select name="material_name" id="stock_material_select" onchange="updateStockUnit()" required class="w-full bg-white border border-pink-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-pink-300 outline-none appearance-none cursor-pointer font-medium text-gray-700 shadow-sm">
                        <option value="" data-unit="-">Pilih bahan baku...</option>
                        @foreach($materials ?? [] as $mat)
                            <option value="{{ $mat->name }}" data-unit="{{ $mat->unit }}">{{ $mat->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute right-4 top-3.5 text-pink-400 pointer-events-none"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg></div>
                </div>
            </div>

            <div class="bg-[#F0FDF4] border border-green-200 rounded-2xl p-4">
                <label class="block text-xs font-bold text-[#059669] mb-2">Jumlah Masuk</label>
                <div class="flex gap-3">
                    <input type="number" name="qty" step="0.1" min="0.1" required placeholder="0" class="flex-1 bg-white border border-green-100 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-green-300 outline-none text-gray-800 font-bold shadow-sm">
                    <div id="stock_unit_display" class="w-16 bg-white border border-green-100 rounded-xl flex items-center justify-center text-[#059669] font-bold text-sm shadow-sm">-</div>
                </div>
            </div>

            <div class="pt-4 flex gap-3">
                <button type="submit" class="flex-1 bg-[#10B981] hover:bg-[#059669] text-white font-bold py-3.5 rounded-xl shadow-md transition cursor-pointer">+ Tambah Stok</button>
                <button type="button" onclick="closeAddStockModal()" class="flex-1 bg-white border-2 border-gray-200 text-gray-600 hover:bg-gray-50 font-bold py-3.5 rounded-xl transition cursor-pointer">Batal</button>
            </div>
        </form>
    </div>
</div>

<div id="newMaterialModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900/40 backdrop-blur-sm py-10 transition-opacity">
    <div class="bg-white rounded-3xl w-full max-w-md mx-4 shadow-2xl flex flex-col relative max-h-[95vh] overflow-hidden">
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
                    <input type="text" name="unit" required placeholder="Satuan (misal: kg, pcs, liter)..." class="w-full bg-white border border-pink-50 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-pink-300 outline-none text-gray-800 font-medium shadow-sm">
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

<script>
    function openAddStockModal() {
        document.getElementById('addStockModal').classList.remove('hidden');
        updateStockUnit();
    }

    function closeAddStockModal() {
        document.getElementById('addStockModal').classList.add('hidden');
    }

    function updateStockUnit() {
        const select = document.getElementById('stock_material_select');
        const unitDisplay = document.getElementById('stock_unit_display');
        if (select.selectedIndex > 0) {
            unitDisplay.innerText = select.options[select.selectedIndex].getAttribute('data-unit');
            unitDisplay.classList.add('bg-green-100');
        } else {
            unitDisplay.innerText = '-';
            unitDisplay.classList.remove('bg-green-100');
        }
    }

    function openNewMaterialModal() {
        document.getElementById('newMaterialModal').classList.remove('hidden');
    }

    function closeNewMaterialModal() {
        document.getElementById('newMaterialModal').classList.add('hidden');
    }
</script>
@endsection
