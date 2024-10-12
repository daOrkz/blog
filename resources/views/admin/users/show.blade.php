@extends('admin.layouts.main')

@section('content')
    {{--  content  --}}
    <div class="col-10">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center">
                <h3 >{{$user->name}}</h3>
                <a class="mx-1" href="{{ route('admin.users.edit', $user->id) }}"><i class="bi bi-pencil-fill"></i></a>
            </div>

        </div>

        <div class="row table-category">
            <div class="col-6">

                <table class="table">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <th>{{ $user->id }}</th>
                    </tr>
                    <tr>
                        <td>Имя</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Почта</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Роль</td>
                        <td>{{ $role }}</td>
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

