<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kursi extends Model
{
    protected $table = 'kursi';
    protected $primaryKey = 'id_kursi';

    protected $fillable = [
        'id_stadion',
        'nomor_kursi',
        'tribun',
        'kategori',
        'status',
    ];

    public function stadion()
    {
        return $this->belongsTo(Stadion::class, 'id_stadion');
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class, 'id_kursi');
    }
}