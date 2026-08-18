<?php

namespace App\Http\Controllers;

use App\Models\DestinasiWisata;
use App\Models\Komen;
use Illuminate\Http\Request;

class KomenController extends Controller
{
    public function store(Request $request, DestinasiWisata $destinasi)
{
    $data = $request->validate([
        'rating' => 'required|integer|between:1,5',
        'isi'    => 'required|string|max:1000',
    ]);

    $destinasi->komens()->create([
        'user_id' => auth()->id(),
        'rating'  => $data['rating'],
        'isi'     => $data['isi'],
    ]);

    return back()->with('success', 'Ulasan kamu sudah terkirim! ⭐');
} 

    public function destroy(Komen $komen)
    {
        abort_unless($komen->user_id === auth()->id(), 403); 

        $komen->delete();

        return back()->with('success', 'Komentar dihapus.');
    }
}