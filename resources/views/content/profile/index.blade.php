@extends('home.submain')
@section('title', 'Profile')
@section('content')

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Profile</h1>
        <div class="row">

            <div class="col-lg-4 order-lg-2">
                <div class="card shadow mb-4">
                    @if (Auth::user()->gambar !== null)
                        <div class="card-profile-image mt-4 d-flex justify-content-center">
                            <a>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('storage/foto/' . Auth::user()->gambar) }}" width="160" height="160"  style="width: 150px; height: 150px; object-fit: cover;">
                            </a>
                        </div>
                    @else
                        <div class="card-profile-image mt-4 d-flex justify-content-center">
                            <a>
                                <img class="img-profile rounded-circle" src="{{ asset('template/img/undraw_profile.svg') }}"
                                    width="160" height="160">
                            </a>
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('gambar-profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <h5 class="font-weight-bold">{{ Auth::user()->anggota->nama }}</h5>
                                        <p class="font-weight">{{ Auth::user()->role }}</p>

                                        <div class="mb-3">
                                            <input type="file" id="gambar" name="gambar" style="opacity:0; display:none" class="btn btn-primary">
                                            <label for="gambar" class="btn btn-primary btn-block">Ubah Foto</label>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="submit" class="btn btn-success flex-grow-1 mr-1">Simpan</button>
                                            <button type="submit" form="deleteForm" class="btn btn-danger flex-grow-1 ml-1">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form id="deleteForm" action="{{ route('delete-profile') }}" method="POST">
                            @csrf
                        </form>
                    </div>


                </div>
            </div>


            <div class="col-lg-8 order-lg-1">
                <div class="card shadow mb-4">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Akun Saya</h6>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('update-profile') }}" autocomplete="off">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="hidden" name="_method" value="PUT">

                            <h6 class="heading-small text-muted mb-4">Informasi User</h6>

                            {{-- Form --}}
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">Nama<span
                                                    class="small text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control" name="name"
                                                placeholder="Name" value="{{ old('name', Auth::user()->anggota->nama) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Email
                                                <span class="small text-danger">*</span></label>
                                            <input type="email" id="email" class="form-control" name="email"
                                                placeholder="example@example.com"
                                                value="{{ old('email', Auth::user()->email) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="current_password">Current
                                                password</label>
                                            <input type="password" id="current_password" class="form-control"
                                                name="current_password" placeholder="Current password">
                                            @error('current_password')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Warning!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="new_password">New
                                                password</label>
                                            <input type="password" id="new_password" class="form-control"
                                                name="new_password" placeholder="New password">
                                            @error('new_password')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Warning!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="confirm_password">Confirm
                                                password</label>
                                            <input type="password" id="confirm_password" class="form-control"
                                                name="password_confirmation" placeholder="Confirm password">
                                            @error('password_confirmation')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Warning!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>

    {{-- sweet alert --}}
    @include('sweetalert::alert')

@endsection
