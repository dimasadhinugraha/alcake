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

    <div class="bg-gradient-to-r from-[#FFB84C] to-[#F59E0B] rounded-[2rem] p-8 shadow-md flex justify-between items-center relative overflow-hidden">
        <div class="relative z-10 flex items-start gap-5">
            <div class="bg-white/20 w-14 h-14 rounded-2xl flex items-center justify-center text-white shadow-inner mt-1 backdrop-blur-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
            </div>
            <div>
                <h1 class="text-4xl font-extrabold text-white mb-2">Resep Master Kue</h1>
                <p class="text-orange-50 font-medium text-sm flex items-center gap-1.5">
                    ✨ Koleksi resep rahasia untuk kue terbaik
                </p>
            </div>
        </div>
        <button onclick="openModal('create')" class="relative z-10 bg-white hover:bg-orange-50 text-[#F59E0B] px-6 py-3 rounded-xl text-sm font-bold shadow-lg transition duration-300 flex items-center gap-2 cursor-pointer">
            <span class="text-lg leading-none">+</span> Buat Resep Baru
        </button>
        <div class="absolute -right-10 -top-10 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-[#F59E0B] rounded-[2rem] p-6 shadow-md flex justify-between items-center text-white">
            <div><p class="text-orange-100 text-sm font-bold mb-1">Total Resep</p><h3 class="text-5xl font-extrabold">{{ count($recipes) }}</h3></div>
            <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur-sm"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg></div>
        </div>
        <div class="bg-[#FF4B8B] rounded-[2rem] p-6 shadow-md flex justify-between items-center text-white">
            <div><p class="text-pink-100 text-sm font-bold mb-1">Bahan Digunakan</p><h3 class="text-5xl font-extrabold">7</h3></div>
            <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur-sm"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg></div>
        </div>
        <div class="bg-[#F59E0B] rounded-[2rem] p-6 shadow-md flex justify-between items-center text-white">
            <div><p class="text-orange-100 text-sm font-bold mb-1">Produk Tersedia</p><h3 class="text-5xl font-extrabold">16</h3></div>
            <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur-sm"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a2 2 0 01-2 2H5a2 2 0 01-2-2m18 0V9a2 2 0 00-2-2H5a2 2 0 00-2 2v6M12 5v4m-4-4v4m8-4v4" /></svg></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @foreach($recipes as $recipe)
        <div class="bg-white rounded-[2rem] shadow-sm border border-orange-100 overflow-hidden flex flex-col">
            <div class="bg-[#FFF9F5] p-6 border-b border-orange-100 flex justify-between items-start">
                <div class="flex items-center gap-4">
                    <div class="bg-[#F59E0B] w-12 h-12 rounded-xl flex items-center justify-center text-white shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-extrabold text-[#9A3412] mb-1">{{ $recipe->product_name }}</h2>
                        <p class="text-[#D97706] text-sm font-bold">{{ count($recipe->ingredients) }} bahan baku</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button onclick="openModal('edit', {{ json_encode($recipe) }})" class="w-9 h-9 rounded-lg border border-orange-200 text-orange-500 flex items-center justify-center hover:bg-orange-50 transition cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    </button>
                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus resep ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-9 h-9 rounded-lg border border-red-200 text-red-500 flex items-center justify-center hover:bg-red-50 transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="p-6 bg-white flex-1">
                <h3 class="text-sm font-extrabold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    Bahan yang Dibutuhkan:
                </h3>
                <div class="space-y-3">
                    @foreach($recipe->ingredients as $item)
                    <div class="flex justify-between items-center bg-[#FFFBF9] border border-orange-50 p-4 rounded-xl">
                        <p class="font-bold text-gray-700 flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span> {{ $item->name }}</p>
                        <p class="font-extrabold text-orange-600 bg-orange-100 px-3 py-1 rounded-md text-sm">{{ $item->qty }} {{ $item->unit }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div id="recipeModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900/50 backdrop-blur-sm py-10 transition-opacity">
    <div class="bg-white rounded-[2rem] w-full max-w-xl mx-4 shadow-2xl flex flex-col relative max-h-[95vh] overflow-hidden">

        <div class="px-8 pt-8 pb-4 shrink-0 flex justify-between items-center relative z-10 bg-white border-b border-gray-100">
            <div class="flex items-center gap-4">
                <div class="bg-[#F59E0B] w-12 h-12 rounded-2xl flex items-center justify-center text-white shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <h2 id="modalTitle" class="text-2xl font-extrabold text-[#D97706]">Tambah Resep Baru</h2>
            </div>
            <button onclick="closeModal()" class="w-8 h-8 rounded-full border border-gray-200 text-gray-400 hover:text-red-500 hover:border-red-200 hover:bg-red-50 flex items-center justify-center transition cursor-pointer">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <div class="p-8 pt-4 overflow-y-auto custom-scrollbar">
            <form id="recipeForm" action="" method="POST">
                @csrf
                <input type="hidden" id="methodField" name="_method" value="POST">

                <div class="bg-[#FFF9F5] border border-orange-100 rounded-2xl p-5 mb-6">
                    <h3 class="text-[#B45309] font-bold flex items-center gap-2 mb-4"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a2 2 0 01-2 2H5a2 2 0 01-2-2m18 0V9a2 2 0 00-2-2H5a2 2 0 00-2 2v6M12 5v4m-4-4v4m8-4v4" /></svg> Pilih Produk Kue</h3>
                    <label class="block text-xs font-bold text-[#D97706] mb-1.5">Produk</label>
                    <div class="relative">
                        <select id="product_name" name="product_name" required class="w-full bg-white border border-orange-200 rounded-xl px-4 py-3.5 text-sm focus:ring-2 focus:ring-orange-300 outline-none appearance-none cursor-pointer font-medium text-gray-700 shadow-sm">
                            <option value="">Pilih produk kue...</option>
                            @foreach($availableProducts as $prod)
                                <option value="{{ $prod }}">{{ $prod }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-4 text-orange-400 pointer-events-none"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg></div>
                    </div>
                </div>

                <div class="bg-[#FFF0F6] border border-pink-100 rounded-2xl p-5 mb-6 shadow-sm">
                    <h3 class="text-[#D82A97] font-bold flex items-center gap-2 mb-4"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg> Tambah Bahan Baku</h3>

                    <div class="flex gap-3 items-end mb-4">
                        <div class="flex-1">
                            <label class="block text-xs font-bold text-[#C1126A] mb-1.5">Pilih Bahan Baku</label>
                            <div class="relative">
                                <select id="input_material" class="w-full bg-white border border-pink-200 rounded-xl pl-3 pr-8 py-3 text-sm focus:ring-2 focus:ring-pink-300 outline-none appearance-none font-medium text-gray-700">
                                    <option value="" data-unit="">Pilih bahan baku...</option>
                                    @foreach($availableMaterials as $mat)
                                        <option value="{{ $mat->name }}" data-unit="{{ $mat->unit }}">{{ $mat->name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute right-3 top-3.5 text-pink-400 pointer-events-none"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg></div>
                            </div>
                        </div>
                        <div class="w-24">
                            <label class="block text-xs font-bold text-[#C1126A] mb-1.5">Jumlah</label>
                            <input type="number" id="input_qty" step="0.1" min="0.1" placeholder="0" class="w-full bg-white border border-pink-200 rounded-xl px-3 py-3 text-sm focus:ring-2 focus:ring-pink-300 outline-none font-bold text-center">
                        </div>
                    </div>
                    <button type="button" onclick="addIngredient()" class="w-full bg-white border border-pink-200 text-[#D82A97] hover:bg-pink-50 py-3 rounded-xl text-sm font-bold shadow-sm transition flex justify-center items-center gap-2 cursor-pointer">
                        <span class="text-lg leading-none">+</span> Tambah Bahan
                    </button>
                </div>

                <div class="mb-8">
                    <h3 class="text-[#D97706] font-bold flex items-center gap-2 mb-4">✨ Daftar Bahan dalam Resep</h3>

                    <div id="ingredients_container" class="bg-white border border-orange-100 rounded-2xl overflow-hidden shadow-sm">
                        <div class="bg-[#FFF9F5] px-4 py-3 flex text-xs font-bold text-[#B45309] border-b border-orange-100">
                            <div class="flex-1">Bahan Baku</div>
                            <div class="w-16 text-center">Jumlah</div>
                            <div class="w-16 text-center">Satuan</div>
                            <div class="w-10"></div> </div>

                        <div id="ingredients_list" class="divide-y divide-gray-50">
                            <div class="p-8 text-center" id="empty_state">
                                <svg class="w-12 h-12 text-orange-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                <p class="text-[#D97706] font-bold">Belum ada bahan baku</p>
                                <p class="text-orange-400 text-xs">Tambahkan bahan untuk membuat resep</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" id="btnSubmit" class="flex-1 bg-gradient-to-r from-[#F59E0B] to-[#F97316] hover:opacity-90 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-orange-200 transition cursor-pointer">
                        Simpan Resep
                    </button>
                    <button type="button" onclick="closeModal()" class="flex-1 bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 font-bold py-3.5 rounded-xl transition cursor-pointer">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let currentIngredients = [];

    // --- FUNGSI BUKA MODAL (Buat Baru ATAU Edit) ---
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

            // Reset form
            productSelect.value = '';
            currentIngredients = [];
        }
        else if (mode === 'edit') {
            title.innerText = 'Edit Resep';
            btnSubmit.innerText = 'Update Resep';
            methodField.value = 'PUT';
            form.action = `/recipes/${recipeData.id}`; // Arahin ke route update

            // Isi data resep yang diklik
            productSelect.value = recipeData.product_name;
            currentIngredients = [...recipeData.ingredients]; // Copy array bahannya
        }

        renderIngredients(); // Gambar list bahannya
    }

    function closeModal() {
        document.getElementById('recipeModal').classList.add('hidden');
    }

    // --- FUNGSI TAMBAH BAHAN KE LIST ARRAY ---
    function addIngredient() {
        const select = document.getElementById('input_material');
        const qtyInput = document.getElementById('input_qty');

        if(!select.value || !qtyInput.value || qtyInput.value <= 0) {
            alert('Pilih bahan baku dan masukkan jumlah yang valid!');
            return;
        }

        const name = select.value;
        const unit = select.options[select.selectedIndex].getAttribute('data-unit');
        const qty = parseFloat(qtyInput.value);

        // Cek kalau bahannya udah ada, tambahin aja qty-nya biar ga dobel
        const existingIndex = currentIngredients.findIndex(item => item.name === name);
        if(existingIndex !== -1) {
            currentIngredients[existingIndex].qty += qty;
        } else {
            currentIngredients.push({ name, qty, unit });
        }

        // Reset inputan
        select.value = '';
        qtyInput.value = '';

        renderIngredients(); // Gambar ulang listnya
    }

    // --- FUNGSI HAPUS BAHAN DARI LIST ARRAY ---
    function removeIngredient(index) {
        currentIngredients.splice(index, 1);
        renderIngredients();
    }

    // --- FUNGSI GAMBAR LIST & BIKIN INPUT HIDDEN ---
    function renderIngredients() {
        const listDiv = document.getElementById('ingredients_list');
        listDiv.innerHTML = ''; // Bersihin dulu

        if(currentIngredients.length === 0) {
            // Kalau kosong, tampilin gambar panci
            listDiv.innerHTML = `
                <div class="p-8 text-center">
                    <svg class="w-12 h-12 text-orange-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                    <p class="text-[#D97706] font-bold">Belum ada bahan baku</p>
                    <p class="text-orange-400 text-xs">Tambahkan bahan untuk membuat resep</p>
                </div>
            `;
            return;
        }

        // Kalau ada isinya, looping array-nya dan bikin baris HTML
        currentIngredients.forEach((item, index) => {
            listDiv.innerHTML += `
                <div class="px-4 py-3 flex items-center text-sm font-bold text-gray-700 bg-white">
                    <div class="flex-1">${item.name}</div>
                    <div class="w-16 text-center text-[#D97706]">${item.qty}</div>
                    <div class="w-16 text-center text-orange-400 text-xs bg-orange-50 rounded px-1 py-0.5 mx-1">${item.unit}</div>
                    <div class="w-10 text-right">
                        <button type="button" onclick="removeIngredient(${index})" class="text-red-400 hover:text-red-600 p-1.5 hover:bg-red-50 rounded-md transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </div>

                    <input type="hidden" name="ingredients[${index}][name]" value="${item.name}">
                    <input type="hidden" name="ingredients[${index}][qty]" value="${item.qty}">
                    <input type="hidden" name="ingredients[${index}][unit]" value="${item.unit}">
                </div>
            `;
        });
    }
</script>
@endsection
