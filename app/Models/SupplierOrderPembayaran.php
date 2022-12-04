<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierOrderPembayaran extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'supplier_order_pembayarans';
    protected $fillable = [
        'id_supplier_order',
        'total_bayar_sebelumnya',
        'pembayaran_sekarang',
        'bukti_bayar',
        'tanggal_pembayaran'
    ];

    protected $appends = ['tanggal_formatted'];

    public function getTanggalFormattedAttribute(){
        $carbon = Carbon::parse($this->tanggal_pembayaran)->locale('id')->isoFormat('dd/MM/YYYY');
        return $carbon;
    }

    public function supplierOrder(){
        return $this->belongsTo(SupplierOrder::class, 'id_supplier_order');
    }
}
