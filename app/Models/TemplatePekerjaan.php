<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplatePekerjaan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'template_pekerjaan';
    protected $fillable = [
        'nama_pekerjaan',
        'keterangan',
        'id_form_master',
        'kondisi'
    ];

    public function detail(){
        return $this->hasMany(TemplatePekerjaanDetail::class, 'id_template_pekerjaan');
    }

    public function formMaster(){
        return $this->belongsTo(FormMaster::class, 'id_form_master');
    }
}
