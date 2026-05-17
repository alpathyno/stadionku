<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_tiket',
        'kode_booking',
        'metode_bayar',
        'bukti_bayar',
        'total_bayar',
        'tgl_transaksi',
        'status_bayar',
    ];

    public function tiket()
    {
        return $this->belongsTo(Tiket::class, 'id_tiket');
    }
}