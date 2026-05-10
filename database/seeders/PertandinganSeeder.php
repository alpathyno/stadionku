<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pertandingan;

class PertandinganSeeder extends Seeder
{
    public function run(): void
    {
        $pertandingan = [
            [
                'id_stadion'           => 1,
                'tim_tuan_rumah'       => 'FC Barcelona',
                'tim_tamu'             => 'Atletico Madrid',
                'tanggal_pertandingan' => '2025-04-22',
                'jam_mulai'            => '03:00:00',
                'status'               => 'Selesai',
                'harga_min'            => 2000000,
            ],
            [
                'id_stadion'           => 2,
                'tim_tuan_rumah'       => 'Real Madrid',
                'tim_tamu'             => 'Bayern Munich',
                'tanggal_pertandingan' => '2025-04-22',
                'jam_mulai'            => '00:45:00',
                'status'               => 'Selesai',
                'harga_min'            => 2500000,
            ],
            [
                'id_stadion'           => 3,
                'tim_tuan_rumah'       => 'Arsenal',
                'tim_tamu'             => 'Sporting Lisbon',
                'tanggal_pertandingan' => '2025-04-23',
                'jam_mulai'            => '00:45:00',
                'status'               => 'Dijual',
                'harga_min'            => 2000000,
            ],
            [
                'id_stadion'           => 4,
                'tim_tuan_rumah'       => 'PSG',
                'tim_tamu'             => 'Liverpool',
                'tanggal_pertandingan' => '2025-04-23',
                'jam_mulai'            => '03:00:00',
                'status'               => 'Dijual',
                'harga_min'            => 2500000,
            ],
        ];

        foreach ($pertandingan as $p) {
            Pertandingan::create($p);
        }
    }
}