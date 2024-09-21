@extends('admin.layouts.main')

@section('content')
    {{--  content  --}}
    <div class="col-10">
        <div class="row row-cols-2 justify-content-around">
            <h3 class="col-12">Категории постов</h3>
            <div class="col-3">
                <a class="btn btn-primary" href="{{ route('admin.categories.create') }}">Создать категорию</a>
            </div>

        </div>
    </div>

@endsection
