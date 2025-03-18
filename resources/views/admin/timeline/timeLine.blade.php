@extends('home.submain')
@section('title', 'Timeline')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">TimeLine Pendaftaran</h1>

    <div class="row">
        <div class="col-lg-6 order-lg-2">

            <!-- Gelombang Pertama -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Gelombang Pertama</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('timeline-update', 1) }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="waktu_mulai" style="font-weight: bold;">Tanggal Mulai</label>
                                <input type="date" name="waktu_mulai" id="waktu_mulai" class="form-control" placeholder="Masukkan tanggal pendaftaran" value="{{ $dtTimeLine1->waktu_mulai }}" required>
                                @if ($errors->has('waktu_mulai') && old('nama') == $dtTimeLine1->nama)
                                    <div class="text-danger">{{ $errors->first('waktu_mulai') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="waktu_berakhir" style="font-weight: bold;">Tanggal Berakhir</label>
                                <input type="date" name="waktu_berakhir" id="waktu_berakhir" class="form-control" placeholder="Masukkan tanggal pendaftaran" value="{{ $dtTimeLine1->waktu_berakhir }}" required>                               
                            </div>

                            <div class="form-group">
                                <label for="status" style="font-weight: bold;">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="0" {{ $status1 == 0 ? 'selected' : '' }}>Non-Aktif</option>
                                    <option value="1" {{ $status1 == 1 ? 'selected' : '' }}>Aktif</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Simpan Data</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 order-lg-2">

            <!-- Gelombang Kedua -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Gelombang Kedua</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{ route('timeline-update', 2) }}" method="post">
                            {{ csrf_field() }}
                           
                            <div class="form-group">
                                <label for="waktu_mulai" style="font-weight: bold;">Tanggal Mulai</label>
                                <input type="date" name="waktu_mulai" id="waktu_mulai" class="form-control" placeholder="Masukkan tanggal pendaftaran" value="{{ $dtTimeLine2->waktu_mulai }}" required>
                                @if ($errors->has('waktu_mulai') && old('nama') == $dtTimeLine2->nama)
                                    <div class="text-danger">{{ $errors->first('waktu_mulai') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="waktu_berakhir" style="font-weight: bold;">Tanggal Berakhir</label>
                                <input type="date" name="waktu_berakhir" id="waktu_berakhir" class="form-control" placeholder="Masukkan tanggal pendaftaran" value="{{ $dtTimeLine2->waktu_berakhir }}" required>
                                
                            </div>

                            <div class="form-group">
                                <label for="status" style="font-weight: bold;">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="0" {{ $status2 == 0 ? 'selected' : '' }}>Non-Aktif</option>
                                    <option value="1" {{ $status2 == 1 ? 'selected' : '' }}>Aktif</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Simpan Data</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
{{-- sweet alert --}}
@include('sweetalert::alert')
@endsection
