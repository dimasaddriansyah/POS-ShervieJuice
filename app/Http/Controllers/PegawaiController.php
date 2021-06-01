<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Throwable;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::get();

        return view('content.pemilik.pegawai.index', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama' => 'required|min:4|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email|unique:pegawai,email',
                'alamat' => 'required|min:6',
                'password' => 'required|min:3',
                'no_hp' => 'required|min:10|numeric',
            ],
            [
                'nama.required' => 'Harus Mengisi Bagian Nama !',
                'nama.min' => 'Minimal 4 Karakter !',
                'nama.regex' => 'Inputan Nama Tidak Valid !',
                'email.required' => 'Harus Mengisi Bagian Email !',
                'email.required' => 'Email Sudah Tedaftar !',
                'alamat.required' => 'Harus Mengisi Bagian Alamat !',
                'alamat.min' => 'Minimal 6 Karakter !',
                'no_hp.required' => 'Harus Mengisi Bagian No Hp !',
                'no_hp.min' => 'Minimal 10 Karakter !',
                'no_hp.numeric' => 'Harus Pakai Nomer !',
            ]
        );
        
        $pegawai = new pegawai();
        $pegawai->nama = ucwords($request->nama);
        $pegawai->email = $request->email;
        $pegawai->password = bcrypt($request->password);
        $pegawai->alamat = ucwords($request->alamat);
        $pegawai->no_hp = $request->no_hp;
        $pegawai->save();

        alert()->success('Data Berhasil Ditambah !', 'Success');
        return redirect()->route('pegawai.index');
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'nama' => 'required|min:4|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email|unique:pegawai,email,' . $id,
                'alamat' => 'required|min:6',
                'no_hp' => 'required|min:10|numeric',
            ],
            [
                'nama.required' => 'Harus Mengisi Bagian Nama !',
                'nama.min' => 'Minimal 4 Karakter !',
                'nama.regex' => 'Inputan Nama Tidak Valid !',
                'email.required' => 'Harus Mengisi Bagian Email !',
                'alamat.required' => 'Harus Mengisi Bagian Alamat !',
                'alamat.min' => 'Minimal 6 Karakter !',
                'no_hp.required' => 'Harus Mengisi Bagian No Hp !',
                'no_hp.min' => 'Minimal 10 Karakter !',
                'no_hp.numeric' => 'Harus Pakai Nomer !',
            ]
        );
        pegawai::where('id', $id)
            ->update([
                'nama' => ucwords($request->nama),
                'email' => $request->email,
                'alamat' => ucwords($request->alamat),
                'no_hp' => $request->no_hp,
            ]);

        alert()->success('Data Berhasil Di Update', 'Success');
        return redirect()->route('pegawai.index');
    }
    public function destroy($id)
    {
        try {
            Pegawai::find($id)->delete();

            alert()->success('Data Terhapus', 'Deleted');
            return redirect()->route('pegawai.index');
        } catch (Throwable $e) {

            alert()->error('Data Tidak Dapat Dihapus Karena Relasi RESCRICT', 'Error');
            return redirect()->route('pegawai.index');
        }
    }
}
