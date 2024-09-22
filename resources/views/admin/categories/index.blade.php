@extends('admin.layouts.main')

@section('content')
    {{--  content  --}}
    <div class="col-10">
        <div class="row row-cols-2 justify-content-around">
            <h3 class="col-12">Категории постов</h3>
            <div class="col-3 mb-3">
                <a class="btn btn-primary" href="{{ route('admin.categories.create') }}">Создать категорию</a>
            </div>

        </div>

        <div class="row table-category">
            <div class="col-6">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Количество постов</th>
                        <th scope="col">Редактировать</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->title }}</td>
                            <td>0</td>
                            <td>редактировать</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
