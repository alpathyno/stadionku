<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertandingan extends Model
{
    protected $table = 'pertandingan';
    protected $primaryKey = 'id_pertandingan';

    protected $fillable = [
        'id_stadion',
        'tim_tuan_rumah',
        'logo_tuan_rumah',
        'tim_tamu',
        'logo_tamu',
        'tanggal_pertandingan',
        'jam_mulai',
        'status',
        'harga_min',
    ];

    public function stadion()
    {
        return $this->belongsTo(Stadion::class, 'id_stadion');
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class, 'id_pertandingan');
    }
}