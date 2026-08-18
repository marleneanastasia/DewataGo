<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DestinasiWisata;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $destinasis = DestinasiWisata::with('kategoriWisata')->latest()->get();
        return view('admin.promo.index', compact('destinasis'));
    }

    public function update(Request $request, DestinasiWisata $destinasi)
    {
        $request->validate(['diskon' => 'nullable|integer|min:0|max:90']);

        $destinasi->update([
            'diskon'   => $request->diskon ?: null,
            'unggulan' => $request->has('unggulan'),
        ]);

        return back()->with('success', 'Promo diperbaru');
    }
}