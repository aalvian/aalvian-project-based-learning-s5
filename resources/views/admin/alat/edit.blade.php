@extends('home.submain')
@section('title', 'Edit Data')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-4 text-gray-800 h3">Edit Data alat</h1>


    <!-- DataTales Example -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary"></h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <form action="{{ route('updatealat', $alats->id_alat) }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="nama_alat" style="font-weight: bold;"> Nama</label>
                            <input type="text" name="nama_alat" id="nama_alat" class="form-control" value="{{ $alats->nama_alat }}">
                        </div>

                        <div class="form-group">
                            <label for="stok" style="font-weight: bold;"> Stok</label>
                            <input type="number" name="stok" id="stok" class="form-control" value="{{ $alats->stok }}">
                            @error('stok')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Ubah Data</button>
                        </div>

                    </form>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection