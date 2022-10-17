<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'username',
        'password',
        'is_active',
        'id_tipe_user',
        'jabatan',
        'email',
        'phone',
        'foto',
    ];

    protected $hidden = [
        'password', 'token',
    ];

    protected $appends = ['is_active_formatted'];

    public function getIsActiveFormattedAttribute()
    {
        if ($this->is_active == 1) {
            return "<span class='badge badge-success'>Aktif</span>";
        } else {
            return "<span class='badge badge-danger'>Tidak Aktif</span>";
        }
    }

    public function tipeUser()
    {
        return $this->belongsTo(TipeUser::class, 'id_tipe_user');
    }
}
