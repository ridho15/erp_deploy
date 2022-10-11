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
        'id_kondisi',
        'keterangan'
    ];

    public function laporanPekerjaan(){
        return $this->belongsTo(LaporanPekerjaan::class, 'id_laporan_pekerjaan');
    }

    public function templatePekerjaanDetail(){
        return $this->belongsTo(TemplatePekerjaanDetail::class, 'id_template_pekerjaan_detail');
    }

    public function kondisi(){
        return $this->belongsTo(Kondisi::class, 'id_kondisi');
    }
}
