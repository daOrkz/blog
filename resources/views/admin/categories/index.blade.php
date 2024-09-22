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
            <div class="col-8">

                <table class="table table-striped">
                    <thead>
                    <tr class="table-secondary">
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Количество постов</th>
                        <th scope="col">Редактировать</th>
                        <th scope="col">Просмотр</th>
                        <th scope="col">Удалить</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->title }}</td>
                            <td>0</td>
                            <td><a href="{{ route('admin.categories.edit', $category->id) }}"><i
                                        class="bi bi-pencil-fill"></i></a></td>
                            <td><a href="{{ route('admin.categories.show', $category->id) }}"><i
                                        class="bi bi-eye-fill"></i></a></td>
                            <td>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="border-0 bg-transparent" type="submit" ><i class="bi bi-trash-fill text-danger"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
