<?php

namespace App\Imports;

use App\Models\TipeUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportWorker implements ToModel, WithValidation, WithHeadingRow, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['active'] == 'aktif') {
            $active = true;
        } else {
            $active = false;
        }

        $tipe_user = [];
        $tipeUser = TipeUser::where('nama_tipe', 'LIKE', '%' . $row['tipe_user'] . '%')
            ->first();

        if ($tipeUser) {
            array_push($tipe_user, $tipeUser->id);
        }
        return new User([
            'name' => $row['name'],
            'username' => $row['username'],
            'password' => Hash::make($row['password']),
            'is_active' => $active,
            'id_tipe_user' => json_encode($tipe_user),
            'jabatan' => $row['jabatan'],
            'email' => $row['email'],
            'phone' => $row['phone'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'username' => 'required|string',
            'active' => 'nullable|string',
            'tipe_user' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'email' => 'nullable|string|email',
            'phone' => 'nullable|string',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama tidak valid !',
            'username.required' => 'Username tidak boleh kosong',
            'username.string' => 'Username tidak valid !',
            'tipe_user.string' => 'Tipe user tidak valid !',
            'jabatan.string' => 'Jabatan tidak valid !',
            'email.string' => 'Email tidak valid !',
            'email.email' => 'Email tidak valid !',
            'phone.string' => 'Phone number tidak valid !',
        ];
    }
}
