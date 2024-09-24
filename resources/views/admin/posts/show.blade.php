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

        <div class="row">
            <p class="text-start">{{ $post->content }}</p>
        </div>

    </div>

@endsection

