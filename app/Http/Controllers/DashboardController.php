<?php

namespace App\Http\Controllers;

use App\Models\DestinasiWisata;
use App\Models\KategoriWisata;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = DestinasiWisata::with('kategoriWisata');

        if ($request->filled('q')) {
            $query->where('nama', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_wisata_id', $request->kategori);
        }

        $destinasis = $query->latest()->get();

        $featured = DestinasiWisata::with('kategoriWisata')
            ->where('unggulan', true)
            ->orWhereNotNull('diskon')
            ->get();

        $kategoris = KategoriWisata::all();

        return view('dashboard', compact('destinasis', 'featured', 'kategoris'));
    }
}  