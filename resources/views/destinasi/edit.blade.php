@extends('layouts.app')

@section('title', 'Edit Destinasi')

@section('content')
<div class="mx-auto max-w-4xl">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="font-display text-2xl font-semibold">Edit Destinasi</h2>
            <p class="text-sm text-white/50">Perbarui informasi destinasi "{{ $destinasi->nama }}".</p>
        </div>
        <a href="{{ route('destinasi.index') }}" class="text-sm text-white/60 transition hover:text-lime-300">← Kembali</a>
    </div>

    <form method="POST" action="{{ route('destinasi.update', $destinasi->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('put')

        {{-- ===== INFORMASI DASAR ===== --}}
        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <h3 class="font-display text-lg font-semibold mb-4">Informasi Dasar</h3>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Nama Destinasi</label>
                    <input type="text" name="nama" value="{{ old('nama', $destinasi->nama) }}" required
                           class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30">
                    @error('nama') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Kategori</label>
                    <select name="kategori_wisata_id" required
                            class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60 [&>option]:bg-[#04120b]">
                        @foreach ($kategoriWisatas as $kategori)
                            <option value="{{ $kategori->id }}" @selected(old('kategori_wisata_id', $destinasi->kategori_wisata_id) == $kategori->id)>{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                    @error('kategori_wisata_id') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-4">
                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $destinasi->lokasi) }}" required
                       class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30">
                @error('lokasi') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="mt-4">
                <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Deskripsi</label>
                <textarea name="deskripsi" rows="4" required
                          class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30">{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                @error('deskripsi') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- ===== HARGA & PROMO ===== --}}
        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <h3 class="font-display text-lg font-semibold mb-4">Harga & Promo</h3>

            <div class="grid gap-4 md:grid-cols-3">
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Harga Tiket (Rp)</label>
                    <input type="number" name="harga" value="{{ old('harga', $destinasi->harga) }}" required min="0"
                           class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30">
                    @error('harga') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Diskon (%)</label>
                    <input type="number" name="diskon" value="{{ old('diskon', $destinasi->diskon ?? 0) }}" min="0" max="90"
                           class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white outline-none transition focus:border-lime-300/60 focus:ring-2 focus:ring-lime-300/30">
                    @error('diskon') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Status</label>
                    <label class="flex cursor-pointer items-center gap-2 pt-2">
                        <input type="checkbox" name="unggulan" value="1" @checked(old('unggulan', $destinasi->unggulan))
                               class="h-4 w-4 rounded border-white/20 bg-white/10 text-lime-400 focus:ring-lime-300">
                        <span class="text-sm text-white/70">Destinasi Unggulan</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- ===== GAMBAR: LINK / UPLOAD ===== --}}
        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 class="font-display text-lg font-semibold">Gambar Destinasi</h3>

                {{-- Tab switcher --}}
                <div class="flex rounded-lg bg-black/30 p-1">
                    <button type="button" id="tab-link" onclick="switchTab('link')"
                            class="rounded-md px-3 py-1.5 text-xs font-semibold transition"> Pakai Link</button>
                    <button type="button" id="tab-upload" onclick="switchTab('upload')"
                            class="rounded-md px-3 py-1.5 text-xs font-semibold transition"> Upload File</button>
                </div>
            </div>

            {{-- Badge keterangan --}}
            <div class="mb-5 flex flex-wrap gap-2 text-[11px]">
                <span class="rounded-full bg-white/10 px-3 py-1 text-white/60"> File: JPG / JPEG / PNG</span>
                <span class="rounded-full bg-white/10 px-3 py-1 text-white/60"> Ukuran maksimal 2MB</span>
                <span class="rounded-full bg-white/10 px-3 py-1 text-white/60">Link: wajib diawali https://</span>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    {{-- Panel LINK --}}
                    <div id="panel-link">
                        <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-white/70">Link Gambar (URL)</label>
                        <input type="url" name="gambar_link" value="{{ old('gambar_link', str_starts_with($destinasi->gambar, 'http') ? $destinasi->gambar : '') }}"
                               placeholder="https://images.unsplash.com/..."
                               oninput="previewFromLink(this.value)"
                               class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-2.5 text-sm text-white placeholder-white/40 outline-none transition focus:border-lime-300/60">
                        @error('gambar_link') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                        <p class="mt-2 text-xs text-white/40"> Tips: klik kanan gambar di Google/Unsplash → "Copy image address"</p>
                    </div>

                    {{-- Panel UPLOAD --}}
                    <div id="panel-upload" class="hidden">
                        
                        {{-- Kotak Upload --}}
                        <div id="upload-box">
                            <input type="file" name="gambar" id="gambarInput" accept="image/jpeg,image/jpg,image/png"
                                   class="hidden" onchange="previewFromFile(event)">
                            <label for="gambarInput"
                                   class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-white/20 bg-white/5 py-10 transition hover:border-lime-300/50 hover:bg-white/10">
                                <svg class="mb-3 h-10 w-10 text-white/40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                </svg>
                                <span class="text-sm text-white/60">Klik untuk ganti gambar</span>
                                <span class="mt-1 text-xs text-white/40">Kosongkan jika tidak ingin diganti</span>
                            </label>
                            @error('gambar') <p class="mt-2 text-xs text-red-400">{{ $message }}</p> @enderror
                        </div>

                        {{-- Info File Terpilih --}}
                        <div id="file-info" class="hidden rounded-xl border border-lime-300/30 bg-lime-400/10 p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <svg class="h-8 w-8 text-lime-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-semibold text-white" id="file-name">nama-file.jpg</p>
                                        <p class="text-xs text-white/50" id="file-size">0 MB</p>
                                    </div>
                                </div>
                                <button type="button" onclick="resetFileInput()" 
                                        class="rounded-lg bg-red-500/20 px-3 py-1.5 text-xs font-semibold text-red-300 transition hover:bg-red-500 hover:text-white">
                                    Ganti Foto
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Preview --}}
                <div>
                    <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-white/70">Preview</p>
                    <div class="h-48 overflow-hidden rounded-xl border border-white/10 bg-black/30">
                        <img id="imagePreview"
                             src="{{ $destinasi->gambar && !str_starts_with($destinasi->gambar, 'http') ? asset('storage/' . $destinasi->gambar) : ($destinasi->gambar ?? 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=800&q=60') }}"
                             alt="Preview" class="h-full w-full object-cover transition-opacity duration-300">
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== TOMBOL AKSI ===== --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('destinasi.index') }}"
               class="rounded-lg border border-white/10 px-6 py-2.5 text-sm font-semibold text-white/70 transition hover:bg-white/5">Batal</a>
            <button type="submit"
                    class="rounded-lg bg-gradient-to-r from-lime-400 to-emerald-400 px-6 py-2.5 text-sm font-bold uppercase tracking-widest text-black transition hover:brightness-110">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const PLACEHOLDER = 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=800&q=60';

    function switchTab(tab) {
        const isLink = tab === 'link';
        document.getElementById('panel-link').classList.toggle('hidden', !isLink);
        document.getElementById('panel-upload').classList.toggle('hidden', isLink);

        // styling tab aktif
        const tl = document.getElementById('tab-link'), tu = document.getElementById('tab-upload');
        tl.className = 'rounded-md px-3 py-1.5 text-xs font-semibold transition ' + (isLink ? 'bg-lime-400 text-black' : 'text-white/60 hover:text-white');
        tu.className = 'rounded-md px-3 py-1.5 text-xs font-semibold transition ' + (!isLink ? 'bg-lime-400 text-black' : 'text-white/60 hover:text-white');

        // kosongkan input sisi lainnya
        if (isLink) resetFileInput();
        else document.querySelector('input[name="gambar_link"]').value = '';
    }

    function previewFromLink(val) {
        const img = document.getElementById('imagePreview');
        img.src = val || PLACEHOLDER;
        img.classList.remove('opacity-60');
        img.classList.add('opacity-100');
    }

    function previewFromFile(event) {
        const file = event.target.files[0];
        if (!file) return;

        // Cek ukuran maksimal 2MB
        if (file.size > 2 * 1024 * 1024) {
            alert(' Ukuran gambar maksimal 2MB! Gambar kamu: ' + (file.size / 1024 / 1024).toFixed(2) + 'MB');
            event.target.value = '';
            return;
        }

        // Tampilkan info file & sembunyikan kotak upload
        document.getElementById('file-name').textContent = file.name;
        document.getElementById('file-size').textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
        document.getElementById('upload-box').classList.add('hidden');
        document.getElementById('file-info').classList.remove('hidden');

        // Update preview image
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('imagePreview');
            img.src = e.target.result;
            img.classList.remove('opacity-60');
            img.classList.add('opacity-100');
        };
        reader.readAsDataURL(file);
    }

    function resetFileInput() {
        document.getElementById('gambarInput').value = '';
        document.getElementById('upload-box').classList.remove('hidden');
        document.getElementById('file-info').classList.add('hidden');

        const img = document.getElementById('imagePreview');
        img.src = PLACEHOLDER;
        img.classList.add('opacity-60');
        img.classList.remove('opacity-100');
    }

    // Default: cek gambar saat ini, kalau link aktifkan tab link, kalau file aktifkan tab upload
    const currentSrc = document.getElementById('imagePreview').src;
    if (currentSrc && currentSrc.includes('http') && !currentSrc.includes('storage')) {
        switchTab('link');
        document.querySelector('input[name="gambar_link"]').value = currentSrc;
    } else {
        switchTab('upload');
    }
</script>
@endpush
@endsection