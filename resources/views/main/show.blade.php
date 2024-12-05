@extends('layouts.main')

@section('content')
    <div class="show-wrap">
        <div class="post-title-wrap">
            <p class="post-title-text">{{ $post->title }}</p>
            <p class="post-title-create">{{ $date->translatedFormat('d F Y H:i') }}</p>
        </div>
        <div class="post-img-wrap">
            <img class="post-img" src="{{ $post->main_image }}" alt="img">
        </div>
        <div class="post-text-wrap">
            <p class="post-text">{{ $post->content }}</p>
        </div>

        @auth()
            <div class="like-button-wrap">
                <form action="{{ route('main.like.store', $post->id) }}" method="POST">
                    @csrf
                    <button class="like-button">

                        @if(auth()->user()->userPostLiked->contains($post->id))
                            <img class="like-img"
                                 src="{{ asset('img/home/heart-fill.svg') }}" alt="">
                        @else
                            <img class="like-img" src="{{ asset('img/home/heart.svg') }}" alt="">
                        @endif
                    </button>
                </form>
            </div>
        @endauth

        @if($randomRelated->count() > 0)
            <div class="related-wrap">
                <div class="related-title-wrap">
                    <h3 class="related-title">Похожие посты</h3>
                </div>
                <div class="rel-card-wrap">
                    @foreach($randomRelated as $relPost)
                        <div class="rel-card">
                            <div class="rel-img-wrap">
                                <img class="rel-img" src="{{ $relPost->preview_image }}" alt="img">
                            </div>
                            <div class="rel-title-wrap">
                                <p class="rel-title">{{ $relPost->title }}</p>
                            </div>
                            <div class="rel-link-wrap">
                                <a class="rel-link" href="{{ route('main.show', $relPost->id) }}">Читать</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @auth()
            <div class="comment_form-wrap">
                <form action="{{ route('main.comment.store', $post->id) }}" method="post">
                    @csrf
                    <div class="comment_form-text">
                        <textarea class="comment_form" name="text" id="" placeholder="Текст комментария" cols="30"
                                  rows="8"></textarea>
                    </div>
                    <div class="comment_form-submit-wrap">
                        <input class="comment_form-submit" type="submit" value="Отправить">
                    </div>
                </form>

                @error('text')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        @endauth
        <div class="comments-wrap">
            <div class="comments-title-wrap">
                <h3 class="comments-title">Комментарии ({{ $post->comments->count() }})</h3>
            </div>
            @foreach($post->comments as $comment)
                <div class="comments-card-wrap">
                    <div class="comments-card">
                        <div class="comments-name-wrap">
                            <p class="comments-name">{{ $comment->user->name }}
                                : {{ $comment->cteatedDate->diffForHumans() }}</p>
                        </div>
                        <div class="comments-text-wrap">
                            <i class="comments-text">{{ $comment->text }}</i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection
