<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectDetailSubUser extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'project_detail_sub_user';
    protected $fillable = [
        'id_user',
        'id_project_detail_subs'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user')->withTrashed();
    }

    public function projectDetailSub(){
        return $this->belongsTo(ProjectDetailSub::class, 'id_project_detail_subs')->withTrashed();
    }
}
