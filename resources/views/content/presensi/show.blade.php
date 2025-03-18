@extends('home.submain')
@section('title', 'Data Presensi')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 mb-4">Data Presensi</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Optional header -->
             <div class="row d-flex justify-content-center align-items-center">

             <form action="{{ route('cetak-presensi') }}" method="GET" target="_blank" style="display: inline;">
                <input type="hidden" name="tanggal" id="tanggal-filter-hidden">
                <button type="submit" class="btn btn-sm btn-secondary">
                    <i class="fas fa-print"></i> cetak
                </button>
            </form>
            <div class="space col-lg-6"></div>
                 <div class="text col-lg-2 text-center">

                     filter tanggal : 
                 </div>
                 <input class="col-lg-2 " type="date" name="filter-tanggal" id="">
             </div>
        </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Divisi</th>
                                <th>Tanggal</th>
                                <th>Pertemuan</th>
                                <th>Status Presensi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $item)
                                <tr class="data">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="nama">{{ $item->nama_anggota }}</td>
                                    <td class="divisi">{{ $item->nama_divisi }}</td>
                                    <td class="tanggal">{{ $item->tanggal }}</td>
                                    <td class="pertemuan">{{$item->pertemuan}}</td>
                                    <td>

                                        @if ($item->status == 'valid')
                                            <span class="badge badge-success" style="padding: 4px 10px;"> valid </span>
                                        @elseif ($item->status == 'invalid')
                                            <span class="badge badge-danger" style="padding: 4px 14px;"> invalid </span>
                                        @else
                                            <span class="badge badge-warning" style="padding: 4px 14px;"> menunggu </span>

                                        @endif
                                    </td>

                                   
                                    <td>

                                        <form action="{{ route('detail-presensi', $item->id_presensi) }}" method="GET" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> detail
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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen input tanggal
        const filterTanggalInput = document.querySelector('input[name="filter-tanggal"]');
        const rows = document.querySelectorAll('.data'); // Ambil semua baris data

        // Tambahkan event listener untuk perubahan tanggal
        filterTanggalInput.addEventListener('change', function () {
            const filterTanggal = this.value; // Ambil nilai tanggal dari input
            
            rows.forEach(row => {
                const tanggalCell = row.querySelector('.tanggal'); // Ambil sel tanggal
                const rowTanggal = tanggalCell ? tanggalCell.textContent.trim() : '';

                // Tampilkan atau sembunyikan baris berdasarkan tanggal
                if (filterTanggal === '' || rowTanggal === filterTanggal) {
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const filterTanggalInput = document.querySelector('input[name="filter-tanggal"]');
        const hiddenTanggalInput = document.getElementById('tanggal-filter-hidden');

        filterTanggalInput.addEventListener('change', function () {
            hiddenTanggalInput.value = this.value;
        });
    });
</script>


@endsection
