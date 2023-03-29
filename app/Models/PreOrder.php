<?php

namespace App\Models;

use App\Http\Controllers\HelperController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreOrder extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pre_order';
    protected $fillable = [
        'no_ref',
        'id_quotation',
        'status',
        'id_tipe_pembayaran',
        'id_user',
        'id_project_unit',
        'keterangan',
        'file',
        'id_metode_pembayaran',
        'tanggal_tempo_pembayaran',
        // 'id_laporan_pekerjaan',
        // 'diskon'
    ];

    protected $appends = [
        // 'no_ref',
        'status_formatted',
        'total',
        'total_bayar',
        'total_bayar_formatted',
        'status_pembayaran',
        'status_pembayaran_kode',
        'sudah_bayar',
        'ppn',
    ];

    public function getPpnAttribute(){
        $preOrderDetail = PreOrderDetail::where('id_pre_order', $this->id)->get();
        if($this->quotation){
            $n_ppn = $this->quotation->ppn;
        }elseif(isset($this->projectUnit->project->customer)){
            $n_ppn = $this->projectUnit->project->customer->ppn;
        }else{
            $n_ppn = 11;
        }
        $total_bayar = 0;
        foreach ($preOrderDetail as $item) {
            $total_bayar += $item->sub_total;
        }

        $ppn = $total_bayar * ($n_ppn/100); //PPN default 11%;

        return $ppn;
    }

    public function getSudahBayarAttribute(){
        $preOrderBayar = PreOrderBayar::where('id_pre_order', $this->id)->get();
        $sudah_bayar = 0;
        foreach ($preOrderBayar as $item) {
            $sudah_bayar += $item->pembayaran_sekarang;
        }

        return $sudah_bayar;
    }

    public function getTotalAttribute(){
        $preOrderDetail = PreOrderDetail::where('id_pre_order', $this->id)->get();
        $total_bayar = 0;
        foreach ($preOrderDetail as $item) {
            $total_bayar += $item->sub_total;
        }

        return $total_bayar;
    }

    public function getStatusPembayaranKodeAttribute(){
        $preOrderBayar = PreOrderBayar::where('id_pre_order', $this->id)->get();
        $sudah_bayar = 0;
        foreach ($preOrderBayar as $item) {
            $sudah_bayar += $item->pembayaran_sekarang;
        }

        if($this->total_bayar == $sudah_bayar){
            return 2;
        }elseif($sudah_bayar != 0){
            return 1;
        }else{
            return null;
        }
    }

    public function getStatusPembayaranAttribute(){
        $preOrderBayar = PreOrderBayar::where('id_pre_order', $this->id)->get();
        $sudah_bayar = 0;
        foreach ($preOrderBayar as $item) {
            $sudah_bayar += $item->pembayaran_sekarang;
        }

        if($this->total_bayar == $sudah_bayar && count($preOrderBayar) > 0){
            return '<span class="badge badge-success">Lunas</span>';
        }elseif($sudah_bayar != 0){
            return '<span class="badge badge-warning">Belum Lunas</span>';
        }else{
            return '<span class="badge badge-warning">Belum ada pembayaran</span>';
        }
    }

    public function getTotalBayarAttribute(){
        $preOrderDetail = PreOrderDetail::where('id_pre_order', $this->id)->get();
        $total_bayar = 0;
        $n_ppn = $this->quotation ? $this->quotation->ppn : 11;
        foreach ($preOrderDetail as $item) {
            $total_bayar += $item->sub_total;
        }

        $ppn = $total_bayar * ($n_ppn/100); //PPN 11%;

        return $total_bayar + $ppn;
    }

    public function getTotalBayarFormattedAttribute(){
        $preOrderDetail = PreOrderDetail::where('id_pre_order', $this->id)->get();
        $total_bayar = 0;
        $n_ppn = $this->quotation ? $this->quotation->ppn : 11;
        foreach ($preOrderDetail as $item) {
            $total_bayar += $item->sub_total;
        }

        $ppn = $total_bayar * ($n_ppn/100); //ppn 11 %;

        return 'Rp. ' . number_format($total_bayar + $ppn,0,',','.');
    }

    public function getStatusFormattedAttribute(){
        if($this->status == 1){
            return '<span class="badge badge-secondary">Belum Diproses</span>';
        }else if($this->status == 2){
            return '<span class="badge badge-warning">Sedang Diproses</span>';
        }else if($this->status == 0){
            return '<span class="badge badge-danger">Dibatalkan</span>';
        }else if($this->status == 3){
            return '<span class="badge badge-success">Selesai</span>';
        }
    }

    public function projectUnit(){
        return $this->belongsTo(ProjectUnit::class, 'id_project_unit')->withDefault();
    }

    public function quotation(){
        return $this->belongsTo(Quotation::class, 'id_quotation')->withDefault();
    }

    public function tipePembayaran(){
        return $this->belongsTo(TipePembayaran::class, 'id_tipe_pembayaran')->withDefault();
    }

    public function preOrderDetail(){
        return $this->hasMany(PreOrderDetail::class, 'id_pre_order');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user')->withDefault();
    }

    public function log(){
        return $this->hasMany(PreOrderLog::class, 'id_pre_order');
    }

    public function metodePembayaran(){
        return $this->belongsTo(MetodePembayaran::class, 'id_metode_pembayaran')->withDefault();
    }

    public function preOrderBayar(){
        return $this->hasMany(PreOrderBayar::class, 'id_pre_order');
    }

    public function agendaPenagihan(){
        return $this->hasOne(CalenderPenagihan::class, 'id_accounts')->where('tipe', 2);
    }
}
