<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h1>Invoice</h1>
    <p>Nama: {{ $Pengirim->nama }}</p>
    <p>No WA: {{ $Pengirim->no_wa }}</p>
    <p>Email: {{ $Pengirim->email }}</p>
    <p>Judul Berita: {{ $Pengirim->judul_berita }}</p>
    <p>Tanggal: {{ $Pengirim->tanggal }}</p>
    <p>Paket: {{ $Pengirim->paket }}</p>

</body>

</html>
