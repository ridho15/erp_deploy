<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangKategori extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'barang_kategoris';
    protected $fillable = [
        'id_barang',
        'id_kategori'
    ];

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang')->withTrashed();
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori')->withTrashed();
    }
}
