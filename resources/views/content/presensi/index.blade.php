@extends('home.submain')
@section('title', 'Presensi')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 mb-4">Presensi Sekarang</h1>

    <div class="row">

        <!-- TABEL -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <!-- Optional header -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jadwal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($namaDivisi as $index => $nama)
                                    @if ($nama !== 'None')
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $nama }}</td>
                                            <td>
                                                @if (isset($jadwalDivisi2[$index]))
                                                    <ul>
                                                        <li>{{ $jadwalDivisi2[$index]->hari }}: {{ $jadwalDivisi2[$index]->waktu_mulai }} - {{ $jadwalDivisi2[$index]->waktu_selesai }}</li>
                                                    </ul>
                                                @else
                                                    Jadwal tidak tersedia
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $statusPresensi = ${"statusPresensi" . ($index + 1)} ?? 'belum presensi';
                                                @endphp
                                                @if ($statusPresensi == 'sudah presensi')
                                                    <span class="badge badge-success" style="padding: 4px 10px;"> Sudah Presensi </span>
                                                @else
                                                    <span class="badge badge-danger" style="padding: 4px 14px;"> Belum Presensi </span>
                                                @endif
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

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                @if (Auth::user()->gambar !== null)
                <div class="card-profile-image mt-4 d-flex justify-content-center">
                    <a>
                        <img class="img-profile rounded-circle" src="{{ asset('storage/foto/' . Auth::user()->gambar) }}" width="160" height="160">
                    </a>
                </div>
                @else
                <div class="card-profile-image mt-4 d-flex justify-content-center">
                    <a>
                        <img class="img-profile rounded-circle" src="{{ asset('template/img/undraw_profile.svg') }}" width="160" height="160">
                    </a>
                </div>
                @endif

                <div class="card-body">
                <form action="{{ route('store-presensi') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{ Auth::user()->name }}</h5>
                                <p class="font-weight">{{ Auth::user()->role }}</p>

                                <!-- Dropdown untuk memilih id_aktifasi -->
                                <select name="aktifasi_id" id="divisi" class="form-control">
                                    @if ($dtAktifasi != null )
                                        @foreach ($dtAktifasi as $aktifasiCollection)
                                            @foreach (collect($aktifasiCollection) as $aktifasi)
                                                @if(isset($aktifasi->pertemuan))
                                                    @if($aktifasi->status == 1)
                                                        <option 
                                                            value="{{ $aktifasi->id_aktifasi }}" 
                                                            data-id-divisi="{{ $aktifasi->id_divisi }}"> <!-- Menyimpan id_divisi dalam atribut data -->
                                                            {{$aktifasi->nama}} ( {{ $aktifasi->pertemuan }} )
                                                        </option>
                                                    @endif
                                                       
                                                @else
                                                    <option value="">Pertemuan tidak tersedia</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                </select>

                                <!-- Input hidden untuk menyimpan id_divisi yang dipilih -->
                                <input type="hidden" name="id_divisi" id="id_divisi">

                                <br>
                                <div class="mb-3">
                                    <input type="file" id="bukti" name="bukti" style="opacity:0; display:none" class="btn btn-primary">
                                    <label for="bukti" class="btn btn-primary btn-block">Upload bukti</label>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success flex-grow-1">Presensi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Link untuk mengakses halaman pemindaian QR/Barcode -->
                <a href="{{ route('scan-qr') }}" id="scanLink">Scan QR/Barcode</a>

                    
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

{{-- sweet alert --}}
@include('sweetalert::alert')

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen dropdown dan input hidden
        const divisiDropdown = document.getElementById('divisi');
        const idDivisiHidden = document.getElementById('id_divisi');

        // Fungsi untuk memperbarui nilai id_divisi
        function updateIdDivisi() {
            const selectedOption = divisiDropdown.options[divisiDropdown.selectedIndex];
            const idDivisi = selectedOption.getAttribute('data-id-divisi');
            idDivisiHidden.value = idDivisi;
        }

        // Panggil fungsi pertama kali untuk set nilai default saat halaman dimuat
        updateIdDivisi();

        // Tambahkan event listener untuk memperbarui nilai saat dropdown berubah
        divisiDropdown.addEventListener('change', updateIdDivisi);
    });
</script>