<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DestinasiWisata;
use App\Models\ReservasiWisata;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'destinasi'  => DestinasiWisata::count(),
            'reservasi'  => ReservasiWisata::count(),
            'menunggu'   => ReservasiWisata::where('status', 'menunggu')->count(),
            'user'       => User::count(),
            'pendapatan' => ReservasiWisata::where('status', 'dikonfirmasi')->sum('total_harga'),
        ];

        $terbaru = ReservasiWisata::with(['user', 'destinasiWisata'])->latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'terbaru'));
    }
}