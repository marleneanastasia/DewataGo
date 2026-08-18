<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Komen;

class KomenController extends Controller
{
    public function index()
    {
        $komens = Komen::with(['user', 'destinasiWisata'])->latest()->get();
        return view('admin.komen.index', compact('komens'));
    }

    public function destroy(Komen $komen)
    {
        $komen->delete();
        return back()->with('success', 'Ulasan dihapus ');
    }
}