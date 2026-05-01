<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru - Alva Cake</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex h-screen overflow-hidden font-sans text-gray-800 bg-gray-50">

    <aside class="z-10 flex flex-col w-64 h-full bg-white shadow-md">
        <div class="p-6 text-2xl font-bold text-indigo-600 border-b">🍰 Alva Cake</div>
        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <a href="/" class="block px-4 py-2 text-gray-500 transition rounded-lg hover:bg-gray-100">Dashboard</a>
            <a href="/products" class="block px-4 py-2 font-semibold text-indigo-700 transition rounded-lg bg-indigo-50">📦 Kelola Produk</a>
            <a href="#" class="block px-4 py-2 text-gray-500 transition rounded-lg hover:bg-gray-100">🌾 Stok Bahan</a>
            <a href="#" class="block px-4 py-2 text-gray-500 transition rounded-lg hover:bg-gray-100">🛒 Kasir (POS)</a>
            <a href="#" class="block px-4 py-2 text-gray-500 transition rounded-lg hover:bg-gray-100">📄 Laporan</a>
        </nav>
    </aside>

    <main class="flex-1 h-full p-8 overflow-y-auto">

        <header class="flex items-center gap-4 mb-8">
            <a href="/products" class="text-2xl font-bold text-gray-400 transition hover:text-gray-600">&larr;</a>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tambah Produk Kue</h1>
                <p class="mt-1 text-gray-500">Masukkan detail kue dan atur resep/kebutuhan bahan bakunya.</p>
            </div>
        </header>

        <form action="{{ route('products.store') }}" method="POST" class="max-w-4xl p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
            @csrf <h2 class="pb-2 mb-6 text-xl font-semibold border-b">1. Informasi Dasar</h2>

            <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nama Kue</label>
                    <input type="text" name="name" required placeholder="Contoh: Red Velvet Cake"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 border p-2.5">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Harga Jual (Rp)</label>
                    <input type="number" name="price" required placeholder="Contoh: 85000" min="0"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50 border p-2.5">
                </div>
            </div>

            <h2 class="flex items-center justify-between pb-2 mb-4 text-xl font-semibold border-b">
                <span>2. Komposisi Resep (BOM)</span>
                <button type="button" id="btn-tambah-bahan" class="text-sm bg-indigo-100 text-indigo-700 px-3 py-1.5 rounded-lg hover:bg-indigo-200 transition font-medium">
                    + Tambah Bahan
                </button>
            </h2>

            <div id="recipe-container" class="mb-8 space-y-4">
                <div class="flex items-end gap-4 recipe-row">
                    <div class="flex-1">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Pilih Bahan Baku</label>
                        <select name="materials[]" required class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-50 border p-2.5">
                            <option value="">-- Pilih Bahan --</option>
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}">{{ $material->name }} ({{ $material->unit }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-1/3">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Takaran</label>
                        <input type="number" name="quantities[]" step="0.01" min="0" required placeholder="Jumlah"
                            class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-50 border p-2.5">
                    </div>
                    <div class="w-12 pb-2 text-center">
                        <button type="button" class="font-bold text-red-500 opacity-50 cursor-not-allowed hover:text-red-700 btn-hapus-bahan" disabled>&times;</button>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t">
                <a href="/products" class="px-5 py-2.5 border rounded-lg text-gray-600 hover:bg-gray-50 transition font-medium">Batal</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg shadow-sm transition font-medium">Simpan Produk</button>
            </div>
        </form>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnTambah = document.getElementById('btn-tambah-bahan');
            const container = document.getElementById('recipe-container');

            // Ambil struktur HTML dari baris pertama sebagai template
            const templateRow = container.querySelector('.recipe-row').cloneNode(true);

            // Aktifkan tombol silang (hapus) di template
            const btnHapusTemplate = templateRow.querySelector('.btn-hapus-bahan');
            btnHapusTemplate.disabled = false;
            btnHapusTemplate.classList.remove('cursor-not-allowed', 'opacity-50');

            btnTambah.addEventListener('click', function() {
                // Gandakan template
                const newRow = templateRow.cloneNode(true);

                // Kosongkan nilainya
                newRow.querySelector('select').value = '';
                newRow.querySelector('input').value = '';

                // Tambahkan event hapus ke tombol silang
                newRow.querySelector('.btn-hapus-bahan').addEventListener('click', function() {
                    newRow.remove();
                });

                // Masukkan ke layar
                container.appendChild(newRow);
            });
        });
    </script>
</body>
</html>
