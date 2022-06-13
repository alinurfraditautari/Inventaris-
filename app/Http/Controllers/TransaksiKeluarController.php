<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiKeluar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransaksiKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $transaksis = TransaksiKeluar::join('barangs','barangs.id','transaksi_keluars.barang_id')
                            ->select('transaksi_keluars.id','tujuan_keluar','tanggal_keluar','jumlah_keluar','nama_barang','kode_barang','tahun_anggaran','sumber_dana','satuan')
                            ->orderBy('transaksi_keluars.id','desc')
                            ->get();
        return view('operator/transaksi_keluar/index',compact('transaksis'));
    }

    public function add(){
        $barangs = Barang::all();
        return view('operator/transaksi_keluar.add',compact('barangs'));
    }

    public function post(Request $request){
        $barang = Barang::where('id',$request->barang_id)->first();
        $barang_tersedia = $barang->jumlah_barang - $request->jumlah_keluar;
        if ($request->jumlah_keluar > $barang->jumlah_barang) {
            return redirect()->back()->with(['error'    => 'Jumlah barang tidak mencukupi']);
        }
        $this->validate($request,[
            'nama_barang'   =>  'required',
            'merk'  =>  'required',
            'jumlah_keluar' =>  'required',
            'tujuan_keluar'    =>  'required',
            'tanggal_keluar'  =>  'required',
        ]);
        $date = Carbon::now();
        $kode_barang =  Str::slug($date->toDateTimeString()).'-'.md5($date);
        DB::beginTransaction();
        try {
            $barang = new TransaksiKeluar;
            $barang->barang_id = $request->barang_id;
            $barang->tanggal_keluar = $request->tanggal_keluar;
            $barang->tujuan_keluar = $request->tujuan_keluar;
            $barang->jumlah_keluar = $request->jumlah_keluar;
            $barang->save();
            // Barang::where('id',$request->barang_id)->update([
            //     'jumlah_barang' => $barang_tersedia,
            // ]);

            DB::commit();
            return redirect()->route('barang.transaksi_keluar')->with(['success' => 'Data transaksi masuk sudah ditambahkan !']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('barang.transaksi_keluar.add')->with(['error' => 'Data transaksi masuk gagal ditambahkan !']);
        }


    }
    public function edit($id){
        $transaksi = TransaksiKeluar::join('barangs','barangs.id','transaksi_keluars.barang_id')
                    ->select('transaksi_keluars.id','jumlah_keluar','tanggal_keluar','tujuan_keluar','kode_barang')
                    ->where('transaksi_keluars.id',$id)
                    ->first();
        $barang = Barang::where('kode_barang',$transaksi->kode_barang)->first();
        return view('operator/transaksi_keluar/.edit',compact('transaksi','barang'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'nama_barang'   =>  'required',
            'merk'  =>  'required',
            'jumlah_keluar' =>  'required',
            'tujuan_keluar'    =>  'required',
            'tanggal_keluar'  =>  'required',
        ]);

        TransaksiKeluar::where('id',$id)->update([
            'barang_id'   =>  $request->barang_id,
            'jumlah_keluar'  =>  $request->jumlah_keluar,
            'tujuan_keluar'  =>  $request->tujuan_keluar,
            'tanggal_keluar' =>  $request->tanggal_keluar,
        ]);

        return redirect()->route('barang.transaksi_keluar')->with(['success' => 'Data Transaksi Keluar berhasil diubah !']);

    }
    public function delete($id){
        TransaksiKeluar::where('id',$id)->delete();
        return redirect()->route('barang.transaksi_keluar')->with(['success' => 'Data Transaksi Keluar berhasil dihapus !']);
    }

    public function cariBarang(Request $request){
        $barang = Barang::where('id',$request->barang_id)->first();
        return $barang;
    }
}
