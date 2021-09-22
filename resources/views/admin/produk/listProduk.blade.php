@extends('admin.layouts.master')
@section('title','List Product')
@section('page-name','List Product')
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
        <h2 class="card-title" style="float: left;">List Product </h2>
        <button type="button" class="btn btn-outline-primary btn-sm mt-0" data-toggle="modal" data-target="#add" style="float: right; top:0"><i class="fas fa-plus"></i> Tambah Produk</button><br>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table id="user_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto Produk</th>
                        <th>Nama Produk</th>
                        <th >Harga</th>
                        <th class="text-center" style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($product) == 0)
                        <tr class="text-center">
                        <td colspan="5" class="text-center">- No Data -</td>
                    </tr>
                    @endif
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($product as $data)
                    <tr>
                        <td>{{$no++}}</td>
                        <td class="text-center">
                            <a class="image-popup-no-margins" href="{{ url('assets/dist/img/produk/'.$data->foto_produk) }}" target="_blank">
                                <img class="img-fluid" alt="" src="{{ url('assets/dist/img/produk/'.$data->foto_produk) }}" width="150px" height="50px">
                            </a>
                        </td>
                        <td>{{ $data->nama }}</td>
                        <td>@currency($data->harga)</td>
                        <td class="text-center" style="width: 10%">
                            <button type="button" class="btn btn-outline-info btn-sm mt-1" style="width: 100%" data-toggle="modal" data-target="#read{{ $data->id_produk }}"><i class="fas fa-eye"> </i> Detail</button>
                            <a href="/product/edit/{{ $data->id_produk }}"><button type="button" class="btn btn-outline-warning btn-sm mt-1" style="width: 100%"><i class="fas fa-edit"> </i> Edit</button></a>
                                
                            <button type="button" class="btn btn-outline-danger btn-sm mt-1" style="width: 100%" data-toggle="modal" data-target="#delete{{ $data->id_produk }}"><i class="fas fa-trash"> </i> Hapus</button>
                        </td>
                    </tr>
                    @endforeach  
                </tbody>
            </table>
            <span class="mt-0" style="float: right">{{ $product->links() }}</span>
        </div>
        
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- Add Data -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="{{ route('product.add') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Produk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
                        <div class="form-group">
                            <label for="nama">Nama Produk</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan Nama Produk" value="{{ old('nama') }}">
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" onkeypress="return Angka(event)" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" placeholder="Masukkan Harga Produk" value="{{ old('harga') }}">
                            @error('harga')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kategori Produk</label>
                            <select class="form-control @error('id_kategori') is-invalid @enderror select2bs4" name="id_kategori" value="{{ old('id_kategori') }}">
                                <option selected="selected" disabled>- Kategori -</option>
                                @foreach ($kategori as $item)
                                <option @if (old('id_kategori') == $item->id) selected @endif value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea id="task-textarea"  name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="5" placeholder="Masukkan Deskripsi">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="foto_produk">Foto Produk</label>
                            <input type="file" class="form-control @error('foto_produk') is-invalid @enderror" id="foto_produk" name="foto_produk" placeholder="Masukkan Foto Produk" value="{{ old('foto_produk') }}">
                            <small>Foto Produk harus memiliki ekstensi JPG, JPEG, atau PNG dengan maksimum ukuran file 4MB.</small>
                            @error('foto_produk')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            {{-- <div class="progress">
                                <div class="bar progress-bar progress-bar-striped progress-bar-animated"></div >
                            </div>
                            <div class="percent" style="float: right">0%</div > --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>

            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Delete Data -->
@foreach ($product as $data)
<div class="modal fade" id="delete{{ $data->id_produk }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/product/delete/{{ $data->id_produk }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-danger text-white">
                    <h4 class="modal-title">Hapus Produk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus produk "{{ $data->nama }}"</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>

            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach

<!-- Detail Produk -->
@foreach ($product as $data)
<div class="col-sm-6 col-md-3 mt-4">
    <!-- sample modal content -->
    <div id="read{{$data->id_produk}}" class="modal fade  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Detail - {{ $data->nama }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form style="padding: 15px;" action="#" method="POST" enctype="multipart/form-data">
                       @csrf
                       {{-- <h5 class="mt-0">Informasi Produk</h5><hr> --}}
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
                        <div class="form-group mt-2">
                            <div class="row">
                                <label class="col-md-3" for="varchar">Kategori Produk</label>
                                <div class="col-md-9">
                                    <select class="form-control select2bs4" name="id_kategori" disabled>
                                        <option disabled>- Kategori -</option>
                                        @foreach ($kategori as $item)
                                        <option @if ($data->id_kategori == $item->id) selected @endif value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3" for="deskripsi">Harga Produk </label>
                                <div class="col-md-9">
                                    <input type="text"  class="form-control" value="@currency($data->harga)" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-3" for="deskripsi">Deskripsi <br>
                                </label>
                                <div class="col-md-9">
                                    {!! $data->deskripsi !!}
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
<script>
    function Angka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
@endsection

@section('script')
<script>
    ClassicEditor
        .create( document.querySelector( '#task-textarea' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

{{-- <script type="text/javascript">
 
    var SITEURL = "{{URL('/')}}";
     
    $(function() {
        $(document).ready(function(){
            var bar = $('.bar');
            var percent = $('.percent');
     
            $('form').ajaxForm({
                beforeSend: function() {
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                complete: function(xhr) {
                    // alert('Foto Berhasil diunggah');
                    window.location.href = SITEURL +"/"+"product";
                }
            });
        }); 
    });
</script> --}}
@endsection