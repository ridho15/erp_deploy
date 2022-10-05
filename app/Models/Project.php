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

    protected $appends = ['diketahui_pelanggan_formatted', 'total_harga_formatted'];

    public function getDiketahuiPelangganFormattedAttribute(){
        if($this->diketahui_pelanggan == 1){
            return "Diketahui";
        }else{
            return "Tidak Diketahui";
        }
    }

    public function getTotalHargaFormattedAttribute(){
        return 'Rp ' . number_format($this->total_harga, 0,',','.');
    }

    public function customer(){
        return $this->belongsTo(Kostumer::class, 'id_customer');
    }
}
