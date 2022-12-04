<?php

namespace App\Models;

use App\Http\Controllers\HelperController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'customers';
    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'alamat',
        'status',
        'id_barang_customer',
        'barang_customer'
    ];

    protected $appends = ['status_formatted', 'kode', 'total_order'];

    public function getTotalOrderAttribute(){
        return PreOrder::where("id_customer", $this->id)->count();
    }

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
