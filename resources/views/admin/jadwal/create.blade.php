@extends('home.submain')
@section('title', 'Create Data')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create Data Jadwal</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('simpan-jadwal') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="hari" style="font-weight: bold;"> Hari</label>
                        <select id="hari" name="hari" class="form-control">
                            <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            <option value="Minggu" {{ old('hari') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                        </select>
                        @if ($errors->has('hari'))
                            <div class="text-danger">{{ $errors->first('hari') }}</div>
                        @endif
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
                            @foreach($divisis as $divisi)
                                <option value="{{ $divisi->id_divisi }}" {{ old('id_divisi') == $divisi->id_divisi ? 'selected' : '' }}>{{ $divisi->nama }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('divisi_id'))
                            <div class="text-danger">{{ $errors->first('divisi_id') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
