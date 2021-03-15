<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PemilikSeeder::class);
        $this->call(PegawaiSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(ProdukSeeder::class);
    }
}
