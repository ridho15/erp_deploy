<?php

namespace App\Models;

use App\Http\Controllers\HelperController;
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
        'file',
        'hal'
    ];

    protected $appends = ['status_formatted', 'no_ref', 'updated_at_formatted'];

    public function getStatusFormattedAttribute(){
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

    public function getNoRefAttribute(){
        $helper = new HelperController;
        $bulan = date('m', strtotime($this->created_at));
        $tahun = date('y', strtotime($this->created_at));
        return $helper->format_num($this->id, 3) . '/QT/MGK/' . $helper->format_romawi($bulan) . '/' . $tahun;
    }

    public function getUpdatedAtFormattedAttribute(){
        $carbon = Carbon::parse($this->updated_at)->locale('id')->isoFormat('DD MMMM YYYY');
        return $carbon;
    }
}
