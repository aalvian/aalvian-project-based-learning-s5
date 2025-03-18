@extends('home.submain')
@section('title', 'Pengembalian Alat')
@section('content')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.querySelector('input[name="tggl_kembali"]');
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    });
</script>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Form Pengembalian Alat</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('simpan-kembali') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_peminjaman" value="{{ $dtpeminjaman->id_peminjaman }}">

                    <div class="form-group">
                        <label for="nama">Nama Anggota</label>
                        <input type="text" class="form-control" value="{{ $dtpeminjaman->anggota->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" value="{{ $dtpeminjaman->anggota->nim }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="prodi">Prodi</label>
                        <input type="text"class="form-control" value="{{ $dtpeminjaman->anggota->prodi->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jml_barang">Jumlah Barang</label>
                        <input type="text" class="form-control" value="{{ $dtpeminjaman->jml_alat }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jml_barang">Nama Barang</label>
                        <input type="text" class="form-control" value="{{ $dtpeminjaman->alat->nama_alat }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tggl_pinjam">Tanggal Pinjam</label>
                        <input type="text" name="tggl_pinjam"class="form-control" value="{{ $dtpeminjaman->tggl_pinjam }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="tggl_kembali">Tanggal Kembali</label>
                        <input type="date" name="tggl_kembali" class="form-control" required>
                    </div>  
                    <div class="form-group">
                        <label for="image">Upload Bukti Pengembalian</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Kembalikan Alat</button>
                </form>

            </div>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection