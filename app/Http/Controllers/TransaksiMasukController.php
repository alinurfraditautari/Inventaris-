<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransaksiMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $transaksis = TransaksiMasuk::select('id','nama_barang','kode_barang','tahun_anggaran','sumber_dana','satuan','jumlah_barang')
                            ->orderBy('id','desc')
                            ->get();
        return view('operator/transaksi_masuk/index',compact('transaksis'));
    }

    public function add(){
        $barangs = Barang::all();
        return view('operator/transaksi_masuk.add',compact('barangs'));
    }

    public function post(Request $request){
        $this->validate($request,[
            'merk'  =>  'required',
            'kategori'  =>  'required',
            'jumlah_barang' =>  'required',
            'satuan'    =>  'required',
            'merk'  =>  'required',
            'sumber_dana'   =>  'required',
            'kondisi'   =>  'required',
        ]);
        $date = Carbon::now();
        $kode_barang =  Str::slug($date->toDateTimeString()).'-'.md5($date);
        $barang = new TransaksiMasuk;
        $barang->kode_barang = $kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->merk = $request->merk;
        $barang->kategori = $request->kategori;
        $barang->jumlah_barang = $request->jumlah_barang;
        $barang->satuan = $request->satuan;
        $barang->merk = $request->merk;
        $barang->tahun_anggaran = $request->tahun_anggaran;
        $barang->tanggal_masuk = $request->tanggal_masuk;
        $barang->sumber_dana = $request->sumber_dana;
        $barang->kondisi = $request->kondisi;
        $barang->save();

        $barang = new Barang;
        $barang->kode_barang = $kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->merk = $request->merk;
        $barang->kategori = $request->kategori;
        $barang->jumlah_barang = $request->jumlah_barang;
        $barang->satuan = $request->satuan;
        $barang->merk = $request->merk;
        $barang->tahun_anggaran = $request->tahun_anggaran;
        $barang->sumber_dana = $request->sumber_dana;
        $barang->kondisi = $request->kondisi;
        $barang->save();

        return redirect()->route('barang.transaksi_masuk')->with(['success' => 'Data transaksi masuk sudah ditambahkan !']);

    }
    public function edit($id){
        $transaksi = TransaksiMasuk::where('id',$id)->first();
        return view('operator/transaksi_masuk/.edit',compact('transaksi'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'nama_barang'   =>  'required',
            'merk'  =>  'required',
            'kategori'  =>  'required',
            'jumlah_barang' =>  'required',
            'satuan'    =>  'required',
            'merk'  =>  'required',
            'tahun_anggaran'    =>  'required',
            'sumber_dana'   =>  'required',
            'kondisi'   =>  'required',
        ]);

        $transaksi = TransaksiMasuk::where('id',$id)->first();
        TransaksiMasuk::where('id',$id)->update([
            'nama_barang'   =>  $request->nama_barang,
            'merk'  =>  $request->merk,
            'kategori'  =>  $request->kategori,
            'jumlah_barang' =>  $request->jumlah_barang,
            'satuan'    =>  $request->satuan,
            'merk'  =>  $request->merk,
            'tahun_anggaran'    =>  $request->tahun_anggaran,
            'tanggal_masuk'    =>  $request->tanggal_masuk,
            'sumber_dana'   =>  $request->sumber_dana,
            'kondisi'   =>  $request->kondisi,
        ]);

        Barang::where('kode_barang',$transaksi->kode_barang)->update([
            'nama_barang'   =>  $request->nama_barang,
            'merk'  =>  $request->merk,
            'kategori'  =>  $request->kategori,
            'jumlah_barang' =>  $request->jumlah_barang,
            'satuan'    =>  $request->satuan,
            'merk'  =>  $request->merk,
            'tahun_anggaran'    =>  $request->tahun_anggaran,
            'sumber_dana'   =>  $request->sumber_dana,
            'kondisi'   =>  $request->kondisi,
        ]);

        return redirect()->route('barang.transaksi_masuk')->with(['success' => 'Data Transaksi Masuk berhasil diubah !']);

    }
    public function delete($id){
        TransaksiMasuk::where('id',$id)->delete();
        $notification = array(
            'message' => 'Berhasil, data transaksi masuk berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('barang.transaksi_masuk')->with($notification);
    }

    public function cariBarang(Request $request){
        $barang = Barang::where('id',$request->barang_id)->first();
        return $barang;
    }
}
