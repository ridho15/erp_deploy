<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalenderPenagihan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'calender_penagihans';
    protected $fillable = [
        'tipe',
        'id_accounts',
        'description',
        'tanggal'
    ];

    protected $appends = [
        'tipe_formatted'
    ];

    public function getTipeFormattedAttribute(){
        if($this->tipe == 1){
            return "Account Receivable";
        }elseif($this->tipe == 2){
            return "Account Payable";
        }
    }

    public function preOrder(){
        return $this->belongsTo(PreOrder::class, 'id_accounts')->withTrashed();
    }

    public function supplierOrder(){
        return $this->belongsTo(SupplierOrder::class, 'id_accounts')->withTrashed();
    }

    public function quotation(){
        return $this->belongsTo(Quotation::class, 'id_accounts')->withTrashed();
    }

    public function laporanPekerjaan(){
        return $this->belongsTo(LaporanPekerjaan::class, 'id_accounts')->withTrashed();
    }
}
