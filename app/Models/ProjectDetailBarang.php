<?php

namespace App\Models;

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
        'status_barang',
    ];

    public function projectDetail(){
        return $this->belongsTo(ProjectDetail::class, 'id_project_detail');
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
