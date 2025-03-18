@extends('home.submain')
@section('title', 'Alat')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 mb-4">Tabel Alat</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('FormAlat') }}" class="btn btn-primary btn-sm ml-auto"><i class="fas fa-plus"></i>
                    Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Stok</th>
                                <th>Tanggal Masuk</th>

                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dtAlat as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_alat}}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tggl_masuk)) }}</td>

                                    <td class="text-center" style="width: 15%;">
                                        <form onsubmit="return confirm('Apakah Anda Yakin Menghapus?');"
                                            action="{{ route('hapusalat', $item->id_alat) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            @php $id_alat = Crypt::encrypt($item->id_alat); @endphp
                                            <a href="{{ route('FindId', $id_alat) }}" {{ $item->id_alat }}
                                                class="btn btn-sm btn-primary" ><i class="fas fa-edit"></i> Edit</a>

                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                    class="fas fa-trash-alt"></i> Hapus</button>
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