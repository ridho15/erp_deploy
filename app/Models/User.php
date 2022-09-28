<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'username',
        'password',
        'is_active',
        'id_tipe_user'
    ];

    protected $hidden = [
        'password', 'token'
    ];

    public function tipeUser(){
        return $this->belongsTo(TipeUser::class, 'id_tipe_user');
    }
}
