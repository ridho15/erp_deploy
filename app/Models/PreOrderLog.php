<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrderLog extends Model
{
    use HasFactory;
    protected $table = 'pre_order_logs';
    protected $fillable = [
        'id_pre_order',
        'tanggal',
        'status'
    ];

    protected $appends = ['status_formatted', 'tanggal_formatted'];

    public function getStatusFormattedAttribute(){
        if($this->status == 1){
            return '<span class="badge badge-secondary">Belum Diproses</span>';
        }else if($this->status == 2){
            return '<span class="badge badge-warning">Sedang Diproses</span>';
        }else if($this->status == 0){
            return '<span class="badge badge-danger">Dibatalkan</span>';
        }else if($this->status == 3){
            return '<span class="badge badge-success">Selesai</span>';
        }
    }

    public function preOrder(){
        return $this->belongsTo(PreOrder::class, 'id_pre_order');
    }

    public function getTanggalFormattedAttribute(){
        $carbon = Carbon::parse($this->tanggal)->locale('id')->isoFormat('dddd, DD MMMM YYYY HH:mm');
        return $carbon;
    }
}
