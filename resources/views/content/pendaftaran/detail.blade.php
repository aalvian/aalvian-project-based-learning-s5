@extends('home.submain')
@section('title', 'Pendaftaran')
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
                            <td>: {{ $dtAnggota->nama }}</td>
                        </tr>
                        <tr>
                            <td>CV</td>
                            <td>:
                            @if ($dtAnggota->cv)
                                <a href="{{ asset('storage/cv/' . $dtAnggota->cv) }}" download>
                                    <i class="fas fa-file-pdf text-danger"></i> Unduh CV
                                </a>
                            @else
                                Tidak ada bukti
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Nim</td>
                            <td>: {{ $dtAnggota->nim }}</td>
                        </tr>
                        <tr>
                            <td>Prodi</td>
                            <td>: {{ $dtAnggota->prodi->nama }}</td>
                        </tr>
                        <tr>
                            <td>Semester</td>
                            <td>: {{ $dtAnggota->semester }}</td>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td>: {{ $dtAnggota->no_telp }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: {{ $dtAnggota->email }}</td>
                        </tr>                                                                                    
                        <tr>
                            <td>Divisi 1</td>
                            <td>: {{ $dtAnggota->divisi->get(0)->nama }}</td>                                
                        </tr> 
                        <tr>
                            <td>Divisi 2</td>
                            <td>: {{ $dtAnggota->divisi->get(1)->nama ?? 'None'}}</td>                                
                        </tr>                                                                                                        
                    </tbody>                        
                </table>                    

                <div class="text-right">
                    @if ($dtAnggota->status == 'menunggu')
                        <form action="{{ route('pendaftaran-terima', $dtAnggota->id_anggota) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success " onclick="return confirm('Apakah anda ingin menerima?')">
                                <i class="fas fa-check-circle"></i> Terima
                            </button>
                        </form>
                        <form action="{{ route('tolak-pendaftaran', $dtAnggota->id_anggota) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('Apakah anda ingin menolak?')">
                                <i class="fas fa-times-circle"></i> Tolak
                            </button>
                        </form>
                    @elseif ($dtAnggota->status == 'diterima')
                        <span class="badge badge-success">Pendaftaran Diterima</span>
                    @elseif ($dtAnggota->status == 'ditolak')
                        <span class="badge badge-danger">Pendaftaran Ditolak</span>
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
