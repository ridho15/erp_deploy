<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notifikasi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'notifikasis';
    protected $fillable = [
        'tipe_notifikasi',
        'pesan',
        'status_lihat',
        'tanggal',
        'route',
        'id_user'
    ];

    protected $appends = [
        'judul'
    ];

    public function getJudulAttribute(){
        if($this->tipe_notifikasi == 1){
            return "Stock Minimum";
        }elseif($this->tipe_notifikasi == 2){
            return "Pembayaran Supplier Order";
        }elseif($this->tipe_notifikasi == 3){
            return "Pembayaran Pre Order";
        }
    }
}
