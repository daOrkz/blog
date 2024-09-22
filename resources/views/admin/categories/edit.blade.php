@extends('admin.layouts.main')

@section('content')
    {{--  content  --}}
    <div class="col-10">
        <div class="row mx-3">
            <div class="col-12 m-2">
                <h5>Редактирование категории</h5>
            </div>

            <div class="row justify-content-start">
                <form class="row justify-content-start" action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row  mb-3">
                        <input name="title"
                               class="form-control w-25"
                               id="category_title"
                               placeholder="Название категории"
                               value="{{ $category->title }}"
                        >
                    </div>

                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row col-2">
                        <button type="submit" class="btn btn-success">Изменить</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

@endsection
