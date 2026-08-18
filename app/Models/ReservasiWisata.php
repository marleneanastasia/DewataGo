<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservasiWisata extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destinasiWisata()
    {
        return $this->belongsTo(DestinasiWisata::class);
    }
}