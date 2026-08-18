@extends('layouts.app')

@section('title', 'Admin — Promo')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="font-display text-2xl font-semibold">Kelola Promo & Unggulan</h2>
        <p class="text-sm text-white/50">Atur diskon (%) dan tandai destinasi unggulan (tampil di banner).</p>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-lime-300/40 bg-lime-400/20 px-4 py-3 text-sm text-lime-200">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto rounded-2xl border border-white/10 bg-white/5">
        <table class="w-full min-w-[720px] text-left text-sm">
            <thead class="border-b border-white/10 text-[11px] uppercase tracking-wider text-white/50">
                <tr>
                    <th class="px-5 py-4">Destinasi</th>
                    <th class="px-5 py-4">Harga Dasar</th>
                    <th class="px-5 py-4 text-right">Diskon (%) · Unggulan · Simpan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach ($destinasis as $d)
                <tr class="transition hover:bg-white/5">
                    <td class="px-5 py-4">
                        <p class="font-semibold">{{ $d->nama }}</p>
                        <p class="text-xs text-white/40">{{ $d->kategoriWisata?->nama }}</p>
                    </td>
                    <td class="px-5 py-4 text-white/70">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                    <td class="px-5 py-4">
                        <form method="POST" action="{{ route('admin.promo.update', $d->id) }}" class="flex items-center justify-end gap-3">
                            @csrf @method('patch')
                            <div class="flex items-center gap-1">
                                <input type="number" name="diskon" min="0" max="90" value="{{ $d->diskon ?? 0 }}"
                                       class="w-20 rounded-md border border-white/15 bg-white/10 px-2 py-1.5 text-sm text-white outline-none focus:border-lime-300/60">
                                <span class="text-xs text-white/50">%</span>
                            </div>
                            <label class="flex items-center gap-1.5 text-xs text-white/60">
                                <input type="checkbox" name="unggulan" value="1" @checked($d->unggulan) class="h-4 w-4 accent-lime-400">
                                Unggulan
                            </label>
                            <button class="rounded-md bg-lime-400 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-black hover:brightness-110">Simpan</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection