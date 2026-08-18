@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div x-data="{ active: 'info' }" class="space-y-6">

    <div>
        <h2 class="font-display text-2xl font-semibold">Profil</h2>
        <p class="text-sm text-white/50">Kelola data diri & keamanan akun.</p>
    </div>

    {{-- Tab switcher — muncul cuma di HP --}}
    <div class="flex gap-2 lg:hidden">
        <button @click="active = 'info'"
                :class="active === 'info' ? 'bg-lime-400 text-black shadow-[0_0_15px_rgba(163,230,53,0.4)]' : 'bg-white/10 text-white/60'"
                class="flex-1 rounded-full px-4 py-2 text-[11px] font-semibold uppercase tracking-wider transition-all duration-300">
            Profil
        </button>
        <button @click="active = 'password'"
                :class="active === 'password' ? 'bg-lime-400 text-black shadow-[0_0_15px_rgba(163,230,53,0.4)]' : 'bg-white/10 text-white/60'"
                class="flex-1 rounded-full px-4 py-2 text-[11px] font-semibold uppercase tracking-wider transition-all duration-300">
            Password
        </button>
        <button @click="active = 'hapus'"
                :class="active === 'hapus' ? 'bg-red-500 text-white shadow-[0_0_15px_rgba(239,68,68,0.4)]' : 'bg-white/10 text-white/60'"
                class="flex-1 rounded-full px-4 py-2 text-[11px] font-semibold uppercase tracking-wider transition-all duration-300">
            Hapus
        </button>
    </div>

    {{-- Kartu: di HP tampil satu sesuai tab, di laptop sejajar tiga --}}
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">

        <div class="lg:block" :class="active === 'info' ? 'block' : 'hidden'">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="lg:block" :class="active === 'password' ? 'block' : 'hidden'">
            @include('profile.partials.update-password-form')
        </div>

        <div class="lg:block" :class="active === 'hapus' ? 'block' : 'hidden'">
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</div>
@endsection