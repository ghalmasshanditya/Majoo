<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class kategoriController extends Controller
{
    public function __construct()
    {
        $this->Kategori = new Kategori();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'kategori'    => $this->Kategori->getData(),
        );
        // dd($data);
        return view('admin.kategori.listKategori', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            return back()->withErrors($validator)->withInput($request->all())->with('message', 'error');
        }

        $data = array(
            'nama'       => Request()->nama,
            'deskripsi'  => Request()->deskripsi,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        // dd($data);
        $this->Kategori->insert($data);

        return redirect('/kategori');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
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
            return back()->withErrors($validator)->withInput($request->all())->with('message', 'error');
        }

        $data = array(
            'nama'       => Request()->nama,
            'deskripsi'  => Request()->deskripsi,
            'updated_at' => date('Y-m-d H:i:s')
        );
        // dd($data);
        $this->Kategori->updateData($data, $id);

        return redirect('/kategori')->with('message', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori, $id)
    {
        Kategori::findOrFail($id);
        $this->Kategori->deleteData($id);
        return redirect('/kategori');
    }
}
