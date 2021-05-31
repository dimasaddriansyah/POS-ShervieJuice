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
                'icon.required' => 'Harus Mengisi Bagian Icon !'
            ]
        );


        $file = $request->file('icon');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'img/icon/';
        $file->move($tujuan_upload, $nama_file);

        $kategori = new Kategori();
        $kategori->nama = ucwords($request->nama);
        $kategori->icon = $nama_file;
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
                'icon.required' => 'Harus Mengisi Bagian Icon !'
            ]
        );

        $kategori = Kategori::find($id);
        $kategori->nama = ucwords($request->nama);
        if (empty($request->icon)) {
            $kategori->icon = $kategori->icon;
        } else {
            unlink('img/icon/' . $kategori->icon); //menghapus file lama
            $file = $request->file('icon'); // menyimpan data gambar yang diupload ke variabel $file
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move('img/icon/', $nama_file); // isi dengan nama folder tempat kemana file diupload
            $kategori->icon = $nama_file;
        }
        $kategori->save();

        alert()->success('Data Berhasil Di Update !', 'Success');
        return redirect()->route('kategori.index');
    }

    public function destroy($id)
    {
        try {
            $kategori = Kategori::find($id);
            unlink('img/icon/' . $kategori->icon); //menghapus file lama
            $kategori->delete();

            alert()->success('Data Terhapus', 'Deleted');
            return redirect()->route('kategori.index');
        } catch (Throwable $e) {

            alert()->error('Data Tidak Dapat Dihapus Karena Relasi RESCRICT', 'Error');
            return redirect()->route('kategori.index');
        }
    }
}
