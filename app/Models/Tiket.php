<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $table = 'tiket';
    protected $primaryKey = 'id_tiket';

    protected $fillable = [
        'id_pertandingan',
        'id_penonton',
        'id_kursi',
        'kode_tiket',
        'harga',
        'status_tiket',
        'tgl_pembelian',
    ];

    public function pertandingan()
    {
        return $this->belongsTo(Pertandingan::class, 'id_pertandingan');
    }

    public function penonton()
    {
        return $this->belongsTo(User::class, 'id_penonton');
    }

    public function kursi()
    {
        return $this->belongsTo(Kursi::class, 'id_kursi');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'id_tiket');
    }
}