<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectV2 extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'project_v2';
    protected $fillable = [
        'kode',
        'nama',
        'penanggung_jawab',
        'no_mfg',
        'alamat',
        'id_customer',
        'no_hp',
        'email',
        'catatan',
        'tanggal',
        'map',
        'total_pekerjaan'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'id_customer')->withDefault();
    }

    public function salesProject(){
        return $this->hasMany(SalesProject::class, 'id_project');
    }

    public function listUnit(){
        return $this->hasMany(ProjectUnit::class, 'id_project');
    }
}
