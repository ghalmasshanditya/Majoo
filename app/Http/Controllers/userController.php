<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class userController extends Controller
{
    public function __construct()
    {
        $this->User = new User();
    }

    public function profile()
    {
        return view('admin/profile/profile');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name'   => 'required',
            'alamat' => 'required',
            'birth'  => 'required',
            'jk'     => 'required',
            'phone'  => 'required',
        ];
        $messages = [
            'name.required'   => 'Silahkan masukkan nama anda terlebih dahulu',
            'alamat.required' => 'Silahkan masukkan alamat anda terlebih dahulu',
            'birth.required'  => 'Silahkan masukkan tanggal lahir anda terlebih dahulut',
            'jk.required'     => 'Silahkan pilih jenis kelamin anda terlebih dahulu',
            'phone.required'  => 'Silahkan masukkan nomor telepon anda terlebih dahulu',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput($request->all())->with('gagal', 'Maaf! Gagal memperbarui profile.');
        }

        $data = array(
            'name'       => Request()->name,
            'alamat'     => Request()->alamat,
            'birth'        => Request()->birth,
            'jk'         => Request()->jk,
            'phone'    => Request()->phone,
            'updated_at' => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->User->updateData($data, $id);
        return redirect('profile')->with('success', 'Selamat! Berhasil memperbarui Informasi profile.');
    }

    public function updateProfile(Request $request, $id)
    {
        // die;
        $rules = [
            'profile' => 'required|max:4048|mimes:jpg,jpeg,gif,png',
        ];
        $messages = [
            'profile.required' => 'Silahkan pilih foto terlebih dahulu',
            'profile.max'      => 'Ukuran file maksimum 4 MB',
            'profile.mimes'    => 'Ekstensi file harus JPG, JPEG, GIF, AND PNG',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all())->with('gagal', 'Maaf! gagal memperbarui foto profile');
        }
        // die;
        $file     = Request()->profile;
        $fileName = Auth::user()->email . '.' . $file->extension();
        $file->move(public_path('assets/dist/img/profile/'), $fileName);


        $data = array(
            'foto'       => $fileName,
            'updated_at' => date('Y-m-d N:i:s'),
        );
        // dd($data);
        $this->User->updateData($data, $id);
        return redirect('profile')->with('success', 'Selamat! Berhasil memperbarui foto profile.');
    }
}
