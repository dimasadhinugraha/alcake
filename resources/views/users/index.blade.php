@extends('layouts.app')

@section('title', 'Manajemen User - Alva Cake')

@section('content')
<!-- Premium Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">

<div class="flex-1 overflow-auto relative z-10 bg-transparent min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 py-6">
        <div class="space-y-8" style="font-family: 'DM Sans', sans-serif;">
            
            <!-- Flash Success Message -->
            @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-2xl font-bold border border-green-100 flex items-center gap-3 shadow-sm">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>✨ {{ session('success') }}</span>
            </div>
            @endif

            <!-- Flash Error Message -->
            @if(session('error'))
            <div class="bg-red-50 text-red-700 p-4 rounded-2xl font-bold border border-red-100 flex items-center gap-3 shadow-sm">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>⚠️ {{ session('error') }}</span>
            </div>
            @endif

            <!-- Validation Errors -->
            @if($errors->any())
            <div class="bg-red-50 text-red-700 p-4 rounded-2xl font-bold border border-red-100 space-y-1 shadow-sm">
                @foreach ($errors->all() as $error)
                    <p class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ $error }}</span>
                    </p>
                @endforeach
            </div>
            @endif

            <!-- 1. Premium Header Banner -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-rose-100 via-pink-100 to-fuchsia-50 p-8 shadow-xl border border-rose-200/50">
                <div class="absolute top-0 right-0 w-64 h-64 bg-pink-200/30 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-fuchsia-200/30 rounded-full blur-3xl"></div>
                <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-fuchsia-400 rounded-2xl flex items-center justify-center shadow-lg transform rotate-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-8 h-8 text-white"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </div>
                        <div>
                            <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-pink-600 to-fuchsia-600 bg-clip-text text-transparent" style="font-family: 'Outfit', sans-serif;">Manajemen User</h1>
                            <p class="text-pink-600 mt-1 flex items-center gap-2 font-medium">
                                Kelola akun administrator sistem Alva Cake
                            </p>
                        </div>
                    </div>
                    <button onclick="openAddModal()" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium hover:bg-primary/90 h-12 bg-gradient-to-r from-pink-400 to-fuchsia-400 hover:from-pink-500 hover:to-fuchsia-500 text-white shadow-2xl rounded-2xl px-6 py-6 transform hover:scale-105 transition-all w-full md:w-auto cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-5 h-5 mr-1"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                        <span class="font-bold">Tambah User</span>
                    </button>
                </div>
            </div>

            <!-- 2. Statistics Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-pink-400 to-fuchsia-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                    <div>
                        <p class="text-pink-100 text-sm font-medium mb-1">Total Admin</p>
                        <p class="text-4xl font-bold font-outfit">{{ count($users) }}</p>
                    </div>
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-purple-400 to-indigo-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                    <div>
                        <p class="text-purple-100 text-sm font-medium mb-1">Aktif Saat Ini</p>
                        <p class="text-lg font-bold font-outfit truncate" style="max-width: 180px;">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-8 h-8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-amber-400 to-orange-400 rounded-2xl p-6 text-white shadow-xl flex justify-between items-center">
                    <div>
                        <p class="text-amber-100 text-sm font-medium mb-1">Akses Sistem</p>
                        <p class="text-2xl font-bold font-outfit">Akses Penuh</p>
                    </div>
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-8 h-8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                </div>
            </div>

            <!-- 3. User List Table Card -->
            <div class="bg-white border-2 border-pink-100 rounded-3xl shadow-xl overflow-hidden">
                <div class="px-6 py-5 bg-gradient-to-r from-pink-50/50 to-rose-50/50 border-b border-pink-100 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                        📋 Daftar Admin & Akun Pengguna
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm font-medium border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-xs tracking-wider font-bold">
                                <th class="px-6 py-4">NAMA LENGKAP</th>
                                <th class="px-6 py-4">EMAIL</th>
                                <th class="px-6 py-4">PERAN</th>
                                <th class="px-6 py-4">TANGGAL DAFTAR</th>
                                <th class="px-6 py-4 text-right">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($users as $user)
                            <tr class="transition hover:bg-pink-50/20">
                                <td class="px-6 py-4 font-bold text-slate-800 flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-pink-100 to-fuchsia-100 rounded-full flex items-center justify-center text-pink-600 font-extrabold uppercase shadow-sm">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <span>{{ $user->name }}</span>
                                </td>
                                <td class="px-6 py-4 font-mono text-xs text-slate-600">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center justify-center rounded-md border px-2.5 py-0.5 text-xs font-bold bg-pink-100 text-pink-700 border-pink-300">Admin</span>
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-500">{{ $user->created_at ? $user->created_at->translatedFormat('d M Y, H:i') : '-' }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex gap-2 justify-end">
                                        <button onclick="openEditModal({{ json_encode($user) }})" class="inline-flex items-center justify-center whitespace-nowrap text-xs font-bold transition-all h-8 gap-1.5 px-3 border-2 border-pink-300 text-pink-700 bg-white hover:bg-pink-50 rounded-xl cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg>
                                            Edit
                                        </button>
                                        
                                        @if($user->id === auth()->id())
                                            <span class="inline-flex items-center justify-center rounded-xl border px-3 py-1 text-xs font-bold bg-slate-50 text-slate-400 border-slate-200">
                                                Aktif (Anda)
                                            </span>
                                        @else
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap text-xs font-bold transition-all h-8 gap-1.5 px-3 border-2 border-red-300 text-red-700 bg-white hover:bg-red-50 rounded-xl cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-400 font-medium">Belum ada user terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- MODAL: TAMBAH USER                                             -->
<!-- ============================================================== -->
<div id="addModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-md animate-fade-in !mt-0">
    <div class="bg-white rounded-3xl border-4 border-pink-200 shadow-2xl p-0 max-h-[90vh] flex flex-col w-full max-w-lg relative overflow-hidden">
        <div class="flex flex-col gap-2 text-center sm:text-left px-6 py-5 border-b-4 border-pink-200 bg-gradient-to-r from-pink-50 to-rose-50">
            <h2 class="text-2xl font-extrabold text-pink-900 flex items-center gap-2 font-outfit">
                👤 Tambah User Baru
            </h2>
            <p class="text-xs text-pink-600 font-medium">Buat akun admin baru untuk sistem Alva Cake</p>
        </div>
        <form action="{{ route('users.store') }}" method="POST" class="flex-1 overflow-y-auto p-6 space-y-4">
            @csrf
            
            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700" for="add_name">Nama Lengkap *</label>
                <input type="text" name="name" id="add_name" required class="w-full border-2 border-pink-100 bg-white rounded-2xl h-12 px-4 focus:outline-none focus:border-pink-400 font-semibold text-slate-700 transition" placeholder="Masukkan nama lengkap">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700" for="add_email">Alamat Email *</label>
                <input type="email" name="email" id="add_email" required class="w-full border-2 border-pink-100 bg-white rounded-2xl h-12 px-4 focus:outline-none focus:border-pink-400 font-semibold text-slate-700 transition" placeholder="contoh@gmail.com">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700" for="add_password">Password Awal *</label>
                <input type="password" name="password" id="add_password" required class="w-full border-2 border-pink-100 bg-white rounded-2xl h-12 px-4 focus:outline-none focus:border-pink-400 font-semibold text-slate-700 transition" placeholder="Minimal 6 karakter">
            </div>

            <div class="pt-4 border-t border-slate-100 flex gap-3">
                <button type="button" onclick="closeAddModal()" class="flex-1 inline-flex items-center justify-center border-2 border-slate-200 text-slate-500 hover:bg-slate-50 px-4 py-2 rounded-2xl h-12 font-bold cursor-pointer transition">
                    Batal
                </button>
                <button type="submit" class="flex-1 inline-flex items-center justify-center text-white bg-gradient-to-r from-pink-500 to-fuchsia-500 hover:from-pink-600 hover:to-fuchsia-600 px-4 py-2 rounded-2xl h-12 font-bold cursor-pointer transition shadow-md">
                    Simpan User
                </button>
            </div>
        </form>
        <button type="button" onclick="closeAddModal()" class="absolute top-4 right-4 text-pink-900 opacity-70 hover:opacity-100 transition cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
</div>

<!-- ============================================================== -->
<!-- MODAL: EDIT USER                                               -->
<!-- ============================================================== -->
<div id="editModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-md animate-fade-in !mt-0">
    <div class="bg-white rounded-3xl border-4 border-pink-200 shadow-2xl p-0 max-h-[90vh] flex flex-col w-full max-w-lg relative overflow-hidden">
        <div class="flex flex-col gap-2 text-center sm:text-left px-6 py-5 border-b-4 border-pink-200 bg-gradient-to-r from-pink-50 to-rose-50">
            <h2 class="text-2xl font-extrabold text-pink-900 flex items-center gap-2 font-outfit">
                ✏️ Edit Data User
            </h2>
            <p class="text-xs text-pink-600 font-medium">Ubah rincian profil atau perbarui password user</p>
        </div>
        <form id="editForm" method="POST" class="flex-1 overflow-y-auto p-6 space-y-4">
            @csrf
            @method('PUT')
            
            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700" for="edit_name">Nama Lengkap *</label>
                <input type="text" name="name" id="edit_name" required class="w-full border-2 border-pink-100 bg-white rounded-2xl h-12 px-4 focus:outline-none focus:border-pink-400 font-semibold text-slate-700 transition" placeholder="Masukkan nama lengkap">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700" for="edit_email">Alamat Email *</label>
                <input type="email" name="email" id="edit_email" required class="w-full border-2 border-pink-100 bg-white rounded-2xl h-12 px-4 focus:outline-none focus:border-pink-400 font-semibold text-slate-700 transition" placeholder="contoh@gmail.com">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700" for="edit_password">Password Baru (Opsional)</label>
                <input type="password" name="password" id="edit_password" class="w-full border-2 border-pink-100 bg-white rounded-2xl h-12 px-4 focus:outline-none focus:border-pink-400 font-semibold text-slate-700 transition" placeholder="Kosongkan jika tidak diganti">
            </div>

            <div class="pt-4 border-t border-slate-100 flex gap-3">
                <button type="button" onclick="closeEditModal()" class="flex-1 inline-flex items-center justify-center border-2 border-slate-200 text-slate-500 hover:bg-slate-50 px-4 py-2 rounded-2xl h-12 font-bold cursor-pointer transition">
                    Batal
                </button>
                <button type="submit" class="flex-1 inline-flex items-center justify-center text-white bg-gradient-to-r from-pink-500 to-fuchsia-500 hover:from-pink-600 hover:to-fuchsia-600 px-4 py-2 rounded-2xl h-12 font-bold cursor-pointer transition shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
        <button type="button" onclick="closeEditModal()" class="absolute top-4 right-4 text-pink-900 opacity-70 hover:opacity-100 transition cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
</div>

<script>
    // --- MODAL: TAMBAH USER ---
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // --- MODAL: EDIT USER ---
    function openEditModal(user) {
        document.getElementById('editModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        document.getElementById('editForm').action = '/users/' + user.id;
        document.getElementById('edit_name').value = user.name;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_password').value = '';
    }
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    window.openAddModal = openAddModal;
    window.closeAddModal = closeAddModal;
    window.openEditModal = openEditModal;
    window.closeEditModal = closeEditModal;
</script>
@endsection
