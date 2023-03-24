<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplatePekerjaanDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'template_pekerjaan_detail';
    protected $fillable = [
        'id_template_pekerjaan',
        'nama_pekerjaan',
        'periode',
        'id_parent'
    ];

    // protected $appends = ['checklist_1_bulan_formatted', 'checklist_2_bulan_formatted', 'checklist_3_bulan_formatted', 'checklist_6_bulan_formatted', 'checklist_1_tahun_formatted'];

    public function getChecklist1BulanFormattedAttribute()
    {
        if ($this->checklist_1_bulan == 1) {
            return  '<i class="bi bi-check-circle-fill text-success fs-1"></i>';

            return  '<i class="bi bi-check-circle-fill text-success fs-1"></i>';
        }
    }

    public function getChecklist2BulanFormattedAttribute()
    {
        if ($this->checklist_2_bulan == 1) {
            return  '<i class="bi bi-check-circle-fill text-success fs-1"></i>';
        }
    }

    public function getChecklist3BulanFormattedAttribute()
    {
        if ($this->checklist_3_bulan == 1) {
            return  '<i class="bi bi-check-circle-fill text-success fs-1"></i>';
        }
    }

    public function getChecklist6BulanFormattedAttribute()
    {
        if ($this->checklist_6_bulan == 1) {
            return  '<i class="bi bi-check-circle-fill text-success fs-1"></i>';
        }
    }

    public function getChecklist1TahunFormattedAttribute()
    {
        if ($this->checklist_1_tahun == 1) {
            return  '<i class="bi bi-check-circle-fill text-success fs-1"></i>';
        }
    }

    public function templatePekerjaan()
    {
        return $this->belongsTo(TemplatePekerjaan::class, 'id_template_pekerjaan')->withTrashed();
    }

    public function children(){
        return $this->hasMany(TemplatePekerjaanDetail::class, 'id_parent');
    }

    public function parent(){
        return $this->belongsTo(TemplatePekerjaanDetail::class, 'id_parent')->withTrashed();
    }
}
