<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetodePembayaran extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'metode_pembayarans';
    protected $fillable = [
        'nama_metode',
        'nilai'
    ];
}
