@extends('home.submain')
@section('title', 'Anggota')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="mb-2 mb-4 text-gray-800 h3">Tabel Pengurus</h1>

        <!-- DataTales Example -->
        <div class="mb-4 shadow card">
            <div class="py-3 card-header">
                {{-- <a href="{{ route('create-pengurus') }}" class="ml-auto btn btn-primary btn-sm"><i class="fas fa-plus"></i>
                    Tambah</a>
            </div> --}}

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>Prodi</th>
                                {{-- <th>Divisi</th> --}}
                                <th>Jabatan</th>
                                <th>Divisi</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dtPengurus as $item)
                                {{-- @if ($item->jabatan_2 == 'pengurus') --}}
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nim }}</td>
                                        <td>{{ $item->prodi ? $item->prodi->nama : 'belum memilih prodi' }}</td>
                                        <td>
                                            <ul>
                                                @forelse ($item->jabatan as $jabatan)
                                                    <li>{{$jabatan->nama}}</li>
                                                @empty
                                                    <li>Tidak ada data jabatan</li>
                                                @endforelse
                                            </ul>
                                        </td>

                                        <td>
                                                @foreach ($item->divisi as $divisi)
                                                    <li>{{ $divisi->nama }}</li>
                                                @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('JabatanT', $item->id_anggota) }}" {{ $item->id_anggota }} class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Tambah Jabatan</a>
                                            <a href="{{ route('Delete', $item->id_anggota) }}" {{ $item->id_anggota }} class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Hapus</button>
                                        </td>

                                    </form>
                                    </tr>
                                {{-- @endif --}}
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