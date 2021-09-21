<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->Produk = new Produk();
    }

    public function index()
    {
        $data = array(
            'produk'    => $this->Produk->getData(),
        );
        // dd($data);
        return view('admin.produk.produkList', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = [
            'nama'        => 'required|unique:produks',
            'harga'       => 'required',
            'keterangan'  => 'required',
            'foto_produk' => 'required|mimes:png,jpg,jpeg|max:4048',
        ];
        $messages = [
            'nama.required'        => 'Silahkan isi nama terlebih dahulu',
            'nama.unique'          => 'Nama product sudah terdaftar pada database',
            'harga.required'       => 'Silahkan isi harga terlebih dahulu',
            'keterangan.required'  => 'Silahkan isi keterangan terlebih dahulu',
            'foto_produk.required' => 'Silahkan pilih Foto terlebih dahulu',
            'foto_produk.mimes'    => 'Format harus png,jpg, atau jpeg',
            'foto_produk.max'      => 'Foto Maksimal 4mb',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all())->with('toast_error', 'Gagal Menambah Data Produk');
        }

        $file     = Request()->foto_produk;
        $fileName = time() . '.' . $file->extension();
        $file->move(public_path('/assets/product/'), $fileName);

        $data = array(
            'nama'          => Request()->nama,
            'harga'         => preg_replace("/[^0-9]/", "", Request()->harga),
            'keterangan'    => nl2br(Request()->keterangan),
            'foto_produk'   => $fileName,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        );
        // dd($data);
        $this->Produk->insert($data);

        return redirect('/product');
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

    public function fillCheckout($id)
    {
        $data = array(
            'produk'    => $this->Produk->getDataById($id),
        );
        // dd($data);
        return view('users.checkout.checkoutProduct', $data);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama'        => 'required',
            'harga'       => 'required',
            'keterangan'  => 'required',
        ];
        $messages = [
            'nama.required'        => 'Silahkan isi nama terlebih dahulu',
            'harga.required'       => 'Silahkan isi harga terlebih dahulu',
            'keterangan.required'  => 'Silahkan isi keterangan terlebih dahulu',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all())->with('toast_error', 'Gagal Menambah Data Produk');
        }

        if (Request()->foto_produk <> "") {

            unlink(public_path('/assets/product' . '/' . Request()->unlink));

            $file     = Request()->foto_produk;
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('assets/product/'), $fileName);

            $data = array(
                'nama'          => Request()->nama,
                'harga'         => preg_replace("/[^0-9]/", "", Request()->harga),
                'keterangan'    => nl2br(Request()->keterangan),
                'foto_produk'   => $fileName,
                'updated_at'  => date('Y-m-d H:i:s')
            );
            $this->Produk->updateData($data, $id);
        } else {
            $data = array(
                'nama'          => Request()->nama,
                'harga'         => preg_replace("/[^0-9]/", "", Request()->harga),
                'keterangan'    => nl2br(Request()->keterangan),
                'updated_at'  => date('Y-m-d H:i:s')
            );
            $this->Produk->updateData($data, $id);
        }

        // dd($data);
        return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Produk = $this->Produk->getDataById($id);
        // dd($Produk);
        if ($Produk->foto_produk <> "") {
            unlink(public_path('/assets/product' . '/' . $Produk->foto_produk));
        }

        $this->Produk->deleteData($id);
        return redirect('product');
    }
}
