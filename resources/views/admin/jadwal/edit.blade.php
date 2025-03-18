@extends('home.submain')
@section('title', 'Edit Data')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Data Jadwal</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <form action="{{ route('update-jadwal', $jadwals->id_jadwal) }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="hari" style="font-weight: bold;"> Hari</label>
                            <input type="text" name="hari" id="hari" class="form-control" value="{{ $jadwals->hari }}">
                        </div>
                        <div class="form-group">
                            <label for="waktu_mulai" style="font-weight: bold;"> Waktu Mulai</label>
                            <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" value="{{ old('waktu_mulai') }}" placeholder="Masukkan Waktu Mulai" required>
                            @if ($errors->has('waktu_mulai'))
                            <div class="text-danger">{{ $errors->first('waktu_mulai') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="waktu_selesai" style="font-weight: bold;"> Waktu Selesai</label>
                            <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" value="{{ old('waktu_selesai') }}" placeholder="Masukkan Waktu Selesai" required>
                            @if ($errors->has('waktu_selesai'))
                            <div class="text-danger">{{ $errors->first('waktu_selesai') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="id_divisi" style="font-weight: bold;">Pilih Divisi</label>
                            <select name="id_divisi" id="id_divisi" class="form-control">

                                @foreach ($divisis as $divisi)
                                <option value="{{ $divisi->id_divisi }}" @if ($divisi->id_divisi == $jadwals->id_divisi)
                                    selected @endif>{{ $divisi->nama }}</option>
                                @endforeach
                            </select>
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