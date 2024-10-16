<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 1, 
                'pembeli' => 'Steven',
                'penjualan_kode' => 'A1',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 2,
                'pembeli' => 'Bagus',
                'penjualan_kode' => 'A2',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3, 
                'pembeli' => 'Rian',
                'penjualan_kode' => 'A3',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 1,
                'pembeli' => 'Putra',
                'penjualan_kode' => 'A4',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 2,
                'pembeli' => 'Andi',
                'penjualan_kode' => 'A5',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Putr',
                'penjualan_kode' => 'A6',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 1,
                'pembeli' => 'Vina',
                'penjualan_kode' => 'A7',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 2,
                'pembeli' => 'Aulia',
                'penjualan_kode' => 'A8',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Bella',
                'penjualan_kode' => 'A9',
                'penjualan_tanggal' => now(),
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 1,
                'pembeli' => 'Krisna',
                'penjualan_kode' => 'A10',
                'penjualan_tanggal' => now(),
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}