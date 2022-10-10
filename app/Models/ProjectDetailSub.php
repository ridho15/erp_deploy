<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectDetailSub extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'project_detail_subs';
    protected $fillable = [
        'id_project_detail',
        'nama_sub_pekerjaan',
        'kondisi_1_bulan',
        'kondisi_2_bulan',
        'kondisi_3_bulan',
        'kondisi_6_bulan',
        'kondisi_1_tahun',
        'keterangan',
    ];

    public function projectDetail(){
        return $this->belongsTo(ProjectDetail::class, 'id_project_detail');
    }

    public function pekerja(){
        return $this->hasMany(ProjectDetailSubUser::class, 'id_project_detail_subs');
    }

    public function kondisi1Bulan(){
        return $this->belongsTo(Kondisi::class, 'kondisi_1_bulan');
    }

    public function kondisi2Bulan(){
        return $this->belongsTo(Kondisi::class, 'kondisi_2_bulan');
    }

    public function kondisi3Bulan(){
        return $this->belongsTo(Kondisi::class, 'kondisi_3_bulan');
    }

    public function kondisi6Bulan(){
        return $this->belongsTo(Kondisi::class, 'kondisi_6_bulan');
    }

    public function kondisi1Tahun(){
        return $this->belongsTo(Kondisi::class, 'kondisi_1_tahun');
    }
}
