<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    </style>
</head>
<body class="relative min-h-screen text-white antialiased">

    {{-- Background --}}
    <div class="fixed inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=2100&q=80" alt="" class="h-full w-full object-cover">
        <div class="absolute inset-0 bg-[#04120b]/70"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/50"></div>
        <div class="absolute -left-24 -top-24 h-96 w-96 rounded-full bg-lime-400/10 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 h-96 w-96 rounded-full bg-emerald-500/10 blur-3xl"></div>
    </div>

    <div class="relative z-10 flex min-h-screen flex-col items-center justify-center px-4 py-10">

        <a href="{{ url('/') }}" class="mb-6 flex flex-col items-center gap-2">
            <span class="flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-tr from-lime-400 via-emerald-300 to-sky-300 p-[3px]">
                <span class="h-full w-full rounded-full bg-[#06150d]/90"></span>
            </span>
            <span class="font-display text-xl font-semibold tracking-[0.2em] drop-shadow">PESONA <span class="text-lime-300">BALI</span></span>
        </a>

        <div class="w-full max-w-md rounded-2xl border border-white/10 bg-black/40 p-8 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.6)] backdrop-blur-xl">
            {{ $slot }}
        </div>

        <p class="mt-6 text-xs text-white/50">© {{ date('Y') }} Pesona Bali — Island of the Gods</p>
    </div>
</body>
</html>