<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'sales';
    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
        'nama_perusahaan',
    ];

    public function supplierSales(){
        return $this->hasMany(SupplierSales::class, 'id_sales');
    }
}
