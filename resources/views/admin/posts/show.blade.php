@extends('admin.layouts.main')

@section('content')
    {{--  content  --}}
    <div class="col-10">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center">
                <h3 >{{ $post->title }}</h3>
                <a class="mx-1" href="{{ route('admin.posts.edit', $post->id) }}"><i class="bi bi-pencil-fill"></i></a>
            </div>
        </div>

        <div class="row text-start">
            <h4>Категория: {{ $post->category }}</h4>
        </div>

        <div class="row">
            <div class="">
                <img class="w-25" src="{{ asset('storage/'.$post->preview_image) }}" alt="preview_image">
            </div>
        </div>

        <div class="row mt-2">
            <div>
                <img class="w-25" src="{{ asset('storage/'.$post->main_image) }}" alt="main_image">
            </div>
        </div>



        <div class="row">
            <p class="text-start">{{ $post->content }}</p>
        </div>

    </div>

@endsection

