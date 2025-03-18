@extends('home.submain')
@section('title', 'Divisi')
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 mb-4">Tabel Divisi</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @role('admin')
            <a href="{{ route('tambahdivisi') }}" class="btn btn-primary btn-sm ml-auto"><i class="fas fa-plus"></i>
                Tambah</a>
            @endrole
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            @role('admin')
                            <th>Aksi</th>
                            @endrole
                            @role('anggota')
                            <th>anggota</th>
                            @endrole
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($dtDivisi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            @php $id = Crypt::encrypt($item->id_divisi); @endphp
                            @role('anggota')
                            <td>
                                <a href="{{ route('view-anggota', $id) }}" class="btn btn-primary btn-sm"><i class="fas fa-user-friends"></i> anggota</a>
                            </td>
                            @endrole

                            </td>
                            @role('admin')
                            <td class="text-center" style="width: 15%;">

                                <form onsubmit="return confirm('Apakah Anda Yakin Menghapus?');" action="{{ route('hapusdivisi', $item->id_divisi) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @php $id_divisi = Crypt::encrypt($item->id_divisi); @endphp
                                    <a href="{{ route('editdivisi', $id_divisi) }}" {{ $id_divisi }} class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>

                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Hapus</button>
                                </form>
                            </td>
                            @endrole

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