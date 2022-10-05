<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'projects';
    protected $fillable = [
        'nama_project',
        'id_customer',
        'alamat_project',
        'keterangan_project',
        'diketahui_pelanggan',
        'total_barang',
        'total_harga',
    ];

    public function customer(){
        return $this->belongsTo(Kostumer::class, 'id_customer');
    }
}
