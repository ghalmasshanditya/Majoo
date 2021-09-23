@extends('admin.layouts.master')
@section('title','Edit Product')
@section('page-name','Edit Product')
@section('content')
<div class="col-md-12">
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
    <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Edit Product</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="/product/update/{{ $product->id_produk }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan Nama Produk" value="{{ $product->nama }}">
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" onkeypress="return Angka(event)" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" placeholder="Masukkan Harga Produk" value="{{ $product->harga }}">
                    @error('harga')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Kategori Produk</label>
                    <select class="form-control @error('id_kategori') is-invalid @enderror select2bs4" name="id_kategori" value="{{ old('id_kategori') }}">
                        <option selected="selected" disabled>- Kategori -</option>
                        @foreach ($kategori as $item)
                        <option @if ($product->id_kategori == $item->id) selected @endif value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="task-textarea" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="5" placeholder="Masukkan Deskripsi">{!! $product->deskripsi !!}</textarea>
                    @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="foto_produk">Foto Produk <small>(opsional edit)</small></label>
                    <input type="file" class="form-control @error('foto_produk') is-invalid @enderror" id="foto_produk" name="foto_produk" placeholder="Masukkan Foto Produk" value="{{ old('foto_produk') }}">
                    <small>Foto Produk harus memiliki ekstensi JPG, JPEG, atau PNG dengan maksimum ukuran file 4MB.</small>
                    @error('foto_produk')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <!-- Saya comment karena apabila ada progressbar maka aler form validation tidak jalan -->

                    {{-- <div class="progress">
                        <div class="bar progress-bar progress-bar-striped progress-bar-animated"></div >
                    </div>
                    <div class="percent" style="float: right">0%</div > --}}
                </div>
            </div>
            <!-- /.card-body -->
            <input type="hidden" name="unlink" value="{{ $product->foto_produk }}">
            <input type="hidden" name="unique" value="{{ $product->nama }}">
            <div class="card-footer">
                <a href="{{ route('product') }}"><button type="button" class="btn btn-primary">Kembali</button></a>
                <button type="submit" class="btn btn-warning">Edit</button>
            </div>
        </form>
    </div>
</div>

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
<!-- Saya comment karena apabila ada progressbar maka aler form validation tidak jalan -->
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
