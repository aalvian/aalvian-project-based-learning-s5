@extends('home.submain')
@section('title', 'Create Data')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create Data Divisi</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <form action="{{ route('storeDivisi')}}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="nama" style="font-weight: bold;"> Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Divisi" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Simpan Data</button>
                        </div>

                    </form>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection