<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipeBarang extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tipe_barangs';
    protected $fillable = [
        'tipe_barang'
    ];

    public function barang(){
        return $this->hasMany(Barang::class, 'id_tipe_barang');
    }
}
