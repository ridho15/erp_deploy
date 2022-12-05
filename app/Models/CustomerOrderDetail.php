<?php

namespace App\Models;

use App\Http\Controllers\HelperController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer_order',
        'id_produk',
        'total_produk',
        'total_harga',
        'status_order',
        'keterangan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_produk')->withTrashed();
    }

    public function getStatusOrderFormattedAttribute()
    {
        $helper = new HelperController();
        $statusOrder = $helper->getListStatusOrder()->where('status_order', $this->status_order)->first()['keterangan'];

        return $statusOrder;
    }

    public function getTotalHargaFormattedAttribute()
    {
        $formatTotalHarga = 'Rp '.number_format($this->total_harga, 0, ',', '.');

        return $formatTotalHarga;
    }
}
