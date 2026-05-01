@extends('layouts.app')

@section('title', 'Stok Bahan Baku - Alva Cake')

@section('content')
<div class="p-8 bg-[#FFFBFD] min-h-full font-sans relative space-y-8">

@if(session('success'))
    <div class="bg-green-50 text-green-700 p-4 rounded-2xl font-bold border border-green-100 flex items-center gap-3 shadow-sm mb-4">
        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>✨ {{ session('success') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 text-red-700 p-4 rounded-2xl font-bold border border-red-100 flex items-center gap-3 shadow-sm mb-4">
        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        <div>
            @foreach($errors->all() as $error)
                <p>🚨 {{ $error }}</p>
            @endforeach
        </div>
    </div>
    @endif

    <div class="bg-[#FFF0F6] rounded-[2rem] p-8 shadow-sm flex justify-between items-center relative overflow-hidden border border-[#FFE4EF]">
        <div class="relative z-10 flex items-start gap-5">
            <div class="bg-[#FF4B8B] w-14 h-14 rounded-2xl flex items-center justify-center text-white shadow-md mt-1">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
            </div>
            <div>
                <h1 class="text-4xl font-extrabold text-[#D82A97] mb-2">Stok Bahan Baku</h1>
                <p class="text-gray-500 font-medium text-sm mb-3">Kelola stok bahan baku untuk<br>produksi kue</p>
                <div class="inline-flex items-center gap-1.5 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                    Sinkron dengan Order Management
                </div>
            </div>
        </div>
        <div class="relative z-10 flex gap-3">
            <button onclick="openAddStockModal()" class="bg-[#10B981] hover:bg-[#059669] text-white px-5 py-3 rounded-xl text-sm font-bold shadow-md shadow-green-200 transition duration-300 flex items-center gap-2 cursor-pointer">
                <span class="text-lg leading-none">+</span> Tambah Stok
            </button>
            <button onclick="openNewMaterialModal()" class="bg-[#FF4B8B] hover:bg-[#E11D48] text-white px-5 py-3 rounded-xl text-sm font-bold shadow-md shadow-pink-200 transition duration-300 flex items-center gap-2 cursor-pointer">
                <span class="text-lg leading-none">+</span> Tambah Bahan Baku Baru
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-[#10B981] rounded-[2rem] p-6 shadow-md flex justify-between items-center text-white">
            <div><p class="text-green-100 text-sm font-bold mb-1">Stok Aman</p><h3 class="text-5xl font-extrabold">{{ $stokAman ?? 0 }}</h3></div>
            <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur-sm"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg></div>
        </div>
        <div class="bg-[#F59E0B] rounded-[2rem] p-6 shadow-md flex justify-between items-center text-white">
            <div><p class="text-orange-100 text-sm font-bold mb-1">Stok Rendah</p><h3 class="text-5xl font-extrabold">{{ $stokRendah ?? 0 }}</h3></div>
            <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur-sm"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" /></svg></div>
        </div>
        <div class="bg-[#FF4B8B] rounded-[2rem] p-6 shadow-md flex justify-between items-center text-white">
            <div><p class="text-pink-100 text-sm font-bold mb-1">Total Bahan</p><h3 class="text-5xl font-extrabold">{{ $totalBahan ?? 0 }}</h3></div>
            <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur-sm"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg></div>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-pink-100 overflow-hidden">
        <div class="bg-[#FFF0F6] p-6 flex items-center gap-3 border-b border-pink-100">
            <div class="bg-[#FF4B8B] w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-sm"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg></div>
            <h2 class="text-xl font-bold text-[#80153B]">Stok Bahan Baku Saat Ini</h2>
        </div>
        <div class="overflow-x-auto p-2">
            <table class="w-full text-center border-collapse">
                <thead>
                    <tr class="text-[#D82A97] text-xs font-extrabold tracking-wider border-b-2 border-pink-50">
                        <th class="py-5 text-left pl-6">NAMA BAHAN</th><th class="py-5">STOK SAAT INI</th><th class="py-5">SATUAN</th><th class="py-5">STOK MINIMAL</th><th class="py-5">STOK MAKSIMAL</th><th class="py-5 pr-6">STATUS</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700 font-bold">
                    @forelse($materials ?? [] as $mat)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/30 transition">
                        <td class="py-5 text-left pl-6 flex items-center gap-3"><div class="w-2 h-2 rounded-full bg-blue-500"></div>{{ $mat->name }}</td>
                        <td class="py-5 text-gray-900 text-base">{{ $mat->stock }}</td>
                        <td class="py-5 text-[#D82A97]">{{ $mat->unit }}</td>
                        <td class="py-5 text-orange-500 flex items-center justify-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" /></svg> {{ $mat->min_stock }} {{ $mat->unit }}</td>
                        <td class="py-5 text-green-500"><div class="flex items-center justify-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg> {{ $mat->max_stock ?? '-' }} {{ $mat->unit }}</div></td>
                        <td class="py-5 pr-6">
                            @if($mat->status == 'Stok Rendah')
                                <span class="border border-red-200 text-red-600 bg-red-50 px-3 py-1 rounded-md text-xs">{{ $mat->status }}</span>
                            @else
                                <span class="border border-blue-200 text-blue-600 bg-blue-50 px-3 py-1 rounded-md text-xs">{{ $mat->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="py-8 text-gray-400">Belum ada data stok bahan baku.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-purple-100 overflow-hidden">
        <div class="bg-[#F5F0FF] p-6 border-b border-purple-100">
            <div class="flex items-center gap-3 mb-5">
                <div class="bg-[#A72BEE] w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-sm"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg></div>
                <h2 class="text-xl font-bold text-[#4C1D95]">Riwayat Stok Masuk</h2>
            </div>
            <div class="flex flex-col md:flex-row items-center gap-4">
                <div class="flex items-center gap-2 bg-white px-4 py-2.5 rounded-xl border border-purple-100 flex-1 w-full"><span class="text-[#D82A97] font-bold text-sm">🔍 Dari:</span><input type="date" class="outline-none text-sm font-medium w-full text-gray-600"></div>
                <div class="flex items-center gap-2 bg-white px-4 py-2.5 rounded-xl border border-purple-100 flex-1 w-full"><span class="text-[#D82A97] font-bold text-sm">🔍 Sampai:</span><input type="date" class="outline-none text-sm font-medium w-full text-gray-600"></div>
                <button class="bg-white border border-purple-200 text-[#A72BEE] hover:bg-purple-50 px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 transition cursor-pointer"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg> Filter</button>
            </div>
        </div>
        <div class="overflow-x-auto p-2">
            <table class="w-full text-center border-collapse">
                <thead><tr class="text-[#D82A97] text-xs font-extrabold tracking-wider border-b-2 border-purple-50"><th class="py-5 text-left pl-6">TANGGAL</th><th class="py-5">WAKTU</th><th class="py-5">NAMA BAHAN</th><th class="py-5">JUMLAH MASUK</th><th class="py-5 text-left pr-6">KETERANGAN</th></tr></thead>
                <tbody class="text-sm font-bold">
                    @forelse($inboundHistory ?? [] as $in)
                    <tr class="border-b border-gray-50 hover:bg-purple-50/30 transition">
                        <td class="py-5 text-left pl-6 text-[#A72BEE] flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>{{ $in->date }}</td>
                        <td class="py-5 text-[#D82A97]">{{ $in->time }}</td><td class="py-5 text-[#80153B]">{{ $in->name }}</td>
                        <td class="py-5"><span class="bg-green-100 text-green-700 px-3 py-1.5 rounded-lg text-sm flex items-center justify-center gap-1 w-fit mx-auto"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 11l5-5m0 0l5 5m-5-5v12" /></svg> {{ $in->qty }}</span></td>
                        <td class="py-5 text-left text-gray-500 font-medium pr-6">{{ $in->notes }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="py-6 text-gray-400">Belum ada riwayat masuk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-orange-100 overflow-hidden">
        <div class="bg-[#FFF6F0] p-6 flex items-start gap-4 border-b border-orange-100">
            <div class="bg-[#FF523B] w-12 h-12 rounded-2xl flex items-center justify-center text-white shadow-sm mt-1"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" /></svg></div>
            <div>
                <h2 class="text-xl font-bold text-[#9A3412] mb-1">Riwayat Penggunaan Bahan Baku</h2>
                <p class="text-[#C2410C] font-medium text-sm flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Pengurangan stok dari pesanan produksi (Order Management)</p>
            </div>
        </div>
        <div class="overflow-x-auto p-2">
            <table class="w-full text-center border-collapse">
                <thead><tr class="text-[#9A3412] text-xs font-extrabold tracking-wider border-b-2 border-orange-50"><th class="py-5 text-left pl-6">TANGGAL</th><th class="py-5">WAKTU</th><th class="py-5">NAMA BAHAN</th><th class="py-5">JUMLAH KELUAR</th><th class="py-5 text-left pr-6">KETERANGAN</th></tr></thead>
                <tbody class="text-sm font-bold">
                    @forelse($outboundHistory ?? [] as $out)
                    <tr class="border-b border-gray-50 hover:bg-orange-50/30 transition">
                        <td class="py-5 text-left pl-6 text-[#C2410C] flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>{{ $out->date }}</td>
                        <td class="py-5 text-[#F59E0B]">{{ $out->time }}</td><td class="py-5 text-[#80153B]">{{ $out->name }}</td>
                        <td class="py-5"><span class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-sm flex items-center justify-center gap-1 w-fit mx-auto border border-red-100"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 13l-5 5m0 0l-5-5m5 5V6" /></svg> {{ $out->qty }}</span></td>
                        <td class="py-5 text-left pr-6">
                            <p class="text-gray-700 mb-1">{{ $out->notes }}</p>
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

    function openNewMaterialModal() { document.getElementById('newMaterialModal').classList.remove('hidden'); }
    function closeNewMaterialModal() { document.getElementById('newMaterialModal').classList.add('hidden'); }
</script>
@endsection
