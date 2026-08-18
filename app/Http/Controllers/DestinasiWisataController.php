<?php

namespace App\Http\Controllers;

use App\Models\DestinasiWisata;
use App\Models\KategoriWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinasiWisataController extends Controller
{
    public function index()
    {
        $destinasiWisatas = DestinasiWisata::with('kategoriWisata')->get();
        return view('destinasi.index', compact('destinasiWisatas'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak! Halaman ini khusus Administrator.');
        }

        $kategoriWisatas = KategoriWisata::all();
        return view('destinasi.create', compact('kategoriWisatas'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak!');
        }

        $data = $request->validate([
            'kategori_wisata_id' => 'required|exists:kategori_wisatas,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_link' => 'nullable|url|max:500',
            'unggulan' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('destinasi', 'public');
        } elseif ($request->filled('gambar_link')) {
            $data['gambar'] = $request->gambar_link;
        } else {
            $data['gambar'] = null;
        }

        $data['unggulan'] = $request->has('unggulan');

        DestinasiWisata::create($data);

        return redirect()->route('destinasi.index')->with('success', 'Destinasi wisata berhasil ditambahkan!');
    }

    public function show(DestinasiWisata $destinasi)
    {
        $destinasi->load('komens.user');
        return view('destinasi.show', compact('destinasi'));
    } 

    public function edit(DestinasiWisata $destinasi)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak!');
        }

        $kategoriWisatas = KategoriWisata::all();
        return view('destinasi.edit', compact('destinasi', 'kategoriWisatas'));
    }

    public function update(Request $request, DestinasiWisata $destinasi)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak!');
        }

        $data = $request->validate([
            'kategori_wisata_id' => 'required|exists:kategori_wisatas,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_link' => 'nullable|url|max:500',
            'unggulan' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($destinasi->gambar && !str_starts_with($destinasi->gambar, 'http')) {
                Storage::disk('public')->delete($destinasi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('destinasi', 'public');
        } elseif ($request->filled('gambar_link')) {
            $data['gambar'] = $request->gambar_link;
        }

        $data['unggulan'] = $request->has('unggulan');

        $destinasi->update($data);

        return redirect()->route('destinasi.index')->with('success', 'Destinasi wisata berhasil diperbarui!');
    }

    public function destroy(DestinasiWisata $destinasi)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Akses Ditolak!');
        }

        if ($destinasi->gambar && !str_starts_with($destinasi->gambar, 'http')) {
            Storage::disk('public')->delete($destinasi->gambar);
        }

        $destinasi->delete();

        return redirect()->route('destinasi.index')->with('success', 'Destinasi wisata berhasil dihapus!');
    }
}