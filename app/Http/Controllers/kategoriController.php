<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class kategoriController extends Controller
{
    public function __construct()
    {
        $this->Kategori = new Kategori();
    }

    public function index()
    {
        return view('admin.kategori.listKategori', [
            'kategori' => DB::table('categories')->paginate(5),
        ]);
    }

    public function create(Request $request)
    {
        $rules = [
            'nama' => 'required',
        ];
        $messages = [
            'nama.required' => 'Silahkan isi nama terlebih dahulu',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all())->with('gagal', 'Kategori gagal ditambahkan');
        }

        $data = array(
            'nama'       => Request()->nama,
            'deskripsi'  => Request()->deskripsi,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        // dd($data);
        $this->Kategori->insert($data);

        return redirect('/kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, Kategori $kategori, $id)
    {
        $rules = [
            'nama' => 'required',
        ];
        $messages = [
            'nama.required' => 'Silahkan isi nama terlebih dahulu',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all())->with('toast_error', 'Kategori gagal diperbarui!');
        }

        $data = array(
            'nama'       => Request()->nama,
            'deskripsi'  => Request()->deskripsi,
            'updated_at' => date('Y-m-d H:i:s')
        );
        // dd($data);
        $this->Kategori->updateData($data, $id);

        return redirect('/kategori')->with('toast_success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori, $id)
    {
        Kategori::findOrFail($id);
        $this->Kategori->deleteData($id);
        return redirect('/kategori')->with('toast_success', 'Kategori berhasil dihapus!');
    }
}
