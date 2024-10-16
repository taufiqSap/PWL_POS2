<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id' => 1,
                'supplier_kode' => 'SUP01',
                'supplier_nama' => 'Warung Duro',
                'supplier_alamat' => 'Jl. Remujung No. 11, Malang',
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => 'SUP02',
                'supplier_nama' => 'Toko Elektronik Poltek',
                'supplier_alamat' => 'Jl. Veteran No. 20, Malang',
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => 'SUP03',
                'supplier_nama' => 'Toko Pakaian',
                'supplier_alamat' => 'Jl. Ir.Soekarno No. 15, Bandung',
            ],
        ];

        DB::table('m_supplier')->insert($data);
    }
}
