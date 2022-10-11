<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectV2 extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'project_v2';
    protected $fillable = [
        'kode',
        'nama',
        'no_unit',
        'no_mfg',
        'alamat',
        'id_customer',
        'catatan'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
