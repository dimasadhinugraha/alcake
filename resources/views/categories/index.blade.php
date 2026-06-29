@extends('layouts.app')

@section('title', 'Kategori Kue - Alva Cake')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-8 py-6">
    <div class="space-y-8">
        <!-- 1. Premium Header Banner -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-pink-100 via-rose-100 to-pink-50 p-8 shadow-xl border border-pink-200/50">
            <div class="absolute top-0 right-0 w-64 h-64 bg-pink-200/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-rose-200/30 rounded-full blur-3xl"></div>
            <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-rose-400 rounded-2xl flex items-center justify-center shadow-lg transform rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag w-8 h-8 text-white"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"></path><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle></svg>
                    </div>
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent">Kategori Kue</h1>
                        <p class="text-pink-600 mt-2 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-4 h-4"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg>
                            Kelola kategori kue untuk penataan katalog menu
                        </p>
                    </div>
                </div>
                <button onclick="openAddModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50 h-9 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white shadow-2xl rounded-2xl px-6 py-6 transform hover:scale-105 transition-all w-full md:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-5 h-5 mr-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg><span class="font-semibold">Tambah Kategori Baru</span>
                </button>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-50 text-green-700 p-4 rounded-2xl font-bold border border-green-100 flex items-center gap-3 shadow-sm">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>✨ {{ session('success') }}</span>
        </div>
        @endif

        <!-- 2. Categories Table / Content Section -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl border-2 border-pink-100 overflow-hidden shadow-2xl">
            <div class="px-8 py-6 bg-gradient-to-r from-pink-100 via-rose-100 to-pink-100 border-b-2 border-pink-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-500 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag w-5 h-5 text-white"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"></path><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle></svg>
                    </div>
                    <h3 class="text-xl font-bold text-pink-900">Daftar Kategori Kue</h3>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-pink-50 via-rose-50 to-pink-50">
                        <tr>
                            <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">ID Kategori</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Nama Kategori</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-pink-900 uppercase tracking-wide">Jumlah Produk Kue</th>
                            <th class="px-8 py-5 text-right text-xs font-bold text-pink-900 uppercase tracking-wide">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-pink-100">
                        @forelse($categories as $cat)
                            <tr class="hover:bg-gradient-to-r hover:from-pink-50/50 hover:to-transparent transition-all group">
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span class="text-sm font-mono font-bold text-pink-600 bg-pink-50 px-2.5 py-1 rounded-lg border border-pink-100">{{ $cat->formatted_id }}</span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span class="text-base font-bold text-pink-900">{{ $cat->name }}</span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center justify-center rounded-md border px-2.5 py-1 text-xs font-bold bg-purple-100 text-purple-700 border-purple-200">
                                        {{ $cat->products_count }} Menu Kue
                                    </span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-right space-x-2">
                                    <button onclick='openEditModal(@json($cat))' class="inline-flex items-center justify-center whitespace-nowrap text-sm transition-all h-8 gap-1.5 px-3 border-2 border-purple-300 text-purple-700 hover:bg-purple-50 rounded-xl font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen w-4 h-4"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"></path></svg>Edit
                                    </button>
                                    <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kategori ini? Menu kue dengan kategori ini akan di-set menjadi Tanpa Kategori.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap text-sm transition-all h-8 gap-1.5 px-3 border-2 border-red-300 text-red-700 hover:bg-red-50 rounded-xl font-bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path><line x1="10" x2="10" y1="11" y2="17"></line><line x1="14" x2="14" y1="11" y2="17"></line></svg>Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-gray-500">Belum ada data kategori kue.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div id="addModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 animate-fade-in">
    <div onclick="closeAddModal()" class="absolute inset-0 bg-black/40 backdrop-blur-md transition-opacity z-0" aria-hidden="true"></div>
    <div role="dialog" class="relative w-full max-w-lg bg-white to-pink-50/30 rounded-[2rem] border-4 border-pink-200/50 shadow-2xl p-6 flex flex-col z-10 animate-scale-up" tabindex="-1">
        <div class="flex items-center gap-4 pb-3 border-b border-pink-100">
            <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag w-7 h-7 text-white"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"></path><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle></svg>
            </div>
            <h2 class="text-3xl font-extrabold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent" style="font-family: Outfit, sans-serif;">Tambah Kategori</h2>
        </div>

        <form class="space-y-6 pt-2" action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="space-y-3 p-5 bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl border border-pink-100 shadow-inner">
                <label class="flex items-center gap-2 text-sm font-semibold text-pink-900" for="name">Nama Kategori</label>
                <input type="text" id="name" name="name" required placeholder="Masukkan nama kategori (misal: Brownies)" class="bg-white border-2 border-pink-200 rounded-xl h-12 w-full px-3 py-1 text-base outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-200">
            </div>

            <div class="flex gap-3 pt-2">
                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl transition-all text-white px-4 py-2 flex-1 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 h-12 text-base font-semibold shadow-xl" type="submit">Tambah Kategori</button>
                <button onclick="closeAddModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm transition-all text-pink-700 hover:text-pink-900 px-4 py-2 flex-1 h-12 border-2 border-pink-200 hover:bg-pink-50 font-semibold" type="button">Batal</button>
            </div>
        </form>
        <button type="button" onclick="closeAddModal()" class="absolute top-6 right-6 opacity-70 transition-opacity hover:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
        </button>
    </div>
</div>

<!-- Modal Edit Kategori -->
<div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 animate-fade-in">
    <div onclick="closeEditModal()" class="absolute inset-0 bg-black/40 backdrop-blur-md transition-opacity z-0" aria-hidden="true"></div>
    <div role="dialog" class="relative w-full max-w-lg bg-gradient-to-br from-white to-pink-50/30 rounded-[2rem] border-4 border-pink-200/50 shadow-2xl p-6 flex flex-col z-10 animate-scale-up" tabindex="-1">
        <div class="flex items-center gap-4 pb-3 border-b border-pink-100">
            <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag w-7 h-7 text-white"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"></path><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle></svg>
            </div>
            <h2 class="text-3xl font-extrabold bg-gradient-to-r from-pink-600 to-rose-600 bg-clip-text text-transparent" style="font-family: Outfit, sans-serif;">Edit Kategori</h2>
        </div>

        <form id="editForm" class="space-y-6 pt-2" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-3 p-5 bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl border border-pink-100 shadow-inner">
                <label class="flex items-center gap-2 text-sm font-semibold text-pink-900" for="edit_name">Nama Kategori</label>
                <input type="text" id="edit_name" name="name" required placeholder="Masukkan nama kategori" class="bg-white border-2 border-pink-200 rounded-xl h-12 w-full px-3 py-1 text-base outline-none focus:border-pink-500 focus:ring-2 focus:ring-pink-200">
            </div>

            <div class="flex gap-3 pt-2">
                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl transition-all text-white px-4 py-2 flex-1 bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 h-12 text-base font-semibold shadow-xl" type="submit">Simpan Perubahan</button>
                <button onclick="closeEditModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-xl text-sm transition-all text-pink-700 hover:text-pink-900 px-4 py-2 flex-1 h-12 border-2 border-pink-200 hover:bg-pink-50 font-semibold" type="button">Batal</button>
            </div>
        </form>
        <button type="button" onclick="closeEditModal()" class="absolute top-6 right-6 opacity-70 transition-opacity hover:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
        </button>
    </div>
</div>

<script>
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        const mainEl = document.querySelector('main');
        if (mainEl) mainEl.style.overflow = 'hidden';
    }
    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
        document.body.style.overflow = '';
        const mainEl = document.querySelector('main');
        if (mainEl) mainEl.style.overflow = '';
    }
    function openEditModal(category) {
        document.getElementById('editModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        const mainEl = document.querySelector('main');
        if (mainEl) mainEl.style.overflow = 'hidden';
        
        document.getElementById('editForm').action = `/categories/${category.id}`;
        document.getElementById('edit_name').value = category.name;
    }
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.body.style.overflow = '';
        const mainEl = document.querySelector('main');
        if (mainEl) mainEl.style.overflow = '';
    }

    window.openAddModal = openAddModal;
    window.closeAddModal = closeAddModal;
    window.openEditModal = openEditModal;
    window.closeEditModal = closeEditModal;
</script>
@endsection
