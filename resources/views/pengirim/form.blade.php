<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form id="mainForm" action="{{ url('/form/simpan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="text" name="no_wa" placeholder="No WA" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="judul_berita" placeholder="Judul Berita" required>
        <input type="file" name="file_path" required>
        <input type="date" name="tanggal" required>
        <select name="paket" required>
            <option value="A">Paket A</option>
            <option value="B">Paket B</option>
            <option value="C">Paket C</option>
        </select>
        <button type="submit">Submit</button>
    </form>

    <div id="invoiceSection" style="display: none;">
        <a id="viewInvoice" href="#" target="_blank">Lihat Invoice</a>
        <form id="buktiBayarForm" action="{{ url('/upload-bukti/') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="bukti_bayar" required>
            <button type="submit">Upload Bukti Bayar</button>
        </form>
    </div>

    <script>
        document.getElementById('mainForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);

            const response = await fetch(e.target.action, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (result.id) {
                document.getElementById('viewInvoice').href = `/invoice/${result.id}`;
                document.getElementById('buktiBayarForm').action = `/upload-bukti/${result.id}`;
                document.getElementById('invoiceSection').style.display = 'block';
                alert('Form berhasil disimpan!');
            }
        });
    </script>
</body>
</html>
