@extends('layout.pengirim')
@section('dashboard')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-md-14">
                <div class="card mb-4">
                    <h5 class="card-header">Form Pengirim Berita</h5>
                    <div class="card-body">
                        <form id="mainForm" action="{{ url('/form/simpan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_wa" class="form-label">Nomor WhatsApp</label>
                                <input type="text" class="form-control" name="no_wa" placeholder="No WA" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email"class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <label for="judul_berita" class="form-label">Judul Berita</label>
                                <input type="text"class="form-control" name="judul_berita" placeholder="Judul Berita"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="Upload file" class="form-label">Upload File</label>
                                <input type="file" class="form-control" name="file_path" required>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" required>
                            </div>

                            <div class="mb-3">
                                <label for="paket" class="form-label">Paket Berita</label>
                                <select class="form-select" name="paket" id="paketBerita" onchange="handlePaketChange(); updateHarga()"
                                    required>
                                    <option value="" disabled selected>Pilih Paket Berita</option>
                                    <option value="Paket Reguler - Rp 50.000">Paket Reguler - Rp 50.000</option>
                                    <option value="Paket Cepat - Rp 100.000">Paket Cepat - Rp 100.000</option>
                                    <option value="Paket Branding Reguler - Rp 300.000">Paket Branding Reguler - Rp 300.000
                                    </option>
                                    <option value="Paket Branding Cepat - Rp 500.000">Paket Branding Cepat - Rp 500.000
                                    </option>
                                </select>
                            </div>
                            <!-- Keterangan Paket -->
                            <div id="keteranganPaket" class="mb-3" style="display: none;">
                                <label class="form-label">Keterangan Paket</label>
                                <div id="keteranganPaketContent" class="alert alert-info"></div>
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label" hidden>Harga</label>
                                <input type="text" class="form-control" id="harga" name="harga" readonly hidden>
                            </div>

                            <div class="mb-3">
                                <label for="metodebayar" class="form-label">Metode Pembayaran</label>
                                <select class="form-select" name="metodebayar" id="metodebayar" required>
                                    <option value="" disabled selected>Pilih Paket Berita</option>
                                    <option value="TransferVirtualAccount Mandiri - 00987654321">Mandiri</option>
                                    <option value="E-Wallet Shopeepay - 01234567890">Shopeepay</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <div id="invoiceSection" style="display: none;">
                            <div class="mb-3 mt-3">
                                <label for="invoice" class="form-label">Invoice: </label>
                                <a id="viewInvoice" href="#" target="_blank">Lihat Invoice Disini</a>
                            </div>
                            <div class="mb-3">
                                <form id="buktiBayarForm" action="{{ url('/upload-bukti/') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <label for="bukti_bayar" class="form-label">Upload Bukti Pembayaran: </label>
                                    <input type="file" class="form-control" name="bukti_bayar" required>
                                    <button type="submit" class="btn btn-secondary mt-3">Upload Bukti Bayar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateHarga() {
            const paketBerita = document.getElementById("paketBerita").value;
            const hargaInput = document.getElementById("harga");

            // Ekstrak harga dari string
            const harga = paketBerita.match(/Rp (\d+\.\d+)/); // Cari format Rp xxx.xxx
            if (harga) {
                hargaInput.value = harga[1].replace('.', ''); // Hapus titik dari angka
            } else {
                hargaInput.value = ''; // Jika tidak ada harga
            }
        }



        function handlePaketChange() {
            const paketBerita = document.getElementById("paketBerita").value;
            const keteranganPaket = document.getElementById("keteranganPaket");
            const keteranganPaketContent = document.getElementById("keteranganPaketContent");

            keteranganPaket.style.display = "block";

            // Menampilkan keterangan berdasarkan paket yang dipilih
            if (paketBerita === "Paket Reguler - Rp 50.000") {
                keteranganPaketContent.innerHTML = `
                    <ul>
                        <li>1x Publikasi Berita Online.</li>
                        <li>Pengerjaan Maksimal 2x24 Jam.</li>
                        <li>Link Berita Aktif Selamanya.</li>
                    </ul>`;
            } else if (paketBerita === "Paket Cepat - Rp 100.000") {
                keteranganPaketContent.innerHTML = `
                    <ul>
                        <li>1x Publikasi Berita Online.</li>
                        <li>Pengerjaan Maksimal 4 Jam.</li>
                        <li>Link Berita Aktif Selamanya.</li>
                    </ul>`;
            } else if (paketBerita === "Paket Branding Reguler - Rp 300.000") {
                keteranganPaketContent.innerHTML = `
                    <ul>
                        <li>1x Publikasi Berita Online.</li>
                        <li>Pengerjaan Maksimal 2x24 Jam.</li>
                        <li>Link Berita Aktif Selamanya.</li>
                        <li>Terindeks Google.</li>
                    </ul>`;
            } else if (paketBerita === "Paket Branding Cepat - Rp 500.000") {
                keteranganPaketContent.innerHTML = `
                    <ul>
                        <li>1x Publikasi Berita Online.</li>
                        <li>E-Koran dan tampil di 2 media.</li>
                        <li>Terindeks Google.</li>
                    </ul>`;
            } else {
                keteranganPaket.style.display = "none"; // Jika tidak ada paket yang dipilih
            }
        }
    </script>


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
@endsection
