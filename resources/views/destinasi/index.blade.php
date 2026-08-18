@extends('layouts.app')

@section('title', auth()->user()->role === 'admin' ? 'Kelola Destinasi' : 'Daftar Wisata')

@section('content')
<div class="space-y-6">

    {{-- Header (judul & tombol menyesuaikan role) --}}
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="font-display text-2xl font-semibold">
                {{ auth()->user()->role === 'admin' ? 'Kelola Destinasi' : 'Jelajahi Destinasi' }}
            </h2>
            <p class="text-sm text-white/50">
                {{ auth()->user()->role === 'admin'
                    ? 'Daftar semua destinasi wisata yang tersedia di DewataGo.'
                    : 'Temukan tempat wisata terbaik di Bali untuk petualanganmu.' }}
            </p>
        </div>

        {{-- Tombol tambah HANYA untuk admin --}}
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('destinasi.create') }}"
               class="flex items-center gap-2 rounded-lg bg-lime-400 px-4 py-2.5 text-xs font-bold uppercase tracking-widest text-black transition hover:brightness-110">
                + Tambah Destinasi
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-lime-300/40 bg-lime-400/20 px-4 py-3 text-sm text-lime-200">{{ session('success') }}</div>
    @endif

    {{-- Grid Destinasi --}}
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse ($destinasiWisatas as $destinasi)
            @php
                $src = $destinasi->gambar
                    ? (str_starts_with($destinasi->gambar, 'http') ? $destinasi->gambar : asset('storage/' . $destinasi->gambar))
                    : 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=800&q=60';
            @endphp

            <div class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/5 transition hover:border-lime-300/30 hover:bg-white/10">
                {{-- Gambar (klik = lihat detail) --}}
                <a href="{{ route('destinasi.show', $destinasi->id) }}" class="relative block h-48 overflow-hidden">
                    <img src="{{ $src }}" alt="{{ $destinasi->nama }}" loading="lazy"
                         class="h-full w-full object-cover transition duration-500 group-hover:scale-110">

                    <span class="absolute left-3 top-3 rounded-full bg-black/60 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-white backdrop-blur-sm">
                        {{ $destinasi->kategoriWisata->nama ?? 'Umum' }}
                    </span>

                    @if ($destinasi->unggulan)
                        <span class="absolute right-3 top-3 rounded-full bg-lime-400 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-black">
                             Unggulan
                        </span>
                    @endif
                </a>

                {{-- Konten --}}
                <div class="p-5">
                    <a href="{{ route('destinasi.show', $destinasi->id) }}">
                        <h3 class="font-display text-lg font-semibold text-white line-clamp-1 hover:text-lime-300 transition">{{ $destinasi->nama }}</h3>
                    </a>
                    <p class="mt-1 text-xs text-white/50"> {{ $destinasi->lokasi }}</p>

                    <div class="mt-4">
                        @if ($destinasi->diskon > 0)
                            <p class="text-xs text-white/40 line-through">Rp {{ number_format($destinasi->harga, 0, ',', '.') }}</p>
                        @endif
                        <p class="text-lg font-bold {{ $destinasi->hargaFinal() == 0 ? 'text-lime-300' : 'text-lime-300' }}">
                            {{ $destinasi->hargaFinal() == 0 ? 'Gratis' : 'Rp ' . number_format($destinasi->hargaFinal(), 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mt-5 flex gap-2 border-t border-white/10 pt-4">
                        {{-- Lihat detail: semua user --}}
                        <a href="{{ route('destinasi.show', $destinasi->id) }}"
                           class="flex-1 rounded-lg bg-lime-400/10 py-2 text-center text-xs font-semibold text-lime-300 transition hover:bg-lime-400 hover:text-black">
                            👁 Lihat
                        </a>

                        {{-- Edit & Hapus: KHUSUS ADMIN --}}
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('destinasi.edit', $destinasi->id) }}"
                               class="flex-1 rounded-lg bg-white/10 py-2 text-center text-xs font-semibold text-white transition hover:bg-white/20">
                                ✎ Edit
                            </a>
                            <form method="POST" action="{{ route('destinasi.destroy', $destinasi->id) }}" class="flex-1"
                                  onsubmit="return confirm('Yakin ingin menghapus destinasi ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="w-full rounded-lg bg-red-500/10 py-2 text-center text-xs font-semibold text-red-400 transition hover:bg-red-500 hover:text-white">
                                    🗑 Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border border-white/10 bg-white/5 p-12 text-center">
                <p class="text-lg font-semibold text-white/70">Belum ada destinasi wisata</p>
                <p class="mt-1 text-sm text-white/40">Yuk mulai jelajahi atau tambahkan destinasi baru!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection