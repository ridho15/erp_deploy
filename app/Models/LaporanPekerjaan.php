<?php

namespace App\Models;

use App\Http\Controllers\HelperController;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LaporanPekerjaan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'laporan_pekerjaan';
    protected $fillable = [
        'id_customer',
        'id_project',
        'id_merk',
        'nomor_lift',
        'keterangan',
        'jam_mulai',
        'jam_selesai',
        'id_form_master',
        'periode',
        'signature',
        'catatan_pelanggan',
        'tanggal_pekerjaan',
        'dikirim',
        'tanggal_estimasi',
        'confirmasi_customer_barang',
        'is_emergency_call',
        'is_check_detail',
    ];

    protected $appends = [
        'kode_pekerjaan',
        'jam_mulai_formatted',
        'jam_selesai_formatted',
        'list_pekerja',
    ];

    public function getListPekerjaAttribute()
    {
        $name = [];
        $listIdUser = json_decode($this->id_user);
        if (is_array($listIdUser) === true) {
            foreach ($listIdUser as $item) {
                $user = User::find($item);
                array_push($name, $user->name);
            }
        } else {
            return ['-'];
        }

        return $name;
    }

    public function getKodePekerjaanAttribute()
    {
        $helper = new HelperController();

        return 'PK'.$helper->format_num($this->id);
    }

    public function getJamMulaiFormattedAttribute()
    {
        if ($this->jam_mulai) {
            return Carbon::parse($this->jam_mulai)->locale('id')->isoFormat('DD/MM/YYYY HH:mm');
        } else {
            return null;
        }
    }

    public function tanggalPekerjaanFormatted()
    {
        if ($this->tanggal) {
            return Carbon::parse($this->tanggal)->locale('id')->isoFormat('DD/MM/YYYY');
        } else {
            return null;
        }
    }

    public function getJamSelesaiFormattedAttribute()
    {
        if ($this->jam_selesai) {
            return Carbon::parse($this->jam_selesai)->locale('id')->isoFormat('DD/MM/YYYY HH:mm');
        } else {
            return null;
        }
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer')->withTrashed();
    }

    public function project()
    {
        return $this->belongsTo(ProjectV2::class, 'id_project')->withTrashed();
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class, 'id_merk')->withTrashed();
    }

    public function laporanPekerjaanBarang()
    {
        return $this->hasMany(LaporanPekerjaanBarang::class, 'id_laporan_pekerjaan');
    }

    public function laporanPekerjaanFoto()
    {
        return $this->hasMany(LaporanPekerjaanFoto::class, 'id_laporan_pekerjaan');
    }

    public function laporanPekerjaanChecklist()
    {
        return $this->hasMany(LaporanPekerjaanChecklist::class, 'id_laporan_pekerjaan');
    }

    public function formMaster()
    {
        return $this->belongsTo(FormMaster::class, 'id_form_master')->withTrashed();
    }

    public function teknisi()
    {
        return $this->hasMany(LaporanPekerjaanUser::class, 'id_laporan_pekerjaan');
    }

    public function catatanTeknisiPekerjaan(){
        return $this->hasMany(CatatanTeknisiPekerjaan::class, 'id_laporan_pekerjaan');
    }

    public function quotation(){
        return $this->hasOne(Quotation::class, 'id_laporan_pekerjaan');
    }
}
