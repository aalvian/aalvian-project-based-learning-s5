@extends('home.submain')
@section('title', 'Divisi')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 mb-4">Tabel Aktifasi</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Optional header content -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tenggat</th>
                            <th>Pertemuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @foreach ($dtJadwal as $item)
                    @php
                    $aktifasiData = $dtAktifasi[$item->id_jadwal] ?? collect();
                    @endphp
                    <tbody>
                        <tr>

                            <form action="{{ route('aktivasi', $item->id_jadwal) }}" method="post">
                                @csrf
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->divisi->nama ?? 'Divisi Tidak Ditemukan' }}</td>
                                <td class="text-left" style="width: 30%;">
                                    <input type="time" name="tenggat" class="form-control" value="{{ $aktifasiData->first()->tenggat ?? '' }}" placeholder="tenggat" style="width: 50%;" required>
                                </td>
                                <td class="text-left" style="width: 30%;">
                                    <select name="pertemuan" id="pertemuanSelect" class="form-control" onchange="updateTenggat(this)">
                                        @foreach (range(1, 5) as $i)
                                        @php
                                        $tenggat = $aktifasiData->where('pertemuan', $i)->first()->tenggat ?? '';
                                        @endphp
                                        <option value="{{ $i }}" data-tenggat="{{ $tenggat }}">{{ $i }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center" style="width: 15%;">
                                    <button type="submit" class="btn btn-primary">aktifkan</button>
                                </td>

                            </form>

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
    function updateTenggat(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const tenggatInput = selectElement.closest('tr').querySelector('input[name="tenggat"]');
        tenggatInput.value = selectedOption.getAttribute('data-tenggat') || '';
    }
</script>


@endsection