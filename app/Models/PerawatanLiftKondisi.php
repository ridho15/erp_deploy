<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerawatanLiftKondisi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'perawatan_lift_kondisis';
    protected $fillable = [
        'id_laporan_pekerjaan_checklist',
        'periode',
        'id_kondisi'
    ];

    public function laporanPekerjaanCheckList(){
        return $this->belongsTo(LaporanPekerjaanChecklist::class, 'id_laporan_pekerjaan_checklist')->withTrashed();
    }

    public function kondisi(){
        return $this->belongsTo(Kondisi::class,'id_kondisi')->withTrashed();
    }
}
