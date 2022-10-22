<?php

namespace App\Http\Livewire\WebConfig;

use App\CPU\Helpers;
use App\Models\WebConfig;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Data extends Component
{
    use WithFileUploads;
    public $listeners = ['simpanWebConfig', 'refreshWebConfig' => '$refresh', 'saveLogo'];

    public $judul;
    public $deskripsi;
    public $logo;
    public $logoView;
    public $favicon;
    public $faviconView;

    public $nama;
    public $alamat;
    public $email;
    public $phone;
    public $faksimili;
    public $logoPerusahaan;
    public $logoPerusahaanView;

    public function render()
    {
        return view('livewire.web-config.data');
    }

    public function mount()
    {
        $checkLogo = WebConfig::where('type', 'logo')->first();
        if ($checkLogo == null) {
            $checkLogo = new WebConfig();
            $checkLogo->type = 'logo';
            $checkLogo->value = null;
            $checkLogo->save();
        }

        $checkFavicon = WebConfig::where('type', 'favicon')->first();
        if ($checkFavicon == null) {
            $checkFavicon = new WebConfig();
            $checkFavicon->type = 'favicon';
            $checkFavicon->value = null;
            $checkFavicon->save();
        }

        $checkLogoPerusahaan = WebConfig::where('type', 'logo_perusahaan')->first();
        if ($checkLogoPerusahaan == null) {
            $checkLogoPerusahaan = new WebConfig();
            $checkLogoPerusahaan->type = 'logo_perusahaan';
            $checkLogoPerusahaan->value = null;
            $checkLogoPerusahaan->save();
        }

        $this->judul = WebConfig::where('type', 'judul')->first() ? WebConfig::where('type', 'judul')->first()->value : '';
        $this->deskripsi = WebConfig::where('type', 'description')->first() ? WebConfig::where('type', 'description')->first()->value : '';
        $this->logoView = WebConfig::where('type', 'logo')->first() ? WebConfig::where('type', 'logo')->first() : '';
        $this->faviconView = WebConfig::where('type', 'favicon')->first() ? WebConfig::where('type', 'favicon')->first() : '';

        $this->nama = WebConfig::where('type', 'name')->first() ? WebConfig::where('type', 'name')->first()->value : '';
        $this->alamat = WebConfig::where('type', 'alamat')->first() ? WebConfig::where('type', 'alamat')->first()->value : '';
        $this->email = WebConfig::where('type', 'email')->first() ? WebConfig::where('type', 'email')->first()->value : '';
        $this->phone = WebConfig::where('type', 'phone')->first() ? WebConfig::where('type', 'phone')->first()->value : '';
        $this->faksimili = WebConfig::where('type', 'faksimili')->first() ? WebConfig::where('type', 'faksimili')->first()->value : '';
        $this->logoPerusahaanView = Helpers::config('logo_perusahaan')->first() ? Helpers::config('logo_perusahaan')->first() : '';
    }

    public function simpanWebConfig()
    {
        $judul = WebConfig::where('type', 'judul')->first();
        if (!$judul) {
            $judul = new WebConfig();
            $judul->type = 'judul';
            $judul->value = $this->judul;
        } else {
            $judul->value = $this->judul;
        }
        $judul->save();

        $datadeskripsi = WebConfig::where('type', 'description')->first();
        if (!$datadeskripsi) {
            $datadeskripsi = new WebConfig();
            $datadeskripsi->type = 'description';
            $datadeskripsi->value = $this->deskripsi;
        } else {
            $datadeskripsi->value = $this->deskripsi;
        }
        $datadeskripsi->save();

        $this->imgSaver($this->logo, 'logo');
        $this->imgSaver($this->favicon, 'favicon');

        $message = 'Berhasil menyimpan pengaturan Aplikasi';

        $this->emit('finishSimpanData', 1, $message);
        $this->emit('finishRefreshData', 1, $message);

        return redirect(request()->header('Referer'));

        return session()->flash('success', $message);
    }

    public function imgSaver($img, $type)
    {
        $dir = 'company';
        if (isset($img)) {
            $logo = Helpers::config($type)->first();

            $imgLogo = Helpers::update('company/', $logo, 'png', $img);

            $old_image = $logo['value'];

            if ($logo->value !== null) {
                if (File::exists(public_path($old_image))) {
                    unlink(public_path($old_image));
                }
            }

            if ($img != null) {
                $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.'.png';

                if (!Storage::disk('public')->exists($dir)) {
                    Storage::disk('public')->makeDirectory($dir);
                }
                $url = $img->store('storage/'.$dir);
            } else {
                $url = 'def.png';
            }
            WebConfig::updateOrInsert(['type' => $type], [
                'value' => $url,
            ]);
        }
    }

    public function saveLogo()
    {
        $namaPerusahaan = WebConfig::where('type', 'name')->first();
        if (!$namaPerusahaan) {
            $namaPerusahaan = new WebConfig();
            $namaPerusahaan->type = 'name';
            $namaPerusahaan->value = $this->nama;
        } else {
            $namaPerusahaan->value = $this->nama;
        }
        $namaPerusahaan->save();

        $alamat = WebConfig::where('type', 'alamat')->first();
        if (!$alamat) {
            $alamat = new WebConfig();
            $alamat->type = 'alamat';
            $alamat->value = $this->alamat;
        } else {
            $alamat->value = $this->alamat;
        }
        $alamat->save();

        $dataemail = WebConfig::where('type', 'email')->first();
        if (!$dataemail) {
            $dataemail = new WebConfig();
            $dataemail->type = 'email';
            $dataemail->value = $this->email;
        } else {
            $dataemail->value = $this->email;
        }
        $dataemail->save();

        $dataphone = WebConfig::where('type', 'phone')->first();
        if (!$dataphone) {
            $dataphone = new WebConfig();
            $dataphone->type = 'phone';
            $dataphone->value = $this->phone;
        } else {
            $dataphone->value = $this->phone;
        }
        $dataphone->save();

        $faksimili = WebConfig::where('type', 'faksimili')->first();
        if (!$faksimili) {
            $faksimili = new WebConfig();
            $faksimili->type = 'faksimili';
            $faksimili->value = $this->faksimili;
        } else {
            $faksimili->value = $this->faksimili;
        }
        $faksimili->save();

        $this->imgSaver($this->logoPerusahaan, 'logo_perusahaan');

        $message = 'Berhasil menyimpan logo';

        $this->emit('finishSimpanData', 1, $message);
        $this->emit('finishRefreshData', 1, $message);

        return redirect(request()->header('Referer'));

        return session()->flash('success', $message);
    }
}
