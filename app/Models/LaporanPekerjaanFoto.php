<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanPekerjaanFoto extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'laporan_pekerjaan_foto';
    protected $fillable = [
        'id_laporan_pekerjaan',
        'file',
        'keterangan'
    ];

    public function laporanPekerjaan(){
        return $this->belongsTo(LaporanPekerjaan::class, 'id_laporan_pekerjaan')->withTrashed();
    }
}
