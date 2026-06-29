<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Alva Cake</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://s3-figma-foundry-cached-previews-production-sig.figma.com/dab42007-1624-47aa-9130-6dc562aba29b/index.css?Expires=1778457600&Key-Pair-Id=APKAQ4GOSFWCW27IBOMQ&Signature=sAlcuIkf2sAxxjJi-wjoXuNQBHa~0PMvZLJnNukQYpoasWOghVIhNqVIMs1G7-f9wJIXL2Q9BSO~nhss0WfVJJTlYAgpWhoPUyOv8wePS4u-Dw3Cw4TgWOuW3Iv5NaQiCkBUauEKZUUq24CbtHTxnHDP3Sj-9hA~gezVTQCmK-hnBMDlW6vi~BoM7XD7gx2UEqYvg7A417jGgmuWKGXMm9GnSmEgEgTxwAFfFYVSp6JO2z5SWKUbY3~0~W24MFGCuRg0-fVEWeavwzDCoUdLMdPla24Vns68sQ77wOTYepYlCYQotPB7cTVnPwKXPQyG~-8ULtgFm4ZnP0auM2SxoA__">
    <style>
        .bg-card { background-color: white; }
        .text-card-foreground { color: #1a1a1a; }
        .text-muted-foreground { color: #6b7280; }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-pink-50 via-amber-50 to-orange-50 flex items-center justify-center p-4">
        <div data-slot="card" class="bg-card text-card-foreground flex flex-col gap-6 rounded-xl border w-full max-w-md shadow-xl border-pink-100 bg-white">
            <div data-slot="card-header" class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 has-data-[slot=card-action]:grid-cols-[1fr_auto] [.border-b]:pb-6 text-center space-y-4">
                <div class="mx-auto w-20 h-20 bg-gradient-to-br from-pink-200 to-orange-200 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cake w-10 h-10 text-pink-600">
                        <path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"></path>
                        <path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"></path>
                        <path d="M2 21h20"></path>
                        <path d="M7 8v3"></path>
                        <path d="M12 8v3"></path>
                        <path d="M17 8v3"></path>
                        <path d="M7 4h.01"></path>
                        <path d="M12 4h.01"></path>
                        <path d="M17 4h.01"></path>
                    </svg>
                </div>
                <div>
                    <h4 data-slot="card-title" class="text-3xl text-pink-900 font-bold">Alva Cake</h4>
                    <p data-slot="card-description" class="text-muted-foreground mt-2">Sistem Informasi Penjualan &amp; Stok</p>
                </div>
            </div>
            
            <div data-slot="card-content" class="px-6 pb-6">
                @if(session('success'))
                <div class="flex items-center gap-2 p-3 mb-6 text-sm text-green-700 border border-green-200 bg-green-50 rounded-xl">
                    <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                @if($errors->any())
                <div class="flex items-center gap-2 p-3 mb-6 text-sm text-red-600 border border-red-100 bg-red-50 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-2 text-left">
                        <label data-slot="label" class="flex items-center gap-2 text-sm leading-none font-medium text-gray-700" for="username">Username / Email</label>
                        <input type="text" name="username" class="flex h-10 w-full rounded-md border border-pink-200 bg-white px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-colors" id="username" placeholder="Masukkan username atau email" required value="{{ old('username') }}">
                    </div>
                    <div class="space-y-2 text-left">
                        <div class="flex justify-between items-center">
                            <label data-slot="label" class="flex items-center gap-2 text-sm leading-none font-medium text-gray-700" for="password">Password</label>
                            <a href="/forgot-password" class="text-xs text-pink-600 hover:text-pink-700 font-semibold transition-colors">Lupa password?</a>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" class="flex h-10 w-full rounded-md border border-pink-200 bg-white pl-3 pr-10 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-colors" id="password" placeholder="Masukkan password" required>
                            <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-pink-600 focus:outline-none cursor-pointer">
                                <!-- Eye Icon Open -->
                                <svg id="eye-icon-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <!-- Eye Icon Closed -->
                                <svg id="eye-icon-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                                    <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                                    <line x1="2" x2="22" y1="2" y2="22" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <button data-slot="button" class="inline-flex items-center justify-center rounded-md text-sm font-medium text-white h-10 px-4 py-2 w-full bg-pink-500 hover:bg-pink-600 transition-colors mt-2 shadow-sm" type="submit">
                        Login
                    </button>
                    
                </form>

                <div class="mt-8 pt-6 border-t border-pink-100 text-center text-sm text-gray-600 space-y-1">
                    <p>📍 Jl. Pedongkelan Belakang RT 03 RW 14 No. 121,</p>
                    <p>Cengkareng Timur, Jakarta Barat</p>
                    <p>📱 WhatsApp: 085280024001</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const openEye = document.getElementById('eye-icon-open');
            const closedEye = document.getElementById('eye-icon-closed');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                openEye.classList.add('hidden');
                closedEye.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                openEye.classList.remove('hidden');
                closedEye.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
