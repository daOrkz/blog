<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>{{ config('app.name', 'Blog') }}</title>
</head>
<body>

<div class="container" style="height: 100vh;">
    <div class="row bg-secondary-subtle p-3">
        <div class=" d-flex justify-content-around">
            <h3 class=" text-center">Admin Panel</h3>
            <div class="">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input class="btn btn-success" type="submit" value="Выйти">
                </form>
            </div>
        </div>
    </div>


    <div class="row">

        @include('admin.includes.sidebar')

        @yield('content')

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
