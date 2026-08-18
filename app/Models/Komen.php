<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komen extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destinasiWisata()
    {
        return $this->belongsTo(DestinasiWisata::class);
    }
}