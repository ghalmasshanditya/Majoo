@extends('admin.layouts.master')
@section('title','List Kategori')
@section('page-name','List Kategori')
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
        <h2 class="card-title" style="float: left;">List Kategori </h2>
        <button type="button" class="btn btn-outline-primary btn-sm mt-0" data-toggle="modal" data-target="#add" style="float: right; top:0"><i class="fas fa-plus"></i> Tambah Kategori</button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th class="text-center" style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($kategori) == 0)
                    <tr class="text-center">
                        <td colspan="4" class="text-center">- No Data -</td>
                    </tr>
                    @endif
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($kategori as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>
                            @if (strlen($data->deskripsi) > 25)
                            @php
                                echo substr($data->deskripsi, 0,25).'...';
                            @endphp
                            @else
                            {{ $data->deskripsi }}
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">
                            <button type="button" class="btn btn-outline-warning btn-sm mt-1" style="width: 100%" data-toggle="modal" data-target="#edit{{ $data->id }}"><i class="fas fa-edit"> </i> Edit</button>
                            <button type="button" class="btn btn-outline-danger btn-sm mt-1" style="width: 100%" data-toggle="modal" data-target="#delete{{ $data->id }}"><i class="fas fa-trash"> </i> Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <span class="mt-0" style="float: right">{{ $kategori->links() }}</span>
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
            <form class="form-horizontal" method="POST" action="{{ route('kategori.add') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-0">
                        <div class="form-group">
                            <label for="nama">Nama Kategori</label>
                            <input type="text" maxlength="25" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama kategori" value="{{ old('nama') }}">
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi <small>(opsional)</small></label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="5" placeholder="Masukkan deskripsi singkat Kategori">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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

<!-- Edit Data -->
@foreach ($kategori as $data)
<div class="modal fade" id="edit{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/kategori/update/{{ $data->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body mt-0">
                        <div class="form-group">
                            <label for="nama">Nama Kategori</label>
                            <input type="text" maxlength="25" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama kategori" value="{{ $data->nama }}">
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi <small>(opsional)</small></label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="5" placeholder="Masukkan deskripsi singkat Kategori">{{ $data->deskripsi }}</textarea>
                            @error('deskripsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning">Ubah</button>
                </div>

            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endforeach


<!-- Delete Data -->
@foreach ($kategori as $data)
<div class="modal fade" id="delete{{ $data->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="/kategori/delete/{{ $data->id }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-danger text-white">
                    <h4 class="modal-title">Hapus Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus data kategori " {{ $data->nama }} " ?</p>
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
@endsection

