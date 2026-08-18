<section class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur">
    <h3 class="text-lg font-semibold">Informasi Profil</h3>
    <p class="mt-1 text-sm text-white/60">Perbarui nama dan alamat email akunmu.</p>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-4">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white placeholder-white/40 outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30">
            @error('name') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email"
                   class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white placeholder-white/40 outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30">
            @error('email') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="mt-2 text-xs text-yellow-300">
                    Email belum diverifikasi.
                    <a href="{{ route('verification.send') }}" class="font-semibold underline hover:text-lime-300">Kirim ulang</a>
                </p>
            @endif
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="rounded-lg bg-gradient-to-r from-lime-400 to-emerald-400 px-6 py-2.5 text-xs font-bold uppercase tracking-widest text-black transition-all duration-300 hover:shadow-[0_0_25px_rgba(163,230,53,0.5)] hover:brightness-110 active:scale-[0.98]">
                Simpan
            </button>
            @if (session('status') === 'profile-updated')
                <p class="text-xs font-semibold text-lime-300">✔ Profil berhasil diperbarui.</p>
            @endif
        </div>
    </form>
</section>