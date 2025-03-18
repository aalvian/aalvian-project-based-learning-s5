@extends('home.submain')
@section('title', 'Create Data')
@section('content')

<script>
    $(document).ready(function() {
        // Inisialisasi selectpicker
        $('.selectpicker').selectpicker();

        // Ketika pengguna mengetik di input pencarian
        $('#searchInput').on('keyup', function() {
            const input = $(this).val().toLowerCase();
            $('#nama option').each(function() {
                const optionText = $(this).text().toLowerCase();
                $(this).toggle(optionText.includes(input));
            });

            // Refresh selectpicker agar opsi yang cocok saja yang muncul
            $('.selectpicker').selectpicker('refresh');
        });
    });


    function updateDetails() {
        var select = document.getElementById("nama");
        var selectedOption = select.options[select.selectedIndex];
        var idAnggota = selectedOption.value;
        document.getElementById('id_anggota_hidden').value = idAnggota;

        if (selectedOption && selectedOption.value) {
            const nim = selectedOption.getAttribute("data-nim");
            const prodi = selectedOption.getAttribute("data-prodi");

            // Menampilkan nim dan prodi otomatis
            document.getElementById("nim").value = nim;
            document.getElementById("prodi").value = prodi;
        }

    }

    function updateStok() {
        const selectElement = document.querySelector('select[name="id_alat"]');
        const stokDisplay = document.getElementById('stokDisplay');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const stok = selectedOption.getAttribute('data-stok');
        stokDisplay.textContent = stok ? `Stok Tersisa: ${stok}` : '';
    }
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.querySelector('input[name="tggl_pinjam"]');
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    });
</script>


<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Create Pinjam Alat</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Peminjaman Alat</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('simpan-pinjam') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="searchInput">Nama Anggota</label>
                        <select name="id_anggota" class="form-control selectpicker" id="nama" onchange="updateDetails()" data-live-search="true" required>
                            <option value="">Pilih Anggota</option>
                            @foreach ($anggota as $anggotas)
                            <option value="{{ $anggotas->id_anggota }}" data-nim="{{ $anggotas->nim }}" data-prodi="{{ $anggotas->prodi->nama }}">
                                {{ $anggotas->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="id_anggota_hidden" name="id_anggota">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" id="nim" name="nim" maxlength="12" class="form-control" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="prodi">Prodi</label>
                        <input type="text" id="prodi" name="prodi" class="form-control" required readonly>
                    </div>
                    <div class="form-group d-flex align-items-start">
                        <div style="flex: 1; margin-right: 1rem;">
                            <label for="nama_alat">Pilih Alat</label>
                            <select name="id_alat" class="form-control" onchange="updateStok()" required>
                                <option value="">Pilih Alat</option>
                                @foreach ($alat as $item)
                                <option value="{{ $item->id_alat }}" data-stok="{{ $item->stok }}">
                                    {{ $item->nama_alat }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div style="flex: 1;">
                            <label>Jumlah Stok</label>
                            <div id="stokDisplay" class="mt-0 p-1 border rounded" style="border-color: #ccc;">
                                <span class="text-muted">Stok Tersisa:</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jml_alat">Jumlah Barang</label>
                        <input type="number" name="jml_alat" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tggl_pinjam">Tanggal Pinjam</label>
                        <input type="date" name="tggl_pinjam" class="form-control" required>
                    </div>

                    <button type="button" class="btn btn-danger" onclick="history.back()">Batal</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')
@endsection