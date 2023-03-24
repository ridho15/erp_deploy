<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierOrderDetailTemp extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'supplier_order_detail_temps';
    protected $fillable = [
        'id_barang',
        'jumlah_diminta',
        'jumlah_kurang',
        'stock_sekarang',
        'harga_satuan',
        'status',
        'keterangan'
    ];

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang')->withTrashed();
    }
}
