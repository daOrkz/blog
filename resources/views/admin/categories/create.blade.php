@extends('admin.layouts.main')

@section('content')
    {{--  content  --}}
    <div class="col-10">
        <div class="row">
            <div class="col-12 m-2">
                <h5>Добавление категории</h5>
            </div>

            <div class="row justify-content-start">
                <form class="row justify-content-start" action="" method="post">
                    <div class="row  mb-3">
                        <input class="form-control w-25" id="category_title" placeholder="Название категории">
                    </div>

                    <div class="row col-2">
                        <button type="submit" class="btn btn-success">Создать</button>
                    </div>

                </form>
            </div>

        </div>
    </div>

@endsection
