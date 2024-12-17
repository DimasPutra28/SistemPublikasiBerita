<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Nomor Invoice</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Judul Berita</th>
                <th>Tanggal</th>
                <th>Paket</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengirims as $pengirim)
                <tr>
                    <td>{{ $pengirim->nomor_invoice }}</td>
                    <td>{{ $pengirim->nama }}</td>
                    <td>{{ $pengirim->email }}</td>
                    <td>{{ $pengirim->judul_berita }}</td>
                    <td>{{ $pengirim->tanggal }}</td>
                    <td>{{ $pengirim->paket }}</td>
                    <td>
                        <form action="{{ url('/send-kwitansi/' . $pengirim->id) }}" method="POST">
                            @csrf
                            <button type="submit">Send Kwitansi</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
