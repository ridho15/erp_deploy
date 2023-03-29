<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'suppliers';
    protected $fillable = [
        'name',
        'no_hp',
        'alamat',
        'email',
        'status',
        'no_hp_1',
        'no_hp_2',
        'telp_1',
        'telp_2',
        'pic',
        'produk'
    ];

    protected $appends = ['status_formatted'];

    public function getStatusFormattedAttribute(){
        if($this->status == 1){
            return "<span class='badge badge-success'>Aktif</span>";
        }else{
            return "<span class='badge badge-secondary'>Tidak Aktif</span>";
        }
    }

    public function supplierSales(){
        return $this->hasMany(SupplierSales::class, 'id_supplier');
    }

    public function supplierBarang(){
        return $this->hasMany(SupplierBarang::class, 'id_supplier');
    }
}
