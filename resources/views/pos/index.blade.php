@extends('layouts.app')

@section('title', 'Transaksi Penjualan - Alva Cake')

@section('content')
<div class="p-8 bg-[#FFFBFD] min-h-full relative overflow-hidden flex flex-col">
    <header class="flex justify-between items-end relative z-10 mb-8">
        <div>
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#A72BEE] to-[#D82A97] mb-2">
                Transaksi Penjualan
            </h1>
            <p class="text-gray-500 text-sm">Catat semua penjualan produk dan pesanan dengan DP</p>
        </div>
        <button onclick="openTransactionModal()" class="bg-gradient-to-r from-[#A72BEE] to-[#D82A97] text-white px-5 py-2.5 rounded-xl font-bold shadow-md hover:opacity-90 transition">
            + Transaksi Baru
        </button>
    </header>

    @if(session('success'))
    <div class="bg-green-50 text-green-600 p-4 rounded-2xl mb-6 relative z-10 font-medium border border-green-100">
        ✅ {{ session('success') }}
    </div>
    @endif
    @if($errors->any())
    <div class="bg-red-50 text-red-600 p-4 rounded-2xl mb-6 relative z-10 font-medium border border-red-100 flex items-center gap-2">
        <span>⚠️</span> {{ $errors->first() }}
    </div>
    @endif

    <div class="bg-gray-100/80 p-1.5 rounded-full inline-flex w-fit mb-8 relative z-10 shadow-inner border border-gray-200/50">
        <button onclick="filterTransactions('all', this)" class="filter-btn py-2 px-6 rounded-full text-sm transition-all duration-300 bg-white shadow-sm text-gray-800 font-bold whitespace-nowrap">
            Semua Transaksi
        </button>
        <button onclick="filterTransactions('penjualan_langsung', this)" class="filter-btn py-2 px-6 rounded-full text-sm transition-all duration-300 text-gray-500 hover:bg-gray-200/50 font-medium whitespace-nowrap">
            Lunas
        </button>
        <button onclick="filterTransactions('pesanan_dp', this)" class="filter-btn py-2 px-6 rounded-full text-sm transition-all duration-300 text-gray-500 hover:bg-gray-200/50 font-medium whitespace-nowrap">
            Pesanan DP
        </button>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 relative z-10 flex-1">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Semua Riwayat Transaksi</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-800 text-sm border-b-2 border-gray-50">
                        <th class="pb-4 font-bold pl-2">Tanggal & Waktu</th>
                        <th class="pb-4 font-bold">Pelanggan</th>
                        <th class="pb-4 font-bold">Detail Produk</th>
                        <th class="pb-4 font-bold">Total</th>
                        <th class="pb-4 font-bold text-center">Status</th>
                        <th class="pb-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="transaction-table-body" class="text-sm text-gray-600 font-medium">
                    @forelse($transactions as $transaction)
                    <tr class="transaction-row border-b border-gray-50 hover:bg-gray-50/50 transition" data-type="{{ $transaction->type }}">
                        <td class="py-4 pl-2">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-4 text-gray-800 font-semibold">{{ $transaction->customer_name ?: '-' }}</td>
                        <td class="py-4">
                            @foreach($transaction->details as $detail)
                                <p class="text-gray-800 font-semibold text-xs">{{ $detail->product->name }} (x{{ $detail->qty }})</p>
                            @endforeach
                        </td>
                        <td class="py-4 font-bold text-[#C1126A]">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        <td class="py-4 text-center">
                            @if($transaction->status == 'lunas')
                                <span class="bg-green-50 text-green-500 px-3 py-1 rounded text-xs font-bold">Lunas</span>
                            @else
                                <span class="bg-orange-50 text-orange-500 px-3 py-1 rounded text-xs font-bold">DP</span>
                            @endif
                        </td>
                        <td class="py-4 text-center">
                            @if($transaction->type == 'pesanan_dp' && $transaction->status != 'lunas')
                                <form action="{{ route('pos.lunas', $transaction->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" onclick="return confirm('Yakin ingin melunasi transaksi ini?')" class="px-4 py-1.5 rounded-lg border border-green-500 bg-white text-green-500 hover:bg-green-50 transition text-xs font-bold mx-auto cursor-pointer shadow-sm">
                                        Lunasi
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-gray-400">Belum ada transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="transactionModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900/40 backdrop-blur-sm transition-opacity py-10">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg mx-4 flex flex-col max-h-full">

        <div class="flex justify-between items-center p-6 border-b border-gray-100 shrink-0">
            <h2 class="text-xl font-bold text-gray-800">Buat Transaksi Baru</h2>
            <button onclick="closeTransactionModal()" class="text-gray-400 hover:text-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <form action="{{ route('pos.store') }}" method="POST" id="checkout-form" class="overflow-y-auto p-6 space-y-6 custom-scrollbar">
            @csrf

            <input type="hidden" name="cart_data" id="cart_data">

            <div>
                <h3 class="text-[#A72BEE] font-bold mb-3 text-sm">Jenis Pembayaran</h3>
                <div class="grid grid-cols-2 gap-4">
                    <label class="cursor-pointer">
                        <input type="radio" name="type" value="penjualan_langsung" class="peer hidden" checked onchange="togglePaymentFields()">
                        <div class="border-2 border-gray-100 rounded-2xl p-4 text-center peer-checked:border-[#A72BEE] peer-checked:bg-purple-50 transition">
                            <span class="font-bold text-gray-800 block text-sm">Lunas</span>
                            <span class="text-[10px] text-gray-400 block mt-0.5">Pembayaran penuh</span>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="type" value="pesanan_dp" class="peer hidden" onchange="togglePaymentFields()">
                        <div class="border-2 border-gray-100 rounded-2xl p-4 text-center peer-checked:border-[#D82A97] peer-checked:bg-pink-50 transition">
                            <span class="font-bold text-gray-800 block text-sm">DP / Pesanan</span>
                            <span class="text-[10px] text-gray-400 block mt-0.5">Pembayaran sebagian</span>
                        </div>
                    </label>
                </div>
            </div>

            <div id="dp_fields" class="hidden bg-[#FFF9FA] p-4 rounded-2xl border border-pink-100 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Nama Pelanggan</label>
                    <input type="text" name="customer_name" placeholder="Nama pelanggan..." class="w-full bg-white border border-gray-200 text-gray-700 rounded-xl px-4 py-2.5 text-sm focus:ring-pink-500 focus:border-pink-500 shadow-sm">
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                <h3 class="text-[#D82A97] font-bold mb-3 text-sm">Tambah Produk</h3>
                <div class="flex gap-4 mb-4">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Pilih Produk</label>
                        <select id="temp_product" class="w-full bg-white border border-gray-200 text-gray-700 rounded-xl px-4 py-2.5 text-sm focus:ring-pink-500 focus:border-pink-500 shadow-sm">
                            <option value="" data-name="" data-price="0">Pilih produk...</option>
                            @foreach($products ?? [] as $product)
                                <option value="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}">
                                    {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-24">
                        <label class="block text-xs font-bold text-gray-700 mb-1.5">Jumlah</label>
                        <input type="number" id="temp_qty" min="1" value="1" class="w-full bg-white border border-gray-200 text-gray-700 rounded-xl px-4 py-2.5 text-sm focus:ring-pink-500 focus:border-pink-500 shadow-sm text-center">
                    </div>
                </div>
                <button type="button" onclick="addToCartUI()" class="w-full bg-white border border-gray-200 hover:border-pink-300 hover:text-pink-600 text-gray-700 font-bold py-2.5 rounded-xl shadow-sm transition text-sm flex justify-center items-center gap-2">
                    <span>+</span> Tambah ke Keranjang
                </button>
            </div>

            <div>
                <h3 class="text-[#80153B] font-bold mb-3 text-sm">Keranjang Belanja</h3>
                <div id="cartListContainer" class="space-y-2 mb-2"></div>
                <div id="emptyCartState" class="border-2 border-dashed border-gray-200 rounded-2xl p-6 flex flex-col items-center justify-center text-gray-400">
                    <p class="text-xs font-medium">Keranjang masih kosong</p>
                </div>
                <div class="flex justify-between items-center mt-4 px-2">
                    <span class="text-gray-600 font-bold text-sm">Total Harga:</span>
                    <span class="text-xl font-extrabold text-[#C1126A]" id="totalPriceDisplay">Rp 0</span>
                </div>
            </div>

            <div class="pt-2 border-t border-gray-100 mt-4">
                <button type="submit" onclick="prepareCheckout(event)" id="btnSubmitForm" class="w-full bg-[#F9A8D4] hover:bg-pink-400 text-white font-bold py-3.5 rounded-xl shadow-sm transition">
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let cart = [];

    // Buka/Tutup Modal
    function openTransactionModal() {
        document.getElementById('transactionModal').classList.remove('hidden');
    }
    function closeTransactionModal() {
        document.getElementById('transactionModal').classList.add('hidden');
    }

    // Filter Segmented Control
    function filterTransactions(type, btn) {
        const rows = document.querySelectorAll('.transaction-row');
        const buttons = document.querySelectorAll('.filter-btn');

        buttons.forEach(b => {
            b.classList.remove('bg-white', 'shadow-sm', 'text-gray-800', 'font-bold');
            b.classList.add('text-gray-500', 'hover:bg-gray-200/50', 'font-medium');
        });
        btn.classList.remove('text-gray-500', 'hover:bg-gray-200/50', 'font-medium');
        btn.classList.add('bg-white', 'shadow-sm', 'text-gray-800', 'font-bold');

        rows.forEach(row => {
            if (type === 'all' || row.getAttribute('data-type') === type) {
                row.style.display = '';
                row.style.opacity = '0';
                setTimeout(() => { row.style.opacity = '1'; row.style.transition = 'opacity 0.3s'; }, 10);
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Toggle Form DP
    function togglePaymentFields() {
        const typeLunas = document.querySelector('input[value="penjualan_langsung"]').checked;
        const dpFields = document.getElementById('dp_fields');
        const btnSubmit = document.getElementById('btnSubmitForm');

        if (typeLunas) {
            dpFields.classList.add('hidden');
            btnSubmit.innerText = "Simpan Transaksi";
        } else {
            dpFields.classList.remove('hidden');
            btnSubmit.innerText = "Simpan Pesanan DP";
        }
    }

    // Tambah Produk
    function addToCartUI() {
        const selectBox = document.getElementById('temp_product');
        const qtyBox = document.getElementById('temp_qty');

        const productId = selectBox.value;
        const productName = selectBox.options[selectBox.selectedIndex]?.getAttribute('data-name');
        const productPrice = parseInt(selectBox.options[selectBox.selectedIndex]?.getAttribute('data-price'));
        const qty = parseInt(qtyBox.value);

        if (!productId || qty <= 0) {
            alert("Pilih produk dan masukkan jumlah yang valid!");
            return;
        }

        let existingItem = cart.find(item => item.id == productId);
        if (existingItem) {
            existingItem.qty += qty;
        } else {
            cart.push({ id: productId, name: productName, price: productPrice, qty: qty });
        }

        renderCartUI();
        selectBox.value = '';
        qtyBox.value = '1';
    }

    // Render Keranjang
    function renderCartUI() {
        const listContainer = document.getElementById('cartListContainer');
        const emptyState = document.getElementById('emptyCartState');
        const totalPriceEl = document.getElementById('totalPriceDisplay');

        listContainer.innerHTML = '';
        let total = 0;

        if (cart.length === 0) {
            emptyState.style.display = 'flex';
            totalPriceEl.innerText = 'Rp 0';
            return;
        }

        emptyState.style.display = 'none';

        cart.forEach((item, index) => {
            let subtotal = item.price * item.qty;
            total += subtotal;

            listContainer.insertAdjacentHTML('beforeend', `
                <div class="flex justify-between items-center bg-gray-50 border border-gray-100 px-4 py-3 rounded-xl">
                    <div class="flex-1">
                        <p class="text-gray-800 text-sm font-bold">${item.name}</p>
                        <p class="text-[#D82A97] text-xs font-semibold">Rp ${item.price.toLocaleString('id-ID')} <span class="text-gray-400 font-normal">x ${item.qty}</span></p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-gray-800 text-sm font-bold mr-3">Rp ${subtotal.toLocaleString('id-ID')}</span>
                        <button type="button" onclick="removeFromCart(${index})" class="text-red-400 hover:text-red-600 bg-white p-1.5 rounded-lg border border-red-100 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                        </button>
                    </div>
                </div>
            `);
        });

        totalPriceEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
    }

    function removeFromCart(index) {
        cart.splice(index, 1);
        renderCartUI();
    }

    function prepareCheckout(e) {
        if (cart.length === 0) {
            e.preventDefault();
            alert('Keranjang belanja masih kosong! Tambahkan produk terlebih dahulu.');
            return;
        }

        const typeLunas = document.querySelector('input[value="penjualan_langsung"]').checked;
        if (!typeLunas) {
            const customerName = document.querySelector('input[name="customer_name"]').value;
            if (customerName.trim() === "") {
                e.preventDefault();
                alert('Nama pelanggan wajib diisi untuk pesanan DP!');
                return;
            }
        }

        document.getElementById('cart_data').value = JSON.stringify(cart);
    }
</script>
@endsection
