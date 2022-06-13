<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->date('tanggal_masuk');
            $table->string('merk');
            $table->enum('kategori',['aset','barang_habis_pakai']);
            $table->integer('jumlah_barang');
            $table->enum('satuan',['Unit','Pcs','Lembar']);
            $table->string('tahun_anggaran');
            $table->enum('sumber_dana',['apbn','pnpb']);
            $table->enum('kondisi',['baik','rusak','sedang_dipinjam','hilang']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_masuks');
    }
}
