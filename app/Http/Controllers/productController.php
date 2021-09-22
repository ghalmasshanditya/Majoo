<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class productController extends Controller
{

    public function __construct()
    {
        $this->Product = new Product();
        $this->Kategori = new Kategori();
    }

    public function listProduct()
    {
        $data = array(
            'product'  => $this->Product->getData(),
            'kategori' => $this->Kategori->getData(),
        );
        // dd($data);
        return view('admin.produk.listProduk', $data);
    }
    public function edit($id)
    {
        $data = array(
            'product'  => $this->Product->getDataById($id),
            'kategori' => $this->Kategori->getData(),
        );
        // dd($data);
        return view('admin.produk.editProduk', $data);
    }

    public function create(Request $request)
    {
        // $rules = [
        //     'nama'        => 'required|unique:produks',
        //     'harga'       => 'required',
        //     'keterangan'  => 'required',
        //     'kategori'  => 'required',
        //     'foto_produk' => 'required|mimes:png,jpg,jpeg|max:4048',
        // ];
        // $messages = [
        //     'nama.required'        => 'Silahkan isi nama terlebih dahulu',
        //     'nama.unique'          => 'Nama product sudah terdaftar pada database',
        //     'harga.required'       => 'Silahkan isi harga terlebih dahulu',
        //     'kategori.required'       => 'Silahkan pilih kategori produk terlebih dahulu',
        //     'keterangan.required'  => 'Silahkan isi keterangan terlebih dahulu',
        //     'foto_produk.required' => 'Silahkan pilih Foto terlebih dahulu',
        //     'foto_produk.mimes'    => 'Format harus png,jpg, atau jpeg',
        //     'foto_produk.max'      => 'Foto Maksimal 4mb',
        // ];
        // $validator = Validator::make($request->all(), $rules, $messages);
        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput($request->all())->with('message', 'error');
        // }

        $file     = Request()->foto_produk;
        $fileName = time() . '.' . $file->extension();
        $file->move(public_path('/assets/dist/img/produk'), $fileName);

        $data = array(
            'nama'          => Request()->nama,
            'harga'         => Request()->harga,
            'keterangan'    => nl2br(Request()->deskripsi),
            'id_kategori'    => Request()->id_kategori,
            'foto_produk'   => $fileName,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        );
        // dd($data);
        $this->Product->insert($data);

        return redirect('/product');
    }

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

    public function show(Product $produk)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nama'        => 'required|unique:produks',
            'harga'       => 'required',
            'deskripsi'   => 'required',
            'id_kategori' => 'required',
        ];
        $messages = [
            'nama.required'        => 'Silahkan isi nama terlebih dahulu',
            'nama.unique'          => 'Nama produk yang anda masukkan sudah terdaftar',
            'harga.required'       => 'Silahkan isi harga terlebih dahulu',
            'id_kategori.required' => 'Silahkan pilih kategori produk terlebih dahulu',
            'deskripsi.required'   => 'Silahkan isi deskripsi terlebih dahulu',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all())->with('toast_error', 'Gagal Menambah Data Produk');
        }
        // die;
        if (Request()->foto_produk <> "") {
            // echo Request()->unlink;
            // die;
            unlink(public_path('/assets/dist/img/produk' . '/' . Request()->unlink));

            $file     = Request()->foto_produk;
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('assets/dist/img/produk/'), $fileName);

            $data = array(
                'nama'          => Request()->nama,
                'harga'         => Request()->harga,
                'keterangan'    => nl2br(Request()->deskripsi),
                'foto_produk'   => $fileName,
                'updated_at'  => date('Y-m-d H:i:s')
            );
            $this->Product->updateData($data, $id);
        } else {
            $data = array(
                'nama'          => Request()->nama,
                'harga'         => Request()->harga,
                'keterangan'    => nl2br(Request()->deskripsi),
                'updated_at'  => date('Y-m-d H:i:s')
            );
            // dd($data);
            $this->Product->updateData($data, $id);
        }

        // dd($data);
        return redirect('product');
    }

    public function destroy($id)
    {
        $Produk = $this->Product->getDataById($id);
        // dd($Produk);
        if ($Produk->foto_produk <> "") {
            unlink(public_path('/assets/dist/img/produk' . '/' . $Produk->foto_produk));
        }

        $this->Product->deleteData($id);
        return redirect('product');
    }
}
