@extends('personal.layouts.main')

@section('content')

    <div class="statistic-wrap">
        <h3 class="title-content">Личный кабинет</h3>
        <div class="card-container">
            <div class="card">
                <div class="card-body bg-color-green">
                    <h5 class="card-title">Любимые посты</h5>
                    <h6 class="card-subtitle">10</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body bg-color-yellow">
                    <h5 class="card-title">Комментарии</h5>
                    <h6 class="card-subtitle">6</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body bg-color-red">
                    <h5 class="card-title">Категории</h5>
                    <h6 class="card-subtitle">67</h6>
                </div>
            </div>

        </div>
    </div>

@endsection
