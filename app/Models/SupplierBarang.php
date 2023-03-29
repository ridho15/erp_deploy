<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierBarang extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'supplier_barangs';
    protected $fillable = [
        'id_supplier',
        'id_barang'
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'id_supplier')->withDefault();
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang')->withDefault();
    }
}
