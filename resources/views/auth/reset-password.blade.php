<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Alva Cake</title>
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
            <div data-slot="card-header" class="@container/card-header grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6 text-center space-y-4">
                <div class="mx-auto w-20 h-20 bg-gradient-to-br from-pink-200 to-orange-200 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check w-10 h-10 text-pink-600">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        <path d="m9 11 2 2 4-4" />
                    </svg>
                </div>
                <div>
                    <h4 data-slot="card-title" class="text-3xl text-pink-900 font-bold font-outfit">Reset Password</h4>
                    <p data-slot="card-description" class="text-muted-foreground mt-2">Buat password baru yang aman untuk akun Anda</p>
                </div>
            </div>
            
            <div data-slot="card-content" class="px-6 pb-6">
                <!-- Validation Errors -->
                @if($errors->any())
                <div class="flex items-center gap-2 p-3 mb-6 text-sm text-red-600 border border-red-100 bg-red-50 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="space-y-2 text-left">
                        <label data-slot="label" class="flex items-center gap-2 text-sm leading-none font-medium text-gray-700" for="email">Alamat Email</label>
                        <input type="email" name="email" class="flex h-10 w-full rounded-md border border-pink-200 bg-slate-50 px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-colors font-semibold text-slate-500 cursor-not-allowed" id="email" required value="{{ old('email', $email) }}" readonly>
                    </div>

                    <div class="space-y-2 text-left">
                        <label data-slot="label" class="flex items-center gap-2 text-sm leading-none font-medium text-gray-700" for="password">Password Baru</label>
                        <div class="relative">
                            <input type="password" name="password" class="flex h-10 w-full rounded-md border border-pink-200 bg-white pl-3 pr-10 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-colors" id="password" placeholder="Masukkan password baru (min 6 karakter)" required>
                            <button type="button" onclick="togglePasswordVisibility('password', 'eye-open-1', 'eye-closed-1')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-pink-600 focus:outline-none cursor-pointer">
                                <svg id="eye-open-1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <svg id="eye-closed-1" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                                    <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                                    <line x1="2" x2="22" y1="2" y2="22" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-2 text-left">
                        <label data-slot="label" class="flex items-center gap-2 text-sm leading-none font-medium text-gray-700" for="password_confirmation">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" class="flex h-10 w-full rounded-md border border-pink-200 bg-white pl-3 pr-10 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-colors" id="password_confirmation" placeholder="Konfirmasi password baru" required>
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'eye-open-2', 'eye-closed-2')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-pink-600 focus:outline-none cursor-pointer">
                                <svg id="eye-open-2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <svg id="eye-closed-2" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                                    <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                                    <line x1="2" x2="22" y1="2" y2="22" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <button data-slot="button" class="inline-flex items-center justify-center rounded-md text-sm font-medium text-white h-10 px-4 py-2 w-full bg-pink-500 hover:bg-pink-600 transition-colors mt-2 shadow-sm cursor-pointer font-bold" type="submit">
                        Perbarui Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, openId, closedId) {
            const input = document.getElementById(inputId);
            const openEye = document.getElementById(openId);
            const closedEye = document.getElementById(closedId);
            
            if (input.type === 'password') {
                input.type = 'text';
                openEye.classList.add('hidden');
                closedEye.classList.remove('hidden');
            } else {
                input.type = 'password';
                openEye.classList.remove('hidden');
                closedEye.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
