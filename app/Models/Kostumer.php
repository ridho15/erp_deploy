<?php

namespace App\Models;

use App\Http\Controllers\HelperController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kostumer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'customers';
    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'alamat',
        'status'
    ];

    protected $appends = ['status_formatted', 'kode'];

    public function getStatusFormattedAttribute(){
        if($this->status == 1){
            return "<span class='badge badge-success'>Aktif</span>";
        }else{
            return "<span class='badge badge-secondary'>Tidak Aktif</span>";
        }
    }

    public function getKodeAttribute(){
        $helper = new HelperController;
        return 'C' . $helper->format_num($this->id);
    }
}
