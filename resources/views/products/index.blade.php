@extends('layouts.app')

@section('title', 'Katalog Menu Kue - Alva Cake')

@section('content')
<div class="max-w-7xl mx-auto px-8 py-6">
    <div class="space-y-8">
        
        <!-- Flash Message -->
        @if(session('success'))
        <div class="bg-green-50 text-green-700 p-4 rounded-2xl font-bold border border-green-100 flex items-center gap-3 shadow-sm">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- 1. Header Card -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-rose-100 via-pink-100 to-fuchsia-50 p-8 shadow-xl border border-rose-200/50">
            <div class="absolute top-0 right-0 w-64 h-64 bg-pink-200/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-fuchsia-200/30 rounded-full blur-3xl"></div>
            <div class="relative flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-fuchsia-400 rounded-2xl flex items-center justify-center shadow-lg transform rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cake w-8 h-8 text-white"><path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"></path><path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"></path><path d="M2 21h20"></path><path d="M7 8v3"></path><path d="M12 8v3"></path><path d="M17 8v3"></path><path d="M7 4h.01"></path><path d="M12 4h.01"></path><path d="M17 4h.01"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-pink-600 to-fuchsia-600 bg-clip-text text-transparent">Katalog Menu Kue</h1>
                        <p class="text-pink-600 mt-1 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-4 h-4"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>Sistem Pre-Order - Pesan Terlebih Dahulu
                        </p>
                    </div>
                </div>
                <button onclick="openAddModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium bg-gradient-to-r from-pink-400 to-fuchsia-400 hover:from-pink-500 hover:to-fuchsia-500 text-white shadow-2xl rounded-2xl px-6 py-6 transform hover:scale-105 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-5 h-5 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                    <span class="font-semibold">Tambah Menu</span>
                </button>
            </div>
        </div>

        <!-- 2. Statistics Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-pink-400 to-fuchsia-400 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-pink-100 text-sm font-medium mb-1">Total Menu</p>
                        <p class="text-4xl font-bold">{{ $products->total() ?? 0 }}</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cake w-8 h-8"><path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"></path><path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"></path><path d="M2 21h20"></path><path d="M7 8v3"></path><path d="M12 8v3"></path><path d="M17 8v3"></path><path d="M7 4h.01"></path><path d="M12 4h.01"></path><path d="M17 4h.01"></path></svg>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-purple-400 to-indigo-400 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium mb-1">Kategori</p>
                        <p class="text-4xl font-bold">{{ count($categories ?? []) }}</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag w-8 h-8"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"></path><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle></svg>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-amber-400 to-orange-400 rounded-2xl p-6 text-white shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-sm font-medium mb-1">Sistem</p>
                        <p class="text-lg font-bold">Pre-Order Only</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart w-8 h-8"><circle cx="8" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Filter Section -->
        <div class="bg-white/90 backdrop-blur-xl rounded-2xl p-6 border-2 border-pink-100 shadow-xl">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-4 top-1/2 transform -translate-y-1/2 text-pink-400 w-5 h-5"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>
                    <input type="text" class="flex w-full px-3 py-1 text-base outline-none pl-12 h-12 bg-white border-2 border-pink-200 rounded-xl font-medium focus:border-pink-400" placeholder="Cari menu kue...">
                </div>
                <div class="relative w-full md:w-[200px]">
                    <select class="w-full h-12 bg-white border-2 border-pink-200 rounded-xl font-semibold px-4 appearance-none outline-none focus:border-pink-400 text-gray-700 cursor-pointer">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"><path d="m6 9 6 6 6-6"></path></svg>
                </div>
            </div>
        </div>

        <!-- 4. Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($products as $product)
                @php
                    $catColor = 'from-pink-400 to-rose-400'; 
                    $cat = strtolower($product->category);
                    if (str_contains($cat, 'black forest')) $catColor = 'from-gray-700 to-gray-900';
                    elseif (str_contains($cat, 'klapertart')) $catColor = 'from-orange-400 to-red-400';
                    elseif (str_contains($cat, 'lebaran') || str_contains($cat, 'nastar') || str_contains($cat, 'putri') || str_contains($cat, 'kastengel')) $catColor = 'from-yellow-400 to-amber-400';
                    elseif (str_contains($cat, 'jajanan') || str_contains($cat, 'bolu') || str_contains($cat, 'donat') || str_contains($cat, 'brownies') || str_contains($cat, 'lemper')) $catColor = 'from-green-400 to-emerald-400';
                    elseif (str_contains($cat, 'dessert') || str_contains($cat, 'tiramisu')) $catColor = 'from-purple-400 to-pink-400';
                @endphp
                <div class="group bg-white/95 backdrop-blur-sm rounded-2xl border-2 border-pink-100 hover:border-pink-300 shadow-lg hover:shadow-2xl transition-all overflow-hidden flex flex-col">
                    <div class="bg-gradient-to-r {{ $catColor }} p-4 text-white">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs w-fit whitespace-nowrap shrink-0 bg-white/20 text-white border-white/30 font-semibold backdrop-blur-sm">
                                {{ $product->category }}
                            </span>
                            <span class="inline-flex items-center justify-center rounded-md border text-xs w-fit whitespace-nowrap shrink-0 bg-amber-400 text-amber-900 border-amber-500 font-bold px-3 py-1">
                                Pre-Order
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="mb-4 flex-1">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-pink-600 transition-colors">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 line-clamp-2">Kue lezat spesial dari Alva Cake dibuat secara pre-order.</p>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Harga</p>
                                <p class="text-2xl font-bold bg-gradient-to-r from-pink-600 to-fuchsia-600 bg-clip-text text-transparent">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-br from-pink-100 to-fuchsia-100 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cake w-6 h-6 text-pink-500"><path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"></path><path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"></path><path d="M2 21h20"></path><path d="M7 8v3"></path><path d="M12 8v3"></path><path d="M17 8v3"></path><path d="M7 4h.01"></path><path d="M12 4h.01"></path><path d="M17 4h.01"></path></svg>
                            </div>
                        </div>
                        <div class="flex gap-2 pt-4 border-t border-pink-100">
                            <button type="button" onclick="openEditModal({{ json_encode($product) }})" class="inline-flex items-center justify-center whitespace-nowrap text-sm transition-all h-8 px-3 flex-1 border border-pink-200 text-pink-700 hover:bg-pink-50 rounded-xl font-semibold outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil w-4 h-4 mr-1"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"></path><path d="m15 5 4 4"></path></svg>
                                Edit
                            </button>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-1 m-0 flex" onsubmit="return confirm('Yakin ingin menghapus kue ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap text-sm transition-all h-8 px-3 w-full border border-red-200 text-red-700 hover:bg-red-50 rounded-xl font-semibold outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4 mr-1"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <p class="text-gray-400 text-lg font-medium">Belum ada data menu kue.</p>
                </div>
            @endforelse
        </div>

        <div class="mb-8">
            {{ $products->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div id="addModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm p-4 sm:p-0">
    <div class="relative w-full max-w-[600px] bg-white/95 backdrop-blur-xl rounded-3xl border-2 border-pink-200/50 shadow-2xl p-6 mx-auto sm:my-8">
        <div class="flex flex-col gap-2 text-center sm:text-left">
            <div class="flex items-center gap-3 pb-2">
                <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-fuchsia-400 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cake w-6 h-6 text-white"><path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"></path><path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"></path><path d="M2 21h20"></path><path d="M7 8v3"></path><path d="M12 8v3"></path><path d="M17 8v3"></path><path d="M7 4h.01"></path><path d="M12 4h.01"></path><path d="M17 4h.01"></path></svg>
                </div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-pink-600 to-fuchsia-600 bg-clip-text text-transparent">Tambah Menu Baru</h2>
            </div>
        </div>
        <form action="{{ route('products.store') }}" method="POST" class="space-y-5 pt-4">
            @csrf
            <div class="space-y-3 p-5 bg-gradient-to-br from-pink-50 to-fuchsia-50 rounded-2xl border border-pink-100">
                <label class="flex items-center gap-2 text-sm font-semibold text-pink-900" for="name">Nama Kue</label>
                <input class="flex w-full min-w-0 border px-3 py-1 text-base transition-[color,box-shadow] outline-none bg-white border-pink-200 rounded-xl h-12 focus:border-pink-500 focus:ring-2 focus:ring-pink-200" id="name" name="name" required placeholder="Contoh: Nastar Premium, Black Forest, dll">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-3 p-5 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl border border-purple-100">
                    <label class="flex items-center gap-2 text-sm font-semibold text-purple-900" for="category">Kategori</label>
                    <div class="relative">
                        <select id="category" name="category" required class="flex w-full items-center justify-between gap-2 border px-3 py-2 text-sm whitespace-nowrap transition-[color,box-shadow] outline-none bg-white border-purple-200 rounded-xl h-12 appearance-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 cursor-pointer">
                            <option value="">Pilih kategori...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-purple-400 pointer-events-none"><path d="m6 9 6 6 6-6"></path></svg>
                    </div>
                </div>
                <div class="space-y-3 p-5 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-100">
                    <label class="flex items-center gap-2 text-sm font-semibold text-green-900" for="price">Harga (Rp)</label>
                    <input type="number" id="price" name="price" required class="flex w-full min-w-0 border px-3 py-1 transition-[color,box-shadow] outline-none bg-white border-green-200 rounded-xl h-12 text-lg font-semibold focus:border-green-500 focus:ring-2 focus:ring-green-200" placeholder="0" min="0">
                </div>
            </div>
            <div class="space-y-3 p-5 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-100">
                <label class="flex items-center gap-2 text-sm font-semibold text-blue-900" for="description">Deskripsi Produk (Opsional)</label>
                <textarea class="flex min-h-16 w-full border px-3 py-2 text-base transition-[color,box-shadow] outline-none bg-white border-blue-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200" id="description" name="description" placeholder="Deskripsi singkat tentang kue ini..." rows="2"></textarea>
            </div>
            <div class="flex gap-3 pt-2">
                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl transition-all text-white px-4 py-2 flex-1 bg-gradient-to-r from-pink-500 to-fuchsia-500 hover:from-pink-600 hover:to-fuchsia-600 h-12 text-base font-semibold shadow-xl" type="submit">Simpan Menu</button>
                <button onclick="closeAddModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm transition-all text-pink-700 hover:text-pink-900 px-4 py-2 flex-1 h-12 border-2 border-pink-200 hover:bg-pink-50 font-semibold" type="button">Batal</button>
            </div>
        </form>
        <button type="button" onclick="closeAddModal()" class="absolute top-6 right-6 opacity-70 transition-opacity hover:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
            <span class="sr-only">Close</span>
        </button>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm p-4 sm:p-0">
    <div class="relative w-full max-w-[600px] bg-white/95 backdrop-blur-xl rounded-3xl border-2 border-pink-200/50 shadow-2xl p-6 mx-auto sm:my-8">
        <div class="flex flex-col gap-2 text-center sm:text-left">
            <div class="flex items-center gap-3 pb-2">
                <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-fuchsia-400 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil w-6 h-6 text-white"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"></path><path d="m15 5 4 4"></path></svg>
                </div>
                <h2 class="text-2xl font-bold bg-gradient-to-r from-pink-600 to-fuchsia-600 bg-clip-text text-transparent">Edit Menu Kue</h2>
            </div>
        </div>
        <form id="editForm" action="" method="POST" class="space-y-5 pt-4">
            @csrf @method('PUT')
            <div class="space-y-3 p-5 bg-gradient-to-br from-pink-50 to-fuchsia-50 rounded-2xl border border-pink-100">
                <label class="flex items-center gap-2 text-sm font-semibold text-pink-900" for="edit_name">Nama Kue</label>
                <input class="flex w-full min-w-0 border px-3 py-1 text-base transition-[color,box-shadow] outline-none bg-white border-pink-200 rounded-xl h-12 focus:border-pink-500 focus:ring-2 focus:ring-pink-200" id="edit_name" name="name" required placeholder="Contoh: Nastar Premium, Black Forest, dll">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-3 p-5 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl border border-purple-100">
                    <label class="flex items-center gap-2 text-sm font-semibold text-purple-900" for="edit_category">Kategori</label>
                    <div class="relative">
                        <select id="edit_category" name="category" required class="flex w-full items-center justify-between gap-2 border px-3 py-2 text-sm whitespace-nowrap transition-[color,box-shadow] outline-none bg-white border-purple-200 rounded-xl h-12 appearance-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 cursor-pointer">
                            <option value="">Pilih kategori...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-purple-400 pointer-events-none"><path d="m6 9 6 6 6-6"></path></svg>
                    </div>
                </div>
                <div class="space-y-3 p-5 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border border-green-100">
                    <label class="flex items-center gap-2 text-sm font-semibold text-green-900" for="edit_price">Harga (Rp)</label>
                    <input type="number" id="edit_price" name="price" required class="flex w-full min-w-0 border px-3 py-1 transition-[color,box-shadow] outline-none bg-white border-green-200 rounded-xl h-12 text-lg font-semibold focus:border-green-500 focus:ring-2 focus:ring-green-200" placeholder="0" min="0">
                </div>
            </div>
            <div class="space-y-3 p-5 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-100">
                <label class="flex items-center gap-2 text-sm font-semibold text-blue-900" for="edit_description">Deskripsi Produk (Opsional)</label>
                <textarea class="flex min-h-16 w-full border px-3 py-2 text-base transition-[color,box-shadow] outline-none bg-white border-blue-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200" id="edit_description" name="description" placeholder="Deskripsi singkat tentang kue ini..." rows="2"></textarea>
            </div>
            <div class="flex gap-3 pt-2">
                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl transition-all text-white px-4 py-2 flex-1 bg-gradient-to-r from-pink-500 to-fuchsia-500 hover:from-pink-600 hover:to-fuchsia-600 h-12 text-base font-semibold shadow-xl" type="submit">Simpan Perubahan</button>
                <button onclick="closeEditModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm transition-all text-pink-700 hover:text-pink-900 px-4 py-2 flex-1 h-12 border-2 border-pink-200 hover:bg-pink-50 font-semibold" type="button">Batal</button>
            </div>
        </form>
        <button type="button" onclick="closeEditModal()" class="absolute top-6 right-6 opacity-70 transition-opacity hover:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
            <span class="sr-only">Close</span>
        </button>
    </div>
</div>

<script>
    function openAddModal() { document.getElementById('addModal').classList.remove('hidden'); }
    function closeAddModal() { document.getElementById('addModal').classList.add('hidden'); }
    function openEditModal(product) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editForm').action = `/products/${product.id}`;
        document.getElementById('edit_name').value = product.name;
        document.getElementById('edit_category').value = product.category;
        document.getElementById('edit_price').value = product.price;
    }
    function closeEditModal() { document.getElementById('editModal').classList.add('hidden'); }
</script>
@endsection
