<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'         => 'GT3 RS',
                'description'  => 'Sportcar track-ready dengan aerodinamika aktif dan performa tanpa kompromi. Dibuat untuk sirkuit, legal untuk jalan raya.',
                'price'        => 11900000000,
                'segment'      => 'sportcar',
                'image'        => 'img/cars/gt3-rs.png',
                'power'        => '525 PS',
                'acceleration' => '3,2 detik',
                'top_speed'    => '296 km/jam',
                'seats'        => '2 kursi',
                'drivetrain'   => 'RWD',
            ],
            [
                'name'         => 'Macan',
                'description'  => 'SUV kompak yang lincah dengan karakter sporty. Nyaman untuk harian, tetap responsif saat jalan menikung.',
                'price'        => 1900000000,
                'segment'      => 'suv',
                'image'        => 'img/cars/macan.png',
                'power'        => '265 PS',
                'acceleration' => '6,2 detik',
                'top_speed'    => '232 km/jam',
                'seats'        => '5 kursi',
                'drivetrain'   => 'AWD',
            ],
            [
                'name'         => 'Panamera',
                'description'  => 'Sedan mewah dengan kabin luas dan kenyamanan kelas atas, tanpa kehilangan sensasi berkendara sebuah sportcar.',
                'price'        => 3500000000,
                'segment'      => 'sedan',
                'image'        => 'img/cars/panamera.png',
                'power'        => '353 PS',
                'acceleration' => '5,1 detik',
                'top_speed'    => '272 km/jam',
                'seats'        => '4 kursi',
                'drivetrain'   => 'RWD',
            ],
        ];

        foreach ($products as $item) {
            Product::updateOrCreate(
                ['name' => $item['name']], // kunci pencarian, mencegah data dobel
                $item
            );
        }

        // Cayenne dari data awal diganti Macan sebagai kategori SUV
        Product::where('name', 'Cayenne')->delete();
    }
}
