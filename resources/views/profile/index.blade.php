@extends('layouts.app')

@section('title', 'Profil Saya - Alva Cake')

@section('content')
<!-- Premium Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">

<div class="flex-1 overflow-auto relative z-10 bg-transparent min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-8 py-6">
        <div class="space-y-8" style="font-family: 'DM Sans', sans-serif;">
            
            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded-2xl font-bold border border-green-100 flex items-center gap-3 shadow-sm">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>✨ {{ session('success') }}</span>
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
                <div class="relative flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-fuchsia-400 rounded-2xl flex items-center justify-center shadow-lg transform rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-8 h-8 text-white"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </div>
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-pink-600 to-fuchsia-600 bg-clip-text text-transparent" style="font-family: 'Outfit', sans-serif;">Profil Saya</h1>
                        <p class="text-pink-600 mt-1 flex items-center gap-2 font-medium">
                            Kelola Akun & Keamanan Password
                        </p>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout: User Card & Change Password Card -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Left Column: User Info Card -->
                <div class="bg-white border-2 border-pink-100 rounded-3xl p-6 shadow-xl relative overflow-hidden flex flex-col items-center text-center">
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-pink-50 rounded-full blur-2xl"></div>
                    
                    <!-- Avatar placeholder -->
                    <div class="w-24 h-24 bg-gradient-to-br from-pink-100 to-fuchsia-100 rounded-full flex items-center justify-center border-4 border-pink-200 mb-4 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-12 h-12 text-pink-600"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </div>

                    <h3 class="text-xl font-bold text-slate-800 font-outfit">{{ $user->name }}</h3>
                    <p class="text-sm text-pink-600 font-semibold uppercase tracking-wider mt-1">{{ $user->role }}</p>
                    
                    <div class="w-full border-t border-dashed border-slate-200 my-4"></div>

                    <div class="w-full text-left space-y-3 text-sm text-slate-600">
                        <div>
                            <span class="text-slate-400 font-bold block text-[10px] uppercase tracking-wider">Email Address</span>
                            <span class="font-semibold text-slate-800">{{ $user->email }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 font-bold block text-[10px] uppercase tracking-wider">User ID</span>
                            <span class="font-semibold text-slate-800">#{{ $user->id }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Change Password Card -->
                <div class="bg-white border-2 border-pink-100 rounded-3xl p-6 shadow-xl md:col-span-2">
                    <h2 class="text-xl font-bold text-slate-800 font-outfit mb-4 flex items-center gap-2">
                        🔑 Ganti Password Keamanan
                    </h2>
                    <p class="text-xs text-slate-500 mb-6 leading-relaxed">
                        Silakan isi formulir di bawah ini untuk memperbarui password akun Anda. Pastikan untuk menggunakan kombinasi password yang kuat dan aman.
                    </p>

                    <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 flex items-center gap-1.5" for="current_password">
                                Password Saat Ini <span class="text-rose-500">*</span>
                            </label>
                            <input type="password" name="current_password" id="current_password" required class="w-full border-2 border-pink-100 bg-white rounded-2xl h-12 px-4 focus:outline-none focus:border-pink-400 font-semibold text-slate-700 placeholder:text-slate-300 transition" placeholder="Masukkan password saat ini">
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 flex items-center gap-1.5" for="password">
                                Password Baru <span class="text-rose-500">*</span>
                            </label>
                            <input type="password" name="password" id="password" required class="w-full border-2 border-pink-100 bg-white rounded-2xl h-12 px-4 focus:outline-none focus:border-pink-400 font-semibold text-slate-700 placeholder:text-slate-300 transition" placeholder="Masukkan password baru (min 6 karakter)">
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 flex items-center gap-1.5" for="password_confirmation">
                                Konfirmasi Password Baru <span class="text-rose-500">*</span>
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full border-2 border-pink-100 bg-white rounded-2xl h-12 px-4 focus:outline-none focus:border-pink-400 font-semibold text-slate-700 placeholder:text-slate-300 transition" placeholder="Konfirmasi password baru">
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex justify-end">
                            <button type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive hover:bg-primary/90 h-12 has-[>svg]:px-3 bg-gradient-to-r from-pink-500 to-fuchsia-500 hover:from-pink-600 hover:to-fuchsia-600 text-white font-bold px-6 rounded-2xl cursor-pointer transition shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save w-5 h-5 mr-1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 10 12 15 7 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>
                                Simpan Password Baru
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
