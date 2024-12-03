<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ 'css/reset.css' }}">
    <link rel="stylesheet" href="{{ asset('css/main/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/paginate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/post.css') }}">
    <title>{{ config('app.name', 'Blog') }}</title>
</head>
<body>

<div class="container">
    <div class="container-wrap">

        @include('main.includes.header')
        @yield('content')

    </div>
</div>


</body>
</html>
