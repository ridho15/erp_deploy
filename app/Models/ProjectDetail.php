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

    protected $appends = ['status_formatted'];

    public function getStatusFormattedAttribute(){
        if($this->status == 1){
            return "<span class='badge badge-success'>Selesai</span>";
        }else{
            return "<span class='badge badge-secondary'>Belum Selesai</span>";
        }
    }

    public function project(){
        return $this->belongsTo(Project::class, 'id_project');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
