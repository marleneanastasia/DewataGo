<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriWisata;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = KategoriWisata::withCount('destinasiWisatas')->latest()->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.form');
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:100|unique:kategori_wisatas,nama']);
        KategoriWisata::create($request->only('nama'));
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori ditambahkan ✅');
    }

    public function edit(KategoriWisata $kategori)
    {
        return view('admin.kategori.form', compact('kategori'));
    }

    public function update(Request $request, KategoriWisata $kategori)
    {
        $request->validate(['nama' => 'required|string|max:100|unique:kategori_wisatas,nama,' . $kategori->id]);
        $kategori->update($request->only('nama'));
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori diperbarui ✅');
    }

    public function destroy(KategoriWisata $kategori)
    {
        $kategori->delete();
        return back()->with('success', 'Kategori dihapus');
    }
}