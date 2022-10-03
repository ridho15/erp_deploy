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
        'tipe_barang',
        'stock',
        'min_stock',
        'harga',
        'id_merk',
        'id_satuan'
    ];

    protected $appends = ['harga_formatted'];

    public function getHargaFormattedAttribute(){
        return 'Rp '.number_format($this->harga, 0, ',', '.');
    }

    public function tipeBarang(){
        $helper = new HelperController;
        return $helper->getListTipeBarang()->where('tipe_barang', $this->tipe_barang)->first()['keterangan'];
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
}
