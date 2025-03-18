@extends('home.submain')
@section('title', 'Tambah Jabatan')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mb-4 text-gray-800 h3">Tambah Jabatan</h1>

    <!-- Card untuk Form -->
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Jabatan</h6>
        </div>
        <div class="card-body">

            <h5>Data Anggota</h5>
            <ul>
                <li><strong>Nama:</strong> {{ $dtAnggota->nama }}</li>
                <li><strong>Nim:</strong> {{ $dtAnggota->nim }}</li>
                <li><strong>Semester:</strong> {{ $dtAnggota->semester }}</li>
            </ul>

            <h5>Jabatan Saat Ini:</h5>
            <ul>
                @forelse ($dtAnggota->jabatan as $jabatan)
                <li>{{$jabatan->nama}}</li>
                @empty
                    <li>Tidak ada data jabatan</li>
                @endforelse
            </ul>

            <h5>Divisi Saat Ini:</h5>
            <ul>
                @forelse ($dtAnggota->divisi as $divisi)
                    <li>{{ $divisi->nama }}</li>
                @empty
                    <li>Belum memiliki divisi.</li>
                @endforelse
            </ul>

            <!-- Form Tambah Jabatan -->
            <form action="{{ route('JabatanTambah', $dtAnggota->id_anggota) }}" method="post">
                @csrf
                <!-- Pilih Jabatan -->
                <div class="form-group">
                    <label for="jabatan">Jabatan yang Akan Dihapus:</label>
                    <input type="text" name="jabatan_readonly" id="jabatan" class="form-control" value="Pengurus Harian" readonly>
                    <input type="hidden" name="jabatan" value="1">
                </div>

                @if ($errors->has('jabatan_id'))
                    <span class="text-danger">{{ $errors->first('jabatan') }}</span>
                @endif

                <!-- Tombol Submit -->
                <div class="mt-3 form-group">
                    <button type="submit" class="btn btn-success">Simpan Jabatan</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection