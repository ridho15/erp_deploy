<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'project_details';
    protected $fillable = [
        'id_project',
        'nama_pekerjaan',
        'status',
        'id_user',
        'keterangan',
        'jam_mulai',
        'jam_selesai'
    ];

    public function project(){
        return $this->belongsTo(Project::class, 'id_project');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
