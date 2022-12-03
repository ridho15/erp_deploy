<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rak extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'raks';
    protected $fillable = [
        'kode_rak',
        'nama_rak',
        'warna_rak'
    ];

    public function isiRak(){
        return $this->hasMany(IsiRak::class, 'id_rak');
    }
}
