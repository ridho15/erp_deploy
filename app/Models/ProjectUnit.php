<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectUnit extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'project_units';
    protected $fillable = [
        'nama_unit',
        'no_unit',
        'id_project'
    ];

    public function project(){
        return $this->belongsTo(ProjectV2::class, 'id_project')->withDefault();
    }

    public function laporanPekerjaan(){
        return $this->hasOne(LaporanPekerjaan::class, 'id_project_unit');
    }

    public function purchaseOrder(){
        return $this->hasOne(PreOrder::class, 'id_project_unit');
    }

    public function quotation(){
        return $this->hasOne(Quotation::class, 'id_project_unit');
    }
}
