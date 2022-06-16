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
        $transaksis = TransaksiMasuk::select('id','nama_barang','kode_barang','jumlah_baik','tanggal_masuk','jumlah_hilang','jumlah_rusak','tahun_anggaran','sumber_dana','satuan')
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
            'satuan'    =>  'required',
            'merk'  =>  'required',
            'sumber_dana'   =>  'required',
        ]);
        $jumlah = count(Barang::all());
        $jumlah2 = $jumlah+1;
        $kode_barang =  date('Y-m-d').'-'.'AST'.'-'.$jumlah2;
        $barang = new TransaksiMasuk;
        $barang->kode_barang = $kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->merk = $request->merk;
        $barang->kategori = $request->kategori;
        $barang->jumlah_baik = $request->jumlah_baik;
        $barang->jumlah_hilang = $request->jumlah_hilang;
        $barang->jumlah_rusak = $request->jumlah_rusak;
        $barang->satuan = $request->satuan;
        $barang->merk = $request->merk;
        $barang->tahun_anggaran = $request->tahun_anggaran;
        $barang->tanggal_masuk = $request->tanggal_masuk;
        $barang->sumber_dana = $request->sumber_dana;
        $barang->save();

        $barang = new Barang;
        $barang->kode_barang = $kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->merk = $request->merk;
        $barang->kategori = $request->kategori;
        $barang->jumlah_baik = $request->jumlah_baik;
        $barang->jumlah_hilang = $request->jumlah_hilang;
        $barang->jumlah_rusak = $request->jumlah_rusak;
        $barang->satuan = $request->satuan;
        $barang->merk = $request->merk;
        $barang->tahun_anggaran = $request->tahun_anggaran;
        $barang->sumber_dana = $request->sumber_dana;
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
            'satuan'    =>  'required',
            'merk'  =>  'required',
            'tahun_anggaran'    =>  'required',
            'sumber_dana'   =>  'required',
        ]);

        $transaksi = TransaksiMasuk::where('id',$id)->first();
        TransaksiMasuk::where('id',$id)->update([
            'nama_barang'   =>  $request->nama_barang,
            'merk'  =>  $request->merk,
            'kategori'  =>  $request->kategori,
            'jumlah_baik' =>  $request->jumlah_baik,
            'jumlah_hilang' =>  $request->jumlah_hilang,
            'jumlah_rusak' =>  $request->jumlah_rusak,
            'jumlah_barang' =>  $request->jumlah_barang,
            'satuan'    =>  $request->satuan,
            'merk'  =>  $request->merk,
            'tahun_anggaran'    =>  $request->tahun_anggaran,
            'tanggal_masuk'    =>  $request->tanggal_masuk,
            'sumber_dana'   =>  $request->sumber_dana,
        ]);

        Barang::where('kode_barang',$transaksi->kode_barang)->update([
            'nama_barang'   =>  $request->nama_barang,
            'merk'  =>  $request->merk,
            'kategori'  =>  $request->kategori,
            'jumlah_baik' =>  $request->jumlah_baik,
            'jumlah_hilang' =>  $request->jumlah_hilang,
            'jumlah_rusak' =>  $request->jumlah_rusak,
            'satuan'    =>  $request->satuan,
            'merk'  =>  $request->merk,
            'tahun_anggaran'    =>  $request->tahun_anggaran,
            'sumber_dana'   =>  $request->sumber_dana,
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
