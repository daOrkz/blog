@extends('layouts.main')

@section('content')
    <div class="content-wrap">

        <div class="post-content">

            <div class="post-card">
                <div class="card-wrap">
                    @foreach($posts as $post)
                        <div class="card">
                            <div class="card-elem-wrap">
                                <div class="card-tittle-wrap">
                                    <p class="card-tittle-text">{{ $post->title }}</p>
                                </div>

                                <div class="card-img-wrap">
                                    <img class="card-img-prev" src="{{ asset($post->preview_image) }}" alt="prev_img">
                                </div>

                                <div class="card-category-wrap">
                                    <p class="card-category-text">Категория: {{ $post->category->title }}</p>
                                </div>

                                <div class="card-text-wrap">
                                    <p class="card-text-text">{{ $post->content }}</p>
                                </div>

                                <div class="card-link-wrap">
                                    <div class="link-wrap">
                                        <a class="card-link" href="{{ route('main.show', $post->id) }}">Читать</a>
                                    </div>
                                    <div class="liked-count-wrap">
                                        <p class="liked-count-text">{{ $post->postUserLiked->count() }}</p>
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
                                    @else
                                        <div class="like-button-wrap">
                                            <img class="like-img" src="{{ asset('img/home/heart.svg') }}" alt="">
                                        </div>
                                    @endauth

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                {{ $posts->links('main/paginate') }}
            </div>

            {{--
            <div class="pagination" id="pagination">
                <a href="#" id="prev">Previous</a>
                <a href="#" class="page-link" data-page="1">1</a>
                <a href="#" class="page-link" data-page="2">2</a>
                <a href="#" class="page-link" data-page="3">3</a>
                <a href="#" id="next">Next</a>
                <p id="page-numbers"> </p>
            </div>

            <script src="{{ asset('js/paginate.js') }}"> </script>
            --}}

            <div class="post-random">
                <div class="random-wrap">

                    <div class="random-title-wrap">
                        <p class="random-title-text">Случайные посты</p>
                    </div>

                    <div class="random-post-wrap">
                        <div class="card-wrap">
                            @foreach($randomPosts as $post)
                                <div class="card">
                                    <div class="card-elem-wrap">
                                        <div class="card-tittle-wrap">
                                            <p class="card-tittle-text">{{ $post->title }}</p>
                                        </div>

                                        <div class="card-img-wrap">
                                            <img class="card-img-prev" src="{{ asset($post->preview_image) }}" alt="prev_img">
                                        </div>

                                        <div class="card-category-wrap">
                                            <p class="card-category-text">Категория: {{ $post->category->title }}</p>
                                        </div>

                                        <div class="card-text-wrap">
                                            <p class="card-text-text">{{ $post->content }}</p>
                                        </div>

                                        <div class="card-link-wrap">
                                            <a class="card-link" href="{{ route('main.show', $post->id) }}">Читать</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="post-liked">
            <div class="liked-title-wrap">
                <p class="liked-title">Популярные посты</p>
            </div>
            @foreach($likedPosts as $post)

                <div class="liked">
                    <div class="liked-wrap">
                        <div class="liked-img-wrap">
                            <img class="liked-img" src="{{ asset($post->preview_image) }}" alt="liked_img">
                        </div>
                        <div class="liked-title-wrap">
                            <a href="{{ (route('main.show', $post->id)) }}">
                                <p class="liked-title-text">{{ $post->title }}</p>
                            </a>
                        </div>
                        <div class="liked-count-wrap">
                            <img class="liked-count-img" src="{{ asset('img/home/heart-fill.svg') }}" alt="">
                            <p class="liked-count">{{ $post->post_user_liked_count }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection
