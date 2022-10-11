<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanPekerjaan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'laporan_pekerjaan';
    protected $fillable = [
        'id_customer',
        'id_project',
        'id_merk',
        'nomor_lift',
        'keterangan',
        'jam_mulai',
        'jam_selesai',
        'id_user',
        'signature'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function project(){
        return $this->belongsTo(ProjectV2::class, 'id_project');
    }

    public function merk(){
        return $this->belongsTo(Merk::class, 'id_merk');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function laporanPekerjaanBarang(){
        return $this->hasMany(LaporanPekerjaanBarang::class, 'id_laporan_pekerjaan');
    }

    public function laporanPekerjaanFoto(){
        return $this->hasMany(LaporanPekerjaanFoto::class, 'id_laporan_pekerjaan');
    }

    public function laporanPekerjaanChecklist(){
        return $this->hasMany(LaporanPekerjaanChecklist::class, 'id_laporan_pekerjaan');
    }
}
