<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jinggo Sport</title>
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-grow flex justify-center">
                    <div class="hidden sm:flex space-x-20">
                        <a href="#beranda"
                            class="border-transparent text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Beranda</a>
                        <a href="#tentang"
                            class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Tentang
                            Kami</a>
                        <img class="h-14 w-30" src="../img/logo.png" alt="Logo">
                        <a href="#divisi"
                            class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Divisi</a>
                        <a href="#alat"
                            class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Alat</a>
                    </div>
                </div>
                <div class="hidden sm:flex items-center">
                    <a href="{{ route('login') }}"
                        class="ml-3 bg-customColor-kuning hover:bg-yellow-500 text-black px-8 py-2 font-medium text-xs rounded-full">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Text Header Section -->
    <header id="beranda" class="bg-cover bg-center bg-fixed h-screen"
        style="background-image: url('../img/background.png');">
        <div class="container mx-auto h-full flex items-center">
            <div class="text flex-grow mx-20">
                <h1 class="text-7xl font-bold text-white">Jinggo Sport</h1>
                <p class="mt-4 text-2x1 font-medium text-white">
                    Platform all-in-one di bidang olahraga untuk <br>
                    menampung mahasiswa menggapai prestasi.<br>
                    Olahraga makin mudah dan menyenangkan!
                </p>
                <div class="mt-5">
                    <a href="#" id="openpopup"
                        class="mt-5 bg-customColor-kuning hover:bg-yellow-500 text-black px-4 py-2 text-xs font-bold rounded-lg">Lihat
                        Pendaftarannya Disini!</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Prestasi Kami Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center">Prestasi Kami</h2>
            <div class="mt-8 flex space-x-20 overflow-x-auto justify-center">
                <img src="../img/prestasi-1.png" alt="Prestasi 1" class="h-64 object-cover">
                <img src="../img/prestasi-2.png" alt="Prestasi 2" class="h-64 object-cover">
                <img src="../img/prestasi-3.png" alt="Prestasi 3" class="h-64 object-cover">
                <img src="../img/prestasi-4.png" alt="Prestasi 4" class="h-64 object-cover">
            </div>
        </div>
    </section>

    <!-- Divisi Section -->
    <section id="divisi" class="py-12 bg-customColor-biru">
        <div class="container mx-auto text-center">
            <h2 class="mt-10 text-3xl text-white font-bold font-sans">Yuk, Berkarya bersama Jinggo Sports.</h2>
            <div class="mt-10">
                <a href="#" id="openpopup2"
                    class="bg-customColor-kuning hover:bg-yellow-500 font-bold px-10 py-2 text-black rounded-full">Join
                    Yuk!</a>
            </div>
        </div>
        <div class="relative bg-white p-20 pt-40 rounded-t-custom-t shadow-md"
            style="padding-bottom: 400px; margin-top: 8rem;">
            <div class="absolute inset-x-0 top-14 transform -translate-y-1/3 grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-transparent p-6 rounded-lg">
                    <img src="../img/futsal.png" alt="Divisi Futsal" class="h-45 mx-auto">
                    <h3 class="mt-4 text-xl text-center font-bold">Divisi Futsal</h3>
                    <p class="mt-2 text-center text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Corporis minima quisquam assumenda, velit laudantium voluptatibus!</p>
                </div>
                <div class="bg-transparent p-6 rounded-lg">
                    <img src="../img/volley.png" alt="Divisi Volley" class="h-45 mx-auto">
                    <h3 class="mt-4 text-xl text-center font-bold">Divisi Volley</h3>
                    <p class="mt-2 text-center text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Corporis minima quisquam assumenda, velit laudantium voluptatibus!</p>
                </div>
                <div class="bg-transparent p-6 rounded-lg">
                    <img src="../img/badminton.png" alt="Divisi Badminton" class="h-45 mx-auto">
                    <h3 class="mt-4 text-xl text-center font-bold">Divisi Badminton</h3>
                    <p class="mt-2 text-center text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Corporis minima quisquam assumenda, velit laudantium voluptatibus!</p>
                </div>
            </div>
        </div>
    </section>

    <div id="popup2" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Informasi Pendaftaran</h2>
            @if ($currentDate < $gelombang_1->waktu_mulai && $gelombang_1->status == 0)
            <p></p>
            @elseif($currentDate < $gelombang_1->waktu_mulai && $gelombang_1->status == 1)
            <p>Pendaftaran dimulai pada {{date('d - F - Y', strtotime($gelombang_1->waktu_mulai))}} hingga {{date('d - F - Y', strtotime($gelombang_1->waktu_berakhir))}}</p>

                @elseif($currentDate > $gelombang_1->waktu_berakhir && $gelombang_1->status == 0)

                <p></p>
                @elseif($currentDate > $gelombang_1->waktu_berakhir && $gelombang_1->waktu_berakhir == 1)
                <p>Pendaftaran berakhir pada {{$gelombang_1->waktu_berakhir}}</p>

                @elseif($currentDate >= $gelombang_1->waktu_mulai && $currentDate <= $gelombang_1->waktu_berakhir && $gelombang_1->status == 1)
                <p>Pendaftaran masih dibuka, ayo bergabung!!</p>

                @endif

            @if ($currentDate < $gelombang_2->waktu_mulai && $gelombang_2->status == 0)
            <p></p>
            @elseif($currentDate < $gelombang_2->waktu_mulai && $gelombang_2->status == 1)
            <p>Pendaftaran dimulai pada {{$gelombang_2->waktu_mulai}} hingga {{$gelombang_2->waktu_berakhir}}</p>

                @elseif($currentDate > $gelombang_2->waktu_berakhir && $gelombang_2->status == 0)
                <p></p>
                @elseif($currentDate > $gelombang_2->waktu_berakhir && $gelombang_2->status == 1)
                <p>Pendaftaran berakhir pada {{$gelombang_2->waktu_berakhir}}</p>

                @elseif($currentDate >= $gelombang_2->waktu_mulai && $currentDate <= $gelombang_2->waktu_berakhir && $gelombang_2->status == 1)
                <p>Pendaftaran masih dibuka, ayo bergabung!!</p>

                @endif

             @if ($currentDate < $gelombang_1->waktu_mulai || $gelombang_2->waktu_mulai)
            <p>Pendaftaran dimulai pada {{$gelombang_1->waktu_mulai}} hingga {{$gelombang_1->waktu_berakhir}}</p>
                @elseif($currentDate > $gelombang_1->waktu_berakhir || $gelombang_2->waktu_berakhir)
                <p>Pendaftaran berakhir pada {{$gelombang_1->waktu_berakhir}}</p>
                @elseif($currentDate >= $gelombang_1->waktu_mulai || $gelombang_2->waktu_mulai && $currentDate <= $gelombang_1->waktu_berakhir || $gelombang_2->waktu_berakhir && $gelombang_1->status == 1 || $gelombang_2->status == 1) <p>Pendaftaran masih dibuka, ayo bergabung!!</p>
                    @elseif($currentDate >= $gelombang_1->waktu_mulai || $gelombang_2->waktu_mulai && $currentDate <= $gelombang_1->waktu_berakhir || $gelombang_2->waktu_berakhir && $status==0 || $gelombang_2->status == 0) <p>Pendaftaran di non-aktifkan</p>
                        @endif
                        <div class="mt-4 flex justify-end">
                            <button id="closepopup2" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded mr-2">Close</button>
                            @if ($currentDate >= $gelombang_1->waktu_mulai && $currentDate <= $gelombang_1->waktu_berakhir && $gelombang_1->status == 1) <a class="bg-customColor-hijau text-white px-4 py-2 rounded mr-2" href="{{ route("view-pendaftaran") }}">Daftar</a>
                                @endif
                            @if ($currentDate >= $gelombang_2->waktu_mulai && $currentDate <= $gelombang_2->waktu_berakhir && $gelombang_2->status == 1) <a class="bg-customColor-hijau text-white px-4 py-2 rounded mr-2" href="{{ route('view-pendaftaran') }}">Daftar</a>
                                @endif
                        </div>

        </div>
    </div>



    <!-- Informasi Divisi Section -->
    <section class="py-12 bg-customColor-biru flex justify-center items-center">
        <div class="container mx-auto flex flex-col md:flex-row items-center bg-customColor-biru rounded-lg p-6">
            <div class="md:w-1/2 text-center md:text-left">
                <h2 class="text-5xl text-white font-bold">Dapatkan Informasi <br>Divisi!</h2>
                <p class="mt-4 text-white">Jadilah seorang yang berprestasi dengan bergabung bersama kami Jinggo Sport.
                    Kami mempunyai slogan Jaya Jaya Jaya</p>
                <div class="mt-10">
                    <a href="#"
                        class="bg-customColor-kuning hover:bg-yellow-500 text-black font-bold px-6 py-2 rounded-md">Lihat
                        Selengkapnya!</a>
                </div>
            </div>
            <div class="md:w-1/2 mt-6 md:mt-0 flex justify-center md:justify-end">
                <img src="../img/logo-2.png" alt="Jinggo Sport" class="w-full max-w-md">
            </div>
        </div>
    </section>

    <!-- Ketersediaan Alat Section -->
    <section id="alat" class="py-12 bg-white">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-center">Ketersediaan Alat</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center" style="margin-top: 5rem;">
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="#">
                        <img src="../img/kok.png" alt="Futsal" class="h-16 mx-auto">
                        <p class="mt-2">Bola</p>
                    </a>
                </div>
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="#">
                        <img src="../img/kok.png" alt="Basket" class="h-16 mx-auto">
                        <p class="mt-2">Raket Badminton</p>
                    </a>
                </div>
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="#">
                        <img src="../img/kok.png" alt="Bulu Tangkis" class="h-16 mx-auto">
                        <p class="mt-2">Raket Tennis</p>
                    </a>
                </div>
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="#">
                        <img src="../img/kok.png" alt="Sepak Bola" class="h-16 mx-auto">
                        <p class="mt-2">Raket Tennis Meja</p>
                    </a>
                </div>
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="#">
                        <img src="../img/kok.png" alt="Renang" class="h-16 mx-auto">
                        <p class="mt-2">Bola Volley</p>
                    </a>
                </div>
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="#">
                        <img src="../img/kok.png" alt="E-Sport" class="h-16 mx-auto">
                        <p class="mt-2">Kok Badminton</p>
                    </a>
                </div>
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="#">
                        <img src="../img/kok.png" alt="Tenis Meja" class="h-16 mx-auto">
                        <p class="mt-2">Bola Tennis</p>
                    </a>
                </div>
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="">
                        <img src="../img/kok.png" alt="Volly" class="h-16 mx-auto">
                        <p class="mt-2">Bola Tennis Meja</p>
                    </a>
                </div>
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="#">
                        <img src="../img/kok.png" alt="Karate" class="h-16 mx-auto">
                        <p class="mt-2">Papan Catur</p>
                    </a>
                </div>
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="#">
                        <img src="../img/kok.png" alt="Catur" class="h-16 mx-auto">
                        <p class="mt-2">Samsak</p>
                    </a>
                </div>
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="#">
                        <img src="../img/kok.png" alt="Pencak Silat" class="h-16 mx-auto">
                        <p class="mt-2">Body Protector</p>
                    </a>
                </div>
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="#">
                        <img src="../img/kok.png" alt="Taekwondo" class="h-16 mx-auto">
                        <p class="mt-2">Matras</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="tentang" class="bg-customColor-biru text-white py-8">
        <div class="mt-3 container mx-auto flex flex-col md:flex-row md:items-start md:justify-end">
            <div class="flex flex-col md:flex-row w-full md:w-1/2 mb-4 md:mb-0 md:mr-8">
                <img class="h-full w-40 md:h-full mb-4 md:mb-0 md:mr-8" src="../img/logo.png" alt="Logo">
                <div>
                    <div class="text-3xl font-bold uppercase leading-10 mb-4">Menu</div>
                    <a href="#" class="block text-md mb-2 hover:underline">Beranda</a>
                    <a href="#" class="block text-md mb-2 hover:underline">Divisi</a>
                    <a href="#" class="block text-md mb-2 hover:underline">Alat</a>
                    <a href="#" class="block text-md mb-2 hover:underline">Tentang Kami</a>
                </div>
            </div>
            <div class="w-full md:w-1/3 mb-4 md:mb-0 md:mr-8">
                <div class="text-3xl font-bold uppercase leading-10 mb-4">Kontak Kami</div>
                <p class="text-md">Alamat : Jalan Raya Jember KM 13 Banyuwangi 68481, Jawa Timur - Indonesia</p>
                <p class="text-md">No telp : +6282131815153</p>
                <p class="text-md">Email : ukm@poliwangi.ac.id</p>
            </div>
            <div class="w-full md:w-1/3">
                <div class="text-3xl font-bold uppercase leading-10 mb-4">Lokasi</div>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.086560642344!2d114.3043863750104!3d-8.2941844917407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd156d7d86bef9b%3A0x4cb09a70b9109740!2sPoliteknik%20Negeri%20Banyuwangi!5e0!3m2!1sid!2sid!4v1719507692950!5m2!1sid!2sid"
                    class="w-50 h-full rounded-lg"></iframe>
            </div>
        </div>
        <div class="text-center mt-8">
            <p>UKM OLAHRAGA Politeknik Negeri Banyuwangi 2024</p>
        </div>
    </footer>

    <!-- Pop up -->
    <div id="popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Tanggal Pendaftaran</h2>
            <div class="row">

                <div class="container mt-4">
        <table class="table table-bordered">
            <tbody class="mb-3">
                <tr>
                    <th>{{$gelombang_1->nama}}</th>
                </tr>
                <tr>
                    <td>Waktu Mulai : {{date('d - F - Y', strtotime($gelombang_1->waktu_mulai))}}</td>
                </tr>
                <tr>
                    <td>Waktu Selesai : {{date('d - F - Y', strtotime($gelombang_1->waktu_berakhir))}}</td>
                </tr>
            </tbody>

            <tbody class="mb-3">
                <tr>
                    <th>{{$gelombang_2->nama}}</th>
                </tr>
                <tr>
                    <td>Waktu Mulai : {{date('d - F - Y', strtotime($gelombang_2->waktu_mulai))}}</td>
                </tr>
                <tr>
                    <td>Waktu Selesai : {{date('d - F - Y', strtotime($gelombang_2->waktu_berakhir))}}</td>
                </tr>
            </tbody>
        </table>
    </div>
            </div>
            <div class="mt-4">
                <button id="closepopup"
                    class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">Close</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
    {{-- sweet alert --}}
    @include('sweetalert::alert')

</html>
