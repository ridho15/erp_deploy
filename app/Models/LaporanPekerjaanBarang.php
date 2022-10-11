<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanPekerjaanBarang extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'laporan_pekerjaan_barang';
    protected $fillable = [
        'id_laporan_pekerjaan',
        'id_barang',
        'catatan_teknisi',
        'keterangan_customer',
        'qty'
    ];

    public function laporanPekerjaan(){
        return $this->belongsTo(LaporanPekerjaan::class, 'id_laporan_pekerjaan');
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
