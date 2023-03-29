<?php

namespace App\Models;

use App\Http\Controllers\HelperController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectDetailBarang extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'project_detail_barangs';
    protected $fillable = [
        'id_project_detail',
        'id_barang',
        'qty',
        'status_barang',
    ];

    protected $appends = ['status_barang_formatted'];

    public function getStatusBarangFormattedAttribute(){
        $helper = new HelperController;
        return $helper->getListStatusBarang()->where('status_barang', $this->status_barang)->first()['keterangan'];
    }

    public function projectDetail(){
        return $this->belongsTo(ProjectDetail::class, 'id_project_detail')->withDefault();
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang')->withDefault();
    }
}
