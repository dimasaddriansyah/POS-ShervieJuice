<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            'nama' => 'Cipto Gudang Rabat',
            'alamat' => 'Jl. Pasar Baru Indramayu',
            'no_hp' => '089514391356'
        ]);
    }
}
