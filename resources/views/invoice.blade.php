<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <p>Nomor Invoice: </p>
    <p>Nama: {{ $pengirim->nama }}</p>
    <p>No WA: {{ $pengirim->no_wa }}</p>
    <p>Email: {{ $pengirim->email }}</p>
    <p>Judul Berita: {{ $pengirim->judul_berita }}</p>
    <p>Tanggal: {{ $pengirim->tanggal }}</p>
    <p>Paket: {{ $pengirim->paket }}</p>

</body>

</html>
