@extends('layouts.app')

@section('title', 'Kelola Destinasi')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="font-display text-2xl font-semibold">Kelola Destinasi</h2>
            <p class="text-sm text-white/50">Daftar semua destinasi wisata yang tersedia di DewataGo.</p>
        </div>
        <a href="{{ route('destinasi.create') }}" 
           class="flex items-center gap-2 rounded-lg bg-lime-400 px-4 py-2.5 text-xs font-bold uppercase tracking-widest text-black transition hover:brightness-110">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Destinasi
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-lime-300/40 bg-lime-400/20 px-4 py-3 text-sm text-lime-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- Grid Destinasi --}}
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse ($destinasiWisatas as $destinasi)
            <div class="group relative overflow-hidden rounded-2xl border border-white/10 bg-white/5 transition hover:border-lime-300/30 hover:bg-white/10">
                {{-- Gambar --}}
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ $destinasi->gambar ? asset('storage/' . $destinasi->gambar) : 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80' }}" 
                         alt="{{ $destinasi->nama }}" 
                         class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                    
                    {{-- Badge Kategori --}}
                    <span class="absolute left-3 top-3 rounded-full bg-black/60 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-white backdrop-blur-sm">
                        {{ $destinasi->kategoriWisata->nama ?? 'Umum' }}
                    </span>

                    {{-- Badge Unggulan --}}
                    @if ($destinasi->unggulan)
                        <span class="absolute right-3 top-3 rounded-full bg-lime-400 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-black">
                            ⭐ Unggulan
                        </span>
                    @endif
                </div>

                {{-- Konten --}}
                <div class="p-5">
                    <h3 class="font-display text-lg font-semibold text-white line-clamp-1">{{ $destinasi->nama }}</h3>
                    <p class="mt-1 flex items-center gap-1 text-xs text-white/50">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $destinasi->lokasi }}
                    </p>

                    <div class="mt-4 flex items-end justify-between">
                        <div>
                            @if ($destinasi->diskon > 0)
                                <p class="text-xs text-white/40 line-through">Rp {{ number_format($destinasi->harga, 0, ',', '.') }}</p>
                            @endif
                            <p class="text-lg font-bold text-lime-300">
                                Rp {{ number_format($destinasi->hargaFinal(), 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mt-5 flex gap-2 border-t border-white/10 pt-4">
                        <a href="{{ route('destinasi.edit', $destinasi->id) }}" 
                           class="flex-1 rounded-lg bg-white/10 py-2 text-center text-xs font-semibold text-white transition hover:bg-white/20">
                            ✎ Edit
                        </a>
                        <form method="POST" action="{{ route('destinasi.destroy', $destinasi->id) }}" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus destinasi ini? Data tidak bisa dikembalikan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full rounded-lg bg-red-500/10 py-2 text-center text-xs font-semibold text-red-400 transition hover:bg-red-500 hover:text-white">
                                🗑 Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-2xl border border-white/10 bg-white/5 p-12 text-center">
                <svg class="mx-auto mb-4 h-16 w-16 text-white/20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                </svg>
                <p class="text-lg font-semibold text-white/70">Belum ada destinasi wisata</p>
                <p class="mt-1 text-sm text-white/40">Mulai tambahkan destinasi pertamamu sekarang!</p>
                <a href="{{ route('destinasi.create') }}" class="mt-4 inline-block rounded-lg bg-lime-400 px-6 py-2.5 text-xs font-bold uppercase tracking-widest text-black transition hover:brightness-110">
                    Tambah Destinasi
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection