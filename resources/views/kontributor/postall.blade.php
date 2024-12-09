@extends('layout.template')

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
                                        <th>Judul</th>
                                        <th>Slug</th>
                                        <th>Postingan</th>
                                        <th>Password</th>
                                        <th>Tanggal Publish</th>
                                        <th>Tanggal Perubahan</th>
                                        <th>post_excerpt</th>
                                        <th>post_Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse($posts as $post)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $post->post_title }}</td>
                                            <td>{{ $post->post_name }}</td>
                                            <td>{{ $post->post_content }}</td>
                                            <td>{{ $post->post_password }}</td>
                                            <td>{{ $post->post_date }}</td>
                                            <td>{{ $post->post_modified == '-' || is_null($post->post_modified) ? '-' : $post->post_modified }}
                                            </td>
                                            <td>{{ $post->post_excerpt }}</td>
                                            <td>{{ $post->post_status }}</td>
                                            <td>
                                                <a href="{{ route('post.edit', $post) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('post.destroy', $post->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Hapus postingan ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
