<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\TransaksiKeluar;
use App\Models\TransaksiMasuk;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function laporanBarang(){
        $barangs = Barang::select('id','nama_barang','kode_barang','merk','tahun_anggaran','kategori','jumlah_baik','jumlah_rusak','jumlah_hilang','satuan','tahun_anggaran','sumber_dana')
        ->orderBy('id','desc')
        ->get();
        return view('operator/laporan/barang',compact('barangs'));
    }

    public function laporanBarangMasuk(){
        $transaksis = TransaksiMasuk::select('id','nama_barang','kode_barang','tahun_anggaran','sumber_dana','satuan','jumlah_barang','jumlah_baik','jumlah_rusak','jumlah_hilang','tanggal_masuk')
                            ->orderBy('id','desc')
                            ->get();
        return view('operator/laporan/masuk',compact('transaksis'));
    }

    public function laporanBarangKeluar(){
        $transaksis = TransaksiKeluar::join('barangs','barangs.id','transaksi_keluars.barang_id')
                            ->select('transaksi_keluars.id','tujuan_keluar','tanggal_keluar','jumlah_keluar','nama_barang','kode_barang','tahun_anggaran','sumber_dana','satuan','penanggung_jawab')
                            ->orderBy('transaksi_keluars.id','desc')
                            ->get();
        return view('operator/laporan/keluar',compact('transaksis'));
    }

    public function laporanPeminjaman(){
        $transaksis = Peminjaman::join('barangs','barangs.id','peminjamen.barang_id')
                            ->select('peminjamen.id','tanggal_pinjam','tanggal_kembali','kode_barang','nama_barang','jumlah_pinjam','nama_peminjam','keterangan','keterangan_pengembalian','kondisi_pengembalian_rusak','kondisi_pengembalian_hilang','kondisi_pengembalian_baik')
                            ->orderBy('peminjamen.id','desc')
                            ->get();
        return view('operator/laporan/peminjaman',compact('transaksis'));
    }

    public function cariMasuk(Request $request){
        $from = $request->dari_tanggal;
        $to = $request->sampai_tanggal;
        $transaksis = TransaksiMasuk::select('id','nama_barang','kode_barang','tahun_anggaran','sumber_dana','satuan','jumlah_baik','jumlah_rusak','jumlah_hilang','tanggal_masuk')
                            ->whereBetween('tanggal_masuk',[$from, $to])
                            ->orderBy('id','desc')
                            ->get();
        return view('operator/laporan/masuk',compact('transaksis'));
    }

    public function cariKeluar(Request $request){
        $from = $request->dari_tanggal;
        $to = $request->sampai_tanggal;
        $transaksis = TransaksiKeluar::join('barangs','barangs.id','transaksi_keluars.barang_id')
                            ->select('transaksi_keluars.id','tujuan_keluar','tanggal_keluar','jumlah_keluar','nama_barang','kode_barang','tahun_anggaran','sumber_dana','satuan','penanggung_jawab')
                            ->whereBetween('tanggal_keluar',[$from, $to])
                            ->orderBy('transaksi_keluars.id','desc')
                            ->get();
        return view('operator/laporan/keluar',compact('transaksis'));
    }

    public function cariPinjam(Request $request){
        $from = $request->dari_tanggal;
        $to = $request->sampai_tanggal;
        $transaksis = Peminjaman::join('barangs','barangs.id','peminjamen.barang_id')
                            ->select('peminjamen.id','tanggal_pinjam','tanggal_kembali','kode_barang','nama_barang','jumlah_pinjam','nama_peminjam','keterangan','keterangan_pengembalian','kondisi_pengembalian_rusak','kondisi_pengembalian_hilang','kondisi_pengembalian_baik')
                            ->whereBetween('tanggal_pinjam',[$from, $to])
                            ->orderBy('peminjamen.id','desc')
                            ->get();
        return view('operator/laporan/peminjaman',compact('transaksis'));
    }
}
