@extends('admin.layouts.master')
@section('title','Profile')
@section('page-name','Profile')
@section('content')
<div class="col-md-3">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img style="width: 125px; height:125px" class="profile-user-img img-fluid img-circle" @if (Auth::user()->foto == '') src="{{ asset('assets') }}/dist/img/profile/profile.png" @else src="{{ asset('assets') }}/dist/img/profile/{{ Auth::user()->foto }}" @endif alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
        <form class="form-horizontal text-center" method="POST" action="/profile/change-profile/{{ Auth::user()->id }}" enctype="multipart/form-data">
            @csrf
            <input type="file" class="form-control @error('profile') is-invalid @enderror" id="profile" name="profile" placeholder="profile title" value="{{ old('profile') }}">
            @error('profile')
                <small class="text-danger">{{ $message }}</small><br>
            @enderror
            <button type="submit" class="btn btn-primary mt-2 mb-2 center-block">Upload</button>
        </form>
        {{-- <p class="text-muted text-center">Back End Developer</p> --}}

        <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item">
            <b>Email</b><br> <a class="text-muted">{{ Auth::user()->email }}</a><br>
            <b>Telepon</b><br> <a class="text-muted">{{ Auth::user()->phone }}</a><br>
            <b>Alamat</b><br> <a class="text-muted">{{ Auth::user()->alamat }}</a>
        </li>

        </ul>

        {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->

</div>
<!-- /.col -->
<div class="col-md-9">
    <div class="card">

    <div class="card-body">
        <div class="tab-content">
        <div class="active tab-pane" id="profile">
            <form class="form-horizontal" action="/profile/update/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" maxlength="75" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value="{{ Auth::user()->name }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email" name="email" disabled value="{{ Auth::user()->email }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="Birth" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control @error('birth') is-invalid @enderror" id="Birth" placeholder="Birth" name="birth" value="{{ Auth::user()->birth }}">
                    @error('birth')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select class="form-control @error('jk') is-invalid @enderror select2bs4" style="width: 100%;" name="jk" value="{{ Auth::user()->jk }}">
                        <option selected="selected" disabled>- Pilih Jenis Kelamin -</option>
                        <option @if (Auth::user()->jk == 'Men') selected @endif value="Men">Laki - Laki</option>
                        <option @if (Auth::user()->jk == 'Women') selected @endif value="Women">Perempuan</option>
                    </select>
                    @error('jk')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="phone" maxlength="15" name="phone" value="{{ Auth::user()->phone }}">
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('alamat') is-invalid @enderror col-sm-12" placeholder="Alamat"  name="alamat" id="" rows="5">{{ Auth::user()->alamat }}</textarea>
                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            </form>
        </div>
        <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
@section('script')
@endsection
