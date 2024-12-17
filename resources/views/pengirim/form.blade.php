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
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <select class="form-select" name="paket" id="paketBerita" onchange="handlePaketChange()"
                                    required>
                                    <option value="" disabled selected>Pilih Paket Berita</option>
                                    <option value="reguler">Paket Reguler - Rp 50.000</option>
                                    <option value="cepat">Paket Cepat - Rp 100.000</option>
                                    <option value="brandingReguler">Paket Branding Reguler - Rp 300.000</option>
                                    <option value="brandingCepat">Paket Branding Cepat - Rp 500.000</option>
                                </select>
                            </div>
                            <!-- Keterangan Paket -->
                            <div id="keteranganPaket" class="mb-3" style="display: none;">
                                <label class="form-label">Keterangan Paket</label>
                                <div id="keteranganPaketContent" class="alert alert-info"></div>
                            </div>
                            {{-- <select name="paket" required>
                                <option value="A">Paket A</option>
                                <option value="B">Paket B</option>
                                <option value="C">Paket C</option>
                            </select> --}}
                            <button type="submit">Submit</button>
                        </form>

                        <div id="invoiceSection" style="display: none;">
                            <div class="mb-3">
                                <label for="invoice" class="form-label">Invoice</label>
                                <a id="viewInvoice" href="#" target="_blank">Lihat Invoice</a>
                            </div>
                            <div class="mb-3">
                                <form id="buktiBayarForm" action="{{ url('/upload-bukti/') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" class="form-control" name="bukti_bayar" required>
                                    <button type="submit">Upload Bukti Bayar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function handlePaketChange() {
            const paketBerita = document.getElementById("paketBerita").value;
            const keteranganPaket = document.getElementById("keteranganPaket");
            const keteranganPaketContent = document.getElementById("keteranganPaketContent");

            keteranganPaket.style.display = "block";

            // Menampilkan keterangan berdasarkan paket yang dipilih
            if (paketBerita === "reguler") {
                keteranganPaketContent.innerHTML = `
                    <ul>
                        <li>1x Publikasi Berita Online.</li>
                        <li>Pengerjaan Maksimal 2x24 Jam.</li>
                        <li>Link Berita Aktif Selamanya.</li>
                    </ul>`;
            } else if (paketBerita === "cepat") {
                keteranganPaketContent.innerHTML = `
                    <ul>
                        <li>1x Publikasi Berita Online.</li>
                        <li>Pengerjaan Maksimal 4 Jam.</li>
                        <li>Link Berita Aktif Selamanya.</li>
                    </ul>`;
            } else if (paketBerita === "brandingReguler") {
                keteranganPaketContent.innerHTML = `
                    <ul>
                        <li>1x Publikasi Berita Online.</li>
                        <li>Pengerjaan Maksimal 2x24 Jam.</li>
                        <li>Link Berita Aktif Selamanya.</li>
                        <li>Terindeks Google.</li>
                    </ul>`;
            } else if (paketBerita === "brandingCepat") {
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
