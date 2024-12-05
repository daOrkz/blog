<div class="header-wrap">
    <div class="header-logo-wrap">
        <img class="header-logo-img" src="{{ asset('img/home/logo.png') }}" alt="LOGO">
    </div>
    <div class="header-title-wrap">
        <h1 class="header-title">БЛОГ</h1>
    </div>
    <div class="header-nav-wrap">
        <div class="header-nav-list">
            <ul class="nav-list">
                <li class="nav-elem"><a class="nav-link" href="{{ route('main.index') }}">Главная</a></li>
                <li class="nav-elem"><a class="nav-link" href="{{ route('main.category.index') }}">Категории</a></li>
                <li class="nav-elem"><a class="nav-link" href="">Three</a></li>
            </ul>
        </div>
    </div>
    <div class="header-auth-wrap">
        @guest()
            <div class="header-auth-guest-wrap">
                <a class="auth-link" href="{{ route('login') }}">Войти</a>
                <a class="auth-link" href="{{ route('register') }}">Регистрация</a>
            </div>
        @else
            <div class="header-personal-wrap">
                <a href="{{ route('personal.index') }}" class="auth-link">Личный кабинет</a>
            </div>
            <div class="header-logout-wrap">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input class="logout-btn" type="submit" value="Выйти">
                </form>
            </div>
        @endguest
    </div>
</div>
