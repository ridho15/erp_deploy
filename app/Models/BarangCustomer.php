<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangCustomer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'barang_customers';
    protected $fillable = [
        'nama_barang',
        'keterangan'
    ];
}
