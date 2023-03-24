<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockOpname extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'stock_opnames';
    protected $fillable = [
        'id_barang',
        'jumlah_tercatat',
        'jumlah_mutasi',
        'jumlah_terjual',
        'jumlah_terbaru',
        'keterangan',
        'tanggal',
        'id_user'
    ];

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang')->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user')->withTrashed();
    }
}
