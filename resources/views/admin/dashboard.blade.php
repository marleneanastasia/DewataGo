@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-display text-2xl font-semibold">Dashboard Admin</h2>
            <p class="text-sm text-white/50">Ringkasan aktivitas DewataGo.</p>
        </div>
        
        {{-- Tombol Tambah Destinasi Baru --}}
        <a href="{{ route('destinasi.create') }}" 
           class="flex items-center gap-2 rounded-lg bg-lime-400 px-4 py-2.5 text-xs font-bold uppercase tracking-widest text-black transition hover:brightness-110">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Destinasi
        </a>
    </div>

<div class="grid grid-cols-2 gap-4 md:grid-cols-5">
    <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
        <p class="text-[11px] uppercase tracking-wider text-white/50">Destinasi</p>
        <p class="mt-2 text-2xl font-bold text-lime-300">{{ $stats['destinasi'] }}</p>
    </div>
    <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
        <p class="text-[11px] uppercase tracking-wider text-white/50">Reservasi</p>
        <p class="mt-2 text-2xl font-bold text-lime-300">{{ $stats['reservasi'] }}</p>
    </div>
    <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
        <p class="text-[11px] uppercase tracking-wider text-white/50">Menunggu</p>
        <p class="mt-2 text-2xl font-bold text-yellow-300">{{ $stats['menunggu'] }}</p>
    </div>
    <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
        <p class="text-[11px] uppercase tracking-wider text-white/50">Pengguna</p>
        <p class="mt-2 text-2xl font-bold text-lime-300">{{ $stats['user'] }}</p>
    </div>
    <div class="rounded-2xl border border-lime-300/30 bg-lime-400/10 p-5">
        <p class="text-[11px] uppercase tracking-wider text-white/60">Pendapatan</p>
        <p class="mt-2 text-xl font-bold text-lime-300">Rp {{ number_format($stats['pendapatan'], 0, ',', '.') }}</p>
    </div>
</div>

    {{-- Quick Actions --}}
    <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
        <h3 class="font-display text-lg font-semibold mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <a href="{{ route('destinasi.create') }}" 
               class="flex flex-col items-center gap-2 rounded-xl border border-white/10 bg-white/5 p-4 transition hover:bg-white/10 hover:border-lime-300/30">
                <svg class="h-8 w-8 text-lime-300" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="text-xs font-semibold text-white/70">Tambah Destinasi</span>
            </a>

           <a href="{{ route('admin.reservasi.create') }}" 
   class="flex flex-col items-center gap-2 rounded-xl border p-4 transition {{ request()->routeIs('admin.reservasi.*') ? 'border-lime-400/60 bg-lime-400/10' : 'border-white/10 bg-white/5 hover:bg-white/10 hover:border-lime-300/30' }}">
    <svg class="h-8 w-8 {{ request()->routeIs('admin.reservasi.*') ? 'text-lime-400' : 'text-lime-300' }}" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
    </svg>
    <span class="text-xs font-semibold {{ request()->routeIs('admin.reservasi.*') ? 'text-lime-400' : 'text-white/70' }}">Buat Reservasi</span>
</a>

            <a href="{{ route('admin.kategori.create') }}" 
               class="flex flex-col items-center gap-2 rounded-xl border border-white/10 bg-white/5 p-4 transition hover:bg-white/10 hover:border-lime-300/30">
                <svg class="h-8 w-8 text-lime-300" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-5 5a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 10V5a2 2 0 012-2h2z"/>
                </svg>
                <span class="text-xs font-semibold text-white/70">Tambah Kategori</span>
            </a>

            <a href="{{ route('admin.user.index') }}" 
               class="flex flex-col items-center gap-2 rounded-xl border border-white/10 bg-white/5 p-4 transition hover:bg-white/10 hover:border-lime-300/30">
                <svg class="h-8 w-8 text-lime-300" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span class="text-xs font-semibold text-white/70">Kelola User</span>
            </a>
        </div>
    </div>

    {{-- Tabel Reservasi Terbaru dengan Aksi --}}
    <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-display text-lg font-semibold">Reservasi Terbaru</h3>
            <a href="{{ route('admin.reservasi.index') }}" class="text-xs text-lime-300 hover:text-lime-200 transition">Lihat Semua →</a>
        </div>

        <div class="space-y-3">
            @forelse ($terbaru as $r)
                <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-white/10 bg-white/5 px-5 py-4 transition hover:bg-white/10">
                    {{-- Info User & Destinasi --}}
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gradient-to-tr from-lime-400 to-emerald-400 text-sm font-bold text-black">
                            {{ strtoupper(substr($r->user->name ?? 'U', 0, 1)) }}
                        </span>
                        <div class="min-w-0">
                            <p class="font-semibold text-white truncate">{{ $r->user->name ?? 'User Terhapus' }}</p>
                            <p class="text-xs text-white/50 truncate">{{ $r->destinasiWisata->nama ?? 'Destinasi Terhapus' }} · {{ $r->tanggal_kunjungan->format('d M Y') }}</p>
                        </div>
                    </div>

                    {{-- Total & Status --}}
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-xs text-white/50">{{ $r->created_at->format('d M Y') }}</p>
                            <p class="font-semibold text-lime-300">Rp {{ number_format($r->total_harga, 0, ',', '.') }}</p>
                        </div>

                        {{-- Badge Status --}}
                        <span class="rounded-full px-3 py-1 text-[10px] font-bold uppercase tracking-wider {{ $r->status === 'dikonfirmasi' ? 'bg-lime-400/20 text-lime-300' : ($r->status === 'menunggu' ? 'bg-yellow-400/20 text-yellow-300' : 'bg-red-500/20 text-red-300') }}">
                            {{ $r->status }}
                        </span>

                        {{-- Tombol Aksi Cepat --}}
                        <div{{-- Tombol Aksi Cepat --}}
<div class="flex items-center gap-2">
    {{-- Setujui --}}
    @if ($r->status !== 'dikonfirmasi')
        <form method="POST" action="{{ route('admin.reservasi.status', $r->id) }}" onsubmit="return confirm('Setujui reservasi ini?')">
            @csrf @method('patch')
            <input type="hidden" name="status" value="dikonfirmasi">
            <button type="submit" title="Setujui"
                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-lime-400/20 text-lime-300 transition hover:bg-lime-400 hover:text-black">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </button>
        </form>
    @endif

    {{-- Batalkan --}}
    @if ($r->status !== 'dibatalkan')
        <form method="POST" action="{{ route('admin.reservasi.status', $r->id) }}" onsubmit="return confirm('Batalkan reservasi ini?')">
            @csrf @method('patch')
            <input type="hidden" name="status" value="dibatalkan">
            <button type="submit" title="Batalkan"
                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-500/20 text-red-300 transition hover:bg-red-500 hover:text-white">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </form>
    @endif

    {{-- Edit --}}
    <a href="{{ route('admin.reservasi.edit', $r->id) }}" title="Edit"
       class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-white/70 transition hover:bg-white/20 hover:text-white">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
    </a>

    {{-- HAPUS PERMANEN (BARU) --}}
    <form method="POST" action="{{ route('admin.reservasi.destroy', $r->id) }}" onsubmit="return confirm('⚠️ Hapus reservasi ini secara PERMANEN? Data tidak bisa dikembalikan!')">
        @csrf @method('delete')
        <button type="submit" title="Hapus Permanen"
                class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-red-400 transition hover:bg-red-500 hover:text-white">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </button>
    </form>
</div>
                    </div>
                </div>
            @empty
                <div class="rounded-xl border border-white/10 bg-white/5 p-8 text-center">
                    <p class="text-sm text-white/50">Belum ada reservasi.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection