<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\Transaksi_Detail;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\ImagickEscposImage;

class DashboardPegawai extends Controller
{
    public function index()
    {
        // Printing::printers();
        // echo "TRIANA <3"; exit;
        $kategoris = Kategori::get();
        $produks = Produk::with('kategori')->orderBy('stok', 'DESC')->get();
        $transaksi_detail = Transaksi_Detail::get();
        $transaksi = Transaksi::where('status', 0)->first();
        if (!empty($transaksi)) {
            $transaksi_detail  = Transaksi_Detail::where('transaksi_id', $transaksi->id)->get();
            return view('content.pegawai.index', compact('produks', 'transaksi', 'transaksi_detail', 'kategoris'));
        }
        return view('content.pegawai.index', compact('produks', 'transaksi', 'transaksi_detail', 'kategoris'));
    }

    public function tambahTransaksi(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'jumlah_beli' => 'required|min:1|integer'
            ],
            [
                'jumlah_beli.required' => 'Harus Mengisi Jumlah Beli',
                'jumlah_beli.min' => 'Minimal Jumlah Beli Tidak Boleh Kurang Dari 1',
            ]
        );

        $produk = Produk::find($id);

        //Validasi Apakah Melebihi Stok
        if ($request->jumlah_beli > $produk->stok) {
            alert()->error('Melebihi Batas Stok !', 'Error');
            return redirect()->route('kasir');
        }

        //Cek Validasi
        $cekTransaksi = Transaksi::where('pegawai_id', Auth::guard('pegawai')->user()->id)->where('status', 0)->first();
        //Simpan Ke Database Transaksi
        if (empty($cekTransaksi)) {
            $transaksi = new Transaksi;
            $transaksi->pegawai_id    = Auth::guard('pegawai')->user()->id;
            $transaksi->status        = 0;
            $transaksi->jumlah_harga  = 0;
            $transaksi->save();
        }

        //Simpan Ke Database Transaksi_Detail
        $transaksiBaru = Transaksi::where('pegawai_id', Auth::guard('pegawai')->user()->id)->where('status', 0)->first();

        //Cek Transaksi Detail
        $cekTransaksiDetail = Transaksi_Detail::where('produk_id', $produk->id)->where('transaksi_id', $transaksiBaru->id)->first();
        if (empty($cekTransaksiDetail)) {
            $transaksi_detail = new Transaksi_Detail;
            $transaksi_detail->produk_id      = $produk->id;
            $transaksi_detail->transaksi_id   = $transaksiBaru->id;
            $transaksi_detail->jumlah_beli    = $request->jumlah_beli;
            $transaksi_detail->jumlah_harga   = $produk->harga * $request->jumlah_beli;
            $transaksi_detail->save();
        } else {
            $transaksi_detail = Transaksi_Detail::where('produk_id', $produk->id)->where('transaksi_id', $cekTransaksi->id)->first();
            if ($transaksi_detail->jumlah_beli + $request->jumlah_beli > $produk->stok) {
                alert()->error('Barang Yang Di Keranjang Sudah Melebihi Batas Stok ! ', 'Error');
                return redirect()->route('kasir');
            }
            $transaksi_detail->jumlah_beli          = $transaksi_detail->jumlah_beli + $request->jumlah_beli;
            //HARGA SEKARANG
            $harga_transaksi_detail_baru            = $produk->harga * $request->jumlah_beli;
            $transaksi_detail->jumlah_harga         = $transaksi_detail->jumlah_harga + $harga_transaksi_detail_baru;
            $transaksi_detail->update();
        }

        //jumlah TOTAL
        $transaksi = Transaksi::where('pegawai_id', Auth::guard('pegawai')->user()->id)->where('status', 0)->first();
        $transaksi->jumlah_harga = $transaksi->jumlah_harga + $produk->harga * $request->jumlah_beli;
        $transaksi->update();

        alert()->success('Transaksi Sukses Masuk Keranjang', 'Success');
        return redirect()->route('kasir');
    }

    public function konfirmasiTransaksi(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'uang_bayar' => 'required|min:1|numeric',
            ],
            [
                'uang_bayar.required' => 'Harus Mengisi Uang Bayar !',
                'uang_bayar.min' => 'Minimal Uang Bayar Tidak Boleh Kurang Dari 1',
                'uang_bayar.numeric' => 'Harus Pakai Nomer !',
            ]
        );

        //Validasi Apakah Melebihi Stok
        $cekTransaksi = Transaksi::where('id', $id)->where('status', 0)->first();
        if ($cekTransaksi->jumlah_harga <= 0) {
            alert()->error('Tidak Ada Produk Yang Dibeli !', 'Error');
            return redirect()->route('kasir');
        }

        $transaksi = Transaksi::find($id);
        $transaksi_detail = Transaksi_Detail::where('transaksi_id', $transaksi->id)->get();

        if ($request->uang_bayar < $transaksi->jumlah_harga) {
            alert()->error('Uang Bayar Tidak Boleh Kurang !', 'Error');
            return redirect()->route('kasir');
        }

        $transaksi = Transaksi::where('status', 0)->first();
        $transaksi->status = 1;
        $transaksi->nama_pembeli = $request->nama_pembeli;
        $transaksi->uang_bayar = $request->uang_bayar;
        $transaksi->update();

        $transaksi_detail = Transaksi_Detail::where('transaksi_id', $transaksi->id)->get();
        foreach ($transaksi_detail as $transaksi_detail) {
            $produk = Produk::where('id', $transaksi_detail->produk_id)->first();
            $produk->stok = $produk->stok - $transaksi_detail->jumlah_beli;
            $produk->update();
        }

        alert()->success('Transaksi Sudah Selesai !', 'Success');
        return redirect('konfirmasiTransaksi/' . $transaksi->id);
    }

    public function tampilKonfirmasi($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi_detail = Transaksi_Detail::where('transaksi_id', $transaksi->id)->get();

        return view('content.pegawai.konfirmasi', compact('transaksi', 'transaksi_detail'));
    }

    public function cetakPDF($id)
    {
        $transaksi = transaksi::find($id);
        $transaksi_detail = transaksi_detail::with('produk')->where('transaksi_id', $transaksi->id)->get();

        $t = array(0, 0, 380, 500);
        $pdf = PDF::loadview('content/pegawai/cetakStruk', compact('transaksi', 'transaksi_detail'))->setPaper($t);
        return $pdf->stream('cetakStruk.pdf');
        //return $pdf->stream();
    }

    public function hapusTransaksi($id)
    {
        $transaksi_detail = Transaksi_Detail::find($id);
        $transaksi = Transaksi::where('id', $transaksi_detail->transaksi->id)->first();

        $transaksi->jumlah_harga = $transaksi->jumlah_harga - $transaksi_detail->jumlah_harga;
        $transaksi->update();

        $transaksi_detail->delete();
        // if(empty($transaksi_detail)){
        //     $transaksi->delete();
        // }
        // $transaksi->delete();


        alert()->success('Berhasil Menghapus Produk', 'Success');
        return redirect()->route('kasir');
    }

    public function print(Request $request){
        $transaksi = transaksi::find($request->id);
        $transaksi_detail = transaksi_detail::select('transaksi_detail.id','transaksi_detail.jumlah_beli','transaksi_detail.jumlah_harga',
                                                'produk.nama AS produk', 'produk.harga', 'kategori.nama AS kategori')
                                                ->join('produk', 'transaksi_detail.produk_id', '=', 'produk.id')
                                                ->join('kategori', 'produk.kategori_id', '=', 'kategori.id')
                                                ->where('transaksi_id', $transaksi->id)->get();
        $connector = new WindowsPrintConnector("smb://localhost/PRINT");
		$printer = new Printer($connector);

		try {
			$tux = EscposImage::load(public_path('img/Shervie.png'), false);

            $printer -> setJustification(Printer::JUSTIFY_CENTER);
            $printer -> bitImage($tux);

            /* Name of shop */
            $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer -> text("Shervie Juice\n");
            $printer -> selectPrintMode();
            $printer -> text("Jl. Tanjung Pura 18 Ruko Kuning Pintu Ijo, Utara Perempatan SC, Indramayu\n");
            $printer -> feed();

            
            $printer -> setJustification(Printer::JUSTIFY_LEFT);
            $printer -> setEmphasis(true);
            $printer -> text("Nama Kasir   : " . Auth::guard('pegawai')->user()->nama . "\n");
            $printer -> text("No Transaksi : " . $transaksi->id . "\n");
            $printer -> text("Tanggal      : " . $transaksi->created_at . "\n");
            $printer -> text("Nama Pembeli : " . $transaksi->nama_pembeli . "\n");
            $printer -> setEmphasis(false);
            $printer -> feed();

            $printer -> text("--------------------------------\n");
            $printer -> feed();
            
            /* Items */
            foreach($transaksi_detail as $key => $r){
                $printer -> text($r->kategori.'-'.$r->produk. "\n");
                $printer -> text($r->jumlah_beli . " x Rp " . number_format($r->harga) . "\n");
                $printer -> setJustification(Printer::JUSTIFY_RIGHT);
                $printer -> text("Rp " . number_format($r->jumlah_harga)."\n");
                $printer -> setJustification(Printer::JUSTIFY_LEFT);
            }

            $printer -> setEmphasis(true);  
            $printer -> text("Total Harga : Rp " . number_format($transaksi->jumlah_harga) . "\n");
            $printer -> feed();
            $printer -> text("Uang Bayar  : Rp " . number_format($transaksi->uang_bayar) . "\n");
            $printer -> text("Kembali     : Rp " . number_format($transaksi->uang_bayar - $transaksi->jumlah_harga) . "\n");
            $printer -> setEmphasis(false);
            $printer -> text("--------------------------------\n");
            $printer -> feed();

            $printer -> setJustification(Printer::JUSTIFY_CENTER);
            $printer -> text("TERIMA KASIH ATAS KUNJUNGANNYA");
            $printer -> feed(2);

            $printer -> cut();
            $printer -> pulse();  
            echo json_encode(["status"=>200, "message"=>"Print Berhasil"]);

		} catch (Exception $e) {
			/* Images not supported on your PHP, or image file not found */
			//$printer -> text($e -> getMessage() . "\n");
            echo json_encode(["status"=>500, "message"=>$e -> getMessage()]);
		}

		$printer -> close();
    }
}