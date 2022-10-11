<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectFoto extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'project_fotos';
    protected $fillable = [
        'file',
        'id_project_detail',
    ];

    public function projectDetail(){
        return $this->belongsTo(ProjectDetail::class, 'id_project_detail');
    }
}
