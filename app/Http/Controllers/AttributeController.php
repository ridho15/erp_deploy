<?php

namespace App\Http\Controllers;

class AttributeController extends Controller
{
    public function tipeUser()
    {
        $data['title'] = 'Tipe User';
        $data['active'] = ['data-master', 'tipeUser'];
        $data['breadCrumb'] = ['Tipe User', 'Data'];

        return view('master.tipeUser.index', $data);
    }

    public function satuan()
    {
        $data['title'] = 'Satuan';
        $data['active'] = ['data-master', 'satuan'];
        $data['breadCrumb'] = ['Satuan', 'Data'];

        return view('master.satuan.index', $data);
    }
}
