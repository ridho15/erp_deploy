<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'quotation_detail';
    protected $fillable = [
        'id_quotation',
        'id_barang',
        'harga',
        'qty',
        'id_satuan',
        'deskripsi'
    ];

    protected $appends = ['sub_total', 'sub_total_formatted', 'harga_formatted'];

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang')->withTrashed();
    }

    public function satuan(){
        return $this->belongsTo(Satuan::class, 'id_satuan')->withTrashed();
    }

    public function quotation(){
        return $this->belongsTo(Quotation::class, 'id_quotation')->withTrashed();
    }

    public function getHargaFormattedAttribute(){
        return 'Rp.' . number_format($this->harga, 0,',','.');
    }

    public function getSubTotalAttribute(){
        $subTotal = $this->harga * $this->qty;
        return $subTotal;
    }

    public function getSubTotalFormattedAttribute(){
        $subTotal = $this->harga * $this->qty;
        return 'Rp. ' . number_format($subTotal, 0,',','.');
    }
}
