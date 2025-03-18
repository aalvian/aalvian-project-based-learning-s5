@extends('home.submain')
@section('title', 'Scan QR/Barcode')
@section('content')

<div class="container">
    <h1 class="text-center">Scan QR Code or Barcode</h1>
    <!-- Area untuk menampilkan pemindaian QR atau Barcode -->
    <div id="reader" style="width: 100%; height: 400px; background-color: #f3f3f3;"></div>

    <!-- Tempat menampilkan hasil pemindaian -->
    <div id="result" class="mt-3"></div>

    <!-- Modal Structure -->
    <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hasil Scan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyContent">
                    <!-- Hasil scan akan ditampilkan di sini -->
                </div>
                <div class="modal-footer" id="modal-footer">
                
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/html5-qrcode.min.js') }}"></script>

<script>
    const scanner = new Html5QrcodeScanner('reader', {
        qrbox: {
            width: 500,
            height: 300
        },
        fps: 20
    });

    function success(result) {
        // Tampilkan hasil scan di dalam modal
        document.getElementById('modalBodyContent').innerHTML = `
            Nim : ${result}<br>
        `;
        document.getElementById('modal-footer').innerHTML = `
            <form id="" method="POST" action="{{ route('scan-result') }}">
                    @csrf
                    
                    <input type="hidden" name="nim" value="${result}">
                    <input type="submit" value="Presensi Sekarang">
                </form>
        `

        // Simpan hasil scan ke dalam input tersembunyi
        sessionStorage.setItem('nim', result);

        // Hentikan scanner dan hapus area pemindaian
        scanner.clear();
        document.getElementById('reader').remove();

        // Tampilkan modal
        var scanModal = new bootstrap.Modal(document.getElementById('scanModal'));
        scanModal.show();
    }

    function error(err) {
        console.log(err);
    }

    

    // Render scanner dengan callback success dan error
    scanner.render(success, error);
</script>
{{-- sweet alert --}}
@include('sweetalert::alert')

@endsection
