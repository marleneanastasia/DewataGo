@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">

    {{-- Kategori pill --}}
    <div class="scrollbar-hide flex gap-3 overflow-x-auto pb-1">
        <a href="{{ route('dashboard', array_filter(['q' => request('q')])) }}"
           class="shrink-0 rounded-full px-5 py-2 text-xs font-semibold uppercase tracking-wider transition-all duration-300 {{ !request('kategori') ? 'bg-lime-400 text-black shadow-[0_0_20px_rgba(163,230,53,0.4)]' : 'bg-white/10 text-white/70 hover:bg-white/20 hover:text-white' }}">
            Semua
        </a>
        @foreach ($kategoris as $k)
            <a href="{{ route('dashboard', array_filter(['kategori' => $k->id, 'q' => request('q')])) }}"
               class="shrink-0 rounded-full px-5 py-2 text-xs font-semibold uppercase tracking-wider transition-all duration-300 {{ request('kategori') == $k->id ? 'bg-lime-400 text-black shadow-[0_0_20px_rgba(163,230,53,0.4)]' : 'bg-white/10 text-white/70 hover:bg-white/20 hover:text-white' }}">
                {{ $k->nama }}
            </a>
        @endforeach
    </div>

    {{-- Banner unggulan / diskon --}}
    @if ($featured->count())
        <div class="relative h-72 overflow-hidden rounded-2xl border border-white/10 md:h-80">
            @foreach ($featured as $i => $f)
                @php
                    $imgF = $f->gambar
                        ? (str_starts_with($f->gambar, 'http') ? $f->gambar : asset('storage/' . $f->gambar))
                        : 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1600&q=70';
                @endphp
                <div class="banner-slide absolute inset-0 transition-opacity duration-1000 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}">
                    <img src="{{ $imgF }}" alt="{{ $f->nama }}" class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#04120b]/95 via-[#04120b]/45 to-transparent"></div>
                    <div class="absolute inset-0 flex flex-col justify-center px-8 md:px-12">
                        @if ($f->diskon)
                            <span class="mb-3 w-fit rounded-full bg-lime-400 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-black">Diskon {{ $f->diskon }}%</span>
                        @else
                            <span class="mb-3 w-fit rounded-full border border-white/25 bg-white/15 px-3 py-1 text-[11px] font-bold uppercase tracking-wider">Wisata Unggulan</span>
                        @endif
                        <h2 class="font-display text-3xl font-bold text-white drop-shadow-lg md:text-5xl">{{ $f->nama }}</h2>
                        <p class="mt-2 max-w-xl text-sm text-white/70">{{ Str::limit($f->deskripsi, 90) }}</p>
                        <p class="mt-1 flex items-center gap-1 text-xs text-white/60">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $f->lokasi }}
                        </p>
                        <div class="mt-3 text-sm">
                            @if ($f->harga > 0)
                                @if ($f->diskon)
                                    <span class="mr-2 text-white/40 line-through">Rp {{ number_format($f->harga, 0, ',', '.') }}</span>
                                @endif
                                <span class="font-bold text-lime-300">Rp {{ number_format($f->hargaFinal(), 0, ',', '.') }}</span>
                            @else
                                <span class="font-bold text-lime-300">Gratis</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="absolute bottom-4 left-1/2 z-10 flex -translate-x-1/2 gap-2">
                @foreach ($featured as $i => $f)
                    <button type="button" data-index="{{ $i }}"
                            class="banner-dot h-2 rounded-full transition-all duration-300 {{ $i === 0 ? 'w-6 bg-lime-300' : 'w-2 bg-white/40 hover:bg-white/70' }}"></button>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Grid rekomendasi --}}
    <section>
        <h3 class="font-display mb-5 text-2xl font-semibold tracking-wide">Rekomendasi Wisata</h3>

        @if ($destinasis->isEmpty())
            <div class="rounded-2xl border border-white/10 bg-white/5 p-10 text-center text-white/50">
                Destinasi tidak ditemukan 
            </div>
        @else
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($destinasis as $d)
                    @php
                        $img = $d->gambar
                            ? (str_starts_with($d->gambar, 'http') ? $d->gambar : asset('storage/' . $d->gambar))
                            : 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=800&q=60';
                    @endphp
                    <a href="{{ route('destinasi.show', $d->id) }}"
                       class="group overflow-hidden rounded-2xl border border-white/10 bg-white/5 backdrop-blur transition-all duration-300 hover:-translate-y-1.5 hover:border-lime-300/40 hover:shadow-[0_15px_35px_-12px_rgba(163,230,53,0.35)]">
                        <div class="relative h-40 overflow-hidden">
                            <img src="{{ $img }}" alt="{{ $d->nama }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            @if ($d->diskon)
                                <span class="absolute left-3 top-3 rounded-full bg-lime-400 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-black">Promo -{{ $d->diskon }}%</span>
                            @endif
                            <span class="absolute bottom-3 right-3 rounded-full border border-white/20 bg-black/50 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider backdrop-blur">{{ $d->kategoriWisata?->nama }}</span>
                        </div>
                        <div class="p-4">
                            <h4 class="truncate font-semibold">{{ $d->nama }}</h4>
                            <p class="mt-1 text-xs leading-4 text-white/60">{{ Str::limit($d->deskripsi, 40) }}</p>
                            <p class="mt-1 flex items-center gap-1 text-[11px] text-white/40">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ Str::limit($d->lokasi, 30) }}
                            </p>
                            <div class="mt-3 border-t border-white/10 pt-3">
                                @if ($d->harga > 0)
                                    @if ($d->diskon)
                                        <span class="block text-[10px] text-white/40 line-through">Rp {{ number_format($d->harga, 0, ',', '.') }}</span>
                                    @endif
                                    <span class="text-sm font-bold text-lime-300">Rp {{ number_format($d->hargaFinal(), 0, ',', '.') }}</span>
                                @else
                                    <span class="text-sm font-bold text-lime-300">Gratis</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection

@push('scripts')
<script>
    const slides = document.querySelectorAll('.banner-slide');
    const dots = document.querySelectorAll('.banner-dot');
    let current = 0;

    function showSlide(i) {
        current = i;
        slides.forEach((s, idx) => {
            s.classList.toggle('opacity-100', idx === i);
            s.classList.toggle('opacity-0', idx !== i);
        });
        dots.forEach((d, idx) => {
            d.classList.toggle('w-6', idx === i);
            d.classList.toggle('bg-lime-300', idx === i);
            d.classList.toggle('w-2', idx !== i);
            d.classList.toggle('bg-white/40', idx !== i);
        });
    }

    if (slides.length > 1) {
        setInterval(() => showSlide((current + 1) % slides.length), 5000);
        dots.forEach(d => d.addEventListener('click', () => showSlide(+d.dataset.index)));
    }
</script>
@endpush
