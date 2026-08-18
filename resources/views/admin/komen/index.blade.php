@extends('layouts.app')

@section('title', 'Admin — Ulasan')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="font-display text-2xl font-semibold">Moderasi Ulasan</h2>
        <p class="text-sm text-white/50">Hapus komentar yang tidak pantas.</p>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-lime-300/40 bg-lime-400/20 px-4 py-3 text-sm text-lime-200">{{ session('success') }}</div>
    @endif

    <div class="space-y-4">
        @forelse ($komens as $k)
        <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <p class="text-sm font-semibold">{{ $k->user->name ?? 'User terhapus' }}
                        <span class="font-normal text-white/40">di</span>
                        <span class="text-lime-300">{{ $k->destinasiWisata->nama ?? 'Destinasi terhapus' }}</span>
                    </p>
                    <p class="mt-0.5 text-[11px] text-white/40">
                        {{ $k->created_at->format('d M Y') }} ·
                        @for ($i = 1; $i <= 5; $i++)<span class="{{ $i <= $k->rating ? 'text-lime-300' : 'text-white/20' }}">★</span>@endfor
                    </p>
                    <p class="mt-2 text-sm text-white/70">{{ $k->isi }}</p>
                </div>
                <form method="POST" action="{{ route('admin.komen.destroy', $k->id) }}" onsubmit="return confirm('Hapus ulasan ini?')">
                    @csrf @method('delete')
                    <button class="rounded-md bg-white/10 px-2.5 py-1.5 text-red-400 hover:bg-red-500 hover:text-white">🗑</button>
                </form>
            </div>
        </div>
        @empty
        <div class="rounded-2xl border border-white/10 bg-white/5 p-10 text-center text-sm text-white/50">Belum ada ulasan.</div>
        @endforelse
    </div>
</div>
@endsection