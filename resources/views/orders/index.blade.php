@extends('layouts.app')

@section('title', 'Order Management - Alva Cake')

@section('content')
<div class="max-w-7xl mx-auto px-8 py-6">
    <div class="space-y-8" style="font-family: &quot;DM Sans&quot;, sans-serif;">
        <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-purple-500 via-pink-500 to-orange-400 p-10 shadow-2xl" style="opacity: 1; transform: none;">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -top-20 -right-20 w-96 h-96 bg-white/10 rounded-full blur-3xl" style="transform: scale(1.16264) rotate(73.188deg);"></div>
            </div>
            <div class="relative flex items-center justify-between">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-xl rounded-[1.2rem] flex items-center justify-center shadow-2xl border border-white/30">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chef-hat w-10 h-10 text-white drop-shadow-lg"><path d="M17 21a1 1 0 0 0 1-1v-5.35c0-.457.316-.844.727-1.041a4 4 0 0 0-2.134-7.589 5 5 0 0 0-9.186 0 4 4 0 0 0-2.134 7.588c.411.198.727.585.727 1.041V20a1 1 0 0 0 1 1Z"></path><path d="M6 17h12"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-5xl font-extrabold text-white drop-shadow-lg mb-2" style="font-family: Outfit, sans-serif;">Order Management</h1>
                        <p class="text-white/90 text-lg flex items-center gap-2 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-5 h-5"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>
                            Pesanan Multi-Produk dengan Auto-Kalkulasi
                        </p>
                    </div>
                </div>
                <button type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="createModal" onclick="openCreateModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive h-9 has-[&gt;svg]:px-3 bg-white text-purple-700 hover:bg-white/90 shadow-2xl rounded-2xl px-8 py-7 text-lg font-bold border-4 border-white/50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-6 h-6 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                    Buat Pesanan Baru
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6" style="opacity: 1; transform: none;">
            <div class="bg-gradient-to-br from-yellow-400 to-orange-400 rounded-2xl p-6 text-white shadow-xl cursor-pointer" style="opacity: 1; transform: none;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/80 text-sm font-semibold mb-1">Pending</p>
                        <p class="text-5xl font-extrabold">{{ $orders->where('status', 'Pending')->count() }}</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-8 h-8"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-400 to-cyan-400 rounded-2xl p-6 text-white shadow-xl cursor-pointer" style="opacity: 1; transform: none;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/80 text-sm font-semibold mb-1">Diproses</p>
                        <p class="text-5xl font-extrabold">{{ $orders->where('status', 'Diproses')->count() }}</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-8 h-8"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-400 to-emerald-400 rounded-2xl p-6 text-white shadow-xl cursor-pointer" style="opacity: 1; transform: none;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/80 text-sm font-semibold mb-1">Selesai</p>
                        <p class="text-5xl font-extrabold">{{ $orders->where('status', 'Selesai')->count() }}</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-8 h-8"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-red-400 to-rose-400 rounded-2xl p-6 text-white shadow-xl cursor-pointer" style="opacity: 1; transform: none;">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/80 text-sm font-semibold mb-1">Dibatalkan</p>
                        <p class="text-5xl font-extrabold">{{ $orders->where('status', 'Dibatalkan')->count() }}</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-triangle-alert w-8 h-8"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <div style="opacity: 1; transform: none;">
            <div data-slot="card" class="text-card-foreground flex flex-col gap-6 border-4 border-purple-200 shadow-2xl rounded-[2rem] overflow-hidden bg-gradient-to-br from-white to-purple-50/20">
                <div data-slot="card-header" class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6 bg-gradient-to-r from-purple-100 via-pink-100 to-orange-100 border-b-4 border-purple-200 py-6">
                    <h4 data-slot="card-title" class="text-2xl font-extrabold text-purple-900">📋 Daftar Pesanan Produksi</h4>
                </div>
                <div data-slot="card-content" class="px-6 [&amp;:last-child]:pb-6 pt-6">
                    <div class="overflow-x-auto">
                        <div data-slot="table-container" class="relative w-full overflow-x-auto">
                            <table data-slot="table" class="w-full caption-bottom text-sm">
                                <thead data-slot="table-header" class="[&amp;_tr]:border-b">
                                    <tr data-slot="table-row" class="hover:bg-muted/50 data-[state=selected]:bg-muted transition-colors bg-gradient-to-r from-purple-50 to-pink-50 border-b-2 border-purple-200">
                                        <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">ID</th>
                                        <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Pelanggan</th>
                                        <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Produk</th>
                                        <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Total</th>
                                        <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Tgl Pesan</th>
                                        <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Tgl Selesai</th>
                                        <th data-slot="table-head" class="text-foreground h-10 px-2 text-left align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">Status</th>
                                        <th data-slot="table-head" class="text-foreground h-10 px-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] text-right font-extrabold">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody data-slot="table-body" class="[&amp;_tr:last-child]:border-0">
                                    @forelse($orders as $order)
                                        @php
                                            $products = is_array($order->products) ? $order->products : [];
                                            $status = $order->status;
                                            $statusClasses = [
                                                'Pending' => 'bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 border-yellow-200 font-semibold',
                                                'Diproses' => 'bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800 border-blue-200 font-semibold',
                                                'Selesai' => 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border-green-200 font-semibold',
                                                'Dibatalkan' => 'bg-gradient-to-r from-red-100 to-rose-100 text-red-800 border-red-200 font-semibold',
                                            ];
                                            $statusLabel = [
                                                'Pending' => '⏳ Pending',
                                                'Diproses' => '🔄 Diproses',
                                                'Selesai' => '✓ Selesai',
                                                'Dibatalkan' => '⨯ Dibatalkan',
                                            ][$status] ?? $status;
                                        @endphp
                                        <tr data-slot="table-row" class="data-[state=selected]:bg-muted transition-colors hover:bg-purple-50/50 border-b border-purple-100">
                                            <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-mono text-sm font-bold text-purple-600">#{{ $order->id }}</td>
                                            <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold">{{ $order->customer }}</td>
                                            <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]">
                                                <div class="flex flex-col gap-1">
                                                    @forelse($products as $item)
                                                        <span class="text-sm">• {{ is_array($item) ? ($item['name'] ?? '-') : $item }} ×{{ is_array($item) ? ($item['qty'] ?? 1) : 1 }}</span>
                                                    @empty
                                                        <span class="text-sm text-gray-400">-</span>
                                                    @endforelse
                                                </div>
                                            </td>
                                            <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] font-extrabold text-purple-700">Rp&nbsp;{{ number_format((float) $order->total, 0, ',', '.') }}</td>
                                            <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] text-sm">{{ \Carbon\Carbon::parse($order->order_date)->format('d F Y') }}</td>
                                            <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] text-sm font-semibold text-orange-600">{{ $order->finish_date ? \Carbon\Carbon::parse($order->finish_date)->format('d F Y') : '-' }}</td>
                                            <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px]">
                                                <span data-slot="badge" class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs w-fit whitespace-nowrap shrink-0 [&amp;&gt;svg]:size-3 gap-1 [&amp;&gt;svg]:pointer-events-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive transition-[color,box-shadow] overflow-hidden [a&amp;]:hover:bg-primary/90 {{ $statusClasses[$status] ?? 'bg-gradient-to-r from-gray-100 to-slate-100 text-gray-800 border-gray-200 font-semibold' }}">{{ $statusLabel }}</span>
                                            </td>
                                            <td data-slot="table-cell" class="p-2 align-middle whitespace-nowrap [&amp;:has([role=checkbox])]:pr-0 [&amp;&gt;[role=checkbox]]:translate-y-[2px] text-right space-x-2">
                                                <button type="button" data-slot="button" onclick='openDetailModal(@json($order))' class="inline-flex items-center justify-center whitespace-nowrap text-sm transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-background hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 h-8 gap-1.5 px-3 has-[&gt;svg]:px-2.5 border-2 border-blue-300 text-blue-700 hover:bg-blue-50 rounded-xl font-bold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-4 h-4"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                </button>
                                                <button type="button" data-slot="button" onclick='openEditModal(@json($order))' class="inline-flex items-center justify-center whitespace-nowrap text-sm transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-background hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 h-8 gap-1.5 px-3 has-[&gt;svg]:px-2.5 border-2 border-purple-300 text-purple-700 hover:bg-purple-50 rounded-xl font-bold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen w-4 h-4"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path></svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="p-8 text-center text-gray-500">Belum ada data pesanan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="detailModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900/40 backdrop-blur-sm py-10 transition-opacity">
    <div class="bg-white rounded-[2rem] w-full max-w-lg mx-4 overflow-hidden shadow-[0_0_40px_-10px_rgba(167,43,238,0.25)] border-4 border-purple-50 flex flex-col relative max-h-[90vh]">
        <div class="px-8 pt-8 pb-4 shrink-0 flex justify-between items-center relative z-10 bg-white">
            <div class="flex items-center gap-3"><span class="text-3xl">📦</span><h2 class="text-2xl font-extrabold text-[#A72BEE]">Detail Pesanan</h2></div>
            <button type="button" onclick="closeDetailModal()" class="w-8 h-8 rounded-full border border-gray-200 text-gray-400 hover:text-red-500 hover:bg-red-50 transition cursor-pointer"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg></button>
        </div>
        <div class="p-8 pt-2 overflow-y-auto custom-scrollbar">
            <div class="grid grid-cols-2 gap-6 mb-8">
                <div><p class="text-xs text-gray-400 font-semibold mb-1 uppercase">Pelanggan</p><p id="modal_customer" class="text-lg font-bold text-gray-900">-</p></div>
                <div><p class="text-xs text-gray-400 font-semibold mb-1 uppercase">Total</p><p id="modal_total" class="text-lg font-extrabold text-[#A72BEE]">-</p></div>
                <div><p class="text-xs text-gray-400 font-semibold mb-1 uppercase">Tanggal Pesan</p><p id="modal_order_date" class="font-bold text-gray-900">-</p></div>
                <div><p class="text-xs text-gray-400 font-semibold mb-1 uppercase">Estimasi Selesai</p><p id="modal_finish_date" class="font-bold text-[#EF4444]">-</p></div>
            </div>
            <div class="mb-6">
                <h3 class="text-sm font-extrabold text-gray-900 mb-3">Produk dalam Pesanan:</h3>
                <div id="modal_products_container" class="space-y-3"></div>
            </div>
            <div class="bg-[#F0F5FF] rounded-2xl p-5 border border-blue-100">
                <p class="text-xs text-[#5C82FF] font-bold mb-1.5">Catatan:</p>
                <p id="modal_notes" class="text-sm font-medium text-[#1E3A8A] leading-relaxed">-</p>
            </div>
        </div>
    </div>
</div>

<div id="createModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900/50 backdrop-blur-sm py-10 transition-opacity">
    <div role="dialog" aria-describedby="radix-create-desc" aria-labelledby="radix-create-title" data-state="open" data-slot="dialog-content" class="data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 fixed top-[50%] left-[50%] z-50 grid w-full translate-x-[-50%] translate-y-[-50%] gap-4 p-6 duration-200 sm:max-w-5xl max-w-6xl max-h-[95vh] overflow-y-auto bg-gradient-to-br from-white to-purple-50/30 rounded-[2rem] border-4 border-purple-200/50 shadow-2xl" tabindex="-1" style="pointer-events: auto;">
        <div data-slot="dialog-header" class="flex flex-col gap-2 text-center sm:text-left">
            <div class="flex items-center gap-4 pb-3">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-7 h-7 text-white"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                </div>
                <h2 id="radix-create-title" data-slot="dialog-title" class="text-3xl font-extrabold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent" style="font-family: Outfit, sans-serif;">Buat Pesanan Multi-Produk</h2>
            </div>
        </div>

        <form class="space-y-6 pt-2" action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-6 bg-gradient-to-br from-purple-50/80 to-pink-50/80 rounded-2xl border-2 border-purple-100 shadow-inner">
                <div class="space-y-3">
                    <label data-slot="label" class="select-none text-sm font-bold text-purple-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        Nama Pelanggan
                    </label>
                    <input data-slot="input" type="text" name="customer" required placeholder="Masukkan nama pelanggan" class="bg-white border-2 border-purple-200 rounded-xl h-12 w-full min-w-0 px-3 py-1 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50" value="">
                </div>

                <div class="space-y-3">
                    <label data-slot="label" class="flex items-center gap-2 text-sm font-bold text-purple-900">Status Pesanan</label>
                    <select data-slot="select" name="status" class="bg-white border-2 border-purple-200 rounded-xl h-12 w-full min-w-0 px-3 py-1 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50">
                        <option value="Pending">⏳ Pending</option>
                        <option value="Diproses">🔄 Diproses</option>
                        <option value="Selesai">✓ Selesai</option>
                        <option value="Dibatalkan">✕ Dibatalkan</option>
                    </select>
                </div>

                <div class="space-y-3">
                    <label data-slot="label" class="select-none text-sm font-bold text-purple-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                        Tanggal Pemesanan
                    </label>
                    <input type="date" data-slot="input" name="order_date" id="order_date_input" onchange="calculateEstimasi()" class="bg-white border-2 border-purple-200 rounded-xl h-12 w-full min-w-0 px-3 py-1 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50" required value="">
                </div>

                <div class="space-y-3">
                    <label data-slot="label" class="select-none text-sm font-bold text-purple-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                        Tanggal Selesai (Estimasi)
                    </label>
                    <input type="date" data-slot="input" name="finish_date" id="finish_date_input" class="bg-white border-2 border-purple-200 rounded-xl h-12 w-full min-w-0 px-3 py-1 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50" required value="">
                    <p class="text-xs text-purple-600 mt-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info w-3 h-3 inline mr-1"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>Ketentuan: minimal +2 hari dari tanggal pemesanan</p>
                </div>

                <div class="space-y-3 md:col-span-2">
                    <label data-slot="label" class="flex items-center gap-2 text-sm font-bold text-purple-900">Catatan (Opsional)</label>
                    <textarea data-slot="textarea" name="notes" rows="2" placeholder="Catatan tambahan..." class="resize-none bg-white border-2 border-purple-200 rounded-xl w-full px-3 py-2 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50"></textarea>
                </div>
            </div>

            <div class="p-6 bg-gradient-to-br from-orange-50/80 to-pink-50/80 rounded-2xl border-2 border-orange-100">
                <h3 class="text-lg font-extrabold text-orange-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-5 h-5"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                    Tambah Produk ke Pesanan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2 space-y-2">
                        <label data-slot="label" class="flex items-center gap-2 text-sm font-bold text-orange-900">Pilih Produk</label>
                        <select id="cart_product_select" data-slot="select" class="bg-white border-2 border-orange-200 rounded-xl h-12 w-full min-w-0 px-3 py-1 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50">
                            <option value="">Pilih produk...</option>
                            @foreach($availableProducts ?? [] as $product)
                                <option value="{{ $product['id'] }}" data-name="{{ $product['name'] }}" data-price="{{ $product['price'] }}">{{ $product['name'] }} - Rp {{ number_format($product['price'], 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label data-slot="label" class="flex items-center gap-2 text-sm font-bold text-orange-900">Jumlah</label>
                        <input type="number" id="cart_qty_input" data-slot="input" class="bg-white border-2 border-orange-200 rounded-xl h-12 w-full min-w-0 px-3 py-1 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50" min="1" placeholder="0" value="">
                    </div>
                </div>
                <button data-slot="button" type="button" onclick="addToCart()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2 has-[&gt;svg]:px-3 mt-4 bg-gradient-to-r from-orange-500 to-pink-500 hover:from-orange-600 hover:to-pink-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                    Tambah ke Pesanan
                </button>
            </div>

            <div class="bg-white border border-purple-100 rounded-2xl p-5 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-extrabold text-purple-900">Produk dalam Pesanan</h4>
                    <div class="flex items-center gap-3">
                        <span id="cart_item_count" class="text-sm font-bold text-purple-600">0 item</span>
                        <span id="cart_total_text" class="text-base font-extrabold text-purple-900 bg-purple-100 px-3 py-1 rounded-lg">Rp 0</span>
                    </div>
                </div>
                <div id="cart_items_container" class="space-y-3">
                    <p class="text-gray-400 text-sm text-center py-4">Belum ada produk ditambahkan.</p>
                </div>
            </div>

            <div class="space-y-3">
                <div class="text-center text-sm bg-gradient-to-r from-blue-50 to-cyan-50 p-4 rounded-xl border-2 border-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info w-5 h-5 inline mr-2 text-blue-600"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>
                    <span class="font-bold text-blue-900">Stok bahan baku akan otomatis berkurang untuk semua produk</span>
                </div>
                <div class="text-center text-xs bg-gradient-to-r from-green-50 to-emerald-50 p-3 rounded-xl border-2 border-green-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big w-4 h-4 inline mr-2 text-green-600"><path d="M21.801 10A10 10 0 1 1 17 3.335"></path><path d="m9 11 3 3L22 4"></path></svg>
                    <span class="font-semibold text-green-900">✓ Tersinkron dengan Stok Bahan Baku</span>
                </div>
            </div>

            <div class="flex gap-4">
                <button data-slot="button" type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] text-primary-foreground hover:bg-primary/90 px-4 py-2 has-[&gt;svg]:px-3 flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 rounded-2xl h-14 text-lg font-extrabold">🎉 Buat Pesanan</button>
                <button data-slot="button" type="button" onclick="closeCreateModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] border bg-background text-foreground hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 px-4 py-2 has-[&gt;svg]:px-3 flex-1 rounded-2xl h-14 text-lg font-bold">Batal</button>
            </div>
        </form>

        <button type="button" class="ring-offset-background focus:ring-ring data-[state=open]:bg-accent data-[state=open]:text-muted-foreground absolute top-4 right-4 rounded-xs opacity-70 transition-opacity hover:opacity-100 focus:ring-2 focus:ring-offset-2 focus:outline-hidden disabled:pointer-events-none [&amp;_svg]:pointer-events-none [&amp;_svg]:shrink-0 [&amp;_svg:not([class*='size-'])]:size-4" onclick="closeCreateModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
            <span class="sr-only">Close</span>
        </button>
    </div>
</div>

<!-- Modal Edit Pesanan -->
<div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900/50 backdrop-blur-sm py-10 transition-opacity">
    <div role="dialog" aria-describedby="radix-edit-desc" aria-labelledby="radix-edit-title" data-state="open" data-slot="dialog-content" class="data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 fixed top-[50%] left-[50%] z-50 grid w-full translate-x-[-50%] translate-y-[-50%] gap-4 p-6 duration-200 sm:max-w-5xl max-w-6xl max-h-[95vh] overflow-y-auto bg-gradient-to-br from-white to-purple-50/30 rounded-[2rem] border-4 border-purple-200/50 shadow-2xl" tabindex="-1" style="pointer-events: auto;">
        <div data-slot="dialog-header" class="flex flex-col gap-2 text-center sm:text-left">
            <div class="flex items-center gap-4 pb-3">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-7 h-7 text-white"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                </div>
                <h2 id="radix-edit-title" data-slot="dialog-title" class="text-3xl font-extrabold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent" style="font-family: Outfit, sans-serif;">Edit Pesanan</h2>
            </div>
        </div>

        <form id="editForm" class="space-y-6 pt-2" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-6 bg-gradient-to-br from-purple-50/80 to-pink-50/80 rounded-2xl border-2 border-purple-100 shadow-inner">
                <div class="space-y-3">
                    <label data-slot="label" class="select-none text-sm font-bold text-purple-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-4 h-4"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        Nama Pelanggan
                    </label>
                    <input data-slot="input" type="text" name="customer" id="edit_customer_input" required placeholder="Masukkan nama pelanggan" class="bg-white border-2 border-purple-200 rounded-xl h-12 w-full min-w-0 px-3 py-1 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50" value="">
                </div>

                <div class="space-y-3">
                    <label data-slot="label" class="flex items-center gap-2 text-sm font-bold text-purple-900">Status Pesanan</label>
                    <select data-slot="select" name="status" id="edit_status_input" class="bg-white border-2 border-purple-200 rounded-xl h-12 w-full min-w-0 px-3 py-1 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50">
                        <option value="Pending">⏳ Pending</option>
                        <option value="Diproses">🔄 Diproses</option>
                        <option value="Selesai">✓ Selesai</option>
                        <option value="Dibatalkan">✕ Dibatalkan</option>
                    </select>
                </div>

                <div class="space-y-3">
                    <label data-slot="label" class="select-none text-sm font-bold text-purple-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                        Tanggal Pemesanan
                    </label>
                    <input type="date" data-slot="input" name="order_date" id="edit_order_date_input" onchange="calculateEditEstimasi()" class="bg-white border-2 border-purple-200 rounded-xl h-12 w-full min-w-0 px-3 py-1 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50" required value="">
                </div>

                <div class="space-y-3">
                    <label data-slot="label" class="select-none text-sm font-bold text-purple-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                        Tanggal Selesai (Estimasi)
                    </label>
                    <input type="date" data-slot="input" name="finish_date" id="edit_finish_date_input" class="bg-white border-2 border-purple-200 rounded-xl h-12 w-full min-w-0 px-3 py-1 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50" required value="">
                    <p class="text-xs text-purple-600 mt-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info w-3 h-3 inline mr-1"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>Ketentuan: minimal +2 hari dari tanggal pemesanan</p>
                </div>

                <div class="space-y-3 md:col-span-2">
                    <label data-slot="label" class="flex items-center gap-2 text-sm font-bold text-purple-900">Catatan (Opsional)</label>
                    <textarea data-slot="textarea" name="notes" id="edit_notes_input" rows="2" placeholder="Catatan tambahan..." class="resize-none bg-white border-2 border-purple-200 rounded-xl w-full px-3 py-2 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50"></textarea>
                </div>
            </div>

            <div class="p-6 bg-gradient-to-br from-orange-50/80 to-pink-50/80 rounded-2xl border-2 border-orange-100">
                <h3 class="text-lg font-extrabold text-orange-900 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-5 h-5"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                    Tambah Produk ke Pesanan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2 space-y-2">
                        <label data-slot="label" class="flex items-center gap-2 text-sm font-bold text-orange-900">Pilih Produk</label>
                        <select id="edit_cart_product_select" data-slot="select" class="bg-white border-2 border-orange-200 rounded-xl h-12 w-full min-w-0 px-3 py-1 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50">
                            <option value="">Pilih produk...</option>
                            @foreach($availableProducts ?? [] as $product)
                                <option value="{{ $product['id'] }}" data-name="{{ $product['name'] }}" data-price="{{ $product['price'] }}">{{ $product['name'] }} - Rp {{ number_format($product['price'], 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label data-slot="label" class="flex items-center gap-2 text-sm font-bold text-orange-900">Jumlah</label>
                        <input type="number" id="edit_cart_qty_input" data-slot="input" class="bg-white border-2 border-orange-200 rounded-xl h-12 w-full min-w-0 px-3 py-1 text-base outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50" min="1" placeholder="0" value="">
                    </div>
                </div>
                <button data-slot="button" type="button" onclick="addEditToCart()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2 has-[&gt;svg]:px-3 mt-4 bg-gradient-to-r from-orange-500 to-pink-500 hover:from-orange-600 hover:to-pink-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                    Tambah ke Pesanan
                </button>
            </div>

            <div class="bg-white border border-purple-100 rounded-2xl p-5 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="font-extrabold text-purple-900">Produk dalam Pesanan</h4>
                    <div class="flex items-center gap-3">
                        <span id="edit_cart_item_count" class="text-sm font-bold text-purple-600">0 item</span>
                        <span id="edit_cart_total_text" class="text-base font-extrabold text-purple-900 bg-purple-100 px-3 py-1 rounded-lg">Rp 0</span>
                    </div>
                </div>
                <div id="edit_cart_items_container" class="space-y-3">
                    <p class="text-gray-400 text-sm text-center py-4">Belum ada produk ditambahkan.</p>
                </div>
            </div>

            <div class="space-y-3">
                <div class="text-center text-sm bg-gradient-to-r from-blue-50 to-cyan-50 p-4 rounded-xl border-2 border-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info w-5 h-5 inline mr-2 text-blue-600"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>
                    <span class="font-bold text-blue-900">Stok bahan baku akan otomatis berkurang/kembali untuk semua produk</span>
                </div>
            </div>

            <div class="flex gap-4">
                <button data-slot="button" type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] text-primary-foreground hover:bg-primary/90 px-4 py-2 has-[&gt;svg]:px-3 flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 rounded-2xl h-14 text-lg font-extrabold">✓ Update</button>
                <button data-slot="button" type="button" onclick="closeEditModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] border bg-background text-foreground hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 px-4 py-2 has-[&gt;svg]:px-3 flex-1 rounded-2xl h-14 text-lg font-bold">Batal</button>
            </div>
        </form>

        <button type="button" class="ring-offset-background focus:ring-ring data-[state=open]:bg-accent data-[state=open]:text-muted-foreground absolute top-4 right-4 rounded-xs opacity-70 transition-opacity hover:opacity-100 focus:ring-2 focus:ring-offset-2 focus:outline-hidden disabled:pointer-events-none [&amp;_svg]:pointer-events-none [&amp;_svg]:shrink-0 [&amp;_svg:not([class*='size-'])]:size-4" onclick="closeEditModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
            <span class="sr-only">Close</span>
        </button>
    </div>
</div>

<script>
    function openDetailModal(order) {
        document.getElementById('detailModal').classList.remove('hidden');
        document.getElementById('modal_customer').innerText = order.customer;
        document.getElementById('modal_order_date').innerText = order.order_date;
        document.getElementById('modal_finish_date').innerText = order.finish_date || '-';
        document.getElementById('modal_notes').innerText = order.notes || 'Tidak ada catatan.';

        const formattedTotal = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(order.total);
        document.getElementById('modal_total').innerText = formattedTotal;

        const container = document.getElementById('modal_products_container');
        container.innerHTML = '';
        if (order.products && order.products.length > 0) {
            order.products.forEach(item => {
                const pPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(item.subtotal);
                container.innerHTML += `<div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl border border-gray-100"><p class="font-bold text-gray-800">${item.name} <span class="text-gray-500 font-medium ml-1">×${item.qty}</span></p><p class="font-bold text-[#A72BEE]">${pPrice}</p></div>`;
            });
        }
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
        document.getElementById('order_date_input').value = new Date().toISOString().split('T')[0];
        calculateEstimasi();
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

    let cart = [];
    const availableProducts = @json($availableProducts ?? []);
    const productMap = Object.fromEntries(availableProducts.map(product => [String(product.id), product]));

    function addToCart() {
        const prodSelect = document.getElementById('cart_product_select');
        const qtyInput = document.getElementById('cart_qty_input');

        if (!prodSelect.value || !qtyInput.value || qtyInput.value <= 0) {
            alert('Pilih produk dan isi jumlah yang valid ya!');
            return;
        }

        const product = productMap[String(prodSelect.value)];
        if (!product) {
            alert('Produk tidak ditemukan.');
            return;
        }

        const qty = parseInt(qtyInput.value);

        cart.push({ id: product.id, name: product.name, price: Number(product.price), qty });
        prodSelect.value = '';
        qtyInput.value = '';
        renderCart();
    }

    function renderCart() {
        const container = document.getElementById('cart_items_container');
        const totalText = document.getElementById('cart_total_text');
        const countText = document.getElementById('cart_item_count');

        container.innerHTML = '';
        let grandTotal = 0;

        if (cart.length === 0) {
            container.innerHTML = '<p class="text-gray-400 text-sm text-center py-4">Belum ada produk ditambahkan.</p>';
            totalText.innerText = 'Rp 0';
            countText.innerText = '0 item';
            return;
        }

        countText.innerText = cart.length + ' item';

        cart.forEach((item, index) => {
            const subtotal = item.price * item.qty;
            grandTotal += subtotal;

            const formattedPrice = new Intl.NumberFormat('id-ID').format(item.price);
            const formattedSubtotal = new Intl.NumberFormat('id-ID').format(subtotal);

            container.innerHTML += `
            <div class="relative bg-white border border-gray-100 p-4 rounded-xl shadow-sm mb-2 hover:border-pink-200 transition">
                <input type="hidden" name="products[${index}][name]" value="${item.name}">
                <input type="hidden" name="products[${index}][qty]" value="${item.qty}">
                <input type="hidden" name="products[${index}][price]" value="${item.price}">
                <input type="hidden" name="products[${index}][subtotal]" value="${subtotal}">

                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="font-bold text-gray-800">${item.name}</h4>
                        <p class="text-sm text-gray-500 mt-0.5">${item.qty} pcs × Rp ${formattedPrice} = <span class="font-bold text-[#D82A97]">Rp ${formattedSubtotal}</span></p>
                    </div>
                    <button type="button" onclick="removeFromCart(${index})" class="text-red-400 hover:text-red-600 p-2 hover:bg-red-50 rounded-lg transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
            </div>
            `;
        });

        totalText.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);
    }

    function removeFromCart(index) {
        cart.splice(index, 1);
        renderCart();
    }

    let editCart = [];

    function openEditModal(order) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editForm').action = '/orders/' + order.id;
        document.getElementById('edit_customer_input').value = order.customer;
        document.getElementById('edit_order_date_input').value = order.order_date;
        document.getElementById('edit_status_input').value = order.status;
        document.getElementById('edit_notes_input').value = order.notes || '';
        
        calculateEditEstimasi(order.finish_date);

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
            alert('Pilih produk dan isi jumlah yang valid ya!');
            return;
        }

        const product = productMap[String(prodSelect.value)];
        if (!product) {
            alert('Produk tidak ditemukan.');
            return;
        }

        const qty = parseInt(qtyInput.value);

        editCart.push({ id: product.id, name: product.name, price: Number(product.price), qty });
        prodSelect.value = '';
        qtyInput.value = '';
        renderEditCart();
    }

    function renderEditCart() {
        const container = document.getElementById('edit_cart_items_container');
        const totalText = document.getElementById('edit_cart_total_text');
        const countText = document.getElementById('edit_cart_item_count');

        container.innerHTML = '';
        let grandTotal = 0;

        if (editCart.length === 0) {
            container.innerHTML = '<p class="text-gray-400 text-sm text-center py-4">Belum ada produk ditambahkan.</p>';
            totalText.innerText = 'Rp 0';
            countText.innerText = '0 item';
            return;
        }

        countText.innerText = editCart.length + ' item';

        editCart.forEach((item, index) => {
            const subtotal = item.price * item.qty;
            grandTotal += subtotal;

            const formattedPrice = new Intl.NumberFormat('id-ID').format(item.price);
            const formattedSubtotal = new Intl.NumberFormat('id-ID').format(subtotal);

            container.innerHTML += `
            <div class="relative bg-white border border-gray-100 p-4 rounded-xl shadow-sm mb-2 hover:border-pink-200 transition">
                <input type="hidden" name="products[${index}][name]" value="${item.name}">
                <input type="hidden" name="products[${index}][qty]" value="${item.qty}">
                <input type="hidden" name="products[${index}][price]" value="${item.price}">
                <input type="hidden" name="products[${index}][subtotal]" value="${subtotal}">

                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="font-bold text-gray-800">${item.name}</h4>
                        <p class="text-sm text-gray-500 mt-0.5">${item.qty} pcs × Rp ${formattedPrice} = <span class="font-bold text-[#D82A97]">Rp ${formattedSubtotal}</span></p>
                    </div>
                    <button type="button" onclick="removeFromEditCart(${index})" class="text-red-400 hover:text-red-600 p-2 hover:bg-red-50 rounded-lg transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
            </div>
            `;
        });

        totalText.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);
    }

    function removeFromEditCart(index) {
        editCart.splice(index, 1);
        renderEditCart();
    }
</script>
@endsection
