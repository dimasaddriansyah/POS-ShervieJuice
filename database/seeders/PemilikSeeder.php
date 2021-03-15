<?php

namespace Database\Seeders;

use App\Models\Pemilik;
use Illuminate\Database\Seeder;

class PemilikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pemilik::create([
            'nama' => 'Dimas Addriansyah',
            'email' => 'dimas@gmail.com',
            'password' => bcrypt('dimas')
        ]);
        Pemilik::create([
            'nama' => 'pemilik',
            'email' => 'pemilik@gmail.com',
            'password' => bcrypt('pemilik')
        ]);
    }
}
