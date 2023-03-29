<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NomorItt extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'nomor_itts';
    protected $fillable = [
        'id_laporan_pekerjaan_barang',
        'nomor_itt',
        'nomor_tanggal'
    ];

    public function laporanPekerjaanBarang(){
        return $this->belongsTo(LaporanPekerjaanBarang::class, 'id_laporan_pekerjaan_barang')->withDefault();
    }
}
