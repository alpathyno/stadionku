<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kursi;
use App\Models\Stadion;

class KursiSeeder extends Seeder
{
    public static function generateForStadion(int $id_stadion): void
    {
        $zones = [
            'VIP'      => ['prefix' => 'VIP', 'tribun' => 'Utama',            'rows' => ['A','B','C','D'],         'cols' => 10],
            'Tribune'  => ['prefix' => 'TRB', 'tribun' => 'Barat & Timur',    'rows' => ['A','B','C','D','E'],      'cols' => 12],
            'Economy'  => ['prefix' => 'ECO', 'tribun' => 'Utara & Selatan',  'rows' => ['A','B','C','D','E','F'],  'cols' => 14],
        ];

        $data = [];
        $now  = now();

        foreach ($zones as $kategori => $z) {
            foreach ($z['rows'] as $row) {
                for ($i = 1; $i <= $z['cols']; $i++) {
                    $data[] = [
                        'id_stadion'  => $id_stadion,
                        'nomor_kursi' => $z['prefix'] . '-' . $row . '-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                        'tribun'      => $z['tribun'],
                        'kategori'    => $kategori,
                        'status'      => 'Tersedia',
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ];
                }
            }
        }

        Kursi::insert($data);
    }

    public function run(): void
    {
        // Generate untuk semua stadion yang belum punya kursi
        Stadion::all()->each(function ($stadion) {
            $sudahAda = Kursi::where('id_stadion', $stadion->id_stadion)->exists();
            if (!$sudahAda) {
                self::generateForStadion($stadion->id_stadion);
            }
        });
    }
}