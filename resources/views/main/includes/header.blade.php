<div class="header-wrap">
    <div class="header-logo-wrap">

    </div>
    <div class="header-title-wrap">

    </div>
    <div class="header-nav-wrap">
        <div class="header-nav-list">
            <ul class="nav-list">
                <li class="nav-elem"><a href="">One</a></li>
                <li class="nav-elem"><a href="">Two</a></li>
                <li class="nav-elem"><a href="">Three</a></li>
            </ul>
        </div>
    </div>
    <div class="header-auth-wrap">
        @guest()
            <div class="header-auth-guest-wrap">
                <a class="nav-link" href="{{ route('login') }}">Войти</a>
                <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
            </div>
        @else
            <div class="header-personal-wrap">
                <a href="{{ route('personal.index') }}" class="nav-link">Личный кабинет</a>
            </div>
            <div class="header-logout-wrap">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input class="" type="submit" value="Выйти">
                </form>
            </div>
        @endguest
    </div>
</div>
