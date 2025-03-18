<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Akun</title>
</head>
<body>
    <h1>Selamat datang, {{ $nama }}!</h1>
    <p>Anda telah diterima untuk bergabung dengan kami. Silakan klik tombol di bawah ini untuk membuat kata sandi Anda dan menyelesaikan proses pendaftaran.</p>
    <p>
        <a href="{{ $link_aktivasi }}" style="background-color: #3e82ff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Buat Kata Sandi
        </a>
    </p>
    <p>Jika Anda tidak merasa melakukan pendaftaran, silakan abaikan email ini.</p>
</body>
</html>
