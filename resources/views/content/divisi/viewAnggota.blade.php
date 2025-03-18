@extends('home.submain')
@section('title', 'daftar anggota ' . $divisi->nama)
@section('content')

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 mb-4">daftar anggota {{ $divisi->nama }}</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    @foreach ($anggota as $item)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/foto/'.$item->gambar) }}" class="card-img-top"
                                            alt="...">
                                    @else
                                        <img class="card-img-top" alt="..."
                                            src="{{ asset('template/img/undraw_profile.svg') }}"width="160" height="160">
                                    @endif
                                    <p class="card-text">Pekenalkan nama saya {{ $item->nama }} di politeknik negeri
                                        banyuwangi. Saya mengambil prodi {{ $item->prodi->nama }} dan bergabung dengan UKM
                                        Olahraga saat semester {{ $item->semester }}. Kalau mau kenalan? <br> email saya:
                                        {{ $item->email }}</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>

@endsection