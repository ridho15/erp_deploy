<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangStockLog extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'barang_stock_logs';
    protected $fillable = [
        'id_produk',
        'stok_awal',
        'perubahan',
        'tipe_perubahan',
        'tanggal_perubahan'
    ];

    public function tipePerubahan(){
        if($this->tipe_perubahan == 1){
            return "Bertambah";
        }else{
            return "Berkurang";
        }
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
