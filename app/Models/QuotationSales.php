<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationSales extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'quotation_sales';
    protected $fillable = [
        'id_sales',
        'id_quotation'
    ];

    public function sales(){
        return $this->belongsTo(Sales::class, 'id_sales')->withTrashed();
    }

    public function quotation(){
        return $this->belongsTo(Quotation::class, 'id_quotation')->withTrashed();
    }
}
