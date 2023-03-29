<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanPekerjaanChecklist extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'laporan_pekerjaan_checklist';
    protected $fillable = [
        'id_laporan_pekerjaan',
        'id_template_pekerjaan_detail',
        'pekerjaan',
        'kondisi',
        'keterangan',
        'status'
    ];

    public function laporanPekerjaan(){
        return $this->belongsTo(LaporanPekerjaan::class, 'id_laporan_pekerjaan')->withDefault();
    }

    public function templatePekerjaanDetail(){
        return $this->belongsTo(TemplatePekerjaanDetail::class, 'id_template_pekerjaan_detail')->withDefault();
    }

    public function kondisi(){
        return $this->belongsTo(Kondisi::class, 'id_kondisi')->withDefault();
    }

    public function perawatanLiftKondisi(){
        return $this->hasMany(PerawatanLiftKondisi::class, 'id_laporan_pekerjaan_checklist');
    }
}
