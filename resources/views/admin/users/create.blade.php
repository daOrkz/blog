@extends('admin.layouts.main')

@section('content')
    {{--  content  --}}
    <div class="col-10">
        <div class="row mx-3">
            <div class="col-12 m-2">
                <h5>Добавление пользователя</h5>
            </div>

            <div class="row justify-content-start">
                <form class="row justify-content-start" action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="row  mb-3">
                        <input name="name" class="form-control w-25" id="category_title" placeholder="Имя пользователя" value="{{ old('name') }}">
                    </div>

                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row  mb-3">
                        <input name="email" class="form-control w-25" id="category_title" placeholder="Email пользователя" value="{{ old('email') }}">
                    </div>

                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row  mb-3">
                        <input name="password" class="form-control w-25" id="category_title" placeholder="Пароль пользователя">
                    </div>

                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row col-2">
                        <button type="submit" class="btn btn-success">Создать</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

@endsection
