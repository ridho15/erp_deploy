<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationSendLog extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'quotation_send_logs';
    protected $fillable = [
        'id_quotation',
        'id_user',
        'tanggal'
    ];

    public function quotation(){
        return $this->belongsTo(Quotation::class, 'id_quotation');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
