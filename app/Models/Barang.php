<?php

namespace App\Models;

use App\Http\Controllers\HelperController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'barangs';
    protected $fillable = [
        'nama',
        'stock',
        'min_stock',
        'harga',
        'id_merk',
        'id_satuan',
        'id_tipe_barang',
        'deskripsi'
    ];

    protected $appends = ['harga_formatted', 'sku'];

    public function getHargaFormattedAttribute(){
        return 'Rp '.number_format($this->harga, 0, ',', '.');
    }

    public function merk(){
        return $this->belongsTo(Merk::class, 'id_merk');
    }

    public function barangKategori(){
        return $this->hasMany(BarangKategori::class, 'id_barang');
    }

    public function barangGambar(){
        return $this->hasMany(BarangGambar::class, 'id_barang');
    }

    public function satuan(){
        return $this->belongsTo(Satuan::class, 'id_satuan');
    }

    public function supplierBarang(){
        return $this->hasMany(SupplierBarang::class, 'id_barang');
    }

    public function barangStockLog(){
        return $this->hasMany(BarangStockLog::class, 'id_barang');
    }

    public function tipeBarang(){
        return $this->belongsTo(TipeBarang::class, 'id_tipe_barang');
    }

    public function getSkuAttribute(){
        $helper = new HelperController;
        return "B" . $helper->format_num($this->id);
    }
}
