@extends('layouts.app')

@section('title', 'Produksi Pesanan - Alva Cake')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-8 py-6">
    <div class="space-y-8" style="font-family: &quot;DM Sans&quot;, sans-serif;">
        <!-- Header Banner -->
        <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-400 p-8 sm:p-10 shadow-2xl animate-fade-in">
            <div class="absolute inset-0">
                <div class="absolute -top-20 -right-20 w-96 h-96 bg-white/10 rounded-full blur-3xl" style="transform: scale(1.09641) rotate(43.3853deg);"></div>
            </div>
            <div class="relative flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-white/20 backdrop-blur-xl rounded-[1.2rem] flex items-center justify-center shadow-2xl border border-white/30 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-8 h-8 sm:w-10 sm:h-10 text-white"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-3xl sm:text-5xl font-extrabold text-white drop-shadow-lg mb-2 animate-pulse-subtle" style="font-family: Outfit, sans-serif;">Produksi Pesanan</h1>
                        <p class="text-white/90 text-sm sm:text-lg font-medium flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chef-hat w-5 h-5"><path d="M17 21a1 1 0 0 0 1-1v-5.35c0-.457.316-.844.727-1.041a4 4 0 0 0-2.134-7.589 5 5 0 0 0-9.186 0 4 4 0 0 0-2.134 7.588c.411.198.727.585.727 1.041V20a1 1 0 0 0 1 1Z"></path><path d="M6 17h12"></path></svg>
                            Kelola Pesanan Pelanggan &amp; Jadwal Produksi
                        </p>
                    </div>
                </div>
                <button onclick="openCreateModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all bg-white/20 backdrop-blur-xl hover:bg-white/30 text-white border border-white/30 shadow-2xl rounded-2xl px-6 py-4 sm:px-8 sm:py-6 transform hover:scale-105 cursor-pointer w-full lg:w-auto" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-6 h-6 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                    <span class="font-bold text-base sm:text-lg">Buat Pesanan Baru</span>
                </button>
            </div>
        </div>

        <!-- Alert messages -->
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-2xl bg-green-50 border-2 border-green-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-5 h-5 text-green-600"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-2xl bg-red-50 border-2 border-red-200 space-y-1">
                @foreach ($errors->all() as $error)
                    <div class="flex items-center gap-2 font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert w-5 h-5 text-red-600"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>
                        <span>{{ $error }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Stats Counters -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="border-2 border-yellow-200 rounded-[2rem] bg-gradient-to-br from-yellow-50 to-amber-50 p-6 text-yellow-900 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-800 text-sm font-semibold mb-1">⏳ Pending</p>
                        <p class="text-4xl font-extrabold">{{ $orders->where('status', 'Pending')->count() }}</p>
                    </div>
                    <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center border-2 border-yellow-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-8 h-8 text-yellow-600"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                </div>
            </div>

            <div class="border-2 border-blue-200 rounded-[2rem] bg-gradient-to-br from-blue-50 to-cyan-50 p-6 text-blue-900 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-800 text-sm font-semibold mb-1">🔄 Diproses</p>
                        <p class="text-4xl font-extrabold">{{ $orders->where('status', 'Diproses')->count() }}</p>
                    </div>
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center border-2 border-blue-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-8 h-8 text-blue-600"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                    </div>
                </div>
            </div>

            <div class="border-2 border-green-200 rounded-[2rem] bg-gradient-to-br from-green-50 to-emerald-50 p-6 text-green-900 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-800 text-sm font-semibold mb-1">✓ Selesai</p>
                        <p class="text-4xl font-extrabold">{{ $orders->where('status', 'Selesai')->count() }}</p>
                    </div>
                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center border-2 border-green-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-8 h-8 text-green-600"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                    </div>
                </div>
            </div>

            <div class="border-2 border-purple-200 rounded-[2rem] bg-gradient-to-br from-purple-50 to-pink-50 p-6 text-purple-900 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-800 text-sm font-semibold mb-1">📦 Total Pesanan</p>
                        <p class="text-4xl font-extrabold">{{ $orders->count() }}</p>
                    </div>
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center border-2 border-purple-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-list w-8 h-8 text-purple-600"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><path d="M12 11h4"></path><path d="M12 16h4"></path><path d="M8 11h.01"></path><path d="M8 16h.01"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="bg-white rounded-[2rem] border-2 border-blue-200 shadow-xl overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-200 flex items-center justify-between">
                <h3 class="text-xl font-extrabold text-blue-900 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sliders-horizontal w-5 h-5"><line x1="21" x2="14" y1="4" y2="4"></line><line x1="10" x2="3" y1="4" y2="4"></line><line x1="21" x2="12" y1="12" y2="12"></line><line x1="8" x2="3" y1="12" y2="12"></line><line x1="21" x2="16" y1="20" y2="20"></line><line x1="12" x2="3" y1="20" y2="20"></line><line x1="14" x2="14" y1="2" y2="6"></line><line x1="8" x2="8" y1="10" y2="14"></line><line x1="16" x2="16" y1="18" y2="22"></line></svg>
                    Filter Pesanan
                </h3>
                <button type="button" id="reset_filters" class="px-4 py-2 border-2 border-blue-200 text-blue-700 hover:bg-blue-100 rounded-xl font-bold text-sm transition cursor-pointer">
                    Reset Filter
                </button>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-blue-900">Cari Nama/Telepon Pelanggan</label>
                        <div class="relative">
                            <input type="text" id="search_input" placeholder="Masukkan nama atau telepon..." class="w-full h-12 bg-blue-50/50 border-2 border-blue-100 rounded-xl px-4 pl-10 text-sm outline-none focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100 transition">
                            <div class="absolute left-3.5 top-3.5 text-blue-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-5 h-5"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-blue-900">Status Pesanan</label>
                        <select id="status_select" class="w-full h-12 bg-blue-50/50 border-2 border-blue-100 rounded-xl px-4 text-sm outline-none focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100 transition cursor-pointer">
                            <option value="">Semua Status</option>
                            <option value="Pending">⏳ Pending</option>
                            <option value="Diproses">🔄 Diproses</option>
                            <option value="Selesai">✓ Selesai</option>
                            <option value="Dibatalkan">✕ Dibatalkan</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border-2 border-blue-100">
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-blue-900 uppercase tracking-wider block mb-1">Filter Tanggal Pesanan</span>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-xs text-blue-700 font-semibold">Dari</label>
                                <input type="date" id="order_date_from" class="w-full h-10 bg-white border-2 border-blue-100 rounded-lg px-3 text-xs outline-none focus:border-blue-300 transition">
                            </div>
                            <div>
                                <label class="text-xs text-blue-700 font-semibold">Sampai</label>
                                <input type="date" id="order_date_to" class="w-full h-10 bg-white border-2 border-blue-100 rounded-lg px-3 text-xs outline-none focus:border-blue-300 transition">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <span class="text-xs font-bold text-blue-900 uppercase tracking-wider block mb-1">Filter Tanggal Pengambilan</span>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-xs text-blue-700 font-semibold">Dari</label>
                                <input type="date" id="finish_date_from" class="w-full h-10 bg-white border-2 border-blue-100 rounded-lg px-3 text-xs outline-none focus:border-blue-300 transition">
                            </div>
                            <div>
                                <label class="text-xs text-blue-700 font-semibold">Sampai</label>
                                <input type="date" id="finish_date_to" class="w-full h-10 bg-white border-2 border-blue-100 rounded-lg px-3 text-xs outline-none focus:border-blue-300 transition">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table Card -->
        <div class="text-card-foreground flex flex-col border-4 border-blue-200 shadow-2xl rounded-[2rem] overflow-hidden bg-gradient-to-br from-white to-blue-50/20">
            <div class="grid items-start gap-1.5 px-6 bg-gradient-to-r from-blue-100 via-indigo-100 to-purple-100 border-b-4 border-blue-200 py-6">
                <h4 class="text-2xl font-extrabold text-blue-900 flex items-center gap-2">
                    📋 Daftar Pesanan Produksi
                </h4>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto rounded-2xl border border-blue-100 shadow-sm bg-white">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-200">
                                <th class="py-4 px-4 font-extrabold text-blue-900 w-16">ID</th>
                                <th class="py-4 px-4 font-extrabold text-blue-900">Pelanggan</th>
                                <th class="py-4 px-4 font-extrabold text-blue-900">Telepon</th>
                                <th class="py-4 px-4 font-extrabold text-blue-900">Tgl Pesan</th>
                                <th class="py-4 px-4 font-extrabold text-blue-900">Tgl Ambil</th>
                                <th class="py-4 px-4 font-extrabold text-blue-900 text-center">Durasi</th>
                                <th class="py-4 px-4 font-extrabold text-blue-900 w-1/4">Produk</th>
                                <th class="py-4 px-4 font-extrabold text-blue-900">Total</th>
                                <th class="py-4 px-4 font-extrabold text-blue-900">Status</th>
                                <th class="py-4 px-4 font-extrabold text-blue-900 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="orders_table_body" class="divide-y divide-blue-50">
                            @forelse($orders as $order)
                                @php
                                    $products = is_array($order->products) ? $order->products : [];
                                    $status = $order->status;
                                    $statusClasses = [
                                        'Pending' => 'bg-yellow-50 text-yellow-800 border-yellow-200 font-bold',
                                        'Diproses' => 'bg-blue-50 text-blue-800 border-blue-200 font-bold',
                                        'Selesai' => 'bg-green-50 text-green-800 border-green-200 font-bold',
                                        'Dibatalkan' => 'bg-red-50 text-red-800 border-red-200 font-bold',
                                    ];
                                    $statusLabel = [
                                        'Pending' => '⏳ Pending',
                                        'Diproses' => '🔄 Diproses',
                                        'Selesai' => '✓ Selesai',
                                        'Dibatalkan' => '✕ Dibatalkan',
                                    ][$status] ?? $status;

                                    $orderDate = \Carbon\Carbon::parse($order->order_date);
                                    $finishDate = $order->finish_date ? \Carbon\Carbon::parse($order->finish_date) : null;
                                    $duration = $finishDate ? 'H+' . $orderDate->diffInDays($finishDate) : '-';
                                @endphp
                                <tr class="order-row hover:bg-blue-50/30 transition-all border-b border-blue-50"
                                    data-customer="{{ strtolower($order->customer) }}"
                                    data-phone="{{ strtolower($order->phone ?? '') }}"
                                    data-status="{{ $order->status }}"
                                    data-order-date="{{ $order->order_date }}"
                                    data-finish-date="{{ $order->finish_date ?? '' }}">
                                    
                                    <!-- ID -->
                                    <td class="py-4 px-4 font-mono text-sm font-bold text-blue-600">
                                        #{{ $order->id }}
                                    </td>
                                    
                                    <!-- Customer Name -->
                                    <td class="py-4 px-4 font-bold text-slate-800">
                                        <div class="flex items-center gap-1.5">
                                            <button type="button" onclick='openDetailModal(@json($order))' class="font-extrabold text-blue-700 hover:text-blue-900 hover:underline text-left cursor-pointer transition">
                                                {{ $order->customer }}
                                            </button>
                                            <button type="button" onclick='openEditModal(@json($order))' class="text-purple-400 hover:text-purple-600 transition" title="Edit Pesanan">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg>
                                            </button>
                                        </div>
                                    </td>
                                    
                                    <!-- Phone -->
                                    <td class="py-4 px-4 font-semibold text-slate-600">
                                        {{ $order->phone ?? '-' }}
                                    </td>
                                    
                                    <!-- Order Date -->
                                    <td class="py-4 px-4 text-xs font-semibold text-slate-500 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                                    </td>
                                    
                                    <!-- Finish Date -->
                                    <td class="py-4 px-4 text-xs font-bold text-orange-600 whitespace-nowrap">
                                        {{ $order->finish_date ? \Carbon\Carbon::parse($order->finish_date)->format('d M Y') : '-' }}
                                    </td>
                                    
                                    <!-- Duration -->
                                    <td class="py-4 px-4 text-center">
                                        <span class="inline-flex items-center justify-center rounded-lg border-2 px-2 py-0.5 text-xs font-extrabold bg-purple-50 text-purple-700 border-purple-200">
                                            {{ $duration }}
                                        </span>
                                    </td>
                                    
                                    <!-- Products -->
                                    <td class="py-4 px-4">
                                        <div class="flex flex-col gap-1 max-h-24 overflow-y-auto pr-2">
                                            @forelse($products as $item)
                                                <span class="text-xs font-medium text-slate-700">• {{ is_array($item) ? ($item['name'] ?? '-') : $item }} <strong class="text-blue-600 font-bold">×{{ is_array($item) ? ($item['qty'] ?? 1) : 1 }}</strong></span>
                                            @empty
                                                <span class="text-xs text-gray-400 font-medium">-</span>
                                            @endforelse
                                        </div>
                                    </td>
                                    
                                    <!-- Total -->
                                    <td class="py-4 px-4 font-extrabold text-blue-700">
                                        Rp&nbsp;{{ number_format((float) $order->total, 0, ',', '.') }}
                                    </td>
                                    
                                    <!-- Status -->
                                    <td class="py-4 px-4">
                                        <span class="inline-flex items-center justify-center rounded-lg border px-2.5 py-1 text-xs whitespace-nowrap {{ $statusClasses[$status] ?? 'bg-slate-50 text-slate-700 border-slate-200' }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    
                                    <!-- Actions -->
                                    <td class="py-4 px-4 text-right whitespace-nowrap">
                                        @if($order->status === 'Pending')
                                            <div class="flex gap-2 justify-end">
                                                <button type="button" onclick='openProductionConfirmModal(@json($order))' class="inline-flex items-center justify-center whitespace-nowrap text-xs font-bold transition-all h-8 gap-1.5 px-3 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white rounded-xl shadow-sm hover:shadow cursor-pointer">
                                                    Mulai Produksi
                                                </button>
                                                <button type="button" onclick='openReceiptModalForOrder(@json($order), @json($order->transaction))' class="inline-flex items-center justify-center whitespace-nowrap text-xs font-bold transition-all h-8 gap-1.5 px-3 border-2 border-emerald-300 text-emerald-700 bg-white hover:bg-emerald-50 rounded-xl cursor-pointer" title="Cetak Invoice">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-printer w-4 h-4"><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><path d="M6 9V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6"></path><rect x="6" y="14" width="12" height="8" rx="1"></rect></svg>
                                                    Cetak
                                                </button>
                                            </div>
                                        @elseif($order->status === 'Diproses')
                                            <div class="flex gap-2 justify-end">
                                                <button type="button" onclick='openCompleteConfirmModal(@json($order))' class="inline-flex items-center justify-center whitespace-nowrap text-xs font-bold transition-all h-8 gap-1.5 px-3 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white rounded-xl cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-4 h-4 mr-1"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                                                    Selesai
                                                </button>
                                                <button type="button" onclick='openReceiptModalForOrder(@json($order), @json($order->transaction))' class="inline-flex items-center justify-center whitespace-nowrap text-xs font-bold transition-all h-8 gap-1.5 px-3 border-2 border-emerald-300 text-emerald-700 bg-white hover:bg-emerald-50 rounded-xl cursor-pointer" title="Cetak Invoice">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-printer w-4 h-4"><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><path d="M6 9V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6"></path><rect x="6" y="14" width="12" height="8" rx="1"></rect></svg>
                                                    Cetak
                                                </button>
                                            </div>
                                        @else
                                            <div class="flex gap-2 justify-end items-center">
                                                <span class="inline-flex items-center justify-center rounded-lg border px-2.5 py-1 text-xs font-bold bg-slate-50 text-slate-400 border-slate-200">
                                                    Selesai Diproduksi
                                                </span>
                                                <button type="button" onclick='openReceiptModalForOrder(@json($order), @json($order->transaction))' class="inline-flex items-center justify-center whitespace-nowrap text-xs font-bold transition-all h-8 gap-1.5 px-3 border-2 border-emerald-300 text-emerald-700 bg-white hover:bg-emerald-50 rounded-xl cursor-pointer" title="Cetak Invoice">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-printer w-4 h-4"><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><path d="M6 9V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6"></path><rect x="6" y="14" width="12" height="8" rx="1"></rect></svg>
                                                    Cetak
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="py-8 px-4 text-center text-slate-400 font-medium">Belum ada data pesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pesanan -->
<div id="detailModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40 backdrop-blur-md py-10 transition-all duration-300 animate-fade-in !mt-0">
    <div class="bg-white rounded-[2rem] w-full max-w-lg mx-4 overflow-hidden shadow-2xl border-4 border-blue-100 flex flex-col relative max-h-[90vh] animate-scale-up">
        <div class="px-8 pt-8 pb-4 shrink-0 flex justify-between items-center bg-gradient-to-r from-blue-50 to-indigo-50 border-b-2 border-blue-100">
            <div class="flex items-center gap-3">
                <span class="text-3xl">📦</span>
                <h2 class="text-2xl font-extrabold text-blue-900">Detail Pesanan</h2>
            </div>
            <button type="button" onclick="closeDetailModal()" class="w-8 h-8 rounded-full border border-gray-200 text-gray-400 hover:text-red-500 hover:bg-red-50 transition cursor-pointer flex items-center justify-center">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        <div class="p-8 pt-6 overflow-y-auto custom-scrollbar space-y-6">
            <div class="grid grid-cols-2 gap-6 bg-gradient-to-br from-blue-50/50 to-indigo-50/50 p-6 rounded-2xl border border-blue-100">
                <div>
                    <p class="text-xs text-blue-400 font-bold uppercase tracking-wider mb-1">Pelanggan</p>
                    <p id="modal_customer" class="text-base font-extrabold text-slate-800">-</p>
                </div>
                <div>
                    <p class="text-xs text-blue-400 font-bold uppercase tracking-wider mb-1">No. Telepon</p>
                    <p id="modal_phone" class="text-base font-bold text-slate-700">-</p>
                </div>
                <div class="col-span-2 border-t border-blue-50 pt-4 mt-2"></div>
                <div>
                    <p class="text-xs text-blue-400 font-bold uppercase tracking-wider mb-1">Tanggal Pesan</p>
                    <p id="modal_order_date" class="text-sm font-bold text-slate-700">-</p>
                </div>
                <div>
                    <p class="text-xs text-blue-400 font-bold uppercase tracking-wider mb-1">Estimasi Selesai</p>
                    <p id="modal_finish_date" class="text-sm font-extrabold text-orange-600">-</p>
                </div>
                <div class="col-span-2 border-t border-blue-50 pt-4 mt-2"></div>
                <div class="col-span-2">
                    <p class="text-xs text-blue-400 font-bold uppercase tracking-wider mb-1">Total Biaya</p>
                    <p id="modal_total" class="text-xl font-extrabold text-blue-800">-</p>
                </div>
            </div>
            
            <div>
                <h3 class="text-sm font-extrabold text-slate-800 mb-3 flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-list w-4 h-4 text-blue-600"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><path d="M12 11h4"></path><path d="M12 16h4"></path><path d="M8 11h.01"></path><path d="M8 16h.01"></path></svg>
                    Produk dalam Pesanan:
                </h3>
                <div id="modal_products_container" class="space-y-3 max-h-60 overflow-y-auto pr-2"></div>
            </div>
            
            <div class="bg-blue-50 rounded-2xl p-5 border border-blue-100">
                <p class="text-xs text-blue-600 font-extrabold mb-1.5 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info w-3.5 h-3.5"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>
                    Catatan Pesanan:
                </p>
                <p id="modal_notes" class="text-sm font-medium text-blue-900 leading-relaxed">-</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Mulai Produksi (Sufficient Stock / Recipe Check Modal) -->
<div id="productionConfirmModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40 backdrop-blur-md py-10 transition-all duration-300 animate-fade-in !mt-0">
    <div class="bg-white rounded-[2rem] w-full max-w-[700px] mx-4 overflow-hidden shadow-2xl border-4 border-orange-200 flex flex-col relative max-h-[90vh] animate-scale-up">
        <!-- Close button top-right -->
        <button type="button" onclick="closeProductionConfirmModal()" class="absolute top-6 right-6 w-8 h-8 rounded-full border border-gray-200 text-gray-400 hover:text-red-500 hover:bg-red-50 transition cursor-pointer flex items-center justify-center">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>

        <div class="px-8 pt-8 pb-4 shrink-0 flex items-center gap-3 border-b-2 border-orange-100 bg-gradient-to-r from-orange-50 to-amber-50">
            <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-amber-400 rounded-xl flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert w-6 h-6 text-white"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>
            </div>
            <h2 class="text-2xl font-bold bg-gradient-to-r from-orange-600 to-amber-600 bg-clip-text text-transparent">Konfirmasi Mulai Produksi</h2>
        </div>

        <div class="p-8 pt-6 overflow-y-auto custom-scrollbar space-y-5">
            <!-- 1. Detail Pesanan box -->
            <div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border-2 border-blue-200">
                <h3 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-5 h-5"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                    Detail Pesanan
                </h3>
                <div class="space-y-2 text-slate-700">
                    <p class="text-sm"><span class="font-semibold text-slate-800">Pelanggan:</span> <span id="confirm_modal_customer">-</span></p>
                    <p class="text-sm"><span class="font-semibold text-slate-800">Telepon:</span> <span id="confirm_modal_phone">-</span></p>
                    <p class="text-sm"><span class="font-semibold text-slate-800">Tanggal Pengambilan:</span> <span id="confirm_modal_finish_date" class="font-bold text-orange-600">-</span></p>
                </div>
            </div>

            <!-- 2. Resep Produksi box -->
            <div class="p-5 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl border-2 border-purple-200">
                <h3 class="font-bold text-purple-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chef-hat w-5 h-5"><path d="M17 21a1 1 0 0 0 1-1v-5.35c0-.457.316-.844.727-1.041a4 4 0 0 0-2.134-7.589 5 5 0 0 0-9.186 0 4 4 0 0 0-2.134 7.588c.411.198.727.585.727 1.041V20a1 1 0 0 0 1 1Z"></path><path d="M6 17h12"></path></svg>
                    Resep Produksi
                </h3>
                <div id="confirm_recipes_container" class="space-y-3"></div>
            </div>

            <!-- 3. Status card (Mencukupi / Tidak Mencukupi) -->
            <div id="confirm_status_card" class="p-4 bg-green-50 border-2 border-green-300 rounded-2xl"></div>

            <!-- 4. Kebutuhan Bahan Baku table -->
            <div class="p-5 bg-gradient-to-br from-orange-50 to-amber-50 rounded-2xl border-2 border-orange-200">
                <h3 class="font-bold text-orange-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-down w-5 h-5"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"></polyline><polyline points="16 17 22 17 22 11"></polyline></svg>
                    Kebutuhan Bahan Baku
                </h3>
                <div class="bg-white rounded-xl border-2 border-orange-200 overflow-hidden shadow-sm">
                    <div class="relative w-full overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-orange-50 border-b border-orange-200 text-slate-800">
                                <tr>
                                    <th class="py-3 px-4 font-bold text-slate-800">Bahan Baku</th>
                                    <th class="py-3 px-4 font-bold text-slate-800">Perhitungan</th>
                                    <th class="py-3 px-4 font-bold text-slate-800">Total Dibutuhkan</th>
                                    <th class="py-3 px-4 font-bold text-slate-800">Stok Tersedia</th>
                                    <th class="py-3 px-4 font-bold text-slate-800">Status</th>
                                </tr>
                            </thead>
                            <tbody id="confirm_materials_table_body" class="divide-y divide-slate-100"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 5. Form Actions -->
            <form id="confirm_production_form" method="POST" class="flex gap-3 pt-2">
                @csrf
                @method('PUT')
                <input type="hidden" name="customer" id="confirm_form_customer">
                <input type="hidden" name="phone" id="confirm_form_phone">
                <input type="hidden" name="status" value="Diproses">
                <input type="hidden" name="order_date" id="confirm_form_order_date">
                <input type="hidden" name="finish_date" id="confirm_form_finish_date">
                <input type="hidden" name="notes" id="confirm_form_notes">
                <div id="confirm_form_products_container"></div>

                <button type="submit" id="confirm_submit_btn" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl transition-all disabled:pointer-events-none disabled:opacity-50 text-white hover:bg-emerald-600 px-4 py-2 flex-1 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 disabled:from-gray-300 disabled:to-gray-400 h-12 text-base font-semibold shadow-xl cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chef-hat w-5 h-5 mr-2"><path d="M17 21a1 1 0 0 0 1-1v-5.35c0-.457.316-.844.727-1.041a4 4 0 0 0-2.134-7.589 5 5 0 0 0-9.186 0 4 4 0 0 0-2.134 7.588c.411.198.727.585.727 1.041V20a1 1 0 0 0 1 1Z"></path><path d="M6 17h12"></path></svg>
                    Lanjutkan Produksi
                </button>
                <button type="button" onclick="closeProductionConfirmModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm transition-all border-2 border-orange-200 hover:bg-orange-50 px-4 py-2 flex-1 h-12 font-semibold text-orange-900 cursor-pointer" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5 mr-2"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                    Batal
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Pesanan Selesai -->
<div id="completeConfirmModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40 backdrop-blur-md py-10 transition-all duration-300 animate-fade-in !mt-0">
    <div class="bg-white rounded-[2rem] w-full max-w-[550px] mx-4 overflow-hidden shadow-2xl border-4 border-blue-200 flex flex-col relative max-h-[90vh] animate-scale-up">
        <!-- Close button top-right -->
        <button type="button" onclick="closeCompleteConfirmModal()" class="absolute top-6 right-6 w-8 h-8 rounded-full border border-gray-200 text-gray-400 hover:text-red-500 hover:bg-red-50 transition cursor-pointer flex items-center justify-center">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>

        <div class="px-8 pt-8 pb-4 shrink-0 flex items-center gap-3 border-b-2 border-blue-100 bg-gradient-to-r from-blue-50 to-indigo-50">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-indigo-400 rounded-xl flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-6 h-6 text-white"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
            </div>
            <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Konfirmasi Pesanan Selesai</h2>
        </div>

        <div class="p-8 pt-6 overflow-y-auto custom-scrollbar space-y-5">
            <div class="p-4 bg-gradient-to-r from-green-50/50 to-emerald-50/50 rounded-2xl border border-green-200">
                <p class="text-sm font-semibold text-emerald-800 leading-relaxed">
                    Apakah Anda yakin pesanan untuk pelanggan ini telah selesai diproduksi dan siap diserahkan?
                </p>
            </div>

            <!-- Detail Pesanan Box -->
            <div class="p-5 bg-gradient-to-br from-slate-50 to-blue-50/30 rounded-2xl border border-slate-200 space-y-3">
                <h3 class="font-bold text-slate-800 text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user text-blue-500"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Informasi Pelanggan
                </h3>
                <div class="space-y-1.5 text-xs font-semibold text-slate-600 pl-6">
                    <p><span class="text-slate-400">Pelanggan:</span> <span id="complete_modal_customer" class="text-slate-800 font-bold">-</span></p>
                    <p><span class="text-slate-400">Telepon:</span> <span id="complete_modal_phone" class="text-slate-800">-</span></p>
                    <p><span class="text-slate-400">Target Selesai:</span> <span id="complete_modal_finish_date" class="text-orange-600 font-bold">-</span></p>
                </div>
            </div>

            <!-- Detail Produk Kue -->
            <div class="p-5 bg-gradient-to-br from-purple-50/50 to-pink-50/30 rounded-2xl border border-purple-100 space-y-3">
                <h3 class="font-bold text-purple-900 text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cake text-purple-500"><path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"></path><path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"></path><path d="M2 21h20"></path><path d="M7 8v3"></path><path d="M12 8v3"></path><path d="M17 8v3"></path><path d="M7 4h.01"></path><path d="M12 4h.01"></path><path d="M17 4h.01"></path></svg>
                    Produk yang Dipesan
                </h3>
                <div id="complete_modal_products_list" class="space-y-2 pl-6">
                </div>
            </div>

            <!-- Form Actions -->
            <form id="complete_production_form" method="POST" class="flex gap-3 pt-2">
                @csrf
                @method('PUT')
                <input type="hidden" name="customer" id="complete_form_customer">
                <input type="hidden" name="phone" id="complete_form_phone">
                <input type="hidden" name="status" value="Selesai">
                <input type="hidden" name="order_date" id="complete_form_order_date">
                <input type="hidden" name="finish_date" id="complete_form_finish_date">
                <input type="hidden" name="notes" id="complete_form_notes">
                <div id="complete_form_products_container"></div>

                <button type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl transition-all text-white px-4 py-2 flex-1 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 h-12 text-base font-bold shadow-xl cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                    Ya, Selesai
                </button>
                <button type="button" onclick="closeCompleteConfirmModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm transition-all border-2 border-slate-200 hover:bg-slate-50 px-4 py-2 flex-1 h-12 font-bold text-slate-700 cursor-pointer">
                    Batal
                </button>
            </form>
        </div>
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

<!-- Modal Buat Pesanan Baru -->
<div id="createModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40 backdrop-blur-md py-10 transition-all duration-300 animate-fade-in !mt-0">
    <div class="bg-white rounded-[2rem] w-full max-w-[700px] mx-4 overflow-hidden shadow-2xl border-2 border-blue-200/50 flex flex-col relative max-h-[90vh] animate-scale-up">
        <!-- Close Button top-right -->
        <button type="button" onclick="closeCreateModal()" class="absolute top-6 right-6 w-8 h-8 rounded-full border border-gray-200 text-gray-400 hover:text-red-500 hover:bg-red-50 transition cursor-pointer flex items-center justify-center">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>

        <div class="px-8 pt-8 pb-4 shrink-0 flex items-center gap-3">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-indigo-400 rounded-xl flex items-center justify-center shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-6 h-6 text-white"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
            </div>
            <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Buat Pesanan Baru</h2>
        </div>

        <form class="p-8 pt-4 overflow-y-auto space-y-5 custom-scrollbar flex-1" action="{{ route('orders.store') }}" method="POST">
            @csrf
            
            <!-- Data Pelanggan card -->
            <div class="p-5 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border-2 border-blue-100">
                <h3 class="font-bold text-blue-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-5 h-5"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Data Pelanggan
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-blue-800 flex items-center gap-1">Nama Pelanggan <span class="text-red-600">*</span></label>
                        <input type="text" name="customer" placeholder="Nama lengkap..." required class="w-full border px-3 py-1 text-base transition-[color,box-shadow] outline-none bg-white border-blue-200 rounded-xl h-12 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-blue-800 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            Nomor Telepon <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="phone" placeholder="08xx-xxxx-xxxx" required class="w-full border px-3 py-1 text-base transition-[color,box-shadow] outline-none bg-white border-blue-200 rounded-xl h-12 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]">
                    </div>
                </div>
            </div>

            <!-- Jadwal Pesanan card -->
            <div class="p-5 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl border-2 border-purple-100">
                <h3 class="font-bold text-purple-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-5 h-5"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                    Jadwal Pesanan
                </h3>
                <div class="grid grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-purple-800 block">Tanggal Pesanan</label>
                        <input type="date" name="order_date" id="order_date_input" onchange="calculateEstimasi(); updateCreateDuration();" required class="w-full border px-3 py-1 text-base transition-[color,box-shadow] outline-none bg-white border-purple-200 rounded-xl h-12 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-purple-800 flex items-center gap-1">Tanggal Pengambilan <span class="text-red-600">*</span></label>
                        <input type="date" name="finish_date" id="finish_date_input" onchange="updateCreateDuration()" required class="w-full border px-3 py-1 text-base transition-[color,box-shadow] outline-none bg-white border-purple-200 rounded-xl h-12 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-purple-800 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4 inline mr-1"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            Durasi Produksi
                        </label>
                        <div id="create_duration_badge" class="h-12 flex items-center justify-center bg-gradient-to-r from-purple-100 to-pink-100 border-2 border-purple-200 rounded-xl px-4 font-bold text-purple-700">-</div>
                    </div>
                </div>
            </div>

            <!-- Produk Pesanan card -->
            <div class="p-5 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border-2 border-green-100">
                <h3 class="font-bold text-green-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-5 h-5"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                    Produk Pesanan
                </h3>
                <div class="grid grid-cols-3 gap-3 mb-4">
                    <div class="col-span-2">
                        <select id="cart_product_select" class="w-full border px-3 text-sm transition-all outline-none bg-white border-green-200 rounded-xl h-12 focus-visible:ring-2 focus-visible:ring-green-100 cursor-pointer">
                            <option value="">Pilih produk...</option>
                            @foreach($availableProducts ?? [] as $product)
                                <option value="{{ $product['id'] }}">{{ $product['name'] }} - Rp {{ number_format($product['price'], 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="number" id="cart_qty_input" min="1" placeholder="Jumlah" class="w-full border px-3 py-1 text-base transition-all outline-none bg-white border-green-200 rounded-xl h-12 focus-visible:ring-2 focus-visible:ring-green-100">
                    </div>
                    <button type="button" onclick="addToCart()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm font-medium transition-all text-white px-4 py-2 col-span-3 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 h-12 cursor-pointer shadow-md hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                        Tambah Produk
                    </button>
                </div>

                <!-- Live Shopping Basket listed inside card -->
                <div class="mt-4 bg-white border border-green-200 rounded-xl p-4 shadow-sm space-y-3">
                    <div class="flex items-center justify-between border-b border-green-50 pb-2">
                        <span class="font-bold text-slate-800 text-xs uppercase tracking-wider block">🛒 Produk dalam Keranjang:</span>
                        <span id="cart_item_count" class="text-[11px] font-bold text-green-700 bg-green-50 px-2 py-0.5 rounded">0 item</span>
                    </div>
                    <div id="cart_items_container" class="space-y-2 divide-y divide-gray-50 max-h-40 overflow-y-auto pr-1 text-slate-700">
                        <p class="text-slate-400 text-xs text-center py-4">Belum ada produk ditambahkan.</p>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-green-100">
                        <span class="text-xs font-bold text-slate-600">Total Belanja:</span>
                        <span id="cart_total_text" class="text-sm font-extrabold text-green-700">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- Status & Catatan cards in a 2-column row -->
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2 p-5 bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border-2 border-amber-100 flex flex-col justify-between">
                    <label class="flex items-center gap-2 select-none text-sm font-semibold text-amber-900">Status Pesanan</label>
                    <select name="status" id="status_input" class="w-full border px-3 text-sm transition-all outline-none bg-white border-amber-200 rounded-xl h-12 focus-visible:ring-2 focus-visible:ring-amber-100 cursor-pointer">
                        <option value="Pending" selected>⏳ Pending</option>
                        <option value="Diproses">🔄 Diproses</option>
                        <option value="Selesai">✓ Selesai</option>
                    </select>
                </div>
                <div class="space-y-2 p-5 bg-gradient-to-br from-gray-50 to-slate-50 rounded-2xl border-2 border-gray-100">
                    <label class="flex items-center gap-2 select-none text-sm font-semibold text-gray-900">Catatan (Opsional)</label>
                    <textarea name="notes" rows="2" placeholder="Catatan tambahan..." class="resize-none placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 flex min-h-16 w-full border px-3 py-2 text-base transition-[color,box-shadow] outline-none md:text-sm bg-white border-gray-200 rounded-xl"></textarea>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex gap-3 pt-2">
                <button type="submit" id="create_submit_btn" disabled class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl transition-all disabled:pointer-events-none disabled:opacity-50 text-white hover:bg-indigo-600 px-4 py-2 flex-1 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 h-12 text-base font-semibold shadow-xl cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-5 h-5 mr-2"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>
                    Buat Pesanan
                </button>
                <button type="button" onclick="closeCreateModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm transition-all border-2 border-blue-200 hover:bg-blue-50 px-4 py-2 flex-1 h-12 font-semibold text-blue-900 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5 mr-2"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Pesanan -->
<div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/40 backdrop-blur-md py-10 transition-all duration-300 animate-fade-in !mt-0">
    <div class="bg-white rounded-[2rem] w-full max-w-[700px] mx-4 overflow-hidden shadow-2xl border-2 border-blue-200/50 flex flex-col relative max-h-[90vh] animate-scale-up">
        <!-- Close Button top-right -->
        <button type="button" onclick="closeEditModal()" class="absolute top-6 right-6 w-8 h-8 rounded-full border border-gray-200 text-gray-400 hover:text-red-500 hover:bg-red-50 transition cursor-pointer flex items-center justify-center">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>

        <div class="px-8 pt-8 pb-4 shrink-0 flex items-center gap-3">
            <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-xl flex items-center justify-center shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil w-5 h-5 text-white"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">Edit Data Pesanan</h2>
        </div>

        <form id="editForm" class="p-8 pt-4 overflow-y-auto space-y-5 custom-scrollbar flex-1" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Data Pelanggan card -->
            <div class="p-5 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border-2 border-blue-100">
                <h3 class="font-bold text-blue-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-5 h-5"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Data Pelanggan
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-blue-800 flex items-center gap-1">Nama Pelanggan <span class="text-red-600">*</span></label>
                        <input type="text" name="customer" id="edit_customer_input" placeholder="Nama lengkap..." required class="w-full border px-3 py-1 text-base transition-[color,box-shadow] outline-none bg-white border-blue-200 rounded-xl h-12 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-blue-800 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            Nomor Telepon <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="phone" id="edit_phone_input" placeholder="08xx-xxxx-xxxx" required class="w-full border px-3 py-1 text-base transition-[color,box-shadow] outline-none bg-white border-blue-200 rounded-xl h-12 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]">
                    </div>
                </div>
            </div>

            <!-- Jadwal Pesanan card -->
            <div class="p-5 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl border-2 border-purple-100">
                <h3 class="font-bold text-purple-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-5 h-5"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                    Jadwal Pesanan
                </h3>
                <div class="grid grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-purple-800 block">Tanggal Pesanan</label>
                        <input type="date" name="order_date" id="edit_order_date_input" onchange="calculateEditEstimasi(); updateEditDuration();" required class="w-full border px-3 py-1 text-base transition-[color,box-shadow] outline-none bg-white border-purple-200 rounded-xl h-12 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-purple-800 flex items-center gap-1">Tanggal Pengambilan <span class="text-red-600">*</span></label>
                        <input type="date" name="finish_date" id="edit_finish_date_input" onchange="updateEditDuration()" required class="w-full border px-3 py-1 text-base transition-[color,box-shadow] outline-none bg-white border-purple-200 rounded-xl h-12 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-purple-800 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-4 h-4 inline mr-1"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            Durasi Produksi
                        </label>
                        <div id="edit_duration_badge" class="h-12 flex items-center justify-center bg-gradient-to-r from-purple-100 to-pink-100 border-2 border-purple-200 rounded-xl px-4 font-bold text-purple-700">-</div>
                    </div>
                </div>
            </div>

            <!-- Produk Pesanan card -->
            <div class="p-5 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border-2 border-green-100">
                <h3 class="font-bold text-green-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-5 h-5"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                    Produk Pesanan
                </h3>
                <div class="grid grid-cols-3 gap-3 mb-4">
                    <div class="col-span-2">
                        <select id="edit_cart_product_select" class="w-full border px-3 text-sm transition-all outline-none bg-white border-green-200 rounded-xl h-12 focus-visible:ring-2 focus-visible:ring-green-100 cursor-pointer">
                            <option value="">Pilih produk...</option>
                            @foreach($availableProducts ?? [] as $product)
                                <option value="{{ $product['id'] }}">{{ $product['name'] }} - Rp {{ number_format($product['price'], 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="number" id="edit_cart_qty_input" min="1" placeholder="Jumlah" class="w-full border px-3 py-1 text-base transition-all outline-none bg-white border-green-200 rounded-xl h-12 focus-visible:ring-2 focus-visible:ring-green-100">
                    </div>
                    <button type="button" onclick="addEditToCart()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm font-medium transition-all text-white px-4 py-2 col-span-3 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 h-12 cursor-pointer shadow-md hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                        Tambah Produk
                    </button>
                </div>

                <!-- Live Shopping Basket listed inside card -->
                <div class="mt-4 bg-white border border-green-200 rounded-xl p-4 shadow-sm space-y-3">
                    <div class="flex items-center justify-between border-b border-green-50 pb-2">
                        <span class="font-bold text-slate-800 text-xs uppercase tracking-wider block">🛒 Produk dalam Keranjang:</span>
                        <span id="edit_cart_item_count" class="text-[11px] font-bold text-green-700 bg-green-50 px-2 py-0.5 rounded">0 item</span>
                    </div>
                    <div id="edit_cart_items_container" class="space-y-2 divide-y divide-gray-50 max-h-40 overflow-y-auto pr-1 text-slate-700">
                        <p class="text-slate-400 text-xs text-center py-4">Belum ada produk ditambahkan.</p>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-green-100">
                        <span class="text-xs font-bold text-slate-600">Total Belanja:</span>
                        <span id="edit_cart_total_text" class="text-sm font-extrabold text-green-700">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- Status & Catatan cards in a 2-column row -->
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2 p-5 bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border-2 border-amber-100 flex flex-col justify-between">
                    <label class="flex items-center gap-2 select-none text-sm font-semibold text-amber-900">Status Pesanan</label>
                    <select name="status" id="edit_status_input" class="w-full border px-3 text-sm transition-all outline-none bg-white border-amber-200 rounded-xl h-12 focus-visible:ring-2 focus-visible:ring-amber-100 cursor-pointer">
                        <option value="Pending">⏳ Pending</option>
                        <option value="Diproses">🔄 Diproses</option>
                        <option value="Selesai">✓ Selesai</option>
                    </select>
                </div>
                <div class="space-y-2 p-5 bg-gradient-to-br from-gray-50 to-slate-50 rounded-2xl border-2 border-gray-100">
                    <label class="flex items-center gap-2 select-none text-sm font-semibold text-gray-900">Catatan (Opsional)</label>
                    <textarea name="notes" id="edit_notes_input" rows="2" placeholder="Catatan tambahan..." class="resize-none placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 flex min-h-16 w-full border px-3 py-2 text-base transition-[color,box-shadow] outline-none md:text-sm bg-white border-gray-200 rounded-xl"></textarea>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex gap-3 pt-2">
                <button type="submit" id="edit_submit_btn" disabled class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl transition-all disabled:pointer-events-none disabled:opacity-50 text-white hover:bg-indigo-600 px-4 py-2 flex-1 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 h-12 text-base font-semibold shadow-xl cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-5 h-5 mr-2"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>
                    Simpan Perubahan
                </button>
                <button type="button" onclick="closeEditModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm transition-all border-2 border-blue-200 hover:bg-blue-50 px-4 py-2 flex-1 h-12 font-semibold text-blue-900 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-5 h-5 mr-2"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes scaleUp {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .animate-fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }
    .animate-scale-up {
        animation: scaleUp 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .animate-pulse-subtle {
        animation: pulseSubtle 3s infinite ease-in-out;
    }
    @keyframes pulseSubtle {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.95; }
    }
</style>

<script>
    // Inject backend collections
    const recipes = @json($recipes ?? []);
    const materials = @json($materials ?? []);

    // Modal state toggles
    function openDetailModal(order) {
        document.getElementById('detailModal').classList.remove('hidden');
        document.getElementById('modal_customer').innerText = order.customer;
        document.getElementById('modal_phone').innerText = order.phone || '-';
        document.getElementById('modal_order_date').innerText = new Date(order.order_date).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'});
        document.getElementById('modal_finish_date').innerText = order.finish_date ? new Date(order.finish_date).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'}) : '-';
        document.getElementById('modal_notes').innerText = order.notes || 'Tidak ada catatan khusus.';

        const formattedTotal = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(order.total);
        document.getElementById('modal_total').innerText = formattedTotal;

        const container = document.getElementById('modal_products_container');
        container.innerHTML = '';
        if (order.products && order.products.length > 0) {
            order.products.forEach(item => {
                const sub = item.subtotal || (item.price * item.qty);
                const pPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(sub);
                container.innerHTML += `
                    <div class="flex justify-between items-center bg-blue-50/50 p-4 rounded-xl border border-blue-100/50">
                        <p class="font-bold text-slate-800">
                            ${item.name} 
                            <span class="text-indigo-600 font-extrabold ml-1">×${item.qty}</span>
                        </p>
                        <p class="font-extrabold text-blue-800">${pPrice}</p>
                    </div>`;
            });
        }
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    // Confirm Production Modal check
    function openProductionConfirmModal(order) {
        // Check if recipe is complete for all products in this order
        let hasAllRecipes = true;
        order.products.forEach(product => {
            const recipe = recipes.find(r => r.product_name === product.name);
            if (!recipe) {
                hasAllRecipes = false;
            }
        });

        document.getElementById('productionConfirmModal').classList.remove('hidden');
        
        // 1. Set details
        document.getElementById('confirm_modal_customer').innerText = order.customer;
        document.getElementById('confirm_modal_phone').innerText = order.phone || '-';
        document.getElementById('confirm_modal_finish_date').innerText = order.finish_date ? new Date(order.finish_date).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'}) : '-';

        // 2. Set hidden fields in form
        document.getElementById('confirm_production_form').action = '/orders/' + order.id;
        document.getElementById('confirm_form_customer').value = order.customer;
        document.getElementById('confirm_form_phone').value = order.phone || '';
        document.getElementById('confirm_form_order_date').value = order.order_date;
        document.getElementById('confirm_form_finish_date').value = order.finish_date || '';
        document.getElementById('confirm_form_notes').value = order.notes || '';
        
        const formProductsContainer = document.getElementById('confirm_form_products_container');
        formProductsContainer.innerHTML = '';
        order.products.forEach((prod, idx) => {
            formProductsContainer.innerHTML += `
                <input type="hidden" name="products[${idx}][id]" value="${prod.id}">
                <input type="hidden" name="products[${idx}][name]" value="${prod.name}">
                <input type="hidden" name="products[${idx}][qty]" value="${prod.qty}">
                <input type="hidden" name="products[${idx}][price]" value="${prod.price || (prod.subtotal / prod.qty)}">
                <input type="hidden" name="products[${idx}][subtotal]" value="${prod.subtotal || (prod.price * prod.qty)}">
            `;
        });

        // 3. Calculate materials & recipe matching
        const requiredIngredients = {};
        const matchedRecipes = [];

        order.products.forEach(product => {
            const recipe = recipes.find(r => r.product_name === product.name);
            if (recipe) {
                matchedRecipes.push({
                    name: product.name,
                    qty: product.qty,
                    ingredients: recipe.ingredients
                });

                recipe.ingredients.forEach(ing => {
                    const neededAmount = ing.qty * product.qty;
                    if (requiredIngredients[ing.name]) {
                        requiredIngredients[ing.name].needed += neededAmount;
                    } else {
                        requiredIngredients[ing.name] = {
                            needed: neededAmount,
                            unit: ing.unit
                        };
                    }
                });
            } else {
                matchedRecipes.push({
                    name: product.name,
                    qty: product.qty,
                    ingredients: [],
                    missing: true
                });
            }
        });

        // 4. Render matched recipes
        const recipesContainer = document.getElementById('confirm_recipes_container');
        recipesContainer.innerHTML = '';
        matchedRecipes.forEach(recipe => {
            if (recipe.missing) {
                recipesContainer.innerHTML += `
                    <div class="flex justify-between items-start border-b border-red-100 pb-2 mb-2 last:border-0 last:pb-0 last:mb-0 text-slate-800 bg-red-50/70 p-3.5 rounded-xl border border-red-200">
                        <div>
                            <p class="font-bold text-red-950">${recipe.name} <span class="text-red-600 font-extrabold">×${recipe.qty} unit</span></p>
                            <p class="text-xs text-red-700 font-bold mt-1 flex items-center gap-1">
                                <svg class="w-4 h-4 text-red-500 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                Resep belum dibuat!
                            </p>
                        </div>
                    </div>`;
            } else {
                let ingList = recipe.ingredients.map(ing => `${ing.qty * recipe.qty} ${ing.unit} ${ing.name}`).join(', ');
                recipesContainer.innerHTML += `
                    <div class="flex justify-between items-start border-b border-purple-100 pb-2 mb-2 last:border-0 last:pb-0 last:mb-0 text-slate-800">
                        <div>
                            <p class="font-bold text-purple-950">${recipe.name} <span class="text-indigo-600 font-extrabold">×${recipe.qty} unit</span></p>
                            <p class="text-xs text-purple-800/80 mt-0.5">${ingList}</p>
                        </div>
                    </div>`;
            }
        });
        if (matchedRecipes.length === 0) {
            recipesContainer.innerHTML = '<p class="text-xs text-purple-700 italic">Resep tidak ditemukan untuk menu ini.</p>';
        }

        // 5. Render calculations & check stocks
        let isSufficient = true;
        const confirmTableBody = document.getElementById('confirm_materials_table_body');
        confirmTableBody.innerHTML = '';

        Object.keys(requiredIngredients).forEach(ingName => {
            const req = requiredIngredients[ingName];
            const material = materials.find(m => m.name === ingName);
            const stock = material ? material.stock : 0;
            const unit = material ? material.unit : req.unit;

            const isOk = stock >= req.needed;
            if (!isOk) {
                isSufficient = false;
            }

            const statusBadge = isOk 
                ? `<span class="inline-flex items-center justify-center rounded-md px-2 py-0.5 text-xs font-bold bg-green-50 text-green-700 border border-green-200">✓ Cukup</span>`
                : `<span class="inline-flex items-center justify-center rounded-md px-2 py-0.5 text-xs font-bold bg-red-50 text-red-700 border border-red-200">✕ Kurang</span>`;

            // Build Calculation text e.g. "0.5 kg × 2"
            let calculationText = '';
            matchedRecipes.forEach(recipe => {
                if (recipe.ingredients) {
                    const ing = recipe.ingredients.find(i => i.name === ingName);
                    if (ing) {
                        if (calculationText !== '') calculationText += ' + ';
                        calculationText += `${ing.qty} ${ing.unit} × ${recipe.qty}`;
                    }
                }
            });

            confirmTableBody.innerHTML += `
                <tr class="hover:bg-slate-50 transition border-b border-slate-100 text-slate-800">
                    <td class="py-3 px-4 font-bold text-slate-700">${ingName}</td>
                    <td class="py-3 px-4 text-xs font-medium text-slate-500">${calculationText}</td>
                    <td class="py-3 px-4 font-extrabold text-blue-700">${req.needed.toFixed(2)} ${unit}</td>
                    <td class="py-3 px-4 font-bold text-slate-600">${stock.toFixed(2)} ${unit}</td>
                    <td class="py-3 px-4">${statusBadge}</td>
                </tr>`;
        });

        if (Object.keys(requiredIngredients).length === 0) {
            confirmTableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="py-4 text-center text-gray-400 italic">Tidak ada bahan baku yang dibutuhkan.</td>
                </tr>`;
        }

        // 6. Update Sufficiency card & button status
        const statusCard = document.getElementById('confirm_status_card');
        const submitBtn = document.getElementById('confirm_submit_btn');

        if (!hasAllRecipes) {
            statusCard.className = "p-4 bg-red-50 border-2 border-red-300 rounded-2xl";
            statusCard.innerHTML = `
                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert w-6 h-6 text-red-600 flex-shrink-0 mt-0.5"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>
                    <div>
                        <p class="font-bold text-red-900 mb-1">✕ Resep Belum Lengkap</p>
                        <p class="text-sm text-red-800 font-medium">Ada beberapa produk dalam pesanan ini yang resepnya belum dibuat. Silakan tambahkan resep di menu Kelola Produk terlebih dahulu untuk melanjutkan produksi!</p>
                    </div>
                </div>`;
            submitBtn.disabled = true;
        } else if (isSufficient) {
            statusCard.className = "p-4 bg-green-50 border-2 border-green-300 rounded-2xl";
            statusCard.innerHTML = `
                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-6 h-6 text-green-600 flex-shrink-0 mt-0.5"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                    <div>
                        <p class="font-bold text-green-900 mb-1">✓ Stok Mencukupi</p>
                        <p class="text-sm text-green-800">Semua bahan baku tersedia. Stok akan otomatis dikurangi sesuai kebutuhan resep.</p>
                    </div>
                </div>`;
            submitBtn.disabled = false;
        } else {
            statusCard.className = "p-4 bg-red-50 border-2 border-red-300 rounded-2xl";
            statusCard.innerHTML = `
                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-circle w-6 h-6 text-red-600 flex-shrink-0 mt-0.5"><circle cx="12" cy="12" r="10"></circle><line x1="15" x2="9" y1="9" y2="15"></line><line x1="9" x2="15" y1="9" y2="15"></line></svg>
                    <div>
                        <p class="font-bold text-red-900 mb-1">✕ Stok Tidak Mencukupi</p>
                        <p class="text-sm text-red-800">Beberapa bahan baku kurang. Silakan tambah stok bahan terlebih dahulu!</p>
                    </div>
                </div>`;
            submitBtn.disabled = true;
        }
    }

    function closeProductionConfirmModal() {
        document.getElementById('productionConfirmModal').classList.add('hidden');
    }

    function openCompleteConfirmModal(order) {
        document.getElementById('completeConfirmModal').classList.remove('hidden');

        // 1. Set details in UI
        document.getElementById('complete_modal_customer').innerText = order.customer;
        document.getElementById('complete_modal_phone').innerText = order.phone || '-';
        document.getElementById('complete_modal_finish_date').innerText = order.finish_date ? new Date(order.finish_date).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'}) : '-';

        // 2. Set products list
        const productsList = document.getElementById('complete_modal_products_list');
        productsList.innerHTML = '';
        if (order.products && order.products.length > 0) {
            order.products.forEach(item => {
                productsList.innerHTML += `
                    <div class="flex items-center justify-between text-xs font-semibold text-slate-700">
                        <span>• ${item.name}</span>
                        <span class="text-blue-600 font-extrabold">×${item.qty} unit</span>
                    </div>`;
            });
        }

        // 3. Set hidden fields in form
        document.getElementById('complete_production_form').action = '/orders/' + order.id;
        document.getElementById('complete_form_customer').value = order.customer;
        document.getElementById('complete_form_phone').value = order.phone || '';
        document.getElementById('complete_form_order_date').value = order.order_date;
        document.getElementById('complete_form_finish_date').value = order.finish_date || '';
        document.getElementById('complete_form_notes').value = order.notes || '';
        
        const formProductsContainer = document.getElementById('complete_form_products_container');
        formProductsContainer.innerHTML = '';
        order.products.forEach((prod, idx) => {
            formProductsContainer.innerHTML += `
                <input type="hidden" name="products[${idx}][id]" value="${prod.id}">
                <input type="hidden" name="products[${idx}][name]" value="${prod.name}">
                <input type="hidden" name="products[${idx}][qty]" value="${prod.qty}">
                <input type="hidden" name="products[${idx}][price]" value="${prod.price || (prod.subtotal / prod.qty)}">
                <input type="hidden" name="products[${idx}][subtotal]" value="${prod.subtotal || (prod.price * prod.qty)}">
            `;
        });
    }

    function closeCompleteConfirmModal() {
        document.getElementById('completeConfirmModal').classList.add('hidden');
    }

    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
        document.getElementById('order_date_input').value = new Date().toISOString().split('T')[0];
        calculateEstimasi();
        updateCreateDuration();
        cart = [];
        renderCart();
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
    }

    function calculateEstimasi() {
        const inputDate = document.getElementById('order_date_input').value;
        if (inputDate) {
            const dateObj = new Date(inputDate);
            dateObj.setDate(dateObj.getDate() + 2);
            
            const formattedDateString = dateObj.toISOString().split('T')[0];
            const finishInput = document.getElementById('finish_date_input');
            
            finishInput.min = formattedDateString;
            finishInput.value = formattedDateString;
        }
    }

    // Update dynamic durations in badge
    function updateCreateDuration() {
        const orderDateVal = document.getElementById('order_date_input').value;
        const finishDateVal = document.getElementById('finish_date_input').value;
        const badge = document.getElementById('create_duration_badge');
        
        if (orderDateVal && finishDateVal) {
            const oDate = new Date(orderDateVal);
            const fDate = new Date(finishDateVal);
            const diffTime = fDate - oDate;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays >= 0) {
                badge.innerText = diffDays + " Hari";
            } else {
                badge.innerText = "-";
            }
        } else {
            badge.innerText = "-";
        }
    }

    function updateEditDuration() {
        const orderDateVal = document.getElementById('edit_order_date_input').value;
        const finishDateVal = document.getElementById('edit_finish_date_input').value;
        const badge = document.getElementById('edit_duration_badge');
        
        if (orderDateVal && finishDateVal) {
            const oDate = new Date(orderDateVal);
            const fDate = new Date(finishDateVal);
            const diffTime = fDate - oDate;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays >= 0) {
                badge.innerText = diffDays + " Hari";
            } else {
                badge.innerText = "-";
            }
        } else {
            badge.innerText = "-";
        }
    }

    // Dynamic cart implementation for creation
    let cart = [];
    const availableProducts = @json($availableProducts ?? []);
    const productMap = Object.fromEntries(availableProducts.map(product => [String(product.id), product]));

    function addToCart() {
        const prodSelect = document.getElementById('cart_product_select');
        const qtyInput = document.getElementById('cart_qty_input');

        if (!prodSelect.value || !qtyInput.value || qtyInput.value <= 0) {
            alert('Pilih produk kue dan isi jumlah pesanan yang valid!');
            return;
        }

        const product = productMap[String(prodSelect.value)];
        if (!product) {
            alert('Produk tidak ditemukan.');
            return;
        }

        const qty = parseInt(qtyInput.value);

        // Check if product already exists in cart, if so, accumulate qty
        const existingItem = cart.find(item => String(item.id) === String(product.id));
        if (existingItem) {
            existingItem.qty += qty;
        } else {
            cart.push({ id: product.id, name: product.name, price: Number(product.price), qty });
        }

        prodSelect.value = '';
        qtyInput.value = '';
        renderCart();
    }

    function renderCart() {
        const container = document.getElementById('cart_items_container');
        const totalText = document.getElementById('cart_total_text');
        const countText = document.getElementById('cart_item_count');
        const submitBtn = document.getElementById('create_submit_btn');

        container.innerHTML = '';
        let grandTotal = 0;

        if (cart.length === 0) {
            container.innerHTML = '<p class="text-slate-400 text-xs text-center py-4">Belum ada produk ditambahkan.</p>';
            totalText.innerText = 'Rp 0';
            countText.innerText = '0 item';
            submitBtn.disabled = true;
            return;
        }

        countText.innerText = cart.length + ' item';
        submitBtn.disabled = false;

        cart.forEach((item, index) => {
            const subtotal = item.price * item.qty;
            grandTotal += subtotal;

            const formattedPrice = new Intl.NumberFormat('id-ID').format(item.price);
            const formattedSubtotal = new Intl.NumberFormat('id-ID').format(subtotal);

            container.innerHTML += `
            <div class="relative bg-white border border-green-50 p-3 rounded-xl shadow-xs mb-1.5 flex justify-between items-center text-xs">
                <input type="hidden" name="products[${index}][id]" value="${item.id}">
                <input type="hidden" name="products[${index}][name]" value="${item.name}">
                <input type="hidden" name="products[${index}][qty]" value="${item.qty}">
                <input type="hidden" name="products[${index}][price]" value="${item.price}">
                <input type="hidden" name="products[${index}][subtotal]" value="${subtotal}">

                <div>
                    <h4 class="font-bold text-slate-800">${item.name}</h4>
                    <p class="text-[10px] text-slate-500 mt-0.5">
                        ${item.qty} Pcs × Rp ${formattedPrice} = 
                        <span class="font-extrabold text-green-700">Rp ${formattedSubtotal}</span>
                    </p>
                </div>
                <button type="button" onclick="removeFromCart(${index})" class="text-red-400 hover:text-red-600 p-1.5 hover:bg-red-50 rounded-lg transition cursor-pointer flex items-center justify-center border border-transparent hover:border-red-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
            </div>
            `;
        });

        totalText.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);
    }

    function removeFromCart(index) {
        cart.splice(index, 1);
        renderCart();
    }

    // Dynamic cart implementation for editing
    let editCart = [];

    function openEditModal(order) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editForm').action = '/orders/' + order.id;
        document.getElementById('edit_customer_input').value = order.customer;
        document.getElementById('edit_phone_input').value = order.phone || '';
        document.getElementById('edit_order_date_input').value = order.order_date;
        document.getElementById('edit_status_input').value = order.status;
        document.getElementById('edit_notes_input').value = order.notes || '';
        
        calculateEditEstimasi(order.finish_date);
        updateEditDuration();

        // Populate editCart
        editCart = [];
        if (order.products) {
            order.products.forEach(p => {
                editCart.push({
                    id: p.id,
                    name: p.name,
                    price: Number(p.price || p.subtotal / p.qty),
                    qty: Number(p.qty)
                });
            });
        }
        renderEditCart();
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function calculateEditEstimasi(existingFinishDate = null) {
        const inputDate = document.getElementById('edit_order_date_input').value;
        if (inputDate) {
            const dateObj = new Date(inputDate);
            dateObj.setDate(dateObj.getDate() + 2);
            
            const minFormattedDate = dateObj.toISOString().split('T')[0];
            const editFinishInput = document.getElementById('edit_finish_date_input');
            
            editFinishInput.min = minFormattedDate;
            
            if (existingFinishDate) {
                editFinishInput.value = existingFinishDate;
            } else {
                editFinishInput.value = minFormattedDate;
            }
        }
    }

    function addEditToCart() {
        const prodSelect = document.getElementById('edit_cart_product_select');
        const qtyInput = document.getElementById('edit_cart_qty_input');

        if (!prodSelect.value || !qtyInput.value || qtyInput.value <= 0) {
            alert('Pilih produk kue dan isi jumlah pesanan yang valid!');
            return;
        }

        const product = productMap[String(prodSelect.value)];
        if (!product) {
            alert('Produk tidak ditemukan.');
            return;
        }

        const qty = parseInt(qtyInput.value);

        // Check if product already exists in editCart, if so, accumulate qty
        const existingItem = editCart.find(item => String(item.id) === String(product.id));
        if (existingItem) {
            existingItem.qty += qty;
        } else {
            editCart.push({ id: product.id, name: product.name, price: Number(product.price), qty });
        }

        prodSelect.value = '';
        qtyInput.value = '';
        renderEditCart();
    }

    function renderEditCart() {
        const container = document.getElementById('edit_cart_items_container');
        const totalText = document.getElementById('edit_cart_total_text');
        const countText = document.getElementById('edit_cart_item_count');
        const submitBtn = document.getElementById('edit_submit_btn');

        container.innerHTML = '';
        let grandTotal = 0;

        if (editCart.length === 0) {
            container.innerHTML = '<p class="text-slate-400 text-xs text-center py-4">Belum ada produk ditambahkan.</p>';
            totalText.innerText = 'Rp 0';
            countText.innerText = '0 item';
            submitBtn.disabled = true;
            return;
        }

        countText.innerText = editCart.length + ' item';
        submitBtn.disabled = false;

        editCart.forEach((item, index) => {
            const subtotal = item.price * item.qty;
            grandTotal += subtotal;

            const formattedPrice = new Intl.NumberFormat('id-ID').format(item.price);
            const formattedSubtotal = new Intl.NumberFormat('id-ID').format(subtotal);

            container.innerHTML += `
            <div class="relative bg-white border border-green-50 p-3 rounded-xl shadow-xs mb-1.5 flex justify-between items-center text-xs">
                <input type="hidden" name="products[${index}][id]" value="${item.id}">
                <input type="hidden" name="products[${index}][name]" value="${item.name}">
                <input type="hidden" name="products[${index}][qty]" value="${item.qty}">
                <input type="hidden" name="products[${index}][price]" value="${item.price}">
                <input type="hidden" name="products[${index}][subtotal]" value="${subtotal}">

                <div>
                    <h4 class="font-bold text-slate-800">${item.name}</h4>
                    <p class="text-[10px] text-slate-500 mt-0.5">
                        ${item.qty} Pcs × Rp ${formattedPrice} = 
                        <span class="font-extrabold text-green-700">Rp ${formattedSubtotal}</span>
                    </p>
                </div>
                <button type="button" onclick="removeFromEditCart(${index})" class="text-red-400 hover:text-red-600 p-1.5 hover:bg-red-50 rounded-lg transition cursor-pointer flex items-center justify-center border border-transparent hover:border-red-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
            </div>
            `;
        });

        totalText.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);
    }

    function removeFromEditCart(index) {
        editCart.splice(index, 1);
        renderEditCart();
    }

    // Client-side dynamic filters logic
    function filterOrders() {
        const searchQuery = document.getElementById('search_input').value.toLowerCase();
        const statusFilter = document.getElementById('status_select').value;
        
        // Date filters
        const orderDateFrom = document.getElementById('order_date_from').value;
        const orderDateTo = document.getElementById('order_date_to').value;
        const finishDateFrom = document.getElementById('finish_date_from').value;
        const finishDateTo = document.getElementById('finish_date_to').value;
        
        const rows = document.querySelectorAll('.order-row');
        
        rows.forEach(row => {
            const customer = row.getAttribute('data-customer');
            const phone = row.getAttribute('data-phone');
            const status = row.getAttribute('data-status');
            const orderDate = row.getAttribute('data-order-date');
            const finishDate = row.getAttribute('data-finish-date');
            
            // 1. Search Query filter (matches customer name or phone)
            const matchesSearch = customer.includes(searchQuery) || phone.includes(searchQuery);
            
            // 2. Status filter
            const matchesStatus = statusFilter === "" || status === statusFilter;
            
            // 3. Order Date Range filter
            let matchesOrderDate = true;
            if (orderDateFrom && orderDate < orderDateFrom) matchesOrderDate = false;
            if (orderDateTo && orderDate > orderDateTo) matchesOrderDate = false;
            
            // 4. Finish Date Range filter
            let matchesFinishDate = true;
            if (finishDate && finishDateFrom && finishDate < finishDateFrom) matchesFinishDate = false;
            if (finishDate && finishDateTo && finishDate > finishDateTo) matchesFinishDate = false;
            if (!finishDate && (finishDateFrom || finishDateTo)) matchesFinishDate = false; // no finish date but filter active
            
            if (matchesSearch && matchesStatus && matchesOrderDate && matchesFinishDate) {
                row.classList.remove('hidden');
            } else {
                row.classList.add('hidden');
            }
        });
    }

    document.getElementById('search_input').addEventListener('input', filterOrders);
    document.getElementById('status_select').addEventListener('change', filterOrders);
    document.getElementById('order_date_from').addEventListener('change', filterOrders);
    document.getElementById('order_date_to').addEventListener('change', filterOrders);
    document.getElementById('finish_date_from').addEventListener('change', filterOrders);
    document.getElementById('finish_date_to').addEventListener('change', filterOrders);
    
    document.getElementById('reset_filters').addEventListener('click', function() {
        document.getElementById('search_input').value = '';
        document.getElementById('status_select').value = '';
        document.getElementById('order_date_from').value = '';
        document.getElementById('order_date_to').value = '';
        document.getElementById('finish_date_from').value = '';
        document.getElementById('finish_date_to').value = '';
        filterOrders();
    });

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

    function formatRp(value) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
    }

    function openReceiptModalForOrder(order, transaction) {
        // Synthesis a transaction object for openReceiptModal
        const trx = {
            id: order.id,
            customer: order.customer,
            admin: (transaction && transaction.admin) ? transaction.admin : 'Admin Alva Cake',
            payment_date: (transaction && transaction.payment_date) ? transaction.payment_date : order.order_date,
            created_at: order.created_at,
            total: order.total,
            status: (transaction && transaction.status) ? transaction.status : 'Belum Bayar',
            type: (transaction && transaction.type) ? transaction.type : 'Belum Bayar',
            paid: (transaction && transaction.paid) ? transaction.paid : 0,
            notes: order.notes,
            products: order.products,
            dp_nota: (transaction && transaction.dp_nota) ? transaction.dp_nota : null,
        };
        openReceiptModal(trx);
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

        const clone = element.cloneNode(true);
        clone.querySelectorAll('.print-hide').forEach(el => el.remove());
        clone.querySelector('button[type="button"]')?.remove();

        clone.style.border = 'none';
        clone.style.boxShadow = 'none';
        clone.style.padding = '40px';
        clone.style.borderRadius = '0px';
        clone.style.backgroundColor = '#ffffff';
        clone.style.maxHeight = 'none';
        clone.style.height = 'auto';
        clone.style.overflow = 'visible';

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

    window.openDetailModal = openDetailModal;
    window.closeDetailModal = closeDetailModal;
    window.openProductionConfirmModal = openProductionConfirmModal;
    window.closeProductionConfirmModal = closeProductionConfirmModal;
    window.openCompleteConfirmModal = openCompleteConfirmModal;
    window.closeCompleteConfirmModal = closeCompleteConfirmModal;
    window.openCreateModal = openCreateModal;
    window.closeCreateModal = closeCreateModal;
    window.openEditModal = openEditModal;
    window.closeEditModal = closeEditModal;
    window.openReceiptModalForOrder = openReceiptModalForOrder;
    window.openReceiptModal = openReceiptModal;
    window.printReceipt = printReceipt;
    window.downloadReceiptPDF = downloadReceiptPDF;
    window.closeReceiptModal = closeReceiptModal;
    if (typeof addProductRow !== 'undefined') window.addProductRow = addProductRow;
    if (typeof removeProductRow !== 'undefined') window.removeProductRow = removeProductRow;
</script>
@endsection
