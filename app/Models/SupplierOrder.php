<?php

namespace App\Models;

use App\Http\Controllers\HelperController;
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
        'id_metode_pembayaran',
        'status_pembayaran'
    ];

    protected $appends = [
        'no_ref',
        'status_pembayaran_formatted',
        'tanggal_order_formatted',
        'status_order_formatted',
        'total_harga_formatted',
        'status_pembayaran_formatted'
    ];

    public function getNoRefAttribute(){
        $helper = new HelperController;
        return "SO" . $helper->format_num($this->id);
    }

    public function getStatusPembayaranFormattedAttribute(){
        if($this->status_pembayaran == 0){
            return '<span class="badge badge-secondary">Belum Bayar</span>';
        }elseif($this->status_pembayaran == 1){
            return '<span class="badge badge-warning">Belum Lunas</span>';
        }elseif($this->status_pembayaran == 2){
            return '<span class="badge badge-success">Lunas</span>';
        }
    }

    public function getTanggalOrderFormattedAttribute(){
        $carbon = Carbon::parse($this->tanggal_order)->locale('id')->isoFormat('dddd, DD MMMM YYYY');
        return $carbon;
    }

    public function getStatusOrderFormattedAttribute(){
        $helper = new HelperController;
        $statusOrder = $helper->getListStatusOrder()->where('status_order', $this->status_order)->first();
        return $statusOrder;
    }

    public function getTotalHargaFormattedAttribute(){
        $formatTotalHarga = 'Rp ' . number_format($this->total_harga, 0, ',','.');
        return $formatTotalHarga;
    }

    public function detail(){
        return $this->hasMany(SupplierOrderDetail::class, 'id_supplier_order');
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

    public function metodePembayaran(){
        return $this->belongsTo(MetodePembayaran::class, 'id_metode_pembayaran');
    }

    public function supplierOrderPembayaran(){
        return $this->hasMany(SupplierOrderPembayaran::class, 'id_supplier_order');
    }
}
