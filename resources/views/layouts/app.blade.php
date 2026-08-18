<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — {{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body { font-family: 'Montserrat', ui-sans-serif, system-ui, sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { scrollbar-width: none; }
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-[#04120b] text-white antialiased">

    {{-- Glow dekorasi --}}
    <div class="pointer-events-none fixed inset-0 z-0">
        <div class="absolute -left-24 -top-24 h-96 w-96 rounded-full bg-lime-400/10 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 h-96 w-96 rounded-full bg-emerald-500/10 blur-3xl"></div>
    </div>

    {{-- ================= SIDEBAR DESKTOP (hidden di HP) ================= --}}
    <aside class="fixed left-0 top-0 z-50 hidden h-screen w-20 flex-col items-center border-r border-white/10 bg-black/40 py-8 backdrop-blur-xl md:flex">
        <nav class="flex flex-1 flex-col items-center gap-4">

              <a href="{{ route('dashboard') }}" title="Dashboard"
               class="group flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-300 hover:scale-110 {{ request()->routeIs('dashboard') ? 'bg-lime-400 text-black shadow-[0_0_20px_rgba(163,230,53,0.4)]' : 'text-white/60 hover:bg-white/10 hover:text-lime-300' }}">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            </a>
            <a href="{{ route('reservasi.index') }}" title="Reservasi"
               class="group flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-300 hover:scale-110 {{ request()->routeIs('reservasi.*') ? 'bg-lime-400 text-black shadow-[0_0_20px_rgba(163,230,53,0.4)]' : 'text-white/60 hover:bg-white/10 hover:text-lime-300' }}">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
            </a>          

            {{-- Destinasi --}}
            <a href="{{ route('destinasi.index') }}" title="Destinasi"
               class="group flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-300 hover:scale-110 {{ request()->routeIs('destinasi.*') ? 'bg-lime-400 text-black shadow-[0_0_20px_rgba(163,230,53,0.4)]' : 'text-white/60 hover:bg-white/10 hover:text-lime-300' }}">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
            </a>

            {{-- Profil --}}
            <a href="{{ route('profile.edit') }}" title="Profil"
               class="group flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-300 hover:scale-110 {{ request()->routeIs('profile.*') ? 'bg-lime-400 text-black shadow-[0_0_20px_rgba(163,230,53,0.4)]' : 'text-white/60 hover:bg-white/10 hover:text-lime-300' }}">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </a>
              <a href="{{ route('tentang') }}" title="Tentang Kami"
   class="group flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-300 hover:scale-110 {{ request()->routeIs('tentang') ? 'bg-lime-400 text-black shadow-[0_0_20px_rgba(163,230,53,0.4)]' : 'text-white/60 hover:bg-white/10 hover:text-lime-300' }}">
    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
</a>

            {{-- Menu Admin --}}
            @if (auth()->user()->role === 'admin')
                <div class="my-2 h-px w-8 bg-white/20"></div>

              <a href="{{ route('admin.dashboard') }}" title="Admin Dashboard"
   class="group flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-300 hover:scale-110 {{ request()->routeIs('admin.dashboard', 'admin.reservasi.*') ? 'bg-lime-400 text-black shadow-[0_0_20px_rgba(163,230,53,0.4)]' : 'text-white/60 hover:bg-white/10 hover:text-lime-300' }}">
    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
    </svg>
</a>
               

                <a href="{{ route('admin.promo.index') }}" title="Promo"
                   class="group flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-300 hover:scale-110 {{ request()->routeIs('admin.promo.*') ? 'bg-lime-400 text-black shadow-[0_0_20px_rgba(163,230,53,0.4)]' : 'text-white/60 hover:bg-white/10 hover:text-lime-300' }}">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 5L5 19M9 6.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zm11 11a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                </a>

                <a href="{{ route('admin.kategori.index') }}" title="Kategori"
                   class="group flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-300 hover:scale-110 {{ request()->routeIs('admin.kategori.*') ? 'bg-lime-400 text-black shadow-[0_0_20px_rgba(163,230,53,0.4)]' : 'text-white/60 hover:bg-white/10 hover:text-lime-300' }}">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                </a>
            @endif
        </nav>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button type="submit" title="Log Out"
                    class="group flex h-12 w-12 items-center justify-center rounded-xl text-white/60 transition-all duration-300 hover:scale-110 hover:bg-red-500/20 hover:text-red-400">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            </button>
        </form>
    </aside>

    {{-- ================= BOTTOM NAV MOBILE (DI LUAR ASIDE!) ================= --}}
    <nav class="fixed inset-x-0 bottom-0 z-50 border-t border-white/10 bg-[#04120b]/90 backdrop-blur-xl md:hidden">
        <div class="flex items-center justify-around px-2 py-2">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-0.5 rounded-lg px-3 py-1 {{ request()->routeIs('dashboard') ? 'text-lime-300' : 'text-white/60' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span class="text-[9px] font-semibold">Home</span>
            </a>

            <a href="{{ route('destinasi.index') }}" class="flex flex-col items-center gap-0.5 rounded-lg px-3 py-1 {{ request()->routeIs('destinasi.*') ? 'text-lime-300' : 'text-white/60' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                <span class="text-[9px] font-semibold">Wisata</span>
            </a>

            <a href="{{ route('reservasi.index') }}" class="flex flex-col items-center gap-0.5 rounded-lg px-3 py-1 {{ request()->routeIs('reservasi.*') ? 'text-lime-300' : 'text-white/60' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                <span class="text-[9px] font-semibold">Tiket</span>
            </a>

            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-0.5 rounded-lg px-3 py-1 {{ request()->routeIs('profile.*') ? 'text-lime-300' : 'text-white/60' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span class="text-[9px] font-semibold">Profil</span>
            </a>

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-0.5 rounded-lg px-3 py-1 {{ request()->routeIs('admin.*') ? 'text-lime-300' : 'text-white/60' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span class="text-[9px] font-semibold">Admin</span>
                </a>
            @endif
        </div>
    </nav>

    {{-- ================= MAIN CONTENT ================= --}}
    <div class="relative z-10 min-h-screen md:pl-20">

        {{-- Top Bar --}}
        <header class="sticky top-0 z-40 border-b border-white/10 bg-[#04120b]/80 backdrop-blur-xl">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="hidden items-center gap-3 lg:flex">
                    <svg viewBox="0 0 64 64" class="h-8 w-8">
                        <path d="M8 26h14M4 36h12" stroke="#a3e635" stroke-width="5" stroke-linecap="round"/>
                        <path d="M40 6c-11 0-20 9-20 20 0 14 20 32 20 32s20-18 20-32c0-11-9-20-20-20z" fill="#a3e635"/>
                        <circle cx="40" cy="26" r="8" fill="#04120b"/>
                    </svg>
                    <span class="text-lg font-extrabold tracking-tight">Dewata<span class="text-lime-300">Go</span></span>
                </div>

                <div class="flex-1 px-4 lg:max-w-xl">
                    <form action="{{ route('dashboard') }}" method="GET" class="relative">
                        <svg class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-white/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari destinasi wisata..."
                               class="w-full rounded-full border border-white/15 bg-white/10 py-2.5 pl-11 pr-4 text-sm text-white outline-none transition placeholder:text-white/40 focus:border-lime-300/60 focus:bg-white/15 focus:ring-2 focus:ring-lime-300/30">
                    </form>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <div class="hidden items-center gap-3 sm:flex">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-tr from-lime-400 to-emerald-400 text-sm font-bold text-black">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <div class="leading-tight">
                                <p class="text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                                @if (auth()->user()->role === 'admin')
                                    <p class="text-[10px] font-semibold uppercase tracking-wider text-lime-300">Admin</p>
                                @else
                                    <p class="text-[10px] text-white/50">Pengguna</p>
                                @endif
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </header>

        <main class="px-6 py-8 pb-24 md:pb-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>