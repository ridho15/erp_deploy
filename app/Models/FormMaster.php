<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormMaster extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'form_master';
    protected $fillable = [
        'kode',
        'nama',
        'periode',
        'keterangan',
    ];

    public function templatePekerjaan()
    {
        return $this->hasMany(TemplatePekerjaan::class, 'id_form_master');
    }
}
