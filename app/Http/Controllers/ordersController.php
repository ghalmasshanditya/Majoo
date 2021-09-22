<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ordersController extends Controller
{
    public function __construct()
    {
        $this->Orders = new Orders();
        $this->Product = new Product();
    }

    public function index()
    {
        return view('admin.order.listOrder', [
            'order' => DB::table('orders')->Join('produks', 'produks.id_produk', '=', 'orders.id_produk')->paginate(5),
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'firstName' => 'required',
            'lastName'  => 'required',
            'email'      => 'required',
            'telp'       => 'required',
            'alamat'     => 'required',
            'provinsi'   => 'required',
            'kabupaten'  => 'required',
            'code'       => 'required',
        ];
        $messages = [
            'firstName.required' => 'Silahkan isi Nama Depan terlebih dahulu',
            'lastName.required'  => 'Silahkan isi Nama Belakang terlebih dahulu',
            'email.unique'        => 'Silahkan isi email anda terlebih dahulu',
            'telp.required'       => 'Silahkan isi nomor telepon terlebih dahulu',
            'alamat.required'     => 'Silahkan isi nomor telepon terlebih dahulu',
            'provinsi.required'   => 'Silahkan isi provinsi terlebih dahulu',
            'kabupaten.required'  => 'Silahkan isi kabupaten terlebih dahulu',
            'code.required'       => 'Silahkan isi kode pos terlebih dahulu',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all())->with('error', 'Pembelian produk gagal!');
        }
        $data = array(
            'id_produk'  => Request()->id_produk,
            'first_name' => Request()->firstName,
            'last_name'  => Request()->lastName,
            'email'      => Request()->email,
            'telp'       => Request()->telp,
            'alamat'     => Request()->alamat,
            'provinsi'   => Request()->provinsi,
            'kabupaten'  => Request()->kabupaten,
            'kode_pos'   => Request()->code,
            'total'      => Request()->total,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        );
        // dd($data);
        $this->Orders->insert($data);
        return redirect('/')->with('success', 'Pembelian Barang Berhasil!');
    }

    public function fillCheckout($id)
    {
        $data = array(
            'produk'    => $this->Product->getDataById($id),
        );
        // dd($data);
        return view('users.checkout.checkoutProduct', $data);
    }
}
