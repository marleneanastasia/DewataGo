<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DestinasiWisata;
use App\Models\ReservasiWisata;
use App\Models\User;
use Illuminate\Http\Request;

class ReservasiAdminController extends Controller
{
    public function index()
    {
        $reservasiPerBulan = \DB::table('reservasi_wisatas')
            ->selectRaw("DATE_FORMAT(created_at, '%b %Y') as bulan, COUNT(*) as total, SUM(total_harga) as pendapatan")
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupByRaw("DATE_FORMAT(created_at, '%b %Y')")
            ->orderByRaw("MIN(created_at)")
            ->get();

        $statusData = \DB::table('reservasi_wisatas')
            ->select('status', \DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        $topDestinasi = \DB::table('reservasi_wisatas')
            ->join('destinasi_wisatas', 'reservasi_wisatas.destinasi_wisata_id', '=', 'destinasi_wisatas.id')
            ->select('destinasi_wisatas.nama', \DB::raw('COUNT(*) as total'))
            ->groupBy('destinasi_wisatas.nama')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $stats = [
            'total'        => ReservasiWisata::count(),
            'menunggu'     => ReservasiWisata::where('status', 'menunggu')->count(),
            'dikonfirmasi' => ReservasiWisata::where('status', 'dikonfirmasi')->count(),
            'dibatalkan'   => ReservasiWisata::where('status', 'dibatalkan')->count(),
            'pendapatan'   => ReservasiWisata::where('status', 'dikonfirmasi')->sum('total_harga'),
        ];

        return view('admin.reservasi.index', compact(
            'reservasiPerBulan', 'statusData', 'topDestinasi', 'stats'
        ));
    }

    public function create()
    {
        $users = User::all();
        $destinasis = DestinasiWisata::all();
        return view('admin.reservasi.form', compact('users', 'destinasis'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $destinasi = DestinasiWisata::findOrFail($data['destinasi_wisata_id']);

        ReservasiWisata::create([
            'user_id'             => $data['user_id'],
            'destinasi_wisata_id' => $data['destinasi_wisata_id'],
            'tanggal_kunjungan'   => $data['tanggal_kunjungan'],
            'jumlah_tiket'        => $data['jumlah_tiket'],
            'total_harga'         => $data['jumlah_tiket'] * $destinasi->hargaFinal(),
            'status'              => $data['status'],
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Reservasi dibuat.');
    }

    public function edit(ReservasiWisata $reservasi)
    {
        $users = User::all();
        $destinasis = DestinasiWisata::all();
        return view('admin.reservasi.form', compact('reservasi', 'users', 'destinasis'));
    }

    public function update(Request $request, ReservasiWisata $reservasi)
    {
        $data = $this->validateData($request);
        $destinasi = DestinasiWisata::findOrFail($data['destinasi_wisata_id']);

        $reservasi->update([
            'user_id'             => $data['user_id'],
            'destinasi_wisata_id' => $data['destinasi_wisata_id'],
            'tanggal_kunjungan'   => $data['tanggal_kunjungan'],
            'jumlah_tiket'        => $data['jumlah_tiket'],
            'total_harga'         => $data['jumlah_tiket'] * $destinasi->hargaFinal(),
            'status'              => $data['status'],
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Reservasi diperbarui.');
    }

    public function updateStatus(Request $request, ReservasiWisata $reservasi)
    {
        $request->validate(['status' => 'required|in:menunggu,dikonfirmasi,dibatalkan']);
        $reservasi->update(['status' => $request->status]);
        return back()->with('success', 'Status diperbarui.');
    }

    public function destroy(ReservasiWisata $reservasi)
    {
        $reservasi->delete();
        return back()->with('success', 'Reservasi dihapus permanen.');
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'user_id'             => 'required|exists:users,id',
            'destinasi_wisata_id' => 'required|exists:destinasi_wisatas,id',
            'tanggal_kunjungan'   => 'required|date',
            'jumlah_tiket'        => 'required|integer|min:1|max:100',
            'status'              => 'required|in:menunggu,dikonfirmasi,dibatalkan',
        ]);
    }
}