@extends('layouts.app')

@section('title', 'Reservasi')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="font-display text-2xl font-semibold">Reservasi Saya</h2>
        <p class="text-sm text-white/50">Riwayat booking tiket wisatamu.</p>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-lime-300/40 bg-lime-400/20 px-4 py-3 text-sm text-lime-200">{{ session('success') }}</div>
    @endif

    @forelse ($reservasis as $r)
        <div class="flex flex-col gap-4 rounded-2xl border border-white/10 bg-white/5 p-5 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center gap-4">
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-lime-400/20 text-xl">🎫</span>
                <div>
                    <p class="font-semibold">{{ $r->destinasiWisata->nama }}</p>
                    <p class="text-xs text-white/50">{{ $r->tanggal_kunjungan->format('d M Y') }} · {{ $r->jumlah_tiket }} tiket</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-lime-300">Rp {{ number_format($r->total_harga, 0, ',', '.') }}</p>
                    <span class="text-[10px] font-bold uppercase tracking-wider {{ $r->status === 'menunggu' ? 'text-yellow-300' : ($r->status === 'dikonfirmasi' ? 'text-lime-300' : 'text-red-400') }}">
                        ● {{ $r->status }}
                    </span>
                </div>

                <form method="POST" action="{{ route('reservasi.destroy', $r->id) }}" onsubmit="return confirm('Batalkan reservasi ini?')">
                    @csrf @method('delete')
                    <button class="text-[11px] font-semibold text-red-400 transition hover:text-red-300">Batalkan</button>
                </form>
            </div>
        </div>
    @empty
        <div class="rounded-2xl border border-white/10 bg-white/5 p-10 text-center text-sm text-white/50">
            Belum ada reservasi. Yuk booking wisata pertamamu! 
        </div>
    @endforelse
</div>
@endsection