<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreOrder extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pre_order';
    protected $fillable = [
        'id_quotation',
        'status',
        'id_tipe_pembayaran',
        'id_user',
        'id_customer',
        'keterangan'
    ];

    protected $appends = ['status_formatted'];

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

    public function customer(){
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function quotation(){
        return $this->belongsTo(Quotation::class, 'id_quotation');
    }

    public function tipePembayaran(){
        return $this->belongsTo(TipePembayaran::class, 'id_tipe_pembayaran');
    }

    public function preOrderDetail(){
        return $this->hasMany(PreOrderDetail::class, 'id_pre_order');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
