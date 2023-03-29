<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatatanTeknisiPekerjaan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'catatan_teknisi_pekerjaans';
    protected $fillable = [
        'id_laporan_pekerjaan',
        'keterangan',
        'status',
    ];

    public function laporanPekerjaan(){
        return $this->belongsTo(LaporanPekerjaan::class, 'id_laporan_pekerjaan')->withDefault();
    }
}
