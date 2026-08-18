@extends('layouts.app')

@section('title', 'Admin — Kategori')

@section('content')
<div class="mx-auto max-w-xl space-y-6">
    <h2 class="font-display text-2xl font-semibold">{{ isset($kategori) ? 'Edit Kategori' : 'Kategori Baru' }}</h2>

    <form method="POST"
          action="{{ isset($kategori) ? route('admin.kategori.update', $kategori->id) : route('admin.kategori.store') }}"
          class="space-y-4 rounded-2xl border border-white/10 bg-white/5 p-6">
        @csrf
        @if (isset($kategori)) @method('put') @endif

        <div>
            <label class="mb-1 block text-[11px] uppercase tracking-wider text-white/60">Nama Kategori</label>
            <input type="text" name="nama" value="{{ old('nama', $kategori->nama ?? '') }}" required placeholder="Contoh: Pantai"
                   class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60">
            @error('nama') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
        </div>

        <button class="w-full rounded-lg bg-gradient-to-r from-lime-400 to-emerald-400 py-2.5 text-xs font-bold uppercase tracking-widest text-black hover:brightness-110">Simpan</button>
    </form>

    <a href="{{ route('admin.kategori.index') }}" class="text-sm text-white/60 hover:text-lime-300">← Kembali</a>
</div>
@endsection