@extends('layouts.app')

@section('title', 'Order Management - Alva Cake')

@section('content')
<div class="p-8 bg-[#FFFBFD] min-h-full font-sans relative">

    @if(session('success'))
    <div class="bg-green-50 text-green-700 p-4 rounded-2xl font-bold border border-green-100 flex items-center gap-3 shadow-sm mb-6 relative z-10">
        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span>✨ {{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-gradient-to-r from-[#A72BEE] to-[#FF884B] rounded-[2rem] p-8 mb-8 shadow-md flex justify-between items-center relative overflow-hidden">
        <div class="relative z-10 flex items-center gap-5">
            <div class="bg-white/20 backdrop-blur-md w-16 h-16 rounded-2xl flex items-center justify-center text-white shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a2 2 0 01-2 2H5a2 2 0 01-2-2m18 0V9a2 2 0 00-2-2H5a2 2 0 00-2 2v6M12 5v4m-4-4v4m8-4v4" /></svg>
            </div>
            <div>
                <h1 class="text-4xl font-extrabold text-white mb-1">Order Management</h1>
                <p class="text-white/90 font-medium flex items-center gap-2 text-sm tracking-wide">✨ Pesanan Multi-Produk dengan Auto-Kalkulasi</p>
            </div>
        </div>
        <button onclick="openCreateModal()" class="relative z-10 bg-white hover:bg-gray-50 text-[#A72BEE] px-6 py-3.5 rounded-xl text-sm font-extrabold shadow-lg transition duration-300 flex items-center gap-2 cursor-pointer">
            <span class="text-xl leading-none">+</span> Buat Pesanan Baru
        </button>
        <div class="absolute -right-10 -top-10 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-[#F3E8FF] p-8">
        <div class="flex items-center gap-3 mb-8">
            <div class="bg-[#F3E8FF] w-10 h-10 rounded-xl flex items-center justify-center text-[#A72BEE] shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
            </div>
            <h2 class="text-xl font-bold text-[#4C1D95]">Daftar Pesanan Produksi</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-800 text-sm border-b-2 border-gray-100 bg-[#F8FAFC]">
                        <th class="py-4 font-bold pl-4 rounded-l-xl">ID</th>
                        <th class="py-4 font-bold">Pelanggan</th>
                        <th class="py-4 font-bold">Produk</th>
                        <th class="py-4 font-bold">Total</th>
                        <th class="py-4 font-bold">Tgl Pesan</th>
                        <th class="py-4 font-bold">Tgl Selesai</th>
                        <th class="py-4 font-bold text-center">Status</th>
                        <th class="py-4 font-bold text-center rounded-r-xl w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-slate-700 font-medium">
                    @forelse($orders as $order)
                    <tr class="border-b border-gray-50 hover:bg-[#F8FAFC] transition">
                        <td class="py-5 pl-4 font-extrabold text-[#A72BEE]">#{{ $order->id }}</td>
                        <td class="py-5 text-gray-900 font-bold">{{ $order->customer }}</td>
                        <td class="py-5">
                            <ul class="space-y-1">
                                @if($order->products && is_array($order->products))
                                    @foreach($order->products as $item)
                                        <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>{{ $item['name'] }} ×{{ $item['qty'] }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>
                        <td class="py-5 text-[#A72BEE] font-extrabold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td class="py-5 text-slate-500">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
                        <td class="py-5 text-slate-500">{{ \Carbon\Carbon::parse($order->finish_date)->format('d M Y') }}</td>
                        <td class="py-5 text-center">
                            @if($order->status == 'Diproses')
                                <span class="border border-blue-200 text-blue-600 bg-blue-50 px-3 py-1.5 rounded-md text-xs font-bold flex items-center justify-center gap-1.5 w-fit mx-auto"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg> {{ $order->status }}</span>
                            @elseif($order->status == 'Pending')
                                <span class="border border-orange-200 text-orange-500 bg-orange-50 px-3 py-1.5 rounded-md text-xs font-bold flex items-center justify-center gap-1.5 w-fit mx-auto"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> {{ $order->status }}</span>
                            @else
                                <span class="border border-green-200 text-green-600 bg-green-50 px-3 py-1.5 rounded-md text-xs font-bold flex items-center justify-center gap-1.5 w-fit mx-auto"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> {{ $order->status }}</span>
                            @endif
                        </td>
                        <td class="py-5 text-center">
                            <button onclick="openDetailModal({{ json_encode($order) }})" class="w-8 h-8 rounded-lg border border-blue-200 text-blue-500 flex items-center justify-center hover:bg-blue-50 transition cursor-pointer mx-auto">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center text-gray-400">Belum ada data pesanan. Silakan buat pesanan baru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="detailModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-900/40 backdrop-blur-sm py-10 transition-opacity">
    <div class="bg-white rounded-[2rem] w-full max-w-lg mx-4 overflow-hidden shadow-[0_0_40px_-10px_rgba(167,43,238,0.25)] border-4 border-purple-50 flex flex-col relative max-h-[90vh]">
        <div class="px-8 pt-8 pb-4 shrink-0 flex justify-between items-center relative z-10 bg-white">
            <div class="flex items-center gap-3"><span class="text-3xl">📦</span><h2 class="text-2xl font-extrabold text-[#A72BEE]">Detail Pesanan</h2></div>
            <button onclick="closeDetailModal()" class="w-8 h-8 rounded-full border border-gray-200 text-gray-400 hover:text-red-500 hover:bg-red-50 transition cursor-pointer"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg></button>
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
    <div class="bg-white rounded-[2rem] w-full max-w-2xl mx-4 shadow-2xl flex flex-col relative max-h-[90vh] overflow-hidden">

        <div class="px-8 pt-8 pb-4 shrink-0 flex justify-between items-start relative z-10 bg-white">
            <div class="flex gap-4 items-center">
                <div class="bg-gradient-to-br from-[#A72BEE] to-[#D82A97] w-14 h-14 rounded-2xl flex items-center justify-center text-white shadow-md">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-extrabold text-[#A72BEE] mb-0.5">Buat Pesanan Multi-Produk</h2>
                    <p class="text-gray-400 text-xs font-bold">✨ Pesanan Multi-Produk dengan Auto-Kalkulasi</p>
                </div>
            </div>
            <button onclick="closeCreateModal()" class="w-8 h-8 rounded-full border border-gray-200 text-gray-400 hover:text-red-500 hover:bg-red-50 transition cursor-pointer">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <div class="p-8 pt-4 overflow-y-auto custom-scrollbar bg-gray-50/30">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-5">
                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-[#A72BEE] mb-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg> Nama Pelanggan</label>
                            <input type="text" name="customer" required placeholder="Masukkan nama pelanggan..." class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:ring-2 focus:ring-purple-300 outline-none text-gray-700 font-medium shadow-sm">
                        </div>
                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-[#A72BEE] mb-2">Status Pesanan</label>
                            <div class="relative">
                                <select name="status" required class="w-full bg-white border border-gray-200 rounded-xl pl-10 pr-4 py-3.5 text-sm focus:ring-2 focus:ring-purple-300 outline-none appearance-none cursor-pointer text-gray-700 font-medium shadow-sm">
                                    <option value="Pending">Pending</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                                <div class="absolute left-4 top-3.5 text-[#F59E0B]">⏳</div>
                                <div class="absolute right-4 top-4 text-gray-400 pointer-events-none"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg></div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-5">
                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-[#A72BEE] mb-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg> Tanggal Pemesanan</label>
                            <input type="date" name="order_date" required id="order_date_input" onchange="calculateEstimasi()" class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3.5 text-sm focus:ring-2 focus:ring-purple-300 outline-none text-gray-700 font-medium shadow-sm">
                            <p class="text-xs text-[#A72BEE] font-bold mt-2 flex items-center gap-1.5 ml-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Estimasi selesai: <span id="estimasi_text">-</span></p>
                        </div>
                        <div>
                            <label class="flex items-center gap-2 text-xs font-bold text-[#A72BEE] mb-2">Catatan (Opsional)</label>
                            <textarea name="notes" placeholder="Catatan tambahan..." rows="2" class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-300 outline-none resize-none text-gray-700 font-medium shadow-sm"></textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-[#FFF9F5] border border-[#FFE4D6] rounded-2xl p-6 mb-6">
                    <h3 class="text-[#9A3412] font-bold flex items-center gap-2 mb-4"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg> Tambah Produk ke Pesanan</h3>
                    <div class="flex flex-col md:flex-row gap-4 items-end">
                        <div class="flex-1">
                            <label class="block text-xs font-bold text-[#C2410C] mb-1.5">Pilih Produk</label>
                            <div class="relative">
                                <select id="cart_product_select" class="w-full bg-white border border-[#FFDCC8] rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-orange-300 outline-none appearance-none cursor-pointer font-medium text-gray-700 shadow-sm">
                                    <option value="">Pilih produk...</option>
                                    @foreach($availableProducts ?? [] as $prod)
                                        <option value="{{ $prod }}">{{ $prod }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute right-4 top-3.5 text-orange-400 pointer-events-none"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg></div>
                            </div>
                        </div>
                        <div class="w-24">
                            <label class="block text-xs font-bold text-[#C2410C] mb-1.5">Jumlah</label>
                            <input type="number" id="cart_qty_input" min="1" placeholder="0" class="w-full bg-white border border-[#FFDCC8] rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-orange-300 outline-none text-center font-bold text-gray-800 shadow-sm">
                        </div>
                        <button type="button" onclick="addToCart()" class="bg-gradient-to-r from-[#FF884B] to-[#FF5C93] hover:opacity-90 text-white px-5 py-3.5 rounded-xl text-sm font-bold shadow-md transition cursor-pointer whitespace-nowrap">
                            + Tambah ke Pesanan
                        </button>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6 shadow-sm">
                    <h3 class="text-[#4C1D95] font-bold flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-[#A72BEE]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        Produk dalam Pesanan (<span id="cart_item_count">0 item</span>)
                    </h3>

                    <div id="cart_items_container" class="space-y-3 mb-4">
                        <p class="text-gray-400 text-sm text-center py-4">Belum ada produk ditambahkan.</p>
                    </div>

                    <div class="bg-[#F8F3FF] rounded-xl p-4 border border-[#E9D5FF] flex flex-col justify-center items-start">
                        <p class="text-sm font-bold text-[#6B21A8] mb-1">Total Pesanan:</p>
                        <h2 id="cart_total_text" class="text-3xl font-extrabold text-[#7E22CE]">Rp 0</h2>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button" onclick="closeCreateModal()" class="text-gray-500 hover:bg-gray-200 px-6 py-3 rounded-xl font-bold transition cursor-pointer">Batal</button>
                    <button type="submit" class="bg-gradient-to-r from-[#A72BEE] to-[#D82A97] text-white px-8 py-3 rounded-xl font-extrabold shadow-lg hover:opacity-90 transition cursor-pointer">Simpan Pesanan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // --- JS Modal Detail ---
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
        if(order.products && order.products.length > 0) {
            order.products.forEach(item => {
                let pPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(item.subtotal);
                container.innerHTML += `<div class="flex justify-between items-center bg-gray-50 p-4 rounded-xl border border-gray-100"><p class="font-bold text-gray-800">${item.name} <span class="text-gray-500 font-medium ml-1">×${item.qty}</span></p><p class="font-bold text-[#A72BEE]">${pPrice}</p></div>`;
            });
        }
    }
    function closeDetailModal() { document.getElementById('detailModal').classList.add('hidden'); }

    // --- JS Modal Create & Cart ---
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
        document.getElementById('order_date_input').value = new Date().toISOString().split('T')[0];
        calculateEstimasi();
        cart = []; renderCart();
    }
    function closeCreateModal() { document.getElementById('createModal').classList.add('hidden'); }

    function calculateEstimasi() {
        let inputDate = document.getElementById('order_date_input').value;
        if(inputDate) {
            let dateObj = new Date(inputDate);
            dateObj.setDate(dateObj.getDate() + 2);
            document.getElementById('estimasi_text').innerText = dateObj.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
        }
    }

    let cart = [];
    function addToCart() {
        const prodSelect = document.getElementById('cart_product_select');
        const qtyInput = document.getElementById('cart_qty_input');
        if(!prodSelect.value || !qtyInput.value || qtyInput.value <= 0) {
            alert('Pilih produk dan isi jumlah yang valid ya!'); return;
        }

        let parts = prodSelect.value.split(' - Rp ');
        let name = parts[0];
        let price = parseInt(parts[1].replace(/\./g, ''));
        let qty = parseInt(qtyInput.value);

        cart.push({ name: name, price: price, qty: qty });
        prodSelect.value = ''; qtyInput.value = '';
        renderCart();
    }

    function renderCart() {
        const container = document.getElementById('cart_items_container');
        const totalText = document.getElementById('cart_total_text');
        const countText = document.getElementById('cart_item_count');

        container.innerHTML = '';
        let grandTotal = 0;

        if(cart.length === 0) {
            container.innerHTML = '<p class="text-gray-400 text-sm text-center py-4">Belum ada produk ditambahkan.</p>';
            totalText.innerText = 'Rp 0';
            countText.innerText = '0 item';
            return;
        }

        countText.innerText = cart.length + ' item';

        cart.forEach((item, index) => {
            let subtotal = item.price * item.qty;
            grandTotal += subtotal;

            let formattedPrice = new Intl.NumberFormat('id-ID').format(item.price);
            let formattedSubtotal = new Intl.NumberFormat('id-ID').format(subtotal);

            // INI MAGICNYA: Inject hidden input biar dikirim ke Controller
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
</script>
@endsection
