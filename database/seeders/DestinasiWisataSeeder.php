<?php

namespace Database\Seeders;

use App\Models\DestinasiWisata;
use App\Models\KategoriWisata;
use Illuminate\Database\Seeder;

class DestinasiWisataSeeder extends Seeder
{
    public function run(): void
    {
        $alam    = KategoriWisata::firstOrCreate(['nama' => 'Alam'])->id;
        $budaya  = KategoriWisata::firstOrCreate(['nama' => 'Budaya'])->id;
        $pantai  = KategoriWisata::firstOrCreate(['nama' => 'Pantai'])->id;
        $kuliner = KategoriWisata::firstOrCreate(['nama' => 'Kuliner'])->id;

        $data = [
            ['kategori_wisata_id' => $alam,   'nama' => 'Terasering Tegallalang', 'lokasi' => 'Ubud, Gianyar',   'harga' => 25000,  'diskon' => null, 'unggulan' => true,  'gambar' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=70', 'deskripsi' => 'Hamparan sawah terasering ikonik di Ubud dengan pemandangan hijau yang menakjubkan dan spot foto terbaik.'],
            ['kategori_wisata_id' => $budaya, 'nama' => 'Pura Tanah Lot',         'lokasi' => 'Tabanan',         'harga' => 50000,  'diskon' => 20,   'unggulan' => true,  'gambar' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=70', 'deskripsi' => 'Pura legendaris di tengah laut dengan sunset paling romantis di Bali.'],
            ['kategori_wisata_id' => $budaya, 'nama' => 'Gerbang Lempuyang',      'lokasi' => 'Karangasem',      'harga' => 100000, 'diskon' => null, 'unggulan' => true,  'gambar' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=70', 'deskripsi' => 'Gates of Heaven, gerbang pura dengan latar Gunung Agung yang megah dan fotogenik.'],
            ['kategori_wisata_id' => $alam,   'nama' => 'Gunung Batur Sunrise',   'lokasi' => 'Kintamani, Bangli','harga' => 350000,'diskon' => 30,   'unggulan' => true,  'gambar' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=70', 'deskripsi' => 'Trekking seru menuju puncak untuk menyaksikan sunrise di atas lautan awan.'],
            ['kategori_wisata_id' => $pantai, 'nama' => 'Pantai Kuta',            'lokasi' => 'Badung',          'harga' => 0,      'diskon' => null, 'unggulan' => false, 'gambar' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=70', 'deskripsi' => 'Pantai paling terkenal di Bali, surganya peselancar dan penikmat sunset.'],
            ['kategori_wisata_id' => $kuliner,'nama' => 'Seafood Jimbaran',       'lokasi' => 'Jimbaran, Badung','harga' => 200000, 'diskon' => null, 'unggulan' => false, 'gambar' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1200&q=70', 'deskripsi' => 'Makan malam seafood bakar di tepi pantai sambil menikmati senja Jimbaran.'],
        ];

        foreach ($data as $item) {
            DestinasiWisata::create($item);
        }
    }
}