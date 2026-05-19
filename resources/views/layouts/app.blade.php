<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Alva Cake Admin')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #FFFBFD;
        }

        h1, h2, h3, h4, h5, h6, .font-outfit {
            font-family: 'Outfit', sans-serif !important;
        }

        /* Custom Scrollbar tipis */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #fbcfe8;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #f472b6;
        }

        /* Page transitions */
        .animate-page-in {
            animation: pageFadeIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes pageFadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes pageFadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-8px);
            }
        }
        .animate-page-out {
            animation: pageFadeOut 0.2s cubic-bezier(0.7, 0, 0.84, 0) forwards !important;
        }
    </style>
</head>
<body class="text-slate-800 flex h-screen overflow-hidden">

    <aside class="w-64 bg-white/80 backdrop-blur-lg border-r border-pink-100 flex flex-col h-screen sticky top-0 shadow-lg shrink-0 z-20">
        <div class="p-6 border-b border-pink-100 bg-gradient-to-br from-pink-50/50 to-rose-50/50">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-rose-400 rounded-2xl flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cake w-6 h-6 text-white"><path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"></path><path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"></path><path d="M2 21h20"></path><path d="M7 8v3"></path><path d="M12 8v3"></path><path d="M17 8v3"></path><path d="M7 4h.01"></path><path d="M12 4h.01"></path><path d="M17 4h.01"></path></svg>
                </div>
                <div>
                    <h1 class="font-bold text-pink-900">Alva Cake</h1>
                    <p class="text-xs text-pink-600 font-medium">Pre-Order Bakery</p>
                </div>
            </div>
        </div>
        
        <div class="px-6 py-4 border-b border-pink-100 bg-gradient-to-r from-pink-50/50 to-rose-50/50">
            <div class="text-sm">
                <p class="text-xs text-pink-600 font-medium">Login sebagai</p>
                <p class="font-semibold text-pink-900 mt-1">{{ auth()->check() ? auth()->user()->name : 'Owner Alva Cake' }}</p>
                <p class="text-xs text-pink-500 capitalize">(admin)</p>
            </div>
        </div>
        
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <a href="/" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm {{ request()->is('dashboard') || request()->is('/') ? 'bg-gradient-to-r from-pink-100 to-rose-100 text-pink-700 font-semibold shadow-sm' : 'text-gray-700 hover:bg-pink-50/50 hover:text-pink-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard w-5 h-5 flex-shrink-0"><rect width="7" height="9" x="3" y="3" rx="1"></rect><rect width="7" height="5" x="14" y="3" rx="1"></rect><rect width="7" height="9" x="14" y="12" rx="1"></rect><rect width="7" height="5" x="3" y="16" rx="1"></rect></svg>
                <span class="truncate">Dashboard</span>
            </a>
            
            <a href="/products" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm {{ request()->is('products*') ? 'bg-gradient-to-r from-pink-100 to-rose-100 text-pink-700 font-semibold shadow-sm' : 'text-gray-700 hover:bg-pink-50/50 hover:text-pink-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cake w-5 h-5 flex-shrink-0"><path d="M20 21v-8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8"></path><path d="M4 16s.5-1 2-1 2.5 2 4 2 2.5-2 4-2 2.5 2 4 2 2-1 2-1"></path><path d="M2 21h20"></path><path d="M7 8v3"></path><path d="M12 8v3"></path><path d="M17 8v3"></path><path d="M7 4h.01"></path><path d="M12 4h.01"></path><path d="M17 4h.01"></path></svg>
                <span class="truncate">Katalog Menu Kue</span>
            </a>

            <a href="/categories" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm {{ request()->is('categories*') ? 'bg-gradient-to-r from-pink-100 to-rose-100 text-pink-700 font-semibold shadow-sm' : 'text-gray-700 hover:bg-pink-50/50 hover:text-pink-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag w-5 h-5 flex-shrink-0"><path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z"></path><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle></svg>
                <span class="truncate">Kategori Kue</span>
            </a>
            
            <a href="/orders" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm {{ request()->is('orders*') ? 'bg-gradient-to-r from-pink-100 to-rose-100 text-pink-700 font-semibold shadow-sm' : 'text-gray-700 hover:bg-pink-50/50 hover:text-pink-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-list w-5 h-5 flex-shrink-0"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"></rect><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><path d="M12 11h4"></path><path d="M12 16h4"></path><path d="M8 11h.01"></path><path d="M8 16h.01"></path></svg>
                <span class="truncate">Pesanan Produksi</span>
            </a>
            
            <a href="/materials" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm {{ request()->is('materials*') ? 'bg-gradient-to-r from-pink-100 to-rose-100 text-pink-700 font-semibold shadow-sm' : 'text-gray-700 hover:bg-pink-50/50 hover:text-pink-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-5 h-5 flex-shrink-0"><path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path><path d="M12 22V12"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><path d="m7.5 4.27 9 5.15"></path></svg>
                <span class="truncate">Stok Bahan Baku</span>
            </a>
            
            <a href="/recipes" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm {{ request()->is('recipes*') ? 'bg-gradient-to-r from-pink-100 to-rose-100 text-pink-700 font-semibold shadow-sm' : 'text-gray-700 hover:bg-pink-50/50 hover:text-pink-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open w-5 h-5 flex-shrink-0"><path d="M12 7v14"></path><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"></path></svg>
                <span class="truncate">Resep Master</span>
            </a>
            
            <a href="/transactions" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm {{ request()->is('transactions*') ? 'bg-gradient-to-r from-pink-100 to-rose-100 text-pink-700 font-semibold shadow-sm' : 'text-gray-700 hover:bg-pink-50/50 hover:text-pink-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart w-5 h-5 flex-shrink-0"><circle cx="8" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>
                <span class="truncate">Transaksi</span>
            </a>
            
            <a href="/reports" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm {{ request()->is('reports*') ? 'bg-gradient-to-r from-pink-100 to-rose-100 text-pink-700 font-semibold shadow-sm' : 'text-gray-700 hover:bg-pink-50/50 hover:text-pink-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-chart-column-increasing w-5 h-5 flex-shrink-0"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M8 18v-2"></path><path d="M12 18v-4"></path><path d="M16 18v-6"></path></svg>
                <span class="truncate">Laporan Operasional</span>
            </a>
        </nav>
        
        <div class="p-4 border-t border-pink-100">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm text-red-600 hover:bg-red-50 transition-all font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out w-5 h-5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" x2="9" y1="12" y2="12"></line></svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 h-full overflow-y-auto relative z-10 animate-page-in">
        @yield('content')
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const main = document.querySelector('main');
            
            if (main) {
                main.addEventListener('animationend', function (e) {
                    if (e.animationName === 'pageFadeIn') {
                        main.classList.remove('animate-page-in');
                    }
                });
            }

            const links = document.querySelectorAll('aside nav a[href^="/"]');
            links.forEach(link => {
                link.addEventListener('click', function (e) {
                    if (e.button === 0 && !e.ctrlKey && !e.shiftKey && !e.metaKey && !e.altKey) {
                        const targetUrl = this.getAttribute('href');
                        if (targetUrl && targetUrl !== '#' && !targetUrl.startsWith('#') && targetUrl !== window.location.pathname) {
                            e.preventDefault();
                            if (main) {
                                main.classList.add('animate-page-out');
                            }
                            setTimeout(() => {
                                window.location.href = targetUrl;
                            }, 200); // Cocok dengan durasi pageFadeOut (0.2s)
                        }
                    }
                });
            });
        });

        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                const main = document.querySelector('main');
                if (main) {
                    main.classList.remove('animate-page-out');
                }
            }
        });
    </script>
</body>
</html>
