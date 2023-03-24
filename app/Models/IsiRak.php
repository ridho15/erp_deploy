<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IsiRak extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'isi_raks';
    protected $fillable = [
        'id_rak',
        'id_barang',
        'jumlah',
        'kode_masuk'
    ];

    public function rak(){
        return $this->belongsTo(Rak::class, 'id_rak')->withTrashed();
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang')->withTrashed();
    }
}
