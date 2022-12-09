<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanPekerjaanBarangLog extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'laporan_pekerjaan_barang_logs';
    protected $fillable = [
        'id_laporan_pekerjaan_barang',
        'status',
        'keterangan'
    ];

    protected $appends = [
        'status_formatted'
    ];

    public function getStatusFormattedAttribute(){
        if($this->status == 1){
            return '<span class="badge badge-info">Diminta</span>';
        }elseif($this->status == 2){
            return '<span class="badge badge-success">Dipinjam</span>';
        }elseif($this->status == 0){
            return '<span class="badge badge-danger">Diabaikan</span>';
        }elseif($this->status == 3){
            return '<span class="badge badge-info">Dibalikan</span>';
        }elseif($this->status == 4){
            return '<span class="badge badge-success">Terjual</span>';
        }
    }

    public function laporanPekerjaanBarang(){
        return $this->belongsTo(LaporanPekerjaanBarang::class, 'id_laporan_pekerjaan_barang');
    }
}
