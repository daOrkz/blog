@extends('admin.layouts.main')

@section('content')
    {{--  content  --}}
    <div class="col-10">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center">
                <h3 >{{ $post->title }}</h3>
                <a class="mx-1" href="{{ route('admin.posts.edit', $post->id) }}"><i class="bi bi-pencil-fill"></i></a>
            </div>

        </div>

        <div class="row table-category">
            <div class="col-6">

                <table class="table">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <th>{{ $post->id }}</th>
                    </tr>
                    <tr>
                        <td>Название</td>
                        <td>{{ $post->title }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-6">
                    Список постов
                </div>
            </div>
        </div>
    </div>

@endsection

