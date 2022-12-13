<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanPekerjaanUser extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'laporan_pekerjaan_users';
    protected $fillable = [
        'id_user',
        'signature',
        'id_laporan_pekerjaan'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user')->withTrashed();
    }

    public function laporanPekerjaan(){
        return $this->belongsTo(LaporanPekerjaan::class, 'id_laporan_pekerjaan')->withTrashed();
    }
}
