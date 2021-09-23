<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class productController extends Controller
{

    public function __construct()
    {
        $this->Product = new Product();
        $this->Kategori = new Kategori();
    }

    public function listProduct(Request $request)
    {

        return view('admin.produk.listProduk', [
            'product' => DB::table('produks')->paginate(5),
            'kategori' => $this->Kategori->getData(),
        ]);
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
        $rules = [
            'nama'        => 'required|unique:produks',
            'harga'       => 'required',
            'deskripsi'   => 'required',
            'id_kategori'    => 'required',
            'foto_produk' => 'required|mimes:png,jpg,jpeg|max:4048',
        ];
        $messages = [
            'nama.required'        => 'Silahkan isi nama terlebih dahulu',
            'nama.unique'          => 'Nama product sudah terdaftar pada database',
            'harga.required'       => 'Silahkan isi harga terlebih dahulu',
            'id_kategori.required'    => 'Silahkan pilih kategori produk terlebih dahulu',
            'deskripsi.required'   => 'Silahkan isi deskripsi terlebih dahulu',
            'foto_produk.required' => 'Silahkan pilih Foto terlebih dahulu',
            'foto_produk.mimes'    => 'Format harus png,jpg, atau jpeg',
            'foto_produk.max'      => 'Foto Maksimal 4mb',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all())->with('gagal', 'Produk gagal ditambahkan!');
        }

        $file     = Request()->foto_produk;
        $fileName = time() . '.' . $file->extension();
        $file->move(public_path('/assets/dist/img/produk'), $fileName);

        $data = array(
            'nama'        => Request()->nama,
            'harga'       => Request()->harga,
            'deskripsi'  => nl2br(Request()->deskripsi),
            'id_kategori' => Request()->id_kategori,
            'foto_produk' => $fileName,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        );
        // dd($data);
        $this->Product->insert($data);

        return redirect('/product')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function fillCheckout($id)
    {
        $data = array(
            'produk'    => $this->Produk->getDataById($id),
        );
        // dd($data);
        return view('users.checkout.checkoutProduct', $data);
    }

    public function update(Request $request, $id)
    {


        if (Request()->nama == Request()->unique) {
            $rules = [
                'nama'        => 'required',
                'harga'       => 'required',
                'deskripsi'   => 'required',
                'id_kategori' => 'required',
            ];
            $messages = [
                'nama.required'        => 'Silahkan isi nama terlebih dahulu',
                'harga.required'       => 'Silahkan isi harga terlebih dahulu',
                'id_kategori.required' => 'Silahkan pilih kategori produk terlebih dahulu',
                'deskripsi.required'   => 'Silahkan isi deskripsi terlebih dahulu',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput($request->all())->with('gagal', 'Produk gagal diperbarui!');
            }
        } else {
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
                return back()->withErrors($validator)->withInput($request->all())->with('gagal', 'Produk gagal diperbarui!');
            }
        }


        if (Request()->foto_produk <> "") {
            unlink(public_path('/assets/dist/img/produk' . '/' . Request()->unlink));

            $file     = Request()->foto_produk;
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('assets/dist/img/produk/'), $fileName);

            if (Request()->nama == Request()->unique) {
                $data = array(
                    'harga'         => Request()->harga,
                    'deskripsi'    => nl2br(Request()->deskripsi),
                    'foto_produk'   => $fileName,
                    'updated_at'  => date('Y-m-d H:i:s')
                );
            } else {
                $data = array(
                    'nama'          => Request()->nama,
                    'harga'         => Request()->harga,
                    'deskripsi'    => nl2br(Request()->deskripsi),
                    'foto_produk'   => $fileName,
                    'updated_at'  => date('Y-m-d H:i:s')
                );
            }

            $this->Product->updateData($data, $id);
        } else {
            if (Request()->nama == Request()->unique) {
                $data = array(
                    'harga'         => Request()->harga,
                    'deskripsi'    => nl2br(Request()->deskripsi),
                    'updated_at'  => date('Y-m-d H:i:s')
                );
            } else {
                $data = array(
                    'nama'          => Request()->nama,
                    'harga'         => Request()->harga,
                    'deskripsi'    => nl2br(Request()->deskripsi),
                    'updated_at'  => date('Y-m-d H:i:s')
                );
            }

            // dd($data);
            $this->Product->updateData($data, $id);
        }

        // dd($data);
        return redirect('product')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $Produk = $this->Product->getDataById($id);
        // dd($Produk);
        if ($Produk->foto_produk <> "") {
            unlink(public_path('/assets/dist/img/produk' . '/' . $Produk->foto_produk));
        }

        $this->Product->deleteData($id);
        return redirect('product')->with('success', 'Produk berhasil dihapus!');
    }
}
