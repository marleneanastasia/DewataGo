@extends('layouts.app')

@section('title', $destinasi->nama)

@section('content')
<div class="space-y-6">

    {{-- ===== HERO IMAGE ===== --}}
    <div class="relative overflow-hidden rounded-2xl border border-white/10">
        <img src="{{ $destinasi->gambar_url }}" alt="{{ $destinasi->nama }}" loading="lazy"
     class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>

        <div class="absolute left-4 top-4 flex flex-wrap gap-2">
            <span class="rounded-full bg-black/60 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-white backdrop-blur-sm">
                {{ $destinasi->kategoriWisata->nama ?? 'Umum' }}
            </span>
            @if ($destinasi->diskon > 0)
                <span class="rounded-full bg-lime-400 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-black">PROMO -{{ $destinasi->diskon }}%</span>
            @endif
            @if ($destinasi->unggulan)
                <span class="rounded-full bg-white/20 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-white backdrop-blur-sm">Unggulan</span>
            @endif
        </div>

        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
            <h1 class="font-display text-3xl font-bold md:text-5xl">{{ $destinasi->nama }}</h1>
            <p class="mt-2 text-sm text-white/70"> {{ $destinasi->lokasi }}</p>
        </div>
    </div>

    {{-- ===== INFO: HARGA & RATING ===== --}}
    <div class="grid gap-4 md:grid-cols-2">
        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <p class="text-[11px] uppercase tracking-wider text-white/50">Harga Tiket</p>
            @if ($destinasi->diskon > 0)
                <p class="mt-1 text-sm text-white/40 line-through">Rp {{ number_format($destinasi->harga, 0, ',', '.') }}</p>
            @endif
            <p class="text-2xl font-bold text-lime-300">Rp {{ number_format($destinasi->hargaFinal(), 0, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <p class="text-[11px] uppercase tracking-wider text-white/50">Rating</p>
            <div class="mt-2 flex items-center gap-2">
                <span class="text-2xl font-bold text-lime-300">{{ number_format($destinasi->komens->avg('rating') ?? 0, 1) }}</span>
                <span class="text-xl text-lime-300">★</span>
                <span class="text-sm text-white/50">({{ $destinasi->komens->count() }} ulasan)</span>
            </div>
        </div>
    </div>

    {{-- ===== GRID: TENTANG + BOOKING + ULASAN ===== --}}
    <div class="grid gap-6 lg:grid-cols-3">

        {{-- Tentang Destinasi --}}
        <div class="rounded-2xl border border-white/10 bg-white/5 p-6 lg:col-span-2">
            <h3 class="font-display text-xl font-semibold">Tentang Destinasi</h3>
<p class="text-white/70 leading-relaxed">   
    {!! nl2br(e($destinasi->deskripsi)) !!}
</p>        </div>

        {{-- Kolom kanan --}}
        <div class="space-y-6">

            {{-- Booking Tiket --}}
            <div class="rounded-2xl border border-lime-300/30 bg-lime-400/10 p-6">
                <h3 class="font-display text-xl font-semibold">Booking Tiket</h3>

                <form method="POST" action="{{ route('reservasi.store', $destinasi->id) }}" class="mt-4 space-y-4">
                    @csrf
                    <div>
                        <label class="mb-1 block text-[11px] uppercase tracking-wider text-white/60">Tanggal Kunjungan</label>
                        <input type="date" name="tanggal_kunjungan" min="{{ date('Y-m-d') }}" value="{{ old('tanggal_kunjungan') }}" required
                               class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60 [color-scheme:dark]">
                        @error('tanggal_kunjungan') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="mb-1 block text-[11px] uppercase tracking-wider text-white/60">Jumlah Tiket</label>
                        <input type="number" name="jumlah_tiket" id="jumlah" min="1" max="20" value="{{ old('jumlah_tiket', 1) }}" required
                               class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60">
                        @error('jumlah_tiket') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-between rounded-lg bg-black/30 px-4 py-3">
                        <span class="text-xs text-white/60">Total</span>
                        <span id="total-harga" class="text-lg font-bold text-lime-300">Rp {{ number_format($destinasi->hargaFinal(), 0, ',', '.') }}</span>
                    </div>

                    <button type="submit"
                            class="w-full rounded-lg bg-gradient-to-r from-lime-400 to-emerald-400 py-2.5 text-xs font-bold uppercase tracking-widest text-black transition hover:brightness-110 active:scale-[0.98]">
                        Booking Sekarang
                    </button>
                </form>
            </div>

            {{-- Tulis Ulasan --}}
            <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
                <h3 class="font-display text-xl font-semibold">Tulis Ulasan</h3>

                <form method="POST" action="{{ route('komen.store', $destinasi->id) }}" class="mt-4 space-y-4">
                    @csrf
                    <div>
                        <p class="mb-1 text-[11px] uppercase tracking-wider text-white/60">Rating Kamu</p>
                        <div class="flex gap-1" id="star-picker">
                            @for ($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="{{ $i }}" class="sr-only" @checked(old('rating') == $i)>
                                    <span class="star block text-2xl text-white/30 transition hover:scale-110" data-star="{{ $i }}">★</span>
                                </label>
                            @endfor
                        </div>
                        @error('rating') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <textarea name="isi" rows="4" required placeholder="Ceritakan pengalamanmu di sini..."
                                  class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white placeholder-white/40 outline-none transition focus:border-lime-300/60">{{ old('isi') }}</textarea>
                        @error('isi') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit"
                            class="w-full rounded-lg bg-gradient-to-r from-lime-400 to-emerald-400 py-2.5 text-xs font-bold uppercase tracking-widest text-black transition hover:brightness-110">
                        Kirim Ulasan
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ===== DAFTAR KOMENTAR ===== --}}
    <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
        <h3 class="font-display text-xl font-semibold">Komentar ({{ $destinasi->komens->count() }})</h3>

        <div class="mt-4 space-y-4">
            @forelse ($destinasi->komens->sortByDesc('created_at') as $komen)
                <div class="rounded-xl bg-white/5 p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-lime-400 text-sm font-bold text-black">
                                {{ strtoupper(substr($komen->user->name ?? 'U', 0, 1)) }}
                            </span>
                            <div>
                                <p class="text-sm font-semibold">{{ $komen->user->name ?? 'User Terhapus' }}</p>
                                <p class="text-[11px] text-white/40">
                                    {{ $komen->created_at->format('d M Y') }} ·
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="{{ $i <= $komen->rating ? 'text-lime-300' : 'text-white/20' }}">★</span>
                                    @endfor
                                </p>
                            </div>
                        </div>

                        @if ($komen->user_id === auth()->id() || auth()->user()->role === 'admin')
                            <form method="POST" action="{{ route('komen.destroy', $komen->id) }}" onsubmit="return confirm('Hapus komentar ini?')">
                                @csrf @method('delete')
                                <button class="text-[11px] font-semibold text-red-400 transition hover:text-red-300">Hapus</button>
                            </form>
                        @endif
                    </div>
                    <p class="mt-3 text-sm text-white/70">{{ $komen->isi }}</p>
                </div>
            @empty
                <p class="py-6 text-center text-sm text-white/50">Belum ada komentar. Jadilah yang pertama! ✨</p>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Hitung total booking otomatis
    const hargaTiket = {{ $destinasi->hargaFinal() }};
    const inputJumlah = document.getElementById('jumlah');
    const totalEl = document.getElementById('total-harga');

    inputJumlah?.addEventListener('input', () => {
        const n = Math.max(1, parseInt(inputJumlah.value) || 1);
        totalEl.textContent = hargaTiket > 0 ? 'Rp ' + (hargaTiket * n).toLocaleString('id-ID') : 'Gratis';
    });

    // Bintang rating interaktif
    document.querySelectorAll('#star-picker input').forEach(radio => {
        radio.addEventListener('change', () => {
            const val = parseInt(radio.value);
            document.querySelectorAll('#star-picker .star').forEach(s => {
                s.classList.toggle('text-lime-300', parseInt(s.dataset.star) <= val);
                s.classList.toggle('text-white/30', parseInt(s.dataset.star) > val);
            });
        });
    });
</script>
@endpush
@endsection