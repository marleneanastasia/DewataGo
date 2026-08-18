<?php

namespace App\Http\Controllers;

use App\Models\DestinasiWisata;
use App\Models\ReservasiWisata;
use Illuminate\Http\Request;

class ReservasiWisataController extends Controller
{
    public function index()
    {
        $reservasis = auth()->user()
            ->reservasiWisatas()
            ->with('destinasiWisata')
            ->latest()
            ->get();

        return view('reservasi.index', compact('reservasis'));
    }

    public function store(Request $request, DestinasiWisata $destinasi)
    {
        $data = $request->validate([
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
            'jumlah_tiket'      => 'required|integer|min:1|max:20',
        ]);

        $destinasi->reservasiWisatas()->create([
            'user_id'           => auth()->id(),
            'tanggal_kunjungan' => $data['tanggal_kunjungan'],
            'jumlah_tiket'      => $data['jumlah_tiket'],
            'total_harga'       => $data['jumlah_tiket'] * $destinasi->hargaFinal(),
            'status'            => 'menunggu',
        ]);

        return back()->with('success', 'Reservasi terkirim! Lihat di menu Reservasi 🎫');
    }

    public function destroy(ReservasiWisata $reservasi)
    {
        abort_unless($reservasi->user_id === auth()->id(), 403);

        $reservasi->delete();

        return back()->with('success', 'Reservasi dibatalkan.');
    }
}