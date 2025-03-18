<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }

        .image-container {
            height: 100%;
            /* Adjust this as needed */
        }
    </style>
</head>

<body>
    <!-- <section class="h-100 bg-dark"> -->
    <!-- <div class="container py-5 h-100"> -->
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col">
            <div class="card card-registration">
                <div class="row g-0">
                    <div class="col-xl-6 d-none d-xl-block">
                        <div class="d-flex justify-content-center align-items-center image-container">
                            <img src="{{ asset('img/pendaftaranlogo.png') }}" alt="Sample photo" class="img-fluid" />
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card-body p-md-5 text-black">
                            <h3 class="mb-5 text-uppercase">Form Pendaftaran</h3>
                            <form action="{{ route('store-pendaftaran') }}" method="post"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="form3Example1m"
                                                style="font-weight: bold;">Nama</label>
                                            <input type="text" id="form3Example1m"
                                                class="form-control form-control-lg" name="nama" />
                                            @if ($errors->has('nama'))
                                                <div class="text-danger">{{ $errors->first('nama') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4" style="font-weight: bold;">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="form3Example1n">Nim</label>
                                            <input type="text" id="nim" class="form-control form-control-lg"
                                                name='nim' maxlength=12 minlength=12 />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="form3Example1m1"
                                                style="font-weight: bold;">Prodi</label>
                                            <select name="prodi" data-mdb-select-init id="form3Example1m1"
                                                class="form-control form-control-lg">
                                                <option value="">Pilih Prodi</option>
                                                @foreach ($prodi as $prodis)
                                                    <option value='{{ $prodis->id_prodi }}'>{{ $prodis->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="form3Example1n1"
                                                style="font-weight: bold;">Email</label>
                                            <input type="text" id="form3Example1n1"
                                                class="form-control form-control-lg" name="email" />
                                        </div>
                                    </div>
                                </div>

                                <div class="d-md-flex justify-content-start align-items-center mb-1 py-2">

                                    <h6 class="mb-0 me-4 mb-3" style="font-weight: bold;">Semester : </h6>
                                    <div class="form-check form-check-inline mb-1 me-4">
                                        <input class="form-check-input" type="radio" name="semester" id="femaleGender"
                                            value="1" />
                                        <label class="form-check-label" for="femaleGender">1</label>
                                    </div>
                                    <div class="form-check form-check-inline mb-1 me-4">
                                        <input class="form-check-input" type="radio" name="semester" id="maleGender"
                                            value="3" />
                                        <label class="form-check-label" for="maleGender">3</label>
                                    </div>
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="no_telp" style="font-weight: bold;">No
                                        Telphone</label>
                                    <input type="text" id="no_telp" class="form-control form-control-lg"
                                        maxlength=13 name="no_telp" />
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-1">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="divisi_1" style="font-weight: bold;">Pilih
                                                Divisi 1</label>
                                            <select name="divisi_1" id="divisi_1" class="form-control form-control-lg">
                                                <option value="">Pilih Divisi</option>
                                                @foreach ($divisi as $divisis)
                                                    <option value='{{ $divisis->id_divisi }}'>{{ $divisis->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="divisi_2" style="font-weight: bold;">Pilih
                                                Divisi 2</label>
                                            <select name="divisi_2" id="divisi_2"
                                                class="form-control form-control-lg">
                                                <option value="11">None</option>
                                                @foreach ($divisi as $divisis)
                                                    <option value="{{ $divisis->id_divisi }}">{{ $divisis->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label" for="cv" style="font-weight: bold;">CV</label>
                                    <input type="file" id="cv" accept=".pdf,.doc,.docx"
                                        class="form-control form-control-lg" name="cv" />
                                </div>

                                <div class="d-flex justify-content-end pt-1">
                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-warning btn-lg ms-2">Mendaftar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('nim').addEventListener('keydown', function(e) {
            if (!((e.key >= '0' && e.key <= '9') || ['Backspace', 'Delete', 'Tab', 'Enter'].includes(e.key))) {
                e.preventDefault();
            }
        });
        document.getElementById('no_telp').addEventListener('keydown', function(e) {
            if (!((e.key >= '0' && e.key <= '9') || ['Backspace', 'Delete', 'Tab', 'Enter'].includes(e.key))) {
                e.preventDefault();
            }
        });
    </script>
    {{-- sweet alert --}}
    @include('sweetalert::alert')
</body>

</html>
