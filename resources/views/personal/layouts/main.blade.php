<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/personal/main.css') }}">
    <title>{{ config('app.name', 'Blog') }}</title>
</head>
<body>


{{--<form action="{{ route('logout') }}" method="POST">--}}
{{--    @csrf--}}
{{--    <input class="btn btn-success" type="submit" value="Выйти">--}}
{{--</form>--}}


<div class="container">
    <div class="container-wrap">
        <div class="sidebar">
            @include('personal.includes.sidebar')
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>


</div>


</body>
</html>
