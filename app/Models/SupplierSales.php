<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierSales extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'supplier_sales';
    protected $fillable = [
        'id_supplier',
        'id_sales'
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function sales(){
        return $this->belongsTo(Sales::class, 'id_sales');
    }
}
