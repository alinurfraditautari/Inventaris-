<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            $table->integer('kondisi_pengembalian_baik')->nullable();
            $table->integer('kondisi_pengembalian_rusak')->nullable();
            $table->integer('kondisi_pengembalian_hilang')->nullable();
            $table->string('keterangan_pengembalian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            //
        });
    }
}
