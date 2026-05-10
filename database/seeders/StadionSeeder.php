<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stadion;

class StadionSeeder extends Seeder
{
    public function run(): void
    {
        $stadions = [
            [
                'nama_stadion' => 'Camp Nou',
                'kota'         => 'Barcelona, Spanyol',
                'kapasitas'    => 105000,
                'alamat'       => 'C. d\'Arístides Maillol, Barcelona, Spain',
            ],
            [
                'nama_stadion' => 'Santiago Bernabeu',
                'kota'         => 'Madrid, Spanyol',
                'kapasitas'    => 85000,
                'alamat'       => 'Av. de Concha Espina, Madrid, Spain',
            ],
            [
                'nama_stadion' => 'Emirates Stadium',
                'kota'         => 'London, Inggris',
                'kapasitas'    => 60000,
                'alamat'       => 'Holloway Rd, London, England',
            ],
            [
                'nama_stadion' => 'Parc des Princes',
                'kota'         => 'Paris, Perancis',
                'kapasitas'    => 48000,
                'alamat'       => '24 Rue du Commandant Guilbaud, Paris, France',
            ],
        ];

        foreach ($stadions as $s) {
            Stadion::create($s);
        }
    }
}