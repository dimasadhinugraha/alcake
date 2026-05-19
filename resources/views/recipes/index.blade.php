@extends('layouts.app')

@section('title', 'Resep Master - Alva Cake')

@section('content')
<div class="p-8 bg-[#FFFBFD] min-h-full font-sans relative space-y-8">

    @if(session('success'))
    <div class="bg-green-50 text-green-700 p-4 rounded-2xl font-bold border border-green-100 flex items-center gap-3 shadow-sm">
        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>✨ {{ session('success') }}</span>
    </div>
    @endif

   <div class="max-w-7xl mx-auto px-8 py-6"><div class="space-y-8"><div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-amber-100 via-yellow-100 to-orange-50 p-8 shadow-xl border border-amber-200/50"><div class="absolute top-0 right-0 w-64 h-64 bg-amber-200/30 rounded-full blur-3xl"></div><div class="absolute bottom-0 left-0 w-48 h-48 bg-orange-200/30 rounded-full blur-3xl"></div><div class="relative flex items-center justify-between"><div class="flex items-center gap-4"><div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-orange-400 rounded-2xl flex items-center justify-center shadow-lg transform rotate-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chef-hat w-8 h-8 text-white"><path d="M17 21a1 1 0 0 0 1-1v-5.35c0-.457.316-.844.727-1.041a4 4 0 0 0-2.134-7.589 5 5 0 0 0-9.186 0 4 4 0 0 0-2.134 7.588c.411.198.727.585.727 1.041V20a1 1 0 0 0 1 1Z"></path><path d="M6 17h12"></path></svg></div><div><h1 class="text-4xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">Resep Master Kue</h1><p class="text-amber-600 mt-1 flex items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-4 h-4"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>Koleksi resep rahasia untuk kue terbaik</p></div></div><button onclick="openModal('create')" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive hover:bg-primary/90 h-9 has-[&gt;svg]:px-3 bg-gradient-to-r from-amber-400 to-orange-400 hover:from-amber-500 hover:to-orange-500 text-white shadow-2xl rounded-2xl px-6 py-6 transform hover:scale-105 transition-all"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-5 h-5 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg><span class="font-semibold">Buat Resep Baru</span></button></div></div><div class="grid grid-cols-1 md:grid-cols-3 gap-6"><div class="bg-gradient-to-br from-amber-400 to-orange-400 rounded-2xl p-6 text-white shadow-xl"><div class="flex items-center justify-between"><div><p class="text-amber-100 text-sm font-medium mb-1">Total Resep</p><p class="text-4xl font-bold">{{ count($recipes) }}</p></div><div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chef-hat w-8 h-8"><path d="M17 21a1 1 0 0 0 1-1v-5.35c0-.457.316-.844.727-1.041a4 4 0 0 0-2.134-7.589 5 5 0 0 0-9.186 0 4 4 0 0 0-2.134 7.588c.411.198.727.585.727 1.041V20a1 1 0 0 0 1 1Z"></path><path d="M6 17h12"></path></svg></div></div></div><div class="bg-gradient-to-br from-rose-400 to-pink-400 rounded-2xl p-6 text-white shadow-xl"><div class="flex items-center justify-between"><div><p class="text-rose-100 text-sm font-medium mb-1">Bahan Digunakan</p><p class="text-4xl font-bold">{{ $availableMaterials->count() }}</p></div><div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cooking-pot w-8 h-8"><path d="M2 12h20"></path><path d="M20 12v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8"></path><path d="m4 8 16-4"></path><path d="m8.86 6.78-.45-1.81a2 2 0 0 1 1.45-2.43l1.94-.48a2 2 0 0 1 2.43 1.46l.45 1.8"></path></svg></div></div></div><div class="bg-gradient-to-br from-orange-400 to-amber-400 rounded-2xl p-6 text-white shadow-xl"><div class="flex items-center justify-between"><div><p class="text-orange-100 text-sm font-medium mb-1">Produk Tersedia</p><p class="text-4xl font-bold">{{ count($availableProducts) }}</p></div><div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cake w-8 h-8"><path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"></path><path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"></path><path d="M2 21h20"></path><path d="M7 8v3"></path><path d="M12 8v3"></path><path d="M17 8v3"></path><path d="M7 4h.01"></path><path d="M12 4h.01"></path><path d="M17 4h.01"></path></svg></div></div></div></div><div><div class="grid grid-cols-1 md:grid-cols-2 gap-6">
@forelse($recipes as $recipe)
<div data-slot="card" class="text-card-foreground flex flex-col gap-6 border-2 border-amber-100 hover:border-amber-200 hover:shadow-2xl transition-all rounded-2xl overflow-hidden bg-white/95 backdrop-blur-sm">
<div data-slot="card-header" class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6 bg-gradient-to-r from-amber-100 via-orange-100 to-amber-100 border-b-2 border-amber-200">
<div class="flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-400 rounded-xl flex items-center justify-center">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chef-hat w-6 h-6 text-white"><path d="M17 21a1 1 0 0 0 1-1v-5.35c0-.457.316-.844.727-1.041a4 4 0 0 0-2.134-7.589 5 5 0 0 0-9.186 0 4 4 0 0 0-2.134 7.588c.411.198.727.585.727 1.041V20a1 1 0 0 0 1 1Z"></path><path d="M6 17h12"></path></svg>
</div>
                            <div>
                                <h4 data-slot="card-title" class="text-xl text-amber-900 font-extrabold">
                                    <span class="text-xs font-mono font-bold text-amber-600 bg-amber-50 px-2 py-0.5 border border-amber-200 rounded-md mr-1.5">{{ $recipe->formatted_id }}</span>{{ $recipe->product_name }}
                                </h4>
<p class="text-sm text-amber-600 mt-1 font-medium">{{ $recipe->ingredients->count() }} bahan baku</p>
</div>
</div>
<div class="flex gap-2">
<button onclick="openModal('edit', {{ json_encode(['id' => $recipe->id, 'product_name' => $recipe->product_name, 'ingredients' => $recipe->ingredients->toArray()]) }})" data-slot="button" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:hover:bg-accent/50 h-8 gap-1.5 px-3 has-[&gt;svg]:px-2.5 text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-xl">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen w-4 h-4"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path></svg>
</button>
<form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}" style="display:inline;" onsubmit="return confirm('Yakin hapus resep ini?');">
@csrf
@method('DELETE')
<button type="submit" data-slot="button" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:hover:bg-accent/50 h-8 gap-1.5 px-3 has-[&gt;svg]:px-2.5 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-xl">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 lucide-trash-2 w-4 h-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>
</button>
</form>
</div>
</div>
</div>
<div data-slot="card-content" class="px-6 [&:last-child]:pb-6 pt-6">
<div class="space-y-3">
<h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cooking-pot w-4 h-4 text-amber-500"><path d="M2 12h20"></path><path d="M20 12v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8"></path><path d="m4 8 16-4"></path><path d="m8.86 6.78-.45-1.81a2 2 0 0 1 1.45-2.43l1.94-.48a2 2 0 0 1 2.43 1.46l.45 1.8"></path></svg>Bahan yang Dibutuhkan:
</h4>
@forelse($recipe->ingredients as $ingredient)
<div class="flex items-center justify-between p-4 bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl hover:from-amber-100 hover:to-orange-100 transition-all border border-amber-100">
<div class="flex items-center gap-3">
<div class="w-2 h-2 rounded-full bg-gradient-to-r from-amber-400 to-orange-400"></div>
<span class="font-semibold text-gray-900">{{ $ingredient->name }}</span>
</div>
<span data-slot="badge" class="inline-flex items-center justify-center rounded-md w-fit whitespace-nowrap shrink-0 gap-1 transition-[color,box-shadow] overflow-hidden bg-gradient-to-r from-amber-100 to-orange-100 text-amber-900 border-2 border-amber-200 px-4 py-1 text-base font-bold">{{ $ingredient->qty }} {{ $ingredient->unit }}</span>
</div>
@empty
<p class="text-gray-500 text-sm">Belum ada bahan</p>
@endforelse
</div>
</div>
</div>
@empty
<div class="col-span-full">
<div class="p-12 text-center border-2 border-dashed border-amber-200 rounded-2xl bg-amber-50/50">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chef-hat w-16 h-16 mx-auto mb-3 text-amber-300"><path d="M17 21a1 1 0 0 0 1-1v-5.35c0-.457.316-.844.727-1.041a4 4 0 0 0-2.134-7.589 5 5 0 0 0-9.186 0 4 4 0 0 0-2.134 7.588c.411.198.727.585.727 1.041V20a1 1 0 0 0 1 1Z"></path><path d="M6 17h12"></path></svg>
<p class="text-amber-600 font-semibold">Belum ada resep</p>
<p class="text-amber-500 text-sm mt-1">Klik tombol "Buat Resep Baru" untuk mulai membuat resep</p>
</div>
</div>
@endforelse
</div></div>

<!-- Modal Tambah/Edit Resep -->
<div id="recipeModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
    <!-- Background overlay -->
    <div onclick="closeModal()" class="fixed inset-0 bg-black/50 transition-opacity" aria-hidden="true"></div>

    <!-- Modal content -->
    <div role="dialog" aria-labelledby="modalTitle" class="data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 fixed top-[50%] left-[50%] z-50 grid w-full translate-x-[-50%] translate-y-[-50%] gap-4 p-6 duration-200 sm:max-w-lg max-w-3xl max-h-[90vh] overflow-y-auto bg-white rounded-3xl border-2 border-amber-200/50 shadow-2xl" tabindex="-1" style="pointer-events: auto;">
      
      <div class="flex flex-col gap-2 text-center sm:text-left">
        <div class="flex items-center gap-3 pb-2">
          <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-400 rounded-xl flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chef-hat w-6 h-6 text-white"><path d="M17 21a1 1 0 0 0 1-1v-5.35c0-.457.316-.844.727-1.041a4 4 0 0 0-2.134-7.589 5 5 0 0 0-9.186 0 4 4 0 0 0-2.134 7.588c.411.198.727.585.727 1.041V20a1 1 0 0 0 1 1Z"></path><path d="M6 17h12"></path></svg>
          </div>
          <h2 id="modalTitle" class="text-2xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">Tambah Resep Baru</h2>
        </div>
      </div>

      <form id="recipeForm" method="POST" action="{{ route('recipes.store') }}" class="space-y-6 pt-4">
        @csrf
        <input type="hidden" id="methodField" name="_method" value="POST">

        <!-- Pilih Produk Kue -->
        <div class="p-5 bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border-2 border-amber-100 space-y-3">
          <h3 class="font-bold text-amber-900 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cake w-5 h-5"><path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"></path><path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"></path><path d="M2 21h20"></path><path d="M7 8v3"></path><path d="M12 8v3"></path><path d="M17 8v3"></path><path d="M7 4h.01"></path><path d="M12 4h.01"></path><path d="M17 4h.01"></path></svg>Pilih Produk Kue
          </h3>
          <div class="space-y-2">
            <label class="flex items-center gap-2 select-none text-sm font-semibold text-amber-800">Produk</label>
            <select id="product_name" name="product_name" required class="flex w-full items-center justify-between gap-2 px-3 py-2 text-sm whitespace-nowrap transition-[color,box-shadow] outline-none focus-visible:ring-[3px] bg-white border-2 border-amber-200 rounded-xl h-12 font-semibold focus:ring-2 focus:ring-amber-500">
              <option value="">Pilih produk kue...</option>
              @foreach($availableProducts as $product)
              <option value="{{ $product }}">{{ $product }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <!-- Tambah Bahan Baku -->
        <div class="p-5 bg-gradient-to-br from-rose-50 to-pink-50 rounded-2xl border-2 border-rose-100 space-y-3">
          <h3 class="font-bold text-rose-900 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cooking-pot w-5 h-5"><path d="M2 12h20"></path><path d="M20 12v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8"></path><path d="m4 8 16-4"></path><path d="m8.86 6.78-.45-1.81a2 2 0 0 1 1.45-2.43l1.94-.48a2 2 0 0 1 2.43 1.46l.45 1.8"></path></svg>Tambah Bahan Baku
          </h3>
          <div class="grid grid-cols-3 gap-3">
            <div class="col-span-2 space-y-2">
              <label class="flex items-center gap-2 select-none text-sm font-semibold text-rose-800">Pilih Bahan Baku</label>
              <select id="input_material" class="flex w-full items-center justify-between gap-2 px-3 py-2 text-sm whitespace-nowrap transition-[color,box-shadow] outline-none focus-visible:ring-[3px] bg-white border-2 border-rose-200 rounded-xl h-12 font-semibold focus:ring-2 focus:ring-rose-500">
                <option value="">Pilih bahan baku...</option>
                @foreach($availableMaterials as $material)
                <option value="{{ $material->name }}" data-unit="{{ $material->unit ?? 'kg' }}">{{ $material->name }} ({{ $material->unit ?? 'kg' }})</option>
                @endforeach
              </select>
            </div>
            <div class="space-y-2">
              <label class="flex items-center gap-2 select-none text-sm font-semibold text-rose-800">Jumlah</label>
              <input type="number" id="input_qty" step="0.01" min="0.01" placeholder="0" class="flex w-full min-w-0 px-3 py-1 transition-[color,box-shadow] outline-none focus-visible:ring-[3px] bg-white border-2 border-rose-200 rounded-xl h-12 text-lg font-semibold focus:ring-2 focus:ring-rose-500">
            </div>
          </div>
          <button type="button" onclick="addIngredient()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm transition-all w-full h-12 border-2 border-rose-300 hover:bg-rose-50 font-semibold text-rose-700">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>Tambah Bahan
          </button>
        </div>

        <!-- Daftar Bahan dalam Resep -->
        <div class="space-y-3">
          <h3 class="font-bold text-gray-900 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-5 h-5 text-amber-500"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>Daftar Bahan dalam Resep
          </h3>
          <div class="border-2 border-amber-100 rounded-2xl overflow-hidden bg-white">
            <div id="ingredients_list" class="relative w-full overflow-x-auto"></div>
          </div>
        </div>

        <!-- Tombol Simpan & Batal -->
        <div class="flex gap-3 pt-2">
          <button id="btnSubmit" type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md transition-all flex-1 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 h-12 text-base font-semibold shadow-xl text-white">Update Resep</button>
          <button type="button" onclick="closeModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm transition-all flex-1 h-12 border-2 border-amber-200 hover:bg-amber-50 font-semibold text-gray-700">Batal</button>
        </div>
      </form>

      <!-- Close button -->
      <button type="button" onclick="closeModal()" class="ring-offset-background focus:ring-ring absolute top-4 right-4 rounded-xs opacity-70 transition-opacity hover:opacity-100 focus:ring-2 focus:ring-offset-2 focus:outline-hidden disabled:pointer-events-none p-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-6 h-6 text-gray-400"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
        <span class="sr-only">Close</span>
      </button>
    </div>
  </div>
</div>

<script>
    let currentIngredients = [];

    function openModal(mode, recipeData = null) {
        document.getElementById('recipeModal').classList.remove('hidden');
        const form = document.getElementById('recipeForm');
        const title = document.getElementById('modalTitle');
        const methodField = document.getElementById('methodField');
        const btnSubmit = document.getElementById('btnSubmit');
        const productSelect = document.getElementById('product_name');

        if(mode === 'create') {
            title.innerText = 'Tambah Resep Baru';
            btnSubmit.innerText = 'Simpan Resep';
            methodField.value = 'POST';
            form.action = "{{ route('recipes.store') }}";
            productSelect.value = '';
            currentIngredients = [];
        }
        else if (mode === 'edit') {
            title.innerText = 'Edit Resep';
            btnSubmit.innerText = 'Update Resep';
            methodField.value = 'PUT';
            form.action = `/recipes/${recipeData.id}`;
            productSelect.value = recipeData.product_name;
            currentIngredients = [...recipeData.ingredients];
        }
        renderIngredients();
    }

    function closeModal() {
        document.getElementById('recipeModal').classList.add('hidden');
    }

    function addIngredient() {
        const select = document.getElementById('input_material');
        const qtyInput = document.getElementById('input_qty');

        if(!select.value || !qtyInput.value || qtyInput.value <= 0) {
            alert('Pilih bahan baku dan masukkan jumlah yang valid!');
            return;
        }

        const name = select.value;
        const unit = select.options[select.selectedIndex].getAttribute('data-unit') || 'kg';
        const qty = parseFloat(qtyInput.value);

        const existingIndex = currentIngredients.findIndex(item => item.name === name);
        if(existingIndex !== -1) {
            currentIngredients[existingIndex].qty += qty;
        } else {
            currentIngredients.push({ name, qty, unit });
        }

        select.value = '';
        qtyInput.value = '';
        renderIngredients();
    }

    function removeIngredient(index) {
        currentIngredients.splice(index, 1);
        renderIngredients();
    }

    function renderIngredients() {
        const listDiv = document.getElementById('ingredients_list');
        listDiv.innerHTML = '';

        if(currentIngredients.length === 0) {
            listDiv.innerHTML = `
                <div class="p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-16 h-16 mx-auto mb-3 text-amber-300"><path d="M2 12h20"></path><path d="M20 12v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8"></path><path d="m4 8 16-4"></path><path d="m8.86 6.78-.45-1.81a2 2 0 0 1 1.45-2.43l1.94-.48a2 2 0 0 1 2.43 1.46l.45 1.8"></path></svg>
                    <p class="text-amber-600 font-semibold">Belum ada bahan baku</p>
                    <p class="text-amber-500 text-sm mt-1">Tambahkan bahan untuk membuat resep</p>
                </div>
            `;
            return;
        }

        let tableHTML = `
            <table class="w-full caption-bottom text-sm">
                <thead class="[&_tr]:border-b">
                    <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors bg-gradient-to-r from-amber-50 to-orange-50">
                        <th class="h-10 px-2 text-left align-middle whitespace-nowrap font-bold text-amber-900">Bahan Baku</th>
                        <th class="h-10 px-2 text-left align-middle whitespace-nowrap font-bold text-amber-900">Jumlah</th>
                        <th class="h-10 px-2 text-left align-middle whitespace-nowrap font-bold text-amber-900">Satuan</th>
                        <th class="text-foreground h-10 px-2 text-left align-middle font-medium whitespace-nowrap"></th>
                    </tr>
                </thead>
                <tbody class="[&_tr:last-child]:border-0">
        `;

        currentIngredients.forEach((item, index) => {
            tableHTML += `
                <tr class="data-[state=selected]:bg-muted border-b transition-colors hover:bg-amber-50/50">
                    <td class="p-2 align-middle whitespace-nowrap font-semibold text-gray-900">${item.name}</td>
                    <td class="p-2 align-middle whitespace-nowrap text-lg font-bold text-amber-700">${item.qty}</td>
                    <td class="p-2 align-middle whitespace-nowrap">
                        <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 gap-1 bg-amber-100 text-amber-700 border-amber-200">${item.unit}</span>
                    </td>
                    <td class="p-2 align-middle whitespace-nowrap">
                        <button type="button" onclick="removeIngredient(${index})" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium transition-all h-8 rounded-md gap-1.5 px-3 text-red-600 hover:text-red-700 hover:bg-red-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>
                        </button>
                    </td>
                </tr>
                <input type="hidden" name="ingredients[${index}][name]" value="${item.name}">
                <input type="hidden" name="ingredients[${index}][qty]" value="${item.qty}">
                <input type="hidden" name="ingredients[${index}][unit]" value="${item.unit}">
            `;
        });

        tableHTML += `
                </tbody>
            </table>
        `;

        listDiv.innerHTML = tableHTML;
    }
</script>
@endsection
