<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kondisi',
        'merk',
        'kategori',
        'jumlah_barang',
        'satuan',
        'tahun_anggaran',
        'sumber_dana',
        'kondisi',
    ];
}
