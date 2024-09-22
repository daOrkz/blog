@extends('admin.layouts.main')

@section('content')
    {{--  content  --}}
    <div class="col-10">
        <div class="row row-cols-2 justify-content-around">
            <h3 class="col-12">{{ $category->title }}</h3>


        </div>

        <div class="row table-category">
            <div class="col-6">

                <table class="table">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <th>{{ $category->id }}</th>
                    </tr>
                        <tr>
                            <td>Название</td>
                            <td>{{ $category->title }}</td>
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

