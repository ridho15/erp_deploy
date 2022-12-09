<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RakLog extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'rak_logs';
    protected $fillable = [
        'id_rak',
        'id_barang',
        'status',
        'jumlah',
        'keterangan'
    ];

    protected $appends = [
        'status_formatted'
    ];

    public function getStatusFormattedAttribute(){
        if($this->status == 1){
            return '<span class="badge badge-success">Masuk</span>';
        }elseif($this->status == 2){
            return '<span class="badge badge-warning">Keluar</span>';
        }elseif($this->status == 3){
            return '<span class="badge badge-info">Dipindahkan</span>';
        }
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function rak(){
        return $this->belongsTo(Rak::class, 'id_rak');
    }
}
