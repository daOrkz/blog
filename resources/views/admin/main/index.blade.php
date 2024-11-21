@extends('admin.layouts.main')

@section('content')

    {{--  content  --}}
    <div class="col-10 mt-3">
        <h3 class="text-center">Статистика</h3>
        <div class="row row-cols-2 justify-content-between">
            <div class="card bg-primary col-3">
                <div class="card-body">
                    <h5 class="card-title">Пользователи</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $data['usersCount'] }}</h6>
                </div>
            </div>

            <div class="card bg-secondary col-3">
                <div class="card-body">
                    <h5 class="card-title">Посты</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $data['postsCount'] }}</h6>
                </div>
            </div>

            <div class="card bg-warning col-3">
                <div class="card-body">
                    <h5 class="card-title">Категории</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $data['categoryCount'] }}</h6>
                </div>
            </div>

            <div class="card bg-success col-3">
                <div class="card-body">
                    <h5 class="card-title">Теги</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $data['tagsCount'] }}</h6>
                </div>
            </div>
        </div>
    </div>

@endsection
