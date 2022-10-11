<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplatePekerjaanDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'template_pekerjaan_detail';
    protected $fillable = [
        'id_template_pekerjaan',
        'nama_pekerjaan',
        'checklist_1_bulan',
        'checklist_2_bulan',
        'checklist_3_bulan',
        'checklist_6_bulan',
        'checklist_1_tahun',
        'keterangan'
    ];

    public function templatePekerjaan(){
        return $this->belongsTo(TemplatePekerjaan::class ,'id_template_pekerjaan');
    }
}
