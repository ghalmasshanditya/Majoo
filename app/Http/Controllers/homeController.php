<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class homeController extends Controller
{
    public function __construct()
    {
        $this->Product = new Product();
    }

    public function index()
    {
        $data = array(
            'produk'    => $this->Product->getData(),
        );
        // dd($data);
        return view('users.home.index', $data);
    }
}
