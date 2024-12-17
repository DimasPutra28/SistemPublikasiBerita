@extends('layout.admin')

@section('dashboard')
    <div class="container-xxl flex-grow-1 container-p-y">
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
                                        <th>Jumlah View</th>
                                        <th>URL</th>
                                        <th>Tanggal Submit Postingan</th>
                                        <th>Tanggal Perubahan</th>
                                        <th>post_excerpt</th>
                                        <th>post_Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $post->author->display_name }}</td>
                                            {{-- <td>{{ $post->post_author }}</td> --}}
                                            <td>{{ $post->post_title }}</td>
                                            <td>{{ $post->post_name }}</td>
                                            <td>{{ substr($post->post_content, 0, 30) }}...</td>
                                            <td>{{ $post->view_count }}</td>
                                            <td><a href="{{ $post->guid }}">{{ $post->guid }}</a></td>
                                            <td>{{$post->post_date}}</td>
                                            <td>{{ $post->post_modified == '-' || is_null($post->post_modified) ? '-' : $post->post_modified }}
                                            </td>
                                            <td>{{ substr($post->post_excerpt, 0, 30) }}...</td>
                                            <td>{{ $post->post_status }}</td>
                                            <td>
                                                <a href="{{ route('admin.edit', $post->post_name) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
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
