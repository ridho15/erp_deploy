<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierOrder extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'supplier_orders';
    protected $fillable = [
        'id_supplier',
        'id_user',
        'status_order',
        'total_harga',
        'tanggal_order',
        'keterangan',
        'id_tipe_pembayaran',
    ];

    protected $appends = ['tanggal_order_formatted', 'status_order_formatted'];

    public function getTanggalOrderFormattedAttribute(){
        $carbon = Carbon::parse($this->tanggal_order)->locale('id')->isoFormat('dddd, DD MMMM YYYY');
        return $carbon;
    }

    public function getStatusOrderFormattedAttribute(){

    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tipePembayaran(){
        return $this->belongsTo(TipePembayaran::class, 'id_tipe_pembayaran');
    }
}
