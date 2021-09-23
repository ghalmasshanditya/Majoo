@extends('users.layouts.master')
@section('title','Checkout')
@section('content')
<main>
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="{{asset('assets/dist/img/icons')}}/majoo.png" alt="" width="75" height="65">
        <h2>Formulir Pembelian</h2>
        <p class="lead">Silahkan lengkapi formulir dibawah ini untuk melakukan pembelian produk.</p>
    </div>

    <div class="row g-5">
    <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Detail Produk</span>
        </h4>
        <ul class="list-group mb-3">
        <li class="list-group-item justify-content-between lh-sm">
            <div class="text-center border-1">
                <img src="{{ asset('assets') }}/dist/img/produk/{{ $produk->foto_produk }}" class="rounded" alt="...">
            </div>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
                <h6 class="my-0">{{ $produk->nama }}</h6>
                <small class="text-muted">
                   {!! $produk->deskripsi !!}
                </small>
            </div>
            <span class="text-muted">@currency($produk->harga)</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
            <span>Total (RP)</span>
            <strong>@currency($produk->harga)</strong>
        </li>
        </ul>

    </div>
    <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Alamat Penerima</h4>
        <form class="needs-validation" action="{{ url('/check-out/process') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">Nama Depan</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" value="{{ old('firstName') }}" required>
                <div class="invalid-feedback">
                    Silahkan masukkan nama depan.
                </div>
            </div>

            <div class="col-sm-6">
                <label for="lastName" class="form-label">Nama Belakang</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" value="{{ old('lastName') }}" required>
                <div class="invalid-feedback">
                    Silahkan masukkan nama belakang.
                </div>
            </div>

            <div class="col-12">
                <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                <input type="email" value="{{ old('email') }}" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                <div class="invalid-feedback">
                    Silahkan masukkan email yang benar.
                </div>
            </div>

            <div class="col-12">
                <label for="telp" class="form-label">Nomor Telepon</label>
                <input type="text" maxlength="13" value="{{ old('telp') }}" class="form-control" id="telp" name="telp" placeholder="089******" required>
                <div class="invalid-feedback">
                    Silahkan masukkan nomor telepon.
                </div>
            </div>

            <div class="col-12">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" value="{{ old('alamat') }}" class="form-control" id="alamat" name="alamat" placeholder="Jl. Mahakam No.25, Surabaya" required>
                <div class="invalid-feedback">
                    Silahkan masukkan alamat pengiriman.
                </div>
            </div>

            <div class="col-md-5">
                <label for="provinsi" class="form-label">Provinsi</label>
                <input type="text" value="{{ old('provinsi') }}" class="form-control" id="provinsi" name="provinsi" placeholder="Jawa Timur" required>
                <div class="invalid-feedback">
                    Silahkan masukkan provinsi.
                </div>
            </div>

            <div class="col-md-4">
                <label for="Kabupate" class="form-label">Kabupaten / Kota</label>
                <input type="text" value="{{ old('kabupaten') }}" class="form-control" id="kabupaten" name="kabupaten" placeholder="Jawa Timur" required>
                <div class="invalid-feedback">
                    Silahkan masukkan kabupaten / kota.
                </div>
            </div>

            <div class="col-md-3">
                <label for="kode_pos" class="form-label">Kode Pos</label>
                <input type="text" value="{{ old('code') }}" class="form-control" id="code" name="code" placeholder="61268" required>
                <div class="invalid-feedback">
                    Silahkan masukkan kode pos.
                </div>
            </div>
        </div>
        <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}" id="">
        <input type="hidden" name="total" value="{{ $produk->harga }}" id="">
        <hr class="my-3">

        <button class="w-100 btn text-white btn-lg" style="background: #07C53C" type="submit">Lanjutkan Pembelian</button>
        </form>
    </div>
    </div>
</main>
@endsection

