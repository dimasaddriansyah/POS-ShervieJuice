<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProdukTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_createProdukSuccess()
    {
        // Membuat Akun Supplier
        Supplier::create([
            'nama'      => 'Testing Supplier',
            'alamat'    => 'Indramayu',
            'no_hp'     => '08912345678',
        ]);

        // Membuat Kategori Produk
        Kategori::create([
            'nama'      => 'Coffee',
            'icon'      => 'coffee.png',
        ]);

        // Membuat Produk
        Produk::create([
            'supplier_id'   => 1,
            'nama'          => 'Dark Coffee',
            'kategori_id'   => 1,
            'harga'         => 15000,
            'stok'          => 5,
            'stok_masuk'    => 1,
        ]);

        // Mengecek Apakah Ada Data Produk Di Database
        $this->assertDatabaseHas('produk', [
            'supplier_id'   => 1,
            'nama'          => 'Dark Coffee',
            'kategori_id'   => 1,
            'harga'         => 15000,
            'stok'          => 5,
            'stok_masuk'    => 1,
        ]);
    }

    public function test_editProdukSuccess()
    {
        // Membuat Akun Supplier
        Supplier::create([
            'nama'      => 'Testing Supplier',
            'alamat'    => 'Indramayu',
            'no_hp'     => '08912345678',
        ]);

        // Membuat Kategori Produk
        Kategori::create([
            'nama'      => 'Coffee',
            'icon'      => 'coffee.png',
        ]);

        // Membuat Produk
        Produk::create([
            'supplier_id'   => 1,
            'nama'          => 'Dark Coffee',
            'kategori_id'   => 1,
            'harga'         => 15000,
            'stok'          => 5,
            'stok_masuk'    => 1,
        ]);

        // Update Produk
        Produk::find(1)->update([
            'supplier_id'   => 1,
            'nama'          => 'Expresso',
            'kategori_id'   => 1,
            'harga'         => 15000,
            'stok'          => 5,
            'stok_masuk'    => 1,
        ]);

        // Mengecek Apakah Ada Data Produk Di Database
        $this->assertDatabaseHas('produk', [
            'supplier_id'   => 1,
            'nama'          => 'Expresso',
            'kategori_id'   => 1,
            'harga'         => 15000,
            'stok'          => 5,
            'stok_masuk'    => 1,
        ]);
    }

    public function test_hapusProduk()
    {
        // Membuat Akun Supplier
        Supplier::create([
            'nama'      => 'Testing Supplier',
            'alamat'    => 'Indramayu',
            'no_hp'     => '08912345678',
        ]);

        // Membuat Kategori Produk
        Kategori::create([
            'nama'      => 'Coffee',
            'icon'      => 'coffee.png',
        ]);

        // Membuat Produk
        Produk::create([
            'supplier_id'   => 1,
            'nama'          => 'Dark Coffee',
            'kategori_id'   => 1,
            'harga'         => 15000,
            'stok'          => 5,
            'stok_masuk'    => 1,
        ]);

        // Menghapus Produk
        Produk::destroy(1);

        // Mengecek Produk Di Database
        $this->assertDatabaseMissing('produk', [
            'id' => 1
        ]);
    }
}
