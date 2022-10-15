<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreOrderDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pre_order_detail';
    protected $fillable = [
        'id_pre_order',
        'id_barang',
        'harga',
        'qty',
        'id_satuan',
        'keterangan'
    ];

    protected $appends = [
        'harga_formatted',
        'sub_total',
        'sub_total_formatted'
    ];

    public function getHargaFormattedAttribute(){
        return 'Rp. ' . number_format($this->harga, 0,',','.');
    }

    public function getSubTotalAttribute(){
        return $this->harga * $this->qty;
    }

    public function getSubTotalFormattedAttribute(){
        return 'Rp. ' . number_format($this->harga * $this->qty, 0,',','.');
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function preOrder(){
        return $this->belongsTo(PreOrder::class, 'id_pre_order');
    }

    public function satuan(){
        return $this->belongsTo(Satuan::class, 'id_satuan');
    }
}
