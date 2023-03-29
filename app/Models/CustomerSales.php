<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerSales extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'customer_sales';
    protected $fillable = [
        'id_customer',
        'id_sales'
    ];

    public function customer(){
        return $this->belongsTo(Kostumer::class, 'id_customer')->withDefault();
    }

    public function sales(){
        return $this->belongsTo(Sales::class, 'id_sales')->withDefault();
    }
}
