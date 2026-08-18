@extends('layouts.app')

@section('title', 'Admin — User')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="font-display text-2xl font-semibold">Kelola User</h2>
        <p class="text-sm text-white/50">Angkat admin baru atau hapus pengguna.</p>
    </div>

    @if (session('success'))
        <div class="rounded-lg border border-lime-300/40 bg-lime-400/20 px-4 py-3 text-sm text-lime-200">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto rounded-2xl border border-white/10 bg-white/5">
        <table class="w-full min-w-[640px] text-left text-sm">
            <thead class="border-b border-white/10 text-[11px] uppercase tracking-wider text-white/50">
                <tr>
                    <th class="px-5 py-4">User</th>
                    <th class="px-5 py-4">Role</th>
                    <th class="px-5 py-4">Reservasi</th>
                    <th class="px-5 py-4">Bergabung</th>
                    <th class="px-5 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach ($users as $u)
                <tr class="transition hover:bg-white/5">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-lime-400 text-sm font-bold text-black">{{ strtoupper(substr($u->name, 0, 1)) }}</span>
                            <div>
                                <p class="font-semibold">{{ $u->name }} @if ($u->id === auth()->id()) <span class="text-[10px] text-lime-300">(kamu)</span> @endif</p>
                                <p class="text-xs text-white/40">{{ $u->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <span class="rounded-full px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider {{ $u->role === 'admin' ? 'bg-lime-400/20 text-lime-300' : 'bg-white/10 text-white/60' }}">{{ $u->role }}</span>
                    </td>
                    <td class="px-5 py-4">{{ $u->reservasi_wisatas_count }}</td>
                    <td class="px-5 py-4 text-white/50">{{ $u->created_at->format('d M Y') }}</td>
                    <td class="px-5 py-4">
                        <div class="flex justify-end gap-2">
                            @if ($u->id !== auth()->id())
                               @if ($u->role === 'admin')
    <form method="POST" action="{{ route('admin.user.role', $u->id) }}">
        @csrf @method('patch')
        <button class="rounded-md bg-red-500/20 px-2.5 py-1.5 text-xs font-semibold text-red-300 transition hover:bg-red-500 hover:text-white">
            Batalkan Admin
        </button>
    </form>
@else
    <form method="POST" action="{{ route('admin.user.role', $u->id) }}">
        @csrf @method('patch')
        <button class="rounded-md bg-lime-400/20 px-2.5 py-1.5 text-xs font-semibold text-lime-300 transition hover:bg-lime-400 hover:text-black">
            Jadikan Admin
        </button>
    </form>
@endif
                                <form method="POST" action="{{ route('admin.user.destroy', $u->id) }}" onsubmit="return confirm('Hapus user ini?')">
                                    @csrf @method('delete')
                                    <button class="rounded-md bg-white/10 px-2.5 py-1.5 text-red-400 hover:bg-red-500 hover:text-white">🗑</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection