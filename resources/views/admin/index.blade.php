@extends('layout.admin')

@section('dashboard')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Welcome {{ Auth::user()->display_name }}! 🎉</h5>
                                <p class="mb-4">
                                    You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                                    your profile.
                                </p>

                                <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success"
                                            class="rounded" />
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Profit</span>
                                <h3 class="card-title mb-2">$12,628</h3>
                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card"
                                            class="rounded" />
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <span>Sales</span>
                                <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Expense Overview -->
            <div class="col-md-6 col-lg-8 order-1 mb-4">
                <div class="card h-100">
                    <h5 class="card-header">Daftar Postingan</h5>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID Post</th>
                                    <th>Author</th>
                                    <th>Judul</th>
                                    <th>Status Postingan</th>
                                    <th>View</th>
                                    <th>Tanggal Submit Postingan</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $post->author->display_name }}</td>
                                        <td>{{ $post->post_title }}</td>
                                        <td>{{ $post->post_status }}</td>
                                        <td>{{ $post->view_count }}</td>
                                        <td>{{ $post->post_date }}</td>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Expense Overview -->

            <!-- Transactions -->
            <div class="col-md-6 col-lg-4 order-2 mb-4">
                <div class="card h-100">
                    <h5 class="card-title m-0 me-2 mt-4 mb-3 text-center ">Transaksi</h5>
                    <div class="table-responsive text-nowrap">

                        <table class="table table-responsive table-striped" style="text-align: center">
                            @foreach ($pengirim as $pgn)
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Tanggal Transaksi</td>
                                        <td>Nama Pengirim</td>
                                        <td>Bukti Transaksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pgn->tanggal }}</td>
                                        <td>{{ $pgn->nama }}</td>
                                        <td>{{ Str::limit($pgn->bukti_bayar, 10) }}</td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Transactions -->
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <h5 class="card-header">Daftar Postingan</h5>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Post</th>
                                        <th>Author</th>
                                        <th>Judul</th>
                                        <th>Slug</th>
                                        <th>Postingan</th>
                                        <th>Comment Status</th>
                                        <th>Status Postingan</th>
                                        <th>URL</th>
                                        <th>Tanggal Submit Postingan</th>
                                        <th>Tanggal Perubahan</th>
                                        <th>post_excerpt</th>
                                        <th>post_Status</th>
                                        <th>View</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $post->author->display_name }}</td>
                                            <td>{{ $post->post_title }}</td>
                                            <td>{{ $post->post_name }}</td>
                                            <td>{{ substr($post->post_content, 0, 30) }}...</td>
                                            <td>{{ $post->comment_status }}</td>
                                            <td>{{ $post->post_status }}</td>
                                            <td><a href="{{ $post->guid }}">{{ $post->guid }}</a></td>
                                            <td>{{ $post->post_date }}</td>
                                            <td>{{ $post->post_modified == '-' || is_null($post->post_modified) ? '-' : $post->post_modified }}
                                            </td>
                                            <td>{{ substr($post->post_excerpt, 0, 30) }}...</td>
                                            <td>{{ $post->post_status }}</td>
                                            <td>{{ $post->view_count }}</td>
                                            <td>
                                                <a href="{{ route('admin.edit', $post->post_name) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <a href="{{ route('post.show', $post->post_name) }}"
                                                    class="btn btn-sm btn-info">View</a>
                                                <form action="{{ route('admin.destroy', $post->post_name) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Hapus postingan ini?')">Hapus</button>
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
