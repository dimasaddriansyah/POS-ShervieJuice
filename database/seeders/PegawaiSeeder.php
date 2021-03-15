<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pegawai::create([
            'nama' => 'Pegawai Shervie',
            'email' => 'pegawai@gmail.com',
            'password' => bcrypt('pegawai'),
            'alamat' => 'Indramayu',
            'no_hp' => '08899331122'
        ]);
        Pegawai::create([
            'nama' => 'Triana Dyah P',
            'email' => 'triana@gmail.com',
            'password' => bcrypt('triana'),
            'alamat' => 'Indramayu',
            'no_hp' => '08299331124'
        ]);
        Pegawai::create([
            'nama' => 'Ayunda Riyanti',
            'email' => 'ayunda@gmail.com',
            'password' => bcrypt('ayunda'),
            'alamat' => 'Cirebon',
            'no_hp' => '08899331152'
        ]);
    }
}
