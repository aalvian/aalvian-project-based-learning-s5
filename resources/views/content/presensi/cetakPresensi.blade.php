<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="form-group">
        <p align="center"><b>daftar cetak</b></p>
        <table class="static" align="center", rules="all" border="1px", style="width: 95%; border-collapse: collapse;">
            <tr style="height: 90px; text-align:center;">
                <th>Nama</th>
                <th>Nim</th>
                <th>Divisi</th>
                <th>Tanggal</th>
                <th>Bukti</th>
            </tr>
            @foreach($data as $cetak)
            <tr style="height: 50px; text-align:center;">
                <td>{{ $loop->iteration }}</td>
                <td>{{$cetak->nama_anggota}}</td>
                <td>{{$cetak->nama_divisi}}</td>
                <td>{{$cetak->tanggal}}</td>
                <td>

                    @if ($cetak->bukti)
                        <img src="{{ asset('storage/buktiPresensi/' . $cetak->bukti) }}" alt="Gambar tidak ada" style="max-width: 200px; max-height: 200px;">
                    @else
                        Tidak ada bukti
                    @endif
                </td>

            </tr>
            @endforeach
        </table>
    </div>
    <script type="text/javascript"> 

        window.print();
    </script>
</body>
</html>