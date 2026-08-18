<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DestinasiWisata extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kategoriWisata()
    {
        return $this->belongsTo(KategoriWisata::class, 'kategori_wisata_id');
    }

    public function reservasiWisatas()
    {
        return $this->hasMany(ReservasiWisata::class, 'destinasi_wisata_id');
    }
    protected $casts = [
    'unggulan' => 'boolean',
];

// harga setelah diskon
public function hargaFinal()
{
    return $this->diskon
        ? (int) ($this->harga * (100 - $this->diskon) / 100)
        : (int) $this->harga;
}
public function komens()
{
    return $this->hasMany(Komen::class, 'destinasi_wisata_id');
}

// rata-rata rating, contoh: 4.5
public function rataRating()
{
    $avg = $this->komens->avg('rating');
    return $avg ? round($avg, 1) : 0;
}
/**
 * Otomatis pilih URL gambar yang benar untuk SEMUA destinasi.
 */
public function getGambarUrlAttribute(): string
{
    // Kalau kosong → gambar default
    if (!$this->gambar) {
        return 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=800&q=60';
    }

    // Kalau isinya link (http/https) → pakai langsung
    if (str_starts_with($this->gambar, 'http')) {
        return $this->gambar;
    }

    // Kalau isinya path upload → bungkus storage
    return asset('storage/' . $this->gambar);
}
}