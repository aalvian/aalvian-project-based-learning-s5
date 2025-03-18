@extends('master.main')
@section('title', 'Pendaftaran')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 mb-4">Tabel Anggota Diterima</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>Prodi</th>
                                <th>Divisi 1</th>
                                <th>Divisi 2</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pendaftar as $item)
                                @if ($item->status == 'terima')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nim }}</td>
                                        <td>{{ $item->prodi }}</td>
                                        <td>{{ $item->divisi_1 }}</td>
                                        <td>
                                            @if ($item->divisi_2)
                                                {{ $item->divisi_2 }}
                                            @else
                                                tidak memilih
                                            @endif
                                        </td>
                                        <td>{{ $item->jabatan }}</td>

                                        <td class="text-center" style="width: 9%;">
                                        @php $id = Crypt::encrypt($item->id); @endphp
                                            <a href="{{ route('detail-pendaftaran', $id) }}"
                                                class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Detail</a>
                                            {{-- <a href="{{ route('edit-pendaftaran', $id) }}"
                                                class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> --}}
                                        </td>
                                    </tr>
                                @endif
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
