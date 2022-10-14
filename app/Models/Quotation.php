<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    // tanggal Send Email
    use HasFactory, SoftDeletes;
    protected $table = 'quotations';
    protected $fillable = [
        'id_laporan_pekerjaan',
        'status',
        'keterangan',
        'file'
    ];

    protected $appends = ['status_formatted'];

    public function getStatusFormattedAttribute(){
        // if($this->status_response == 1){
        //     return "<span class='badge badge-success'>Sudah Diresponse</span>";
        // }elseif($this->status_response == 0){
        //     return "<span class='badge badge-secondary'>Belum Dikirim</span>";
        // }elseif($this->status_response == 2){
        //     return "<span class='badge badge-info'>Belum Diresponse</span>";
        // }elseif($this->status_response == 3){
        //     return "<span class='badge badge-danger'>Tidak Diresponse</span>";
        // }
        $expiredTime = Carbon::parse($this->created_at)->addDays(3);
        $now = Carbon::now();
        if ($this->status == 0 && strtotime($expiredTime) > strtotime($now)) {
            return "<span class='badge badge-warning'>Belum dikirim</span>";
        }else if($this->status == 0 && strtotime($expiredTime) < strtotime($now)){
            return "<span class='badge badge-danger'>Belum dikirim</span>";
        }else if($this->status == 1){
            return "<span class='badge badge-success'>Sudah dikirim</span>";
        }
    }

    public function laporanPekerjaan(){
        return $this->belongsTo(LaporanPekerjaan::class, 'id_laporan_pekerjaan');
    }

    public function quotationDetail(){
        return $this->hasMany(QuotationDetail::class, 'id_quotation');
    }
}
