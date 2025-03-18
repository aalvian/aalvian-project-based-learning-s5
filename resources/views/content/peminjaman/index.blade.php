@extends('home.submain')
@section('title', 'Create Data')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 mb-4">Tabel Peminjaman Alat</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('create-pinjam') }}" class="btn btn-primary btn-sm ml-auto"><i class="fas fa-plus"></i>
                    Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Nim</th>
                                <th>Prodi</th>
                                <th>Alat</th>
                                <th>Jumlah Alat</th>
                                <th>Tanggal Pinjam</th>
                                <th>Petugas</th>
                                 <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($peminjaman as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->anggota->nama }}</td>
                                    <td>{{ $item->anggota->nim }}</td>
                                    <td>{{ $item->anggota->prodi->nama }}</td>
                                    <td>{{ $item->alat->nama_alat }}</td>
                                    <td>{{ $item->jml_alat }}</td>
                                    
                                    <td>{{ date('d-m-Y', strtotime($item->tggl_pinjam)) }}</td>
                                    <td>{{ $item->nama_petugas ? $item->nama_petugas : 'N/A' }}</td>

                                    <td class="text-center" style="width: 15%;">
                                        <form action="{{ route('create-kembali', $item->id_peminjaman) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="bi bi-arrow-return-left"></i> Kembalikan
                                            </button>
                                        </form>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    {{-- sweet alert --}}
    @include('sweetalert::alert')
    @endsection