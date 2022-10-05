<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'suppliers';
    protected $fillable = [
        'name',
        'no_hp',
        'alamat',
        'email',
        'status'
    ];

    protected $appends = ['status_formatted'];

    public function getStatusFormattedAttribute(){
        if($this->status == 1){
            return "<span class='badge badge-success'>Aktif</span>";
        }else{
            return "<span class='badge badge-secondary'>Tidak Aktif</span>";
        }
    }
}
