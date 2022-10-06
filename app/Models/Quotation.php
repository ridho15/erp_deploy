<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    // tanggal Send Email
    use HasFactory, SoftDeletes;
    protected $table = 'quotations';
    protected $fillable = [
        'id_project',
        'status_response',
        'id_tipe_pembayaran',
    ];

    protected $appends = ['status_response_formatted'];

    public function getStatusResponseFormattedAttribute(){
        if($this->status_response == 1){
            return "<span class='badge badge-success'>Sudah Diresponse</span>";
        }elseif($this->status_response == 0){
            return "<span class='badge badge-secondary'>Belum Dikirim</span>";
        }elseif($this->status_response == 2){
            return "<span class='badge badge-info'>Belum Diresponse</span>";
        }elseif($this->status_response == 3){
            return "<span class='badge badge-danger'>Tidak Diresponse</span>";
        }
    }

    public function project(){
        return $this->belongsTo(Project::class, 'id_project');
    }

    public function tipePembayaran(){
        return $this->belongsTo(TipePembayaran::class, 'id_tipe_pembayaran');
    }
}
