@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="mx-auto max-w-4xl">
    {{-- Header --}}
    <div class="mb-10 text-center">
        <h2 class="font-display text-3xl font-bold text-white mb-3">Tentang DewataGo</h2>
        <p class="text-white/60">Platform reservasi wisata Bali terpercaya</p>
    </div>

   

    {{-- Deskripsi --}}
    <div class="rounded-2xl border border-white/10 bg-white/5 p-8 mb-6">
        <h3 class="font-display text-xl font-semibold text-lime-300 mb-4">Tentang Aplikasi</h3>
        <p class="text-white/70 leading-relaxed mb-4">
            <strong class="text-white">DewataGo</strong> adalah platform digital yang dirancang untuk memudahkan wisatawan 
            dalam menjelajahi keindahan Bali. Kami menyediakan sistem reservasi tiket wisata yang praktis, 
            aman, dan terpercaya.
        </p>
        <p class="text-white/70 leading-relaxed">
            Dengan DewataGo, Anda dapat menemukan berbagai destinasi wisata terbaik di Bali, mulai dari 
            pantai, pura, taman budaya, hingga wisata kuliner. Semua bisa dipesan dengan mudah dalam satu aplikasi.
        </p>
    </div>

    {{-- Fitur Utama --}}
    <div class="grid gap-6 md:grid-cols-2 mb-6">
        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <div class="flex items-center gap-3 mb-3">
                <svg class="h-8 w-8 text-lime-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
                <h4 class="font-display text-lg font-semibold text-white">Destinasi</h4>
            </div>
            <p class="text-sm text-white/60">Berbagai pilihan destinasi wisata unggulan di seluruh Bali</p>
        </div>

        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <div class="flex items-center gap-3 mb-3">
                <svg class="h-8 w-8 text-lime-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h4 class="font-display text-lg font-semibold text-white">Harga Terbaik</h4>
            </div>
            <p class="text-sm text-white/60">Harga kompetitif dengan berbagai promo dan diskon menarik</p>
        </div>

        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <div class="flex items-center gap-3 mb-3">
                <svg class="h-8 w-8 text-lime-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <h4 class="font-display text-lg font-semibold text-white">Aman & Terpercaya</h4>
            </div>
            <p class="text-sm text-white/60">Sistem pembayaran yang aman dan terverifikasi</p>
        </div>

        <div class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <div class="flex items-center gap-3 mb-3">
                <svg class="h-8 w-8 text-lime-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h4 class="font-display text-lg font-semibold text-white">Proses Cepat</h4>
            </div>
            <p class="text-sm text-white/60">Pemesanan tiket yang mudah dan konfirmasi instan</p>
        </div>
    </div>

    {{-- Visi Misi --}}
    <div class="rounded-2xl border border-white/10 bg-white/5 p-8 mb-6">
        <h3 class="font-display text-xl font-semibold text-lime-300 mb-4">Visi & Misi</h3>
        
        <div class="mb-6">
            <h4 class="font-semibold text-white mb-2">Visi</h4>
            <p class="text-white/70 text-sm leading-relaxed">
                Menjadi platform reservasi wisata terdepan di Bali yang memberikan pengalaman terbaik 
                bagi wisatawan dalam menjelajahi keindahan Pulau Dewata.
            </p>
        </div>

        <div>
            <h4 class="font-semibold text-white mb-2">Misi</h4>
            <ul class="text-white/70 text-sm space-y-2">
                <li class="flex items-start gap-2">
                    <span class="text-lime-300 mt-1">•</span>
                    <span>Menyediakan akses mudah ke berbagai destinasi wisata di Bali</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-lime-300 mt-1">•</span>
                    <span>Memberikan pelayanan reservasi yang profesional dan terpercaya</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-lime-300 mt-1">•</span>
                    <span>Mendukung pariwisata Bali dengan mempromosikan destinasi lokal</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-lime-300 mt-1">•</span>
                    <span>Memberikan harga yang kompetitif dan transparan</span>
                </li>
            </ul>
        </div>
    </div>

    {{-- Kontak --}}
    <div class="rounded-2xl border border-lime-300/30 bg-lime-400/10 p-8 text-center">
        <h3 class="font-display text-xl font-semibold text-white mb-2">Hubungi Kami</h3>
        <p class="text-white/60 text-sm mb-4">Ada pertanyaan? Kami siap membantu Anda</p>
        <div class="flex flex-wrap justify-center gap-4 text-sm">
            <a href="mailto:info@dewatago.com" class="text-lime-300 hover:text-lime-200 transition">
                info@dewatago.com
            </a>
            <span class="text-white/40">|</span>
            <span class="text-white/70">+62 812-3456-7890</span>
        </div>
    </div>
</div>
@endsection