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

    protected $appends = ['is_active_formatted', 'list_tipe_user', 'nama_tipe_user'];

    public function getNamaTipeUserAttribute(){
        $listIdTipeUser = json_decode($this->id_tipe_user);
        $tipeUser = "";
        if (is_array($listIdTipeUser)) {
            foreach ($listIdTipeUser as $index => $item) {
                $data = TipeUser::find($item);
                if($index == 0){
                    $tipeUser = $data->nama_tipe . ',';
                }else{
                    $tipeUser = $tipeUser . $data->nama_tipe . ',';
                }
            }
        }

        return $tipeUser;
    }

    public function getListTipeUserAttribute(){
        $listIdTipeUser = json_decode($this->id_tipe_user);
        $tipeUser = [];
        if (is_array($listIdTipeUser)) {
            foreach ($listIdTipeUser as $item) {
                $data = TipeUser::find($item);
                array_push($tipeUser, $data->nama_tipe);
            }
        }

        return $tipeUser;
    }

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
