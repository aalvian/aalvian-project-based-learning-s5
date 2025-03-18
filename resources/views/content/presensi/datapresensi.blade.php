@extends('master.main')
@section('title', 'Presensi')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 mb-4">Data Presensi</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>Divisi</th>
                                <th>Tanggal</th>
                                <th>Bukti Kehadiran</th>
                                <th>Status Presensi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($dtPresensi as $item)
                                <tr class="data">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="nama">{{ $item->nama }}</td>
                                    <td class="nim">{{ $item->nim }}</td>
                                    <td class="divisi">{{ $item->divisi }}</td>
                                    <td class="tanggal">{{$item->tanggal}}</td>
                                    <td class="status">{{$item->status}}</td>
                                    <td>
                                    @if ($item->bukti)
                                        <img src="{{ asset('storage/buktiPresensi/' . $item->bukti) }}" alt="Gambar tidak ada" style="max-width: 200px; max-height: 200px;">
                                        @else
                                        Tidak ada bukti
                                        @endif
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
