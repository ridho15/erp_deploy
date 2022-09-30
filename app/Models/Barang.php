<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'barangs';
    protected $fillable = [
        'nama',
        'tipe_barang',
        'stock',
        'min_stock',
        'harga',
        'id_merk'
    ];

    public function tipeBarang(){
        if($this->tipe_barang == 1){
            return "Pinjam";
        }elseif($this->tipe_barang == 2){
            return "Bisa dibeli";
        }elseif($this->tipe_barang == 3){
            return "Bisa dibeli atau Dipinjam";
        }
    }

    public function merk(){
        return $this->belongsTo(Merk::class, 'id_merk');
    }
}
