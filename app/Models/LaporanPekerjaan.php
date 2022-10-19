<?php

namespace App\Models;

use App\Http\Controllers\HelperController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanPekerjaan extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'laporan_pekerjaan';
    protected $fillable = [
        'id_customer',
        'id_project',
        'id_merk',
        'nomor_lift',
        'keterangan',
        'jam_mulai',
        'jam_selesai',
        'id_user',
        'id_form_master',
        'signature',
        'catatan_pelanggan'
    ];

    protected $appends = [
        'kode_pekerjaan',
        'jam_mulai_formatted',
        'jam_selesai_formatted'
    ];

    public function getKodePekerjaanAttribute(){
        $helper = new HelperController;
        return 'PK' . $helper->format_num($this->id);
    }

    public function getJamMulaiFormattedAttribute(){
        if($this->jam_mulai){
            return Carbon::parse($this->jam_mulai)->locale('id')->isoFormat('dddd, DD MMMM YYYY HH:mm');
        }else{
            return null;
        }
    }

    public function getJamSelesaiFormattedAttribute(){
        if($this->jam_selesai){
            return Carbon::parse($this->jam_selesai)->locale('id')->isoFormat('dddd, DD MMMM YYYY HH:mm');
        }else{
            return null;
        }
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function project(){
        return $this->belongsTo(ProjectV2::class, 'id_project');
    }

    public function merk(){
        return $this->belongsTo(Merk::class, 'id_merk');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function laporanPekerjaanBarang(){
        return $this->hasMany(LaporanPekerjaanBarang::class, 'id_laporan_pekerjaan');
    }

    public function laporanPekerjaanFoto(){
        return $this->hasMany(LaporanPekerjaanFoto::class, 'id_laporan_pekerjaan');
    }

    public function laporanPekerjaanChecklist(){
        return $this->hasMany(LaporanPekerjaanChecklist::class, 'id_laporan_pekerjaan');
    }

    public function formMaster(){
        return $this->belongsTo(FormMaster::class, 'id_form_master');
    }
}
