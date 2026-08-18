<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar — DewataGo</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }

        .floating-card {
            animation: floatIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        @keyframes floatIn {
            from { opacity: 0; transform: translateY(20px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden">

    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1920&q=80"
             alt="Bali" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-[#04120b]/85 via-[#04120b]/70 to-[#04120b]/85 backdrop-blur-sm"></div>
    </div>

    <div class="absolute -top-32 -left-32 w-96 h-96 bg-lime-400/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="floating-card relative z-10 w-full max-w-sm mx-4">

        <div class="relative rounded-xl border border-white/10 bg-[#04120b] p-8 shadow-2xl">

            <a href="{{ url('/') }}" title="Kembali ke beranda"
               class="absolute right-4 top-4 z-20 flex h-8 w-8 items-center justify-center rounded-full bg-white/10 text-white/60 transition hover:bg-red-500/20 hover:text-red-300">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </a>

            <div class="mb-6 flex items-center gap-3">
                <svg viewBox="0 0 64 64" class="h-10 w-10">
                    <path d="M8 26h14M4 36h12" stroke="#a3e635" stroke-width="5" stroke-linecap="round"/>
                    <path d="M40 6c-11 0-20 9-20 20 0 14 20 32 20 32s20-18 20-32c0-11-9-20-20-20z" fill="#a3e635"/>
                    <circle cx="40" cy="26" r="8" fill="#04120b"/>
                </svg>
                <div>
                    <h1 class="text-lg font-semibold text-white">Buat Akun</h1>
                    <p class="text-xs text-white/50">Daftar untuk mulai booking</p>
                </div>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-3">
                @csrf

                @if ($errors->any())
                    <div class="rounded-lg bg-red-500/10 border border-red-500/20 px-3 py-2 text-xs text-red-300">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label class="block text-xs text-white/60 mb-1.5">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                           placeholder="Nama lengkap"
                           class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2.5 text-sm text-white placeholder-white/30 outline-none transition focus:border-lime-400/50">
                    @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs text-white/60 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           placeholder="email@contoh.com"
                           class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2.5 text-sm text-white placeholder-white/30 outline-none transition focus:border-lime-400/50">
                    @error('email') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs text-white/60 mb-1.5">Kata Sandi</label>
                    <input type="password" name="password" required
                           placeholder="Min. 8 karakter"
                           class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2.5 text-sm text-white placeholder-white/30 outline-none transition focus:border-lime-400/50">
                    @error('password') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs text-white/60 mb-1.5">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" required
                           placeholder="Ulangi kata sandi"
                           class="w-full rounded-lg border border-white/10 bg-white/5 px-3 py-2.5 text-sm text-white placeholder-white/30 outline-none transition focus:border-lime-400/50">
                </div>

                <button type="submit"
                        class="w-full rounded-lg bg-lime-400 py-2.5 text-sm font-semibold text-black transition hover:bg-lime-300 active:scale-[0.98] mt-2">
                    Daftar
                </button>
            </form>

            <p class="text-center text-xs text-white/50 mt-5">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-lime-400 hover:text-lime-300 font-medium">Masuk</a>
            </p>
        </div>
    </div>

</body>
</html>