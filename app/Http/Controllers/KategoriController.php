<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Throwable;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::All();
        return view('content.pemilik.kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama' => 'required|min:3|regex:/^[\pL\s\-]+$/u|unique:kategori,nama',
            ],
            [
                'nama.required' => 'Nama Tidak Boleh Kosong !',
                'nama.min' => 'Minimal 3 Karakter !',
                'nama.regex' => 'Nama Tidak Valid !',
                'nama.unique' => 'Nama Kategori Sudah Ada !',
            ]
        );

        $kategori = new Kategori();
        $kategori->nama = ucwords($request->nama);
        $kategori->save();

        alert()->success('Data Berhasil Di Tambah !', 'Success');
        return redirect()->route('kategori.index');
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'nama' => 'required|min:4|regex:/^[\pL\s\-]+$/u',
            ],
            [
                'nama.required' => 'Harus Mengisi Bagian Nama !',
                'nama.min' => 'Minimal 4 Karakter !',
                'nama.regex' => 'Inputan Nama Tidak Valid !',
            ]
        );

        Kategori::where('id', $id)
            ->update([
                'nama' => ucwords($request->nama),
            ]);

        alert()->success('Data Berhasil Di Update !', 'Success');
        return redirect()->route('kategori.index');
    }

    public function destroy($id)
    {
        try{
            Kategori::find($id)->delete();

            alert()->success('Data Terhapus', 'Deleted');
            return redirect()->route('kategori.index');
        }catch (Throwable $e) {

            alert()->error('Data Tidak Dapat Dihapus Karena Relasi RESCRICT', 'Error');
            return redirect()->route('kategori.index');
        }
    }
}
