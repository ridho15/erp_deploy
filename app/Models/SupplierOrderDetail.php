<?php

namespace App\Models;

use App\Http\Controllers\HelperController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierOrderDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'supplier_order_details';
    protected $fillable = [
        'id_supplier_order',
        'id_barang',
        'qty',
        'harga_satuan',
        'status_order',
        'keterangan',
    ];

    protected $appends = [
        'harga_satuan_formatted',
        'status_order_formatted',
        'sub_total'
    ];

    public function getSubTotalAttribute(){
        $barang = Barang::find($this->id_barang);
        if ($barang) {
            $sub_total = $this->qty * $barang->harga_modal;
            $sub_total = 'Rp ' . number_format($sub_total,0,',','.');
            return $sub_total;
        }else{
            return $sub_total = 'Rp' . number_format(0,0,',','.');
        }
    }

    public function getHargaSatuanFormattedAttribute(){
        $hargaSatuan = 'Rp ' . number_format($this->harga_satuan,0, ',','.');
        return $hargaSatuan;
    }

    public function getStatusOrderFormattedAttribute(){
        $helper = new HelperController;
        $status_order = $helper->getListStatusOrder()->where('status_order', $this->status_order)->first()['keterangan'];
        return $status_order;
    }

    public function supplierOrder(){
        return $this->belongsTo(SupplierOrder::class, 'id_supplier_order');
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
