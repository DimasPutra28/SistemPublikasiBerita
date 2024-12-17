@extends('layout.admin')
@section('dashboard')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="card">
                <h5 class="card-header">Daftar Postingan</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nomor Invoice</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Judul Berita</th>
                                    <th>File</th>
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
                                        <td>
                                            <a href="{{ asset('storage/public/uploads/' . $pengirim->upload_file) }}" target="_blank">Lihat File</a>
                                        </td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
