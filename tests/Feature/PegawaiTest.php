<?php

namespace Tests\Feature;

use App\Models\Pegawai;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PegawaiTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_createPegawaiSuccess()
    {
        $password = bcrypt('test');

        Pegawai::create([
            'nama'          =>  'Testing Pegawai',
            'email'         =>  'test@gmail.com',
            'password'      =>  $password,
            'alamat'        =>  'imy',
            'no_hp'         =>  '089321123321',
        ]);

        $this->assertDatabaseHas('pegawai', [
            'nama'          =>  'Testing Pegawai',
            'email'         =>  'test@gmail.com',
            'password'      =>  $password,
            'alamat'        =>  'imy',
            'no_hp'         =>  '089321123321',
        ]);
    }

    public function test_editPegawaiSuccess()
    {
        $password = bcrypt('test');

        Pegawai::create([
            'nama'          => 'Testing Pegawai',
            'email'         => 'test@gmail.com',
            'password'      => $password,
            'alamat'        => 'imy',
            'no_hp'         => '089321123321',
        ]);

        Pegawai::find(1)->update([
            'nama'          => 'Testing Update',
            'email'         => 'edittest@gmail.com',
            'password'      => $password,
            'alamat'        => 'imy',
            'no_hp'         => '089321123321',
        ]);

        $this->assertDatabaseHas('pegawai', [
            'nama'          => 'Testing Update',
            'email'         => 'edittest@gmail.com',
            'password'      => $password,
            'alamat'        => 'imy',
            'no_hp'         => '089321123321',
        ]);
    }

    public function test_pegawaiDestroy()
    {
        $password = bcrypt('test');

        Pegawai::create([
            'nama'          => 'Testing Pegawai',
            'email'         => 'test@gmail.com',
            'password'      =>  $password,
            'alamat'        => 'imy',
            'no_hp'         => '089321123321',
        ]);

        Pegawai::destroy(1);

        $this->assertDatabaseMissing('pegawai', [
            'id' => 1
        ]);
    }
}
