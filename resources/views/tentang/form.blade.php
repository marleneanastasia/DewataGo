@extends('layouts.app')

@section('title', 'Admin — Reservasi')

@section('content')
@php $input = 'w-full rounded-full border border-gray-200 bg-white px-5 py-3 text-sm text-gray-800 placeholder-gray-400 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20'; @endphp

<div class="mx-auto max-w-5xl">
    {{-- Card split-screen --}}
    <div class="overflow-hidden rounded-3xl shadow-2xl">
        <div class="grid md:grid-cols-2">
            
            {{-- ===== SISI KIRI: Gambar + Branding ===== --}}
            <div class="relative min-h-[400px] md:min-h-full">
                <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80" 
                     alt="Bali" 
                     class="absolute inset-0 h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/80 via-teal-800/70 to-lime-900/90"></div>
                
                <div class="relative z-10 flex h-full flex-col justify-between p-10 text-white md:p-12">
                    <div>
                        <svg viewBox="0 0 64 64" class="h-14 w-14 drop-shadow-lg">
                            <path d="M8 26h14M4 36h12" stroke="#a3e635" stroke-width="5" stroke-linecap="round"/>
                            <path d="M40 6c-11 0-20 9-20 20 0 14 20 32 20 32s20-18 20-32c0-11-9-20-20-20z" fill="#a3e635"/>
                            <circle cx="40" cy="26" r="8" fill="#04120b"/>
                        </svg>
                        <h2 class="font-display mt-6 text-4xl font-bold leading-tight">
                            Dewata<span class="text-lime-300">Go</span>
                        </h2>
                        <p class="mt-2 text-sm text-white/70">Admin Panel</p>
                    </div>

                    <div>
                        <h1 class="font-display text-4xl font-bold leading-tight md:text-5xl">
                            {{ isset($reservasi) ? 'Edit Reservasi' : 'Reservasi Baru' }}
                        </h1>
                        <p class="mt-3 text-sm text-white/70 leading-relaxed max-w-sm">
                            Kelola booking wisatawan dengan mudah. Total harga dihitung otomatis berdasarkan destinasi & jumlah tiket.
                        </p>
                        
                        <div class="mt-6 flex items-center gap-3 text-xs text-white/50">
                            <div class="h-1 w-12 rounded-full bg-lime-300"></div>
                            <span>Sistem Reservasi DewataGo</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== SISI KANAN: Form (background putih) ===== --}}
            <div class="bg-white p-8 md:p-12">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">
                        {{ isset($reservasi) ? 'Edit Data' : 'Halo! Senang melihatmu :)' }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">Total harga otomatis = jumlah tiket × harga destinasi.</p>
                </div>

                <form method="POST"
                      action="{{ isset($reservasi) ? route('admin.reservasi.update', $reservasi->id) : route('admin.reservasi.store') }}"
                      class="space-y-4">
                    @csrf
                    @if (isset($reservasi)) @method('put') @endif

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-gray-600">Wisatawan</label>
                            <select name="user_id" required class="{{ $input }}">
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}" @selected(old('user_id', $reservasi->user_id ?? null) == $u->id)>{{ $u->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-gray-600">Destinasi</label>
                            <select name="destinasi_wisata_id" required class="{{ $input }}">
                                @foreach ($destinasis as $d)
                                    <option value="{{ $d->id }}" @selected(old('destinasi_wisata_id', $reservasi->destinasi_wisata_id ?? null) == $d->id)>{{ $d->nama }}</option>
                                @endforeach
                            </select>
                            @error('destinasi_wisata_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-gray-600">Tanggal Kunjungan</label>
                        <input type="date" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan', isset($reservasi) ? $reservasi->tanggal_kunjungan->format('Y-m-d') : '') }}" required
                               class="{{ $input }}">
                        @error('tanggal_kunjungan') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-gray-600">Jumlah Tiket</label>
                            <input type="number" name="jumlah_tiket" min="1" max="100" value="{{ old('jumlah_tiket', $reservasi->jumlah_tiket ?? 1) }}" required class="{{ $input }}">
                            @error('jumlah_tiket') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-gray-600">Status</label>
                            <select name="status" required class="{{ $input }}">
                                @foreach (['menunggu', 'dikonfirmasi', 'dibatalkan'] as $s)
                                    <option value="{{ $s }}" @selected(old('status', $reservasi->status ?? 'menunggu') === $s)>{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button class="mt-4 w-full rounded-full bg-gradient-to-r from-emerald-500 to-lime-500 py-3.5 text-sm font-bold uppercase tracking-widest text-white shadow-lg transition-all duration-300 hover:shadow-emerald-500/50 hover:brightness-110 active:scale-[0.98]">
                        {{ isset($reservasi) ? 'Simpan Perubahan' : 'Buat Reservasi' }}
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('admin.reservasi.index') }}" class="text-sm text-gray-500 transition hover:text-emerald-600">← Kembali ke daftar</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection