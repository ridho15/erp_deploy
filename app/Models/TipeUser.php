<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipeUser extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tipe_users';
    protected $fillable = [
        'nama_tipe'
    ];

    public function user(){
        return $this->hasMany(User::class, 'id_tipe_user');
    }
}
