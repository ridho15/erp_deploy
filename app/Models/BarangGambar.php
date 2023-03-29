<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangGambar extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'barang_gambars';
    protected $fillable = [
        'file',
        'id_barang'
    ];

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang')->withDefault();
    }
}
