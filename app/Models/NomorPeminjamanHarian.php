<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NomorPeminjamanHarian extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'nomor_peminjaman_harians';
    protected $fillable = [
        'itt_start',
        'itt_end',
        'tanggal'
    ];
}
