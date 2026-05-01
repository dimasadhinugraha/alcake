@extends('layouts.app')

@section('title', 'Dashboard - Alva Cake')

@section('content')
<div class="max-w-7xl mx-auto px-8 py-6">
    <div class="space-y-8">
        <!-- 1. Header Card -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-pink-100 via-rose-100 to-fuchsia-50 p-8 shadow-xl border border-pink-200/50">
            <div class="absolute top-0 right-0 w-64 h-64 bg-pink-200/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-fuchsia-200/30 rounded-full blur-3xl"></div>
            <div class="relative">
                <div class="flex items-center gap-4 mb-3">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-fuchsia-400 rounded-2xl flex items-center justify-center shadow-lg transform rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cake w-8 h-8 text-white"><path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"></path><path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"></path><path d="M2 21h20"></path><path d="M7 8v3"></path><path d="M12 8v3"></path><path d="M17 8v3"></path><path d="M7 4h.01"></path><path d="M12 4h.01"></path><path d="M17 4h.01"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-pink-600 to-fuchsia-600 bg-clip-text text-transparent">Dashboard</h1>
                        <p class="text-pink-600 mt-1 flex items-center gap-2 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                        </p>
                    </div>
                </div>
                <div class="mt-4 inline-flex items-center gap-2 bg-white/60 backdrop-blur-sm px-4 py-2 rounded-xl border border-pink-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-4 h-4 text-amber-500"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>
                    <span class="text-sm font-semibold text-pink-900">Sistem Pre-Order Only</span>
                </div>
            </div>
        </div>

        <!-- 2. Statistics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Stat 1 -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl border-2 border-pink-100 p-6 shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm text-pink-600 font-semibold mb-2">Total Menu Katalog</p>
                        <p class="text-4xl font-bold text-pink-900 mb-2">{{ $totalMenu ?? 0 }}</p>
                    </div>
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-pink-400 to-rose-500 flex items-center justify-center text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cake w-8 h-8"><path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"></path><path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"></path><path d="M2 21h20"></path><path d="M7 8v3"></path><path d="M12 8v3"></path><path d="M17 8v3"></path><path d="M7 4h.01"></path><path d="M12 4h.01"></path><path d="M17 4h.01"></path></svg>
                    </div>
                </div>
            </div>
            <!-- Stat 2 -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl border-2 border-pink-100 p-6 shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm text-pink-600 font-semibold mb-2">Pesanan Aktif</p>
                        <p class="text-4xl font-bold text-pink-900 mb-2">{{ $pesananAktif ?? 0 }}</p>
                    </div>
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-list w-8 h-8"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><path d="M12 11h4"></path><path d="M12 16h4"></path><path d="M8 11h.01"></path><path d="M8 16h.01"></path></svg>
                    </div>
                </div>
            </div>
            <!-- Stat 3 -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl border-2 border-pink-100 p-6 shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm text-pink-600 font-semibold mb-2">Pesanan Bulan Ini</p>
                        <p class="text-4xl font-bold text-pink-900 mb-2">{{ $pesananBulanIni ?? 0 }}</p>
                        <p class="text-sm font-semibold text-green-600">+12% dari bulan lalu</p>
                    </div>
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-orange-400 to-pink-500 flex items-center justify-center text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart w-8 h-8"><circle cx="8" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>
                    </div>
                </div>
            </div>
            <!-- Stat 4 -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl border-2 border-pink-100 p-6 shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm text-pink-600 font-semibold mb-2">Bahan Baku Rendah</p>
                        <p class="text-4xl font-bold text-pink-900 mb-2">{{ $bahanBakuRendah ?? 0 }}</p>
                    </div>
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-rose-400 to-red-600 flex items-center justify-center text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-archive w-8 h-8"><rect width="20" height="5" x="2" y="3" rx="1"></rect><path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"></path><path d="M10 12h4"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Top Menu & Bahan Baku Status -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Menu Terpopuler -->
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl border-2 border-pink-100 p-6 shadow-xl">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-400 to-rose-400 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-6 h-6 text-white"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                    </div>
                    <h3 class="text-xl font-bold text-pink-900">Menu Terpopuler</h3>
                </div>
                <div class="space-y-3">
                    @forelse($menuTerpopuler ?? [] as $index => $menu)
                        @php
                            // Mapping colors from User's design
                            $iconGradients = [
                                'from-pink-500 to-rose-500',
                                'from-gray-700 to-gray-900',
                                'from-orange-500 to-amber-500',
                                'from-purple-500 to-pink-500'
                            ];
                            $iconGrad = $iconGradients[$index % 4];
                        @endphp
                        <div class="flex items-center gap-4 py-4 px-4 rounded-xl bg-gradient-to-r from-pink-50 to-rose-50 hover:from-pink-100 hover:to-rose-100 transition-all border border-pink-200">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $iconGrad }} flex items-center justify-center text-white font-bold shadow-md">{{ $index + 1 }}</div>
                            <div class="flex-1">
                                <p class="font-bold text-pink-900">{{ $menu->name }}</p>
                                <p class="text-xs text-pink-600 mt-1">{{ $menu->category ?? 'Kue Umum' }}</p>
                            </div>
                            <span class="inline-flex items-center justify-center rounded-md px-2 py-0.5 text-xs w-fit whitespace-nowrap shrink-0 transition-[color,box-shadow] bg-gradient-to-r from-pink-100 to-rose-100 text-pink-700 border-2 border-pink-200 font-bold">
                                {{ rand(5, 20) }} pesanan
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-400 text-center py-4 font-medium">Belum ada data menu produk.</p>
                    @endforelse
                </div>
            </div>

            <!-- Bahan Baku Rendah -->
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl border-2 border-red-100 p-6 shadow-xl">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-400 to-orange-400 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-archive w-6 h-6 text-white"><rect width="20" height="5" x="2" y="3" rx="1"></rect><path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"></path><path d="M10 12h4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-red-900">Bahan Baku Rendah</h3>
                </div>
                <div class="space-y-3 h-full flex flex-col justify-center pb-8">
                    @if(($bahanBakuRendah ?? 0) > 0)
                        <div class="text-center py-8">
                            <div class="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-red-100 shadow-sm">
                                <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            </div>
                            <h3 class="text-red-600 font-extrabold text-lg">Perhatian!</h3>
                            <p class="text-red-500 font-medium text-sm mt-2">Ada <strong class="font-bold">{{ $bahanBakuRendah }} bahan baku</strong> yang stoknya menipis.</p>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-12 h-12 mx-auto text-green-400 mb-3"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                            <p class="text-green-600 font-semibold">Semua bahan baku aman!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- 4. Pesanan Terbaru & Sistem Pre Order Note -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl border-2 border-blue-100 p-6 shadow-xl">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-indigo-400 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-list w-6 h-6 text-white"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><path d="M12 11h4"></path><path d="M12 16h4"></path><path d="M8 11h.01"></path><path d="M8 16h.01"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-blue-900">Pesanan Terbaru</h3>
            </div>
            
            <div class="space-y-3">
                @forelse($pesananTerbaru ?? [] as $pesanan)
                    <div class="flex items-center justify-between py-4 px-4 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all border border-blue-200">
                        <div class="flex items-center gap-4 flex-1">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-400 to-indigo-400 flex items-center justify-center text-white font-bold">{{ substr($pesanan->customer_name ?? 'C', 0, 1) }}</div>
                            <div>
                                <p class="font-bold text-blue-900">{{ $pesanan->customer_name ?? 'Pelanggan' }}</p>
                                <p class="text-xs text-blue-600 mt-1">{{ $pesanan->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        @if($pesanan->status == 'Selesai')
                            <span class="inline-flex items-center justify-center rounded-md px-2 py-0.5 text-xs w-fit whitespace-nowrap bg-green-100 text-green-700 border-green-200 border-2 font-bold">Selesai</span>
                        @elseif($pesanan->status == 'Diproses')
                            <span class="inline-flex items-center justify-center rounded-md px-2 py-0.5 text-xs w-fit whitespace-nowrap bg-blue-100 text-blue-700 border-blue-200 border-2 font-bold">Diproses</span>
                        @else
                            <span class="inline-flex items-center justify-center rounded-md px-2 py-0.5 text-xs w-fit whitespace-nowrap bg-yellow-100 text-yellow-700 border-yellow-200 border-2 font-bold">{{ $pesanan->status ?? 'Pending' }}</span>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-6 font-medium">Belum ada pesanan terbaru.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl p-6 border-2 border-amber-200/50 shadow-md">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-400 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-6 h-6 text-white"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>
                </div>
                <div>
                    <h4 class="font-bold text-amber-900 mb-2 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart w-4 h-4"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path></svg>Sistem Pre-Order Toko Kue
                    </h4>
                    <p class="text-sm text-amber-700"><strong>Alva Cake</strong> menggunakan sistem <strong>pre-order only</strong>. Semua kue dibuat segar berdasarkan pesanan pelanggan. Tidak ada produk jadi yang disimpan di toko. Kelola pesanan produksi melalui menu <strong>Pesanan Produksi</strong> dan pantau ketersediaan bahan baku untuk memastikan produksi berjalan lancar.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
