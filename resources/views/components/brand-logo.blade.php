@props(['href' => url('/'), 'withText' => true, 'iconSize' => 'h-10 w-10'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'group flex items-center gap-3']) }} title="DewataGo">
    {{-- Pin lokasi + garis kecepatan --}}
    <svg viewBox="0 0 64 64" class="{{ $iconSize }} drop-shadow-[0_0_12px_rgba(163,230,53,0.45)] transition-transform duration-300 group-hover:scale-110">
        <path d="M8 26h14M4 36h12" stroke="#a3e635" stroke-width="5" stroke-linecap="round"/>
        <path d="M40 6c-11 0-20 9-20 20 0 14 20 32 20 32s20-18 20-32c0-11-9-20-20-20z" fill="#a3e635"/>
        <circle cx="40" cy="26" r="8" fill="#04120b"/>
    </svg>
    @if($withText)
        <span class="text-xl font-extrabold tracking-tight text-white">
            Dewata<span class="text-lime-300">Go</span>
        </span>
    @endif
</a>