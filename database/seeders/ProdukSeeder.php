<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produk::create([
            'nama' => 'Panci',
            'kategori_id' => '1',
            'supplier_id' => '1',
            'stok' => '5',
            'stok_masuk' => '5',
            'harga' => '50000',
        ]);
        Produk::create([
            'nama' => 'Wajan',
            'supplier_id' => '1',
            'kategori_id' => '1',
            'stok' => '10',
            'stok_masuk' => '5',
            'harga' => '40000',
        ]);
        Produk::create([
            'nama' => 'Sapu',
            'supplier_id' => '1',
            'kategori_id' => '1',
            'stok' => '15',
            'stok_masuk' => '5',
            'harga' => '20000',
        ]);
    }
}
