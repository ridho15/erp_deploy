<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipePerubahanStock extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tipe_perubahan_stocks';
    protected $fillable = [
        'nama_tipe_perubahan',
        'badge'
    ];
}
