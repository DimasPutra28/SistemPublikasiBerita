@extends('layout.template')

@section('dashboard')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">{{ isset($post) ? 'Edit Postingan' : 'Tambahkan Postingan' }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($post) ? route('post.update', $post->post_name) : route('post.store') }}" method="POST">
                            @csrf
                            @if (isset($post))
                                @method('PUT')
                            @endif

                            <!-- Judul Postingan -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Judul Postingan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="post_title" class="form-control" id="basic-default-name"
                                        placeholder="Masukkan Judul" oninput="generateSlug()"
                                        value="{{ $post->post_title ?? old('post_title') }}" required />
                                </div>
                            </div>

                            <!-- Slug -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="post_name">Slug (URL):</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="post_name" id="post_name" readonly
                                        placeholder="Slug akan dihasilkan secara otomatis"
                                        value="{{ $post->post_name ?? old('post_name') }}">
                                </div>
                            </div>

                            <!-- Postingan -->
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-message">Postingan</label>
                                <div class="col-sm-10">
                                    <textarea name="post_content" class="ckeditor form-control" id="basic-default-message" cols="30" rows="10" >{{ $post->post_content ?? old('post_content') }}</textarea>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                    <a href="{{ route('post.dash') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/ckeditor4/ckeditor.js"></script>
    <script>
        // Fungsi untuk membuat slug secara otomatis dari judul
        function generateSlug() {
            const title = document.getElementById('basic-default-name').value;
            const slug = title
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            document.getElementById('post_name').value = slug;
        }

        CKEDITOR.replace('basic-default-message');
    </script>
@endsection
