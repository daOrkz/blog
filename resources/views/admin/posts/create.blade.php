@extends('admin.layouts.main')

@section('content')
    {{--  content  --}}
    <div class="col-10">
        <div class="row mx-3">
            <div class="col-12 m-2">
                <h5>Добавление поста</h5>
            </div>

            <div class="row justify-content-start text-start">
                <form class="row justify-content-start"
                      action="{{ route('admin.posts.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <input name="title"
                                   class="form-control w-25"
                                   placeholder="Заоловок"
                                   value="{{ old('title') }}"
                            >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <label for="Post_content" class="form-label">Текст поста</label>
                            <textarea name="content" class="form-control" id="Post_content"
                                      rows="4">{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-8">
                            <label for="preview_image" class="form-label">Добавить превью</label>
                            <input type="file" name="preview_image" id="preview_image">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-8">
                            <label for="main_image" class="form-label">Добавить изображение</label>
                            <input type="file" name="main_image" id="main_image">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div>
                            <select name="category_id">
                                <option value="">Выберете категорию</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == old('category_id') ? 'selected' : '' }}
                                    >{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div>
                            <p>Выбирите теги:</p>
                            @foreach($tags as $tag)
                                <label for="{{ $tag->title }}">
                                    <input class="m-2" type="checkbox" name="tag_ids[]" id="{{ $tag->title }}" value="{{ $tag->id }}"
                                        {{ is_array(old('tag_ids')) && in_array($tag->id, old('tag_ids')) ? 'checked' : '' }}
                                    >{{ $tag->title }}</label>
                            @endforeach
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row mt-3">
                        <div class="">
                            <button type="submit" class="col-2 btn btn-success">Создать</button>
                        </div>
                    </div>


                </form>
            </div>

        </div>
    </div>

@endsection

