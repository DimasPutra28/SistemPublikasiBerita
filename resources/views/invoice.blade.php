<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <table style="border-bottom: 2px solid black">
        <tr>
            <td>
                <h1 style="margin: 0; font-size: 24px; color: #333;">INVOICE</h1>
                <h3 style="margin: 5px 0; font-size: 18px; color: #555;">PT XYZ Berita</h3>
                <p style="margin: 5px 0; font-size: 14px;"><b>Kantor Pusat:</b> JL Graha Pena no 111 Surabaya</p>
                <p style="margin: 5px 0; font-size: 14px;"><b>Nomor NIB:</b> 0987601233456789</p>
                <p style="margin: 5px 0; font-size: 14px;"><b>Whatsapp:</b> 01233456789</p>
            </td>
            <td style="width: 200px"></td>

            <td>
                <h1 style="margin: 0; font-size: 20px; color: #ff9900;">BERITA NUSANTARA</h1>
                <p style="margin: 5px 0; font-size: 14px;"><b>Invoice:</b> {{ $pengirim->nomor_invoice }}</p>
                <p style="margin: 5px 0; font-size: 14px;"><b>Tanggal:</b> {{ date('d-m-Y') }}</p>
            </td>
        </tr>
    </table>

    <div>
        <p><b>Kepada : </b>{{ $pengirim->nama }}</p>
    </div>

    <table style="border:1px solid black;" border="1">
        <tr>
            <th style="width: 480px">Deskripsi</th>
            <th style="width: 100px">Jumlah</th>
            <th style="width: 100px">Harga</th>
        </tr>
        <tr style="text-align: center">
            <td>{{ $pengirim->paket }}</td>
            <td>1</td>
            <td>Rp {{ $pengirim->harga }}</td>
        </tr>
    </table>

    <table style="margin-top: 20px" >
        <tr>
            <td style="width: 500px">Pembayaran Melalui</td>
            <td></td>
        </tr>
        <tr>
            <td>{{ $pengirim->metodebayar }}

            </td>
            <td></td>
        </tr>
        <tr>
            <td>
                <div style="margin-top: 10px;margin-left: 20px">
                    <p>Scan Disini untuk Melakukan Pembayaran:</p>
                    <img src="" alt="">
                    {{-- <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code"> --}}
                </div>
            </td>
            <td style="height: 80px">Hormat Kami</td>
        </tr>
        <tr>
            <td></td>
            <td>Wahyu</td>
        </tr>
        <tr>
            <td></td>
            <td>Finance Dept</td>
        </tr>
    </table>

</body>

</html>
