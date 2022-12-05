<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangStockLog extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'barang_stock_logs';
    protected $fillable = [
        'id_barang',
        'stock_awal',
        'perubahan',
        'id_tipe_perubahan_stock',
        'tanggal_perubahan',
        'id_user',
        'check',
        'id_quotation'
    ];

    public $appends = ['tanggal_perubahan_formatted'];

    public function getTanggalPerubahanFormattedAttribute(){
        $carbon = Carbon::parse($this->tanggal_perubahan)->locale('id')->isoFormat("dddd, DD MMMM YYYY HH:mm");
        return $carbon;
    }

    public function tipePerubahanStock(){
        return $this->belongsTo(TipePerubahanStock::class, 'id_tipe_perubahan_stock')->withTrashed();
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang')->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user')->withTrashed();
    }

    public function quotation(){
        return $this->belongsTo(Quotation::class, 'id_quotation')->withTrashed();
    }
}
