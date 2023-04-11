<?php

namespace App\Http\Controllers;

class WebConfigurationController extends Controller
{
    public function index()
    {
        $data['title'] = 'Pengaturan Web';
        $data['active'] = ['web_config', 'Pengaturan'];
        $data['breadCrumb'] = ['Pengaturan', 'Web'];

        return view('webConfig.index', $data);
    }
}
