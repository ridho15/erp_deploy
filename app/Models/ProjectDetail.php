<?php

namespace App\Models;

use Carbon\Carbon;
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

    protected $appends = ['status_formatted', 'jam_mulai_formatted', 'jam_selesai_formatted'];

    public function getJamMulaiFormattedAttribute(){
        if($this->jam_mulai){
            $carbon = Carbon::parse($this->jam_mulai)->locale('id')->isoFormat('dddd, DD MMMM YYYY HH:mm');
            return $carbon;
        }else{
            return '-';
        }
    }

    public function getJamSelesaiFormattedAttribute(){
        if($this->jam_selesai){
            $carbon = Carbon::parse($this->jam_selesai)->locale('id')->isoFormat('dddd, DD MMMM YYYY HH:mm');
            return $carbon;
        }else{
            return '-';
        }
    }

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
