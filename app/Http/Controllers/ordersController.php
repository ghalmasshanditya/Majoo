<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ordersController extends Controller
{
    public function __construct()
    {
        $this->Orders = new Orders();
        $this->Product = new Product();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'order'    => $this->Orders->getData(),
        );
        // dd($data);
        return view('admin.order.listOrder', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'id_produk'  => Request()->id_produk,
            'first_name' => Request()->firstName,
            'last_name'  => Request()->lastName,
            'email'      => Request()->email,
            'telp'       => Request()->telp,
            'alamat'     => Request()->address,
            'provinsi'   => Request()->provinsi,
            'kabupaten'  => Request()->kabupaten,
            'kode_pos'   => Request()->code,
            'total'      => Request()->total,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        );
        // dd($data);
        $this->Order->insert($data);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        //
    }

    public function fillCheckout($id)
    {
        $data = array(
            'produk'    => $this->Produk->getDataById($id),
        );
        // dd($data);
        return view('users.checkout.thanksCheckout', $data);
    }
}
