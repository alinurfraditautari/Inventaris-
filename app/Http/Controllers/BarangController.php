<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\TransaksiKeluar;
use App\Models\TransaksiMasuk;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){
        $barang = count(Barang::all());
        $masuk = count(TransaksiMasuk::all());
        $keluar = count(TransaksiKeluar::all());
        $peminjaman = count(Peminjaman::all());

        // $grafik = Barang::select('nama_barang',DB::raw('sum(jumlah_barang) as jumlah'))
        //                     ->groupBy('nama_barang')->get();
        return view('operator/dashboard',compact('barang','masuk','keluar','peminjaman'));
    }

    public function index(){
        // $anaks = Anak::where('akNip',Auth::user()->pegNip)->get();
        $barangs = Barang::select('id','nama_barang','kode_barang','jumlah_baik','jumlah_hilang','jumlah_rusak','merk','kategori','satuan','tahun_anggaran','sumber_dana')
                            ->orderBy('id','desc')
                            ->get();
        return view('operator/barang/index',compact('barangs'));
    }

    public function add(){
        return view('operator/barang.add');
    }

    public function post(Request $request){
        $this->validate($request,[
            'nama_barang'   =>  'required',
            'merk'  =>  'required',
            'kategori'  =>  'required',
            // 'jumlah_barang' =>  'required',
            'satuan'    =>  'required',
            'merk'  =>  'required',
            'tahun_anggaran'    =>  'required',
            'sumber_dana'   =>  'required',
        ]);
        $date = Carbon::now();
        $jumlah = count(Barang::all());
        $kode = $jumlah+1;
        if ($request->kategori == "aset") {
            $kode_barang =  date('Y-m-d').'-'.'AST'.'-'.$kode;
            $barang = new Barang;
            $barang->kode_barang = $kode_barang;
            $barang->nama_barang = $request->nama_barang;
            $barang->merk = $request->merk;
            $barang->kategori = $request->kategori;
            // $barang->jumlah_barang = $request->jumlah_barang;
            $barang->satuan = $request->satuan;
            $barang->jumlah_baik = $request->jumlah_baik;
            $barang->jumlah_hilang = $request->jumlah_hilang;
            $barang->jumlah_rusak = $request->jumlah_rusak;
            $barang->merk = $request->merk;
            $barang->tahun_anggaran = $request->tahun_anggaran;
            $barang->sumber_dana = $request->sumber_dana;
            $barang->save();
        }
        else {
            $kode_barang =  date('Y-m-d').'-'.'BHP'.'-'.$kode;
            $barang = new Barang;
            $barang->kode_barang = $kode_barang;
            $barang->nama_barang = $request->nama_barang;
            $barang->merk = $request->merk;
            $barang->kategori = $request->kategori;
            // $barang->jumlah_barang = $request->jumlah_barang;
            $barang->satuan = $request->satuan;
            $barang->jumlah_baik = $request->jumlah_baik;
            $barang->jumlah_hilang = $request->jumlah_hilang;
            $barang->jumlah_rusak = $request->jumlah_rusak;
            $barang->merk = $request->merk;
            $barang->tahun_anggaran = $request->tahun_anggaran;
            $barang->sumber_dana = $request->sumber_dana;
            $barang->save();
        }
        return redirect()->route('barang')->with(['success' => 'Data barang sudah ditambahkan !']);

    }
    public function edit($id){
        $barang = Barang::where('id',$id)->first();
        return view('operator/barang/.edit',compact('barang'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'nama_barang'   =>  'required',
            'merk'  =>  'required',
            'kategori'  =>  'required',
            // 'jumlah_barang' =>  'required',
            'satuan'    =>  'required',
            'merk'  =>  'required',
            'tahun_anggaran'    =>  'required',
            'sumber_dana'   =>  'required',
        ]);

        Barang::where('id',$id)->update([
            'nama_barang'   =>  $request->nama_barang,
            'merk'  =>  $request->merk,
            'kategori'  =>  $request->kategori,
            // 'jumlah_barang' =>  $request->jumlah_barang,
            'satuan'    =>  $request->satuan,
            'merk'  =>  $request->merk,
            'tahun_anggaran'    =>  $request->tahun_anggaran,
            'sumber_dana'   =>  $request->sumber_dana,
            'jumlah_baik'   =>  $request->jumlah_baik,
            'jumlah_hilang'   =>  $request->jumlah_hilang,
            'jumlah_rusak'   =>  $request->jumlah_rusak,

        ]);

        return redirect()->route('barang')->with(['success' => 'Data barang berhasil diubah !']);

    }
    public function delete($id){
        Barang::where('id',$id)->delete();
        $notification = array(
            'message' => 'Berhasil, data Barang berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('barang')->with($notification);
    }

    public function detail($id){
        $barang = Barang::join('ruangans', 'ruangans.id','barangs.ruangId')
                        ->where('barangs.id', $id)->first();
        return $barang;
    }
}
