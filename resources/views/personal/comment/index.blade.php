@extends('personal.layouts.main')

@section('content')

    <div class="statistic-wrap">
        <h3 class="title-content">Комментарии</h3>

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

            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->text }}</td>
                    <td><a href="">
                            <img class="table-img" src="{{ asset('img/personal/pencil.svg') }}" alt="eye">
                        </a></td>
                    <td>
                        <form action="{{ route('personal.liked.destroy', $comment->id) }}" method="post">
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
