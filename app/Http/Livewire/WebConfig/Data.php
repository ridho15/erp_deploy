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

    public $id_user;
    public $name;
    public $deskripsi;
    public $phone;
    public $email;
    public $logo;
    public $photo;

    public function render()
    {
        return view('livewire.web-config.data');
    }

    public function mount()
    {
        $this->name = WebConfig::where('type', 'name')->first() ? WebConfig::where('type', 'name')->first()->value : '';
        $this->deskripsi = WebConfig::where('type', 'description')->first() ? WebConfig::where('type', 'description')->first()->value : '';
        $this->phone = WebConfig::where('type', 'phone')->first() ? WebConfig::where('type', 'phone')->first()->value : '';
        $this->email = WebConfig::where('type', 'email')->first() ? WebConfig::where('type', 'email')->first()->value : '';
        $this->photo = Helpers::config('logo')->first();
    }

    public function simpanWebConfig()
    {
        $dataname = WebConfig::where('type', 'name')->first();
        if (!$dataname) {
            $dataname = new WebConfig();
            $dataname->type = 'name';
            $dataname->value = $this->name;
        } else {
            $dataname->value = $this->name;
        }
        $dataname->save();

        $datadeskripsi = WebConfig::where('type', 'description')->first();
        if (!$datadeskripsi) {
            $datadeskripsi = new WebConfig();
            $datadeskripsi->type = 'description';
            $datadeskripsi->value = $this->deskripsi;
        } else {
            $datadeskripsi->value = $this->deskripsi;
        }
        $datadeskripsi->save();

        $dataphone = WebConfig::where('type', 'phone')->first();
        if (!$dataphone) {
            $dataphone = new WebConfig();
            $dataphone->type = 'phone';
            $dataphone->value = $this->phone;
        } else {
            $dataphone->value = $this->phone;
        }
        $dataphone->save();

        $dataemail = WebConfig::where('type', 'email')->first();
        if (!$dataemail) {
            $dataemail = new WebConfig();
            $dataemail->type = 'email';
            $dataemail->value = $this->email;
        } else {
            $dataemail->value = $this->email;
        }
        $dataemail->save();

        $message = 'Berhasil menyimpan pengaturan';

        $this->emit('finishSimpanData', 1, $message);
        $this->emit('finishRefreshData', 1, $message);

        return session()->flash('success', $message);
    }

    public function saveLogo()
    {
        $check = WebConfig::where('type', 'logo')->first();
        if (!$check) {
            $new = new WebConfig();
            $new->type = 'logo';
            $new->save;
        }
        $dir = 'company';
        if (isset($this->logo)) {
            $logo = Helpers::config('logo')->first();

            $imgLogo = Helpers::update('company/', $logo, 'png', $this->logo);

            $old_image = $logo['value'];

            if ($logo->value !== null) {
                if (File::exists(public_path($old_image))) {
                    unlink(public_path($old_image));
                }
            }

            if ($this->logo != null) {
                $imageName = Carbon::now()->toDateString().'-'.uniqid().'.'.'.png';

                if (!Storage::disk('public')->exists($dir)) {
                    Storage::disk('public')->makeDirectory($dir);
                }
                $url = $this->logo->store('storage/'.$dir);
            } else {
                $url = 'def.png';
            }
            WebConfig::updateOrInsert(['type' => 'logo'], [
                'value' => $url,
            ]);
        }

        $message = 'Berhasil menyimpan logo';

        $this->emit('finishSimpanData', 1, $message);
        $this->emit('finishRefreshData', 1, $message);

        return redirect(request()->header('Referer'));

        return session()->flash('success', $message);
    }
}
