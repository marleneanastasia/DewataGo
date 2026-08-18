@extends('layouts.app')

@section('title', 'Admin — Kategori')

@section('content')
<div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="font-display text-2xl font-semibold">Kelola Kategori</h2>
            <p class="text-sm text-white/50">Kategorikan destinasi wisatamu.</p>
        </div>
        <a href="{{ route('admin.kategori.create') }}" class="rounded-lg bg-lime-400 px-4 py-2.5 text-xs font-bold uppercase tracking-widest text-black hover:brightness-110">+ Kategori Baru</a>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-lime-300/40 bg-lime-400/20 px-4 py-3 text-sm text-lime-200">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto rounded-2xl border border-white/10 bg-white/5">
        <table class="w-full min-w-[560px] text-left text-sm">
            <thead class="border-b border-white/10 text-[11px] uppercase tracking-wider text-white/50">
                <tr>
                    <th class="px-5 py-4">Nama</th>
                    <th class="px-5 py-4">Slug</th>
                    <th class="px-5 py-4">Jumlah Destinasi</th>
                    <th class="px-5 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse ($kategoris as $k)
                <tr class="transition hover:bg-white/5">
                    <td class="px-5 py-4 font-semibold">{{ $k->nama }}</td>
                    <td class="px-5 py-4 text-white/50">{{ $k->slug }}</td>
                    <td class="px-5 py-4"><span class="rounded-full bg-lime-400/20 px-2.5 py-1 text-xs font-bold text-lime-300">{{ $k->destinasi_wisatas_count }}</span></td>
                    <td class="px-5 py-4">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.kategori.edit', $k->id) }}" class="rounded-md bg-white/10 px-2.5 py-1.5 text-white/70 hover:bg-white/20">✎</a>
                            <form method="POST" action="{{ route('admin.kategori.destroy', $k->id) }}" onsubmit="return confirm('Hapus kategori? Semua destinasi di dalamnya IKUT TERHAPUS!')">
                                @csrf @method('delete')
                                <button class="rounded-md bg-white/10 px-2.5 py-1.5 text-red-400 hover:bg-red-500 hover:text-white">🗑</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-5 py-10 text-center text-white/50">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection