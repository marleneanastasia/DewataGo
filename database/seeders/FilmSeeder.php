<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan baris ini

class FilmSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('films')->insert([
            [
                'judul' => 'The Last Journey',
                'deskripsi' => 'Sebuah perjalanan epik melintasi dunia pasca-apokaliptik yang penuh dengan bahaya.',
                'url_video' => 'https://www.youtube.com/embed/hCOllAfD8Qc?si=EANj0ZcXuYQs48DF',
                'poster' => 'https://donasi.showcdnx.com/stopjudi/5.jpg',
                'genre' => 'Action',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Kamu bisa tambah film kedua, ketiga, dst di sini kalau mau
        ]);
    }
}