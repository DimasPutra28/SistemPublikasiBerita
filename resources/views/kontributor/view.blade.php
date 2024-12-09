@extends('layout.template')

@section('dashboard')
    <div class="container">
        <h1>{{ $post->post_title }}</h1>
        <div class="content">
            {!! $post->post_content !!}
        </div>

        <div class="footer">
            <p>Jumlah Views: {{ $post->view_count }}</p>
        </div>
    </div>
@endsection
