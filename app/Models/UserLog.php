<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;
    protected $table = 'user_logs';
    protected $fillable = [
        'id_user',
        'status',
        'user_agent',
        'lastLogin',
        'lastPasswordChange',
        'last_ip'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
