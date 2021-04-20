<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Throwable;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::get();
        return view('content.pemilik.supplier.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama' => 'required|unique:supplier|min:4|regex:/^[\pL\s\-]+$/u',
                'alamat' => 'required|min:6',
                'no_hp' => 'required|min:10|numeric|unique:supplier',
            ],
            [
                'nama.required' => 'Harus Mengisi Bagian Nama !',
                'nama.min' => 'Minimal 4 Karakter !',
                'nama.unique' => 'Nama Sudah Terdaftar !',
                'nama.regex' => 'Inputan Nama Tidak Valid !',
                'alamat.required' => 'Harus Mengisi Bagian Alamat !',
                'alamat.min' => 'Minimal 6 Karakter !',
                'no_hp.required' => 'Harus Mengisi Bagian No Hp !',
                'no_hp.min' => 'Minimal 10 Karakter !',
                'no_hp.numeric' => 'Harus Pakai Nomer !',
                'no_hp.unique' => 'No Hp Sudah Terdaftar !',
            ]
        );
        $supplier = new supplier();

        $supplier->nama = ucwords($request->nama);
        $supplier->alamat = ucwords($request->alamat);
        $supplier->no_hp = $request->no_hp;
        $supplier->save();

        alert()->success('Data Berhasil Di Tambah !', 'Success');
        return redirect()->route('supplier.index');
    }


    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'nama' => 'required|min:4|regex:/^[\pL\s\-]+$/u',
                'alamat' => 'required|min:6',
                'no_hp' => 'required|min:10|numeric',
            ],
            [
                'nama.required' => 'Harus Mengisi Bagian Nama !',
                'nama.min' => 'Minimal 4 Karakter !',
                'nama.regex' => 'Inputan Nama Tidak Valid !',
                'alamat.required' => 'Harus Mengisi Bagian Alamat !',
                'alamat.min' => 'Minimal 6 Karakter !',
                'no_hp.required' => 'Harus Mengisi Bagian No Hp !',
                'no_hp.min' => 'Minimal 10 Karakter !',
                'no_hp.numeric' => 'Harus Pakai Nomer !',
            ]
        );
        Supplier::where('id', $id)
            ->update([
                'nama' => ucwords($request->nama),
                'alamat' => ucwords($request->alamat),
                'no_hp' => $request->no_hp,
            ]);

        alert()->success('Data Berhasil Di Update !', 'Success');
        return redirect()->route('supplier.index');
    }

    public function destroy($id)
    {
        try{
            Supplier::find($id)->delete();

            alert()->success('Data Terhapus', 'Deleted');
            return redirect()->route('supplier.index');
        }catch (Throwable $e) {

            alert()->error('Data Tidak Dapat Dihapus Karena Relasi RESCRICT', 'Error');
            return redirect()->route('supplier.index');
        }
    }
}
