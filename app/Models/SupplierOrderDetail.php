<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierOrderDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'supplier_order_details';
    protected $fillable = [
        'id_supplier_order',
        'id_barang',
        'qty',
        'harga_satuan',
        'status_order',
        'keterangan',
    ];

    public function supplierOrder(){
        return $this->belongsTo(SupplierOrder::class, 'id_supplier_order');
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
