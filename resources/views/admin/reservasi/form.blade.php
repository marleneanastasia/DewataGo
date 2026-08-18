@extends('layouts.app')

@section('title', isset($reservasi) ? 'Edit Reservasi' : 'Buat Reservasi')

@section('content')
<div class="mx-auto max-w-3xl">
    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="font-display text-2xl font-semibold">
                {{ isset($reservasi) ? 'Edit Reservasi' : 'Buat Reservasi Baru' }}
            </h2>
            <p class="text-sm text-white/50">
                {{ isset($reservasi) ? 'Perbarui data reservasi wisatawan.' : 'Isi data reservasi wisatawan berikut.' }}
            </p>
        </div>
        <a href="{{ route('admin.reservasi.index') }}" class="text-sm text-white/60 transition hover:text-lime-300">
            ← Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 md:p-8">
        <form method="POST" action="{{ isset($reservasi) ? route('admin.reservasi.update', $reservasi->id) : route('admin.reservasi.store') }}" class="space-y-6">
            @csrf
            @if (isset($reservasi))
                @method('PUT')
            @endif

            {{-- Baris 1: Wisatawan & Destinasi --}}
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">
                        Wisatawan
                    </label>
                    <select name="user_id" required
                            class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30 [&>option]:bg-[#04120b]">
                        <option value="">Pilih Wisatawan</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(isset($reservasi) && $reservasi->user_id == $user->id)>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">
                        Destinasi
                    </label>
                    <select name="destinasi_wisata_id" required
                            class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30 [&>option]:bg-[#04120b]">
                        <option value="">Pilih Destinasi</option>
                        @foreach ($destinasis as $destinasi)
                            <option value="{{ $destinasi->id }}" @selected(isset($reservasi) && $reservasi->destinasi_wisata_id == $destinasi->id)>
                                {{ $destinasi->nama }} — Rp {{ number_format($destinasi->hargaFinal(), 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('destinasi_wisata_id') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Baris 2: Tanggal & Jumlah Tiket --}}
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">
                        Tanggal Kunjungan
                    </label>
                    <input type="date" name="tanggal_kunjungan"
                           value="{{ old('tanggal_kunjungan', isset($reservasi) ? \Carbon\Carbon::parse($reservasi->tanggal_kunjungan)->format('Y-m-d') : '') }}"
                           required
                           class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30 [color-scheme:dark]">
                    @error('tanggal_kunjungan') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">
                        Jumlah Tiket
                    </label>
                    <input type="number" name="jumlah_tiket" id="jumlah_tiket" min="1" max="100"
                           value="{{ old('jumlah_tiket', $reservasi->jumlah_tiket ?? 1) }}"
                           required
                           class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30">
                    @error('jumlah_tiket') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Baris 3: Status --}}
            <div>
                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">
                    Status
                </label>
                <select name="status" required
                        class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30 [&>option]:bg-[#04120b]">
                    <option value="menunggu" @selected((old('status', $reservasi->status ?? '') == 'menunggu'))>Menunggu</option>
                    <option value="dikonfirmasi" @selected((old('status', $reservasi->status ?? '') == 'dikonfirmasi'))>Dikonfirmasi</option>
                    <option value="dibatalkan" @selected((old('status', $reservasi->status ?? '') == 'dibatalkan'))>Dibatalkan</option>
                </select>
                @error('status') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Preview Total Harga --}}
            <div class="rounded-xl border border-lime-300/30 bg-lime-400/10 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-white/60">Estimasi Total Harga</p>
                        <p class="text-[11px] text-white/40">Jumlah tiket × harga destinasi</p>
                    </div>
                    <p id="total-harga" class="text-2xl font-bold text-lime-300">
                        Rp {{ number_format(isset($reservasi) ? $reservasi->total_harga : 0, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('admin.reservasi.index') }}"
                   class="rounded-lg border border-white/10 px-6 py-2.5 text-sm font-semibold text-white/70 transition hover:bg-white/5">
                    Batal
                </a>
                <button type="submit"
                        class="rounded-lg bg-gradient-to-r from-lime-400 to-emerald-400 px-8 py-2.5 text-sm font-bold uppercase tracking-widest text-black transition hover:brightness-110 active:scale-[0.98]">
                    {{ isset($reservasi) ? 'Simpan Perubahan' : 'Buat Reservasi' }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Data harga destinasi dari PHP ke JS
    const hargaDestinasi = @json($destinasis->pluck('harga')->map(function($harga, $id) use ($destinasis) {
        $d = $destinasis->firstWhere('id', $id);
        return $d ? $d->hargaFinal() : $harga;
    }));

    const selectDestinasi = document.querySelector('select[name="destinasi_wisata_id"]');
    const inputJumlah = document.getElementById('jumlah_tiket');
    const totalEl = document.getElementById('total-harga');

    function hitungTotal() {
        const idDestinasi = selectDestinasi?.value;
        const jumlah = Math.max(1, parseInt(inputJumlah?.value) || 1);
        const harga = hargaDestinasi[idDestinasi] || 0;
        const total = harga * jumlah;

        if (totalEl) {
            totalEl.textContent = total > 0 ? 'Rp ' + total.toLocaleString('id-ID') : 'Rp 0';
        }
    }

    selectDestinasi?.addEventListener('change', hitungTotal);
    inputJumlah?.addEventListener('input', hitungTotal);

    // Hitung saat pertama kali load
    hitungTotal();
</script>
@endpush
@endsection