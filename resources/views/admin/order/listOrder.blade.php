@extends('admin.layouts.master')
@section('title','List Orders')
@section('page-name','List Orders')
@section('content')
<div class="col-12">
    @if (session()->has('gagal'))
        <div class="alert alert-danger" role="alert" id="alert">
            <button class="close" data-dismiss="alert">x</button>
            {{ session()->get('gagal') }}
        </div>
    @elseif(session()->has('success'))
        <div class="alert alert-success" role="alert" id="alert">
            <button class="close" data-dismiss="alert">x</button>
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="card">
    <div class="card-header">
        <h2 class="card-title" style="float: left;">List Orders </h2>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="user_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto Produk</th>
                        <th>Nama Pembeli</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($order) == 0)
                        <tr class="text-center">
                        <td colspan="6" class="text-center">- No Data -</td>
                    </tr>
                    @endif
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($order as $data)
                    <tr>
                        <td>{{$no++}}</td>
                        <td class="text-center">
                            <a class="image-popup-no-margins" href="{{ url('assets/dist/img/produk/'.$data->foto_produk) }}">
                                <img class="img-fluid" alt="" src="{{ url('assets/dist/img/produk/'.$data->foto_produk) }}" width="100px" height="50px">
                            </a>
                        </td>
                        <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>@currency($data->harga)</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-outline-info btn-sm mt-1" style="width: 100%" data-toggle="modal" data-target="#read{{ $data->id_produk }}"><i class="fas fa-eye"> </i> Detail</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <span class="mt-0" style="float: right">{{ $order->links() }}</span>
        </div>
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@foreach ($order as $data)
<div class="col-sm-6 col-md-3 mt-4">
    <!-- sample modal content -->
    <div id="read{{$data->id_produk}}" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">{{ $data->first_name }} {{ $data->last_name }} - {{ $data->nama }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form style="padding: 15px;" action="#" method="POST" enctype="multipart/form-data">
                       @csrf
                       <h5 class="mt-0">Informasi Produk</h5><hr>
                        <div class="form-group mt-2">
                            <div class="row">
                                <label class="col-md-3" for="varchar">Foto Produk</label>
                                <div class="col-md-9 text-center">
                                    <img src="{{ url('assets/dist/img/produk/'.$data->foto_produk) }}" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <div class="row">
                                <label class="col-md-3" for="varchar">Nama Produk</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="{{$data->nama}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3" for="deskripsi">Harga Produk </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="@currency($data->harga)" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3" for="deskripsi">Keterangan <br>
                                </label>
                                <div class="col-md-9">
                                    {!! $data->deskripsi !!}
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4">Informasi Pembeli</h5><hr>
                        <div class="form-group mt-2">
                            <div class="row">
                                <label class="col-md-3" for="varchar">Nama Pembeli</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="{{$data->first_name}} {{ $data->last_name }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3" for="deskripsi">Email </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="{{ $data->email }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3" for="deskripsi">No Telp </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="{{ $data->telp }}" readonly>
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4">Informasi Pengiriman</h5><hr>
                        <div class="form-group mt-2">
                            <div class="row">
                                <label class="col-md-3" for="varchar">Alamat Pengiriman</label>
                                <div class="col-md-9">
                                    <textarea placeholder="Text here" class="form-control" rows="8" cols="20" readonly>{{$data->alamat}}, {{ $data->kabupaten }}, {{ $data->provinsi }} ({{ $data->kode_pos }})</textarea>
                                </div>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Keluar</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>
@endforeach
@endsection

@section('script')
@endsection
