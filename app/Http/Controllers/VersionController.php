<?php

namespace App\Http\Controllers;

use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VersionController extends Controller
{
    public function index(){
        $data['title'] = "Version";
        $data['active'] = ['data-master', 'version'];
        $data['breadCrumb'] = ['Version', 'Data'];
        $data['listVersion'] = Version::get();

        return view('version.index', $data);
    }

    public function simpan(Request $request){
        $validator = Validator::make($request->all(), [
            'version' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->with('fail', $validator->errors()->all()[0]);
        }

        if($request->id_version != null){
            $version = Version::find($request->id_version);
            $version->update([
                'version' => $request->version
            ]);
        }else{
            Version::updateOrCreate([
                'version' => $request->version
            ], [
                'version' => $request->version
            ]);
        }

        activity()->causedBy(HelperController::user())->log("Menyimpan data version " . $request->version);
        return redirect()->back()->with('success', 'Berhasil menyimpan data version');
    }

    public function hapus($id){
        $version = Version::find($id);
        if(!$version){
            $message = "Data version tidak ditemukan !";

            return redirect()->back()->with('fail', $message);
        }

        $version->delete();
        activity()->causedBy(HelperController::user())->log("Menghapus data version");

        return redirect()->back()->with('success', 'Berhasil menghapus data version');
    }
}
