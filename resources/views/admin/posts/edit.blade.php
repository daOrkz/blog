@extends('admin.layouts.main')

@section('content')
    {{--  content  --}}
    <div class="col-10">
        <div class="row mx-3">
            <div class="col-12 m-2">
                <h5>Редактирование поста</h5>
            </div>

            <div class="row justify-content-start">
                <form class="row justify-content-start" action="{{ route('admin.posts.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <input name="title"
                                   class="form-control w-25"
                                   id="category_title"
                                   placeholder="Заоловок"
                                   value="{{ $post->title }}"
                            >
                        </div>
                    </div>


                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row">
                        <div class="col-8">
                            <label for="Post_content" class="form-label">Текст поста</label>
                            <textarea name="content" class="form-control" id="Post_content" rows="4">{{ $post->content }}</textarea>
                        </div>
                    </div>

                    @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mt-3 text-start">
                        <div class="">
                            <button type="submit" class="col-2 btn btn-success">Редактировать</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>

@endsection
