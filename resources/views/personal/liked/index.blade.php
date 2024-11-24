@extends('personal.layouts.main')

@section('content')

    <div class="statistic-wrap">
        <h3 class="title-content">Понравившиеся посты</h3>

        <table class="table">
            <thead>
            <tr class="">
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Просмотр</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>

            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td><a href="{{ route('admin.posts.show', $post->id) }}">
                            <img class="table-img" src="{{ asset('img/personal/eye.svg') }}" alt="eye">
                        </a></td>
                    <td>
                        <form action="{{ route('personal.liked.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn delete" type="submit" ><img class="table-img" src="{{ asset('img/personal/trash.svg') }}" alt="eye"></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
