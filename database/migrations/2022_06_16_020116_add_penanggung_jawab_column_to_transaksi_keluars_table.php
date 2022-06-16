<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPenanggungJawabColumnToTransaksiKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi_keluars', function (Blueprint $table) {
            $table->string('penanggung_jawab')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_keluars', function (Blueprint $table) {
            $table->dropColumn('penanggung_jawab');
        });
    }
}
