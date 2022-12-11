<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanPekerjaanBarang extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'laporan_pekerjaan_barang';
    protected $fillable = [
        'id_laporan_pekerjaan',
        'id_barang',
        'catatan_teknisi',
        'keterangan_customer',
        'qty',
        'status',
        'konfirmasi',
        'peminjam',
        'meminjamkan',
        'id_tipe_barang',
        'version',
        'id_rak',
        'estimasi',
        'nomor_itt'
    ];

    protected $appends = ['status_formatted'];

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

    public function laporanPekerjaan(){
        return $this->belongsTo(LaporanPekerjaan::class, 'id_laporan_pekerjaan');
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang')->withTrashed();
    }

    public function userPeminjam(){
        return $this->belongsTo(User::class, 'peminjam')->withTrashed();
    }

    public function userMeminjamkan(){
        return $this->belongsTo(User::class, 'meminjamkan')->withTrashed();
    }

    public function tipeBarang(){
        return $this->belongsTo(TipeBarang::class, 'id_tipe_barang')->withTrashed();
    }

    public function laporanPekerjaanBarangLog(){
        return $this->hasMany(LaporanPekerjaanBarangLog::class, 'id_laporan_pekerjaan_barang');
    }

    public function rak(){
        return $this->belongsTo(Rak::class, 'id_rak')->withTrashed();
    }
}
