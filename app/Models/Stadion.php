<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stadion extends Model
{
    protected $table = 'stadion';
    protected $primaryKey = 'id_stadion';

    protected $fillable = [
        'nama_stadion',
        'kota',
        'kapasitas',
        'alamat',
    ];

    public function pertandingan()
    {
        return $this->hasMany(Pertandingan::class, 'id_stadion');
    }

    public function kursi()
    {
        return $this->hasMany(Kursi::class, 'id_stadion');
    }
}