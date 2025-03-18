@extends('home.submain')
@section('title', 'Detail Presensi')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 mb-4">Detail Pendaftar</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3"></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped mb-5">
                    <tbody>                                                                                  
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $data->nama_anggota }}</td>
                        </tr>
                        
                        <tr>
                            <td>Divisi</td>
                            <td>: {{ $data->nama_divisi }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>: {{ $data->tanggal }}</td>
                        </tr>
                        <tr>
                            <td>status</td>
                            <td>: {{ $data->status }}</td>
                        </tr>
                        <tr>
                            <td>Pertemuan</td>
                            <td>: {{ $data->pertemuan }}</td>
                        </tr>
                        <tr>
                            <td>Bukti</td>
                            <td>:
                                @if ($data->bukti)
                                    <img src="{{ asset('storage/buktiPresensi/' . $data->bukti) }}" alt="Gambar tidak ada" style="max-width: 200px; max-height: 200px;">
                                @else
                                    Tidak ada bukti
                                @endif
                            </td>
                        </tr>
                        
                                                                                                                           
                    </tbody>                        
                </table>

                <div class="text-right">
                    @if ($data->status == 'menunggu')
                        <form action="{{ route('validasi-presensi', $data->id_presensi) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success " onclick="return confirm('Apakah anda ingin menerima?')">
                                <i class="fas fa-check-circle"></i> Valid
                            </button>
                        </form>
                        <form action="{{ route('invalidasi-presensi', $data->id_presensi) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('Apakah anda ingin menolak?')">
                                <i class="fas fa-times-circle"></i> Invalid
                            </button>
                        </form>
                    @elseif ($data->status == 'valid')
                        <form action="{{ route('invalidasi-presensi', $data->id_presensi) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('Apakah anda ingin menolak?')"><i class="fas fa-times-circle"></i> Invalid</button>
                        </form>
                    @elseif ($data->status == 'invalid')
                        <form action="{{ route('validasi-presensi', $data->id_presensi) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success " onclick="return confirm('Apakah anda ingin menerima?')"><i class="fas fa-check-circle"></i> Valid</button>
                        </form>
                    @endif
                </div>
                
              
            </div>                
        </div>
    </div>        

</div>
<!-- /.container-fluid -->

{{-- sweet alert --}}
@include('sweetalert::alert')

@endsection
