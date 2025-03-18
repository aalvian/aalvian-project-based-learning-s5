@extends('home.submain')
@section('title', 'Dashboard')
@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-6 mb-4">
                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        {{-- <h6 class="m-0 font-weight-bold text-primary">Project Based Learning</h6> --}}
                    </div>
                    <div class="card-body">

                        <div class="text-center">
                            <h4>Selamat Datang, {{ auth()->user()->name }}</h4>
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                src="{{ asset('template/img/undraw_posting_photo.svg') }}" alt="...">
                        </div>
                        <span>Terus pantau kegiatan penerimaan anggota baru Ukm Olahraga <br>Politeknik Negeri
                            Banyuwangi</span>
                        @role('pengurus')
                        <div class="text-right">
                            <a href="{{ route('admin-pendaftaran') }}" class="btn btn-primary">
                                Lihat pendaftar</a>
                        </div>
                        @endrole

                    </div>
                </div>
            </div>

            <!-- TOTAL PENDAFTAR -->
            <div class="col-lg-6 mb-4">
                <div class="row">

                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total pendaftar</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPendaftar }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DIVISI SAAT INI -->
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Divisi saat ini</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDivisi }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-people-arrows fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- PENDAFTAR DI TERIMA -->
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            pendaftar diterima
                                        </div>

                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    {{ $pendaftarTerima }}
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: <?= $persentaseTerima ?>%"
                                                        aria-valuenow="<?= $persentaseTerima ?>" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-check fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- PENDAFTAR DI TOLAK -->
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            pendaftar ditolak
                                        </div>

                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    {{ $pendaftarTolak }}
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                        style="width: <?= $persentaseTolak ?>%"
                                                        aria-valuenow="<?= $persentaseTolak ?>%" aria-valuemin="0"
                                                        aria-valuemax="1000">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-times fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-4">
                        <div class="row d-flex justify-content-center">
                            <div class="container">
                                <div class="chart">
                                    <canvas id="barchart" width="300" class="col-lg-12"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- End of total pendaftar -->
            
            


        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('barchart').getContext('2d');
        
        // Data dari controller
        var divisiNames = <?=  json_encode($divisiNames) ?>; // Nama divisi
        var aktifasiCounts = <?= json_encode($aktifasiCounts) ?>; // Jumlah aktifasi

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: divisiNames, // Nama divisi sebagai label
                datasets: [{
                    label: 'Divisi teraktif',
                    data: aktifasiCounts, // Jumlah aktifasi sebagai data
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 18,
                                family: 'Poppins'
                            },
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 14,
                                family: 'Poppins'
                            }
                        }
                    },
                    y: {
                        ticks: {
                            font: {
                                size: 14,
                                family: 'Poppins'
                            }
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

@endsection
