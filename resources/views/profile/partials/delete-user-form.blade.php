<section x-data="{ open: false }" class="rounded-2xl border border-red-400/20 bg-red-500/10 p-6 backdrop-blur">
    <h3 class="text-lg font-semibold text-red-300">Hapus Akun</h3>
    <p class="mt-1 text-sm text-white/60">Sekali dihapus, semua datamu hilang permanen. Pikirkan matang-matang ya!</p>

    <button type="button" @click="open = true"
            class="mt-4 rounded-lg border border-red-400/40 bg-red-500/20 px-6 py-2.5 text-xs font-bold uppercase tracking-widest text-red-300 transition-all duration-300 hover:bg-red-500/40 hover:text-white active:scale-[0.98]">
        Hapus Akun
    </button>

    {{-- Modal konfirmasi --}}
    <div x-show="open" x-cloak @click.self="open = false"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4 backdrop-blur-sm">
        <div class="w-full max-w-md rounded-2xl border border-white/10 bg-[#0a1f14] p-6 shadow-2xl">
            <h4 class="text-lg font-semibold text-red-300">Yakin mau hapus akun?</h4>
            <p class="mt-2 text-sm text-white/60">Masukkan password kamu untuk konfirmasi. Tindakan ini tidak bisa dibatalkan.</p>

            <form method="POST" action="{{ route('profile.destroy') }}" class="mt-4 space-y-4">
                @csrf
                @method('delete')

                <input type="password" name="password" placeholder="Masukkan password"
                       class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white placeholder-white/40 outline-none transition focus:border-red-400/60 focus:ring-2 focus:ring-red-400/30">
                @error('password', 'userDeletion') <p class="text-xs text-red-400">{{ $message }}</p> @enderror

                <div class="flex justify-end gap-3">
                    <button type="button" @click="open = false"
                            class="rounded-lg border border-white/20 px-5 py-2.5 text-xs font-semibold uppercase tracking-widest text-white/70 transition hover:bg-white/10">
                        Batal
                    </button>
                    <button type="submit"
                            class="rounded-lg bg-red-500 px-5 py-2.5 text-xs font-bold uppercase tracking-widest text-white transition hover:bg-red-600 hover:shadow-[0_0_25px_rgba(239,68,68,0.5)]">
                        Hapus Permanen
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>