<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2>KWITANSI PEMBAYARAN</h2>
    <p>Nomor Invoice: {{ $pengirim->nomor_invoice }}</p>
    <p>Tanggal: {{ date('d-m-Y') }}</p>

    <h3>Telah diterima dari: </h3>
    <p>Nama: Berita Nusantara</p>
    <p>Nomor WhatsApp: 0987654323456</p>
    <p>Email: Admin@gmail.com</p>
    <hr>
    <p>Paket: {{ $pengirim->paket }}</p>
    <p>Judul berita: {{ $pengirim->judul_berita }}</p>
    <p>Tanggal Pemesanan: {{ $pengirim->tanggal }}</p>
    <hr>
    <p>Jumlah yang DIbayarkan: {{ $pengirim->harga }}</p>
    <p>Metode Pembayaran: {{ $pengirim->metodebayar }}</p>

    <hr>

</body>

</html>
