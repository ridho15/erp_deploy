<?php

namespace App\Models;

use App\Http\Controllers\HelperController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'id_user',
        'total_produk',
        'total_harga',
        'status_order',
        'keterangan',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user')->withTrashed();
    }

    public function detail()
    {
        return $this->hasMany(CustomerOrderDetail::class, 'id', 'id_customer_order');
    }

    public function CustomerOrderDetail()
    {
        return $this->belongsTo(CustomerOrderDetail::class, 'id', 'id_customer_order')->withTrashed();
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
