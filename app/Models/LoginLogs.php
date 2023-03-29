<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoginLogs extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'login_logs';
    protected $fillable = [
        'id_user',
        'devices',
        'token',
        'is_active',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user')->withDefault();
    }
}
