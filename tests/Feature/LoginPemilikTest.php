<?php

namespace Tests\Feature;

use App\Models\Pegawai;
use App\Models\Pemilik;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginPemilikTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_loginPemilikSuccess()
    {
        $this->withoutExceptionHandling();
        $response = $this->followingRedirects()->post(route('loginPost'), [
            'email' => 'dimas@gmail.com',
            'password' => 'dimas',
        ]);
        // $response = $this->get('adminDashboard');
        $response->assertStatus(200);
    }

    public function test_loginPemilikFailed()
    {
        $this->withoutExceptionHandling();
        $response = $this->followingRedirects()->post(route('loginPost'), [
            'email' => 'dimas@gmail.com',
            'password' => '',
        ]);
        // $response = $this->get('adminDashboard');
        $response->assertStatus(500);
    }
}
