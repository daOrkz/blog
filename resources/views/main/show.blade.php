@extends('layouts.main')

@section('content')
    <div class="">
        <div class="post-title-wrap">
            <p class="post-title-text">{{ $post->title }}</p>
            <p class="post-title-create">{{ $date->translatedFormat('d F Y H:i') }}</p>
            <p class="post-title-comment">Комментариев: {{ $post->comments->count() }}</p>
        </div>
        <div class="post-img-wrap">
            <img src="" alt="img">
        </div>
        <div class="post-text-wrap">
            <p class="post-text">{{ $post->content }}</p>
        </div>

        <div class="related-wrap">
            <div class="related-title-wrap">
                <h3 class="related-title">Похожие посты</h3>
            </div>
            @foreach($randomRelated as $relPost)
                <div class="rel-card-wrap">
                    <div class="rel-card">
                        <div class="rel-img-wrap">
                            <img src="" alt="img">
                        </div>
                        <div class="rel-title-wrap">
                            <p class="rel-title">{{ $relPost->title }}</p>
                        </div>
                        <div class="rel-link-wrap">
                            <a href="{{ route('main.show', $relPost->id) }}">Читать</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>


@endsection
