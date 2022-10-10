<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusBarang extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'status_barangs';
    protected $fillable = [
        'status_barang'
    ];
}
