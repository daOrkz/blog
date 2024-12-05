@extends('layouts.main')

@section('content')
    <div class="content-wrap">

        <div class="category-list-wrap">
            <ul class="category-list">
                @foreach($categories as $category)
                    <li class="category-item"><a class="category-link" href="{{ route('main.category.post.index', $category->id) }}">{{ $category->title }}</a></li>
                @endforeach
            </ul>
        </div>

    </div>

@endsection
