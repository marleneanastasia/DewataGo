<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
  
    <title>{{ config('app.name', 'Laravel') }} — Pesona Bali</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body { font-family: 'Montserrat', ui-sans-serif, system-ui, sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }

        .btn-store { position: relative; overflow: hidden; }
        .btn-store::after {
            content: "";
            position: absolute; top: 0; left: -80%;
            width: 50%; height: 100%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,.35), transparent);
            transform: skewX(-20deg);
            transition: left .7s ease;
            pointer-events: none;
        }
        .btn-store:hover::after { left: 130%; }

        .particle {
            position: absolute; bottom: -10px;
            border-radius: 9999px;
            background: radial-gradient(circle, rgba(220,255,170,.95), rgba(163,230,53,0));
            animation: float-up linear infinite;
            opacity: 0; pointer-events: none;
        }
        @keyframes float-up {
            0%   { transform: translateY(0) scale(1); opacity: 0; }
            10%  { opacity: .9; }
            90%  { opacity: .15; }
            100% { transform: translateY(-105vh) scale(.4); opacity: 0; }
        }

        .text-glow {
            text-shadow: 0 2px 20px rgba(0,0,0,0.9), 0 0 40px rgba(0,0,0,0.7);
        }
    </style>
</head>
<body class="relative min-h-screen text-white antialiased overflow-x-hidden">

    {{-- ================= VIDEO BACKGROUND ================= --}}
    <div class="fixed inset-0 z-0">
        <video autoplay muted loop playsinline class="h-full w-full object-cover"
               poster="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=2100&q=80">
            <source src="https://cdn.pixabay.com/video/2020/05/25/40130-424225493_large.mp4" type="video/mp4">
        </video>

        {{-- Overlay gradient --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-[#04120b]/50 to-black/70"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/60"></div>

        {{-- Glow dekoratif --}}
        <div class="absolute right-[8%] top-1/3 h-80 w-80 rounded-full bg-lime-400/20 blur-3xl"></div>
        <div class="absolute left-[10%] bottom-[15%] h-72 w-72 rounded-full bg-emerald-400/15 blur-3xl"></div>
    </div>

    {{-- Partikel --}}
    <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
        <span class="particle left-[8%]  h-2 w-2"     style="animation-duration:10s"></span>
        <span class="particle left-[18%] h-1.5 w-1.5" style="animation-duration:12s; animation-delay:2s"></span>
        <span class="particle left-[30%] h-2.5 w-2.5" style="animation-duration:9s;  animation-delay:4s"></span>
        <span class="particle left-[45%] h-1.5 w-1.5" style="animation-duration:13s; animation-delay:1s"></span>
        <span class="particle left-[60%] h-2 w-2"     style="animation-duration:10s; animation-delay:5s"></span>
        <span class="particle left-[72%] h-1.5 w-1.5" style="animation-duration:11s; animation-delay:3s"></span>
        <span class="particle left-[85%] h-2 w-2"     style="animation-duration:9.5s; animation-delay:6s"></span>
        <span class="particle left-[93%] h-1.5 w-1.5" style="animation-duration:12.5s; animation-delay:2.5s"></span>
    </div>

    {{-- ================= KONTEN UTAMA ================= --}}
    <div class="relative z-10 flex min-h-screen flex-col">

        {{-- Header: Logo & Tombol Login/Register --}}
        <header class="flex w-full items-center justify-between gap-3 px-6 pt-6 md:px-10">
            {{-- Brand Logo --}}
            <div class="flex items-center gap-3">
                <svg viewBox="0 0 64 64" class="h-10 w-10 drop-shadow-[0_0_15px_rgba(163,230,53,0.5)]">
                    <path d="M8 26h14M4 36h12" stroke="#a3e635" stroke-width="5" stroke-linecap="round"/>
                    <path d="M40 6c-11 0-20 9-20 20 0 14 20 32 20 32s20-18 20-32c0-11-9-20-20-20z" fill="#a3e635"/>
                    <circle cx="40" cy="26" r="8" fill="#04120b"/>
                </svg>
                <span class="text-lg font-extrabold tracking-tight">
                    Dewata<span class="text-lime-300">Go</span>
                </span>
            </div>
            
            <div class="flex items-center gap-3">
                @if (Route::has('login')) 
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="flex items-center gap-2 rounded-md border border-white/70 bg-white/10 px-6 py-2.5 text-[11px] font-semibold uppercase tracking-[0.25em] backdrop-blur-md transition-all duration-300 hover:border-lime-300 hover:bg-white/20 hover:shadow-[0_0_25px_rgba(163,230,53,0.4)] hover:text-lime-100">
                            Dashboard  
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="flex items-center gap-2 rounded-md border border-white/70 bg-white/10 px-6 py-2.5 text-[11px] font-semibold uppercase tracking-[0.25em] backdrop-blur-md transition-all duration-300 hover:border-lime-300 hover:bg-white/20 hover:shadow-[0_0_25px_rgba(163,230,53,0.4)] hover:text-lime-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="rounded-md border border-white/40 bg-white/5 px-5 py-2.5 text-[11px] font-semibold uppercase tracking-[0.25em] text-white backdrop-blur-md transition-all duration-300 hover:border-lime-300/60 hover:bg-white/15 hover:text-lime-100">
                                Daftar
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </header>

        {{-- Hero Section - Centered Content --}}
        <section class="flex flex-1 items-center justify-center px-6 md:px-10">
            <div class="text-center max-w-4xl">
                <p class="font-display text-glow text-3xl font-semibold tracking-[0.15em] md:text-5xl">
                    PESONA <span class="text-lime-300 drop-shadow-[0_0_15px_rgba(163,230,53,0.6)]">BALI</span>
                </p>
                <p class="mt-2 text-[10px] font-semibold uppercase tracking-[0.7em] text-lime-100 drop-shadow md:text-xs">
                    Island of the Gods
                </p>

                <h1 class="font-display text-glow mt-6 text-4xl font-bold uppercase tracking-[0.06em] md:text-6xl">
                    Unraveling Wonders
                </h1>
                <p class="font-display text-glow mt-3 text-lg uppercase tracking-[0.25em] md:text-2xl">
                    of the Island of Gods
                </p>

                {{-- CTA Buttons --}}
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('login') }}" 
                       class="rounded-lg bg-gradient-to-r from-lime-400 to-emerald-400 px-8 py-3 text-sm font-bold uppercase tracking-widest text-black shadow-lg shadow-lime-400/20 transition-all duration-300 hover:shadow-lime-400/40 hover:brightness-110 active:scale-[0.98]">
                        Mulai Petualangan
                    </a>
                    <a href="#" 
                       class="rounded-lg border border-white/30 bg-white/10 px-8 py-3 text-sm font-bold uppercase tracking-widest text-white backdrop-blur-md transition-all duration-300 hover:bg-white/20 hover:border-lime-300/60">
                        Pelajari Lebih
                    </a>
                </div>
            </div>
        </section>

        {{-- Footer: Download Buttons --}}
        <footer class="w-full px-4 pb-10">
            <p class="text-glow text-center text-xs font-semibold tracking-wider md:text-sm">
                Tersedia di Berbagai Platform &mdash; Unduh Sekarang!
            </p>

            <div class="mt-5 flex flex-wrap items-center justify-center gap-3 md:gap-4">
                {{-- App Store --}}
                <a href="#" class="btn-store group flex items-center gap-3 rounded-lg border border-white/15 bg-black/60 px-5 py-3 backdrop-blur-md transition-all duration-300 hover:-translate-y-1.5 hover:border-white/40 hover:bg-black/80 hover:shadow-[0_15px_35px_-12px_rgba(255,255,255,0.3)]">
                    <svg class="h-7 w-7 text-white transition-transform duration-300 group-hover:scale-110" viewBox="0 0 384 512" fill="currentColor">
                        <path d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"/>
                    </svg>
                    <span class="leading-tight text-white">
                        <span class="block text-[10px] font-medium uppercase tracking-wider text-white/80">Download on the</span>
                        <span class="block text-base font-semibold">App Store</span>
                    </span>
                </a>

                {{-- Google Play --}}
                <a href="#" class="btn-store group flex items-center gap-3 rounded-lg border border-white/15 bg-black/60 px-5 py-3 backdrop-blur-md transition-all duration-300 hover:-translate-y-1.5 hover:border-white/40 hover:bg-black/80 hover:shadow-[0_15px_35px_-12px_rgba(255,255,255,0.3)]">
                    <svg class="h-7 w-7 transition-transform duration-300 group-hover:scale-110" viewBox="0 0 512 512">
                        <path fill="#32BBFF" d="M32.4 2.4C23.4 7.3 17.2 17 17.2 30v452c0 13 6.1 22.7 15.2 27.6L287.1 256 32.4 2.4z"/>
                        <path fill="#2C9B48" d="M385.7 168L105.3 7.5 32.4 2.4l254.7 253.6 98.6-88z"/>
                        <path fill="#F3B936" d="M32.4 509.6c2.7 1.4 5.7 2.2 8.9 2.2 4.1 0 8.3-1.2 12-3.5l278.6-160.4-44.8-92-254.7 253.7z"/>
                        <path fill="#DE2043" d="M477.9 231.5l-92.2-63.5-98.6 88 44.8 92 146-84.4c21-12.1 21-41.5 0-32.1z"/>
                        <path fill="#32BBFF" d="M287.1 256l98.6-88 92.2 63.5c21 12.1 21 41.5 0 49.5l-146 84.4-44.8-109.4z" opacity="0.2"/>
                    </svg>
                    <span class="leading-tight text-white">
                        <span class="block text-[10px] font-medium uppercase tracking-wider text-white/80">Get it on</span>
                        <span class="block text-base font-semibold">Google Play</span>
                    </span>
                </a>

                {{-- Windows --}}
                <a href="#" class="btn-store group flex items-center gap-3 rounded-lg border border-white/15 bg-black/60 px-5 py-3 backdrop-blur-md transition-all duration-300 hover:-translate-y-1.5 hover:border-white/40 hover:bg-black/80 hover:shadow-[0_15px_35px_-12px_rgba(0,170,255,0.5)]">
                    <svg class="h-6 w-6 transition-transform duration-300 group-hover:scale-110" viewBox="0 0 448 512">
                        <path fill="#00A4EF" d="M0 93.7l183.6-25.3v177.4H0V93.7zM0 418.6l183.6 25.3V268.4H0v150.2z"/>
                        <path fill="#00A4EF" d="M203.8 446.6L448 480V268.4H203.8v178.2zM203.8 66.4v177.4H448V66.4L203.8 32.6z"/>
                    </svg>
                    <span class="leading-tight text-white">
                        <span class="block text-[10px] font-medium uppercase tracking-wider text-white/80">Download for</span>
                        <span class="block text-base font-semibold">Windows</span>
                    </span>
                </a>

                {{-- Website --}}
                <a href="#" class="btn-store group flex items-center gap-3 rounded-lg border border-white/15 bg-black/60 px-5 py-3 backdrop-blur-md transition-all duration-300 hover:-translate-y-1.5 hover:border-lime-300/60 hover:bg-black/80 hover:shadow-[0_15px_35px_-12px_rgba(163,230,53,0.5)]">
                    <svg class="h-7 w-7 text-lime-300 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="leading-tight text-white">
                        <span class="block text-[10px] font-medium uppercase tracking-wider text-white/80">Kunjungi</span>
                        <span class="block text-base font-semibold">Website</span>
                    </span>
                </a>
            </div>
        </footer>
    </div>
</body>
</html>