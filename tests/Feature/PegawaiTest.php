<?php

namespace Tests\Feature;

use App\Models\Pegawai;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PegawaiTest extends TestCase
{
    public function test_createPegawaiSuccess()
    {
        Pegawai::create([
            'nama' => 'Pegawai Testing',
            'email' => 'pegawaitesting@gmail.com',
            'password' => bcrypt('Pegawai Testing'),
            'alamat' => 'Indramayu',
            'no_hp' => '089123131231',
        ]);

        $this->assertDatabaseHas('pegawai', [
            'email' => 'pegawaitesting@gmail.com'
        ]);
    }
}
