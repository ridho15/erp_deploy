<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectDetailSubFoto extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'project_detail_sub_foto';
    protected $fillable = [
        'id_project_detail_sub',
        'file'
    ];

    public function projectDetailSub(){
        return $this->belongsTo(ProjectDetailSub::class, 'id_project_detail_sub');
    }
}
