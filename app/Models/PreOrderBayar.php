<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreOrderBayar extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pre_order_bayars';
    protected $fillable = [
        'id_pre_order',
        'total_bayar_sebelumnya',
        'pembayaran_sekarang'
    ];

    protected $appends = [
        'total_bayar_formatted',
        'pembayaran_terbaru_formatted',
        'tanggal'
    ];

    public function getTotalBayarFormattedAttribute(){
        return 'Rp. ' . number_format($this->total_bayar_sebelumnya, 0,',','.');
    }

    public function getPembayaranTerbaruFormattedAttribute(){
        return 'Rp. ' . number_format($this->pembayaran_sekarang, 0,',','.');
    }

    public function getTanggalAttribute(){
        $carbon = Carbon::parse($this->updated_at)->locale('id')->isoFormat('dddd, DD MMMM YYYY HH:mm');
        return $carbon;
    }

    public function preOrder(){
        return $this->belongsTo(PreOrder::class, 'id_pre_order')->withTrashed();
    }
}
