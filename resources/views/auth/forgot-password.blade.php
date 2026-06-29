<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Alva Cake</title>
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-key w-10 h-10 text-pink-600">
                        <path d="m21 2-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0 1.5 1.5M15.5 7.5 14 6" />
                    </svg>
                </div>
                <div>
                    <h4 data-slot="card-title" class="text-3xl text-pink-900 font-bold font-outfit">Lupa Password</h4>
                    <p data-slot="card-description" class="text-muted-foreground mt-2">Masukkan email Anda untuk menerima link reset password</p>
                </div>
            </div>
            
            <div data-slot="card-content" class="px-6 pb-6">
                <!-- Success Message -->
                @if(session('success'))
                <div class="flex items-center gap-2 p-4 mb-6 text-sm text-green-700 border border-green-100 bg-green-50 rounded-xl font-medium">
                    <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>✨ {{ session('success') }}</span>
                </div>
                @endif

                <!-- Validation Errors -->
                @if($errors->any())
                <div class="flex items-center gap-2 p-3 mb-6 text-sm text-red-600 border border-red-100 bg-red-50 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-2 text-left">
                        <label data-slot="label" class="flex items-center gap-2 text-sm leading-none font-medium text-gray-700" for="email">Alamat Email</label>
                        <input type="email" name="email" class="flex h-10 w-full rounded-md border border-pink-200 bg-white px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-colors" id="email" placeholder="Masukkan email terdaftar" required value="{{ old('email') }}">
                    </div>
                    
                    <button data-slot="button" class="inline-flex items-center justify-center rounded-md text-sm font-medium text-white h-10 px-4 py-2 w-full bg-pink-500 hover:bg-pink-600 transition-colors mt-2 shadow-sm cursor-pointer font-bold" type="submit">
                        Kirim Link Reset Password
                    </button>

                    <div class="text-center mt-4">
                        <a href="/login" class="text-xs text-pink-600 hover:text-pink-700 font-bold transition-colors">Kembali ke Halaman Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
