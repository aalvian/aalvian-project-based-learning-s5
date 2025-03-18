@extends('home.submain')
@section('title', 'Hasil Scan')
@section('content')

<div class="container">
    <h1 class="text-center">Hasil Pemindaian QR Code</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @elseif($anggota)
    <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 mb-4">Detail Anggota</h1>




<div class="card shadow mb-4">
    <div class="card-header py-3">

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped mb-5">
                <tbody>

                    <tr>
                        <td>Nama</td>
                        <td>: {{ $anggota->nama }}</td>
                        
                    </td>
                        </td>
                    </tr>

                    <tr>
                        <td>Nim</td>
                        <td>: {{ $anggota->nim }}</td>
                    </tr>


                    <tr>
                        <td>Prodi</td>
                        <td>: {{ $anggota->prodi->nama }}</td>
                    </tr>

                    <tr>
                        <td>Semester</td>
                        <td>: {{ $anggota->semester }}</td>
                    </tr>

                    <tr>
                        <td>No HP</td>
                        <td>: {{ $anggota->no_telp }}</td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td>: {{ $anggota->email }}</td>
                    </tr>

                   <tr>
                    <td>
                        jadwal
                    </td>
                    <td>
                        <div>
                            <form action="{{ route('store-presensi') }}" method="POST" enctype="multipart/form-data">
                                @csrf
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
                                <input type="hidden" name="id_divisi" id="id_divisi" value="{{$aktifasi->id_divisi}}">
                                <!-- Input untuk upload gambar -->
                                <div class="col-sm-12 mt-4 d-flex justify-content-center">
                                    <div id="my_camera"></div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <br/>
                                    <button type="button" class="btn btn-primary" onclick="take_snapshot()">Take Snapshot</button>
                                    <br/><br/>

                                    <div id="indicator" class="alert alert-info" style="display: none;">Gambar sudah diambil!</div>

                                    <!-- Input hidden untuk menyimpan gambar yang diambil -->
                                    <input type="file" name="bukti" id="bukti" class="form-control" style="display: none;">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>

                                <!-- Link untuk mengakses halaman pemindaian QR/Barcode -->
                            </div>
                        </td>
                   </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>




</div>
    @else
        <div class="alert alert-warning">No scan data found.</div>
    @endif
</div>

<script language="JavaScript">
    // Konfigurasi Webcam
    Webcam.set({
        width: 490,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    // Menempelkan Webcam pada elemen dengan id my_camera
    Webcam.attach('#my_camera');

    // Fungsi untuk mengambil snapshot dan menyimpannya dalam elemen input file
    function take_snapshot() {
        // Mengambil snapshot dari kamera
        Webcam.snap(function(data_uri) {
            // Mengonversi data URI menjadi file gambar
            var imageBlob = dataURItoBlob(data_uri);

            // Membuat FormData untuk mengirim file menggunakan AJAX
            var formData = new FormData();
            formData.append('bukti', imageBlob, 'snapshot.jpg');

            // Menyimpan file gambar ke input file (untuk form submission)
            var fileInput = document.getElementById('bukti');
            var dataTransfer = new DataTransfer(); // Buat DataTransfer untuk mengelola file input
            dataTransfer.items.add(new File([imageBlob], 'snapshot.jpg', { type: 'image/jpeg' }));
            fileInput.files = dataTransfer.files; // Set file yang diambil ke input file

            document.getElementById('indicator').style.display = 'block';

        });
    }

    // Fungsi untuk mengonversi data URI menjadi Blob
    function dataURItoBlob(dataURI) {
        var byteString = atob(dataURI.split(',')[1]);
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        return new Blob([ab], { type: 'image/jpeg' });
    }
</script>
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

@endsection
