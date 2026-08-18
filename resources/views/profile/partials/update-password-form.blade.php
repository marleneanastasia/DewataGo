<section class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur">
    <h3 class="text-lg font-semibold">Ganti Password</h3>
    <p class="mt-1 text-sm text-white/60">Pastikan akunmu memakai password yang panjang & acak biar aman.</p>

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-4">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Password Saat Ini</label>
            <input id="current_password" type="password" name="current_password" required autocomplete="current-password"
                   class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white placeholder-white/40 outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30">
            @error('current_password') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Password Baru</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white placeholder-white/40 outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30">
            @error('password') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Konfirmasi Password Baru</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white placeholder-white/40 outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30">
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="rounded-lg bg-gradient-to-r from-lime-400 to-emerald-400 px-6 py-2.5 text-xs font-bold uppercase tracking-widest text-black transition-all duration-300 hover:shadow-[0_0_25px_rgba(163,230,53,0.5)] hover:brightness-110 active:scale-[0.98]">
                Perbarui Password
            </button>
            @if (session('status') === 'password-updated')
                <p class="text-xs font-semibold text-lime-300">✔ Password berhasil diganti.</p>
            @endif
        </div>
    </form>
</section>