<div class="sidebar-wrap">

    <ul class="nav">
        <li class="nav-item ">
            <a class="nav-link nav-link-wrap" href="{{ route('main.index') }}">
                <img class="nav-img" src="{{ asset('img/personal/home.svg') }}" alt="home">
                <p class="nav-link-text">Главная</p>
            </a>
        </li>

        <li class="nav-item ">
            <a class="nav-link nav-link-wrap" href="{{ route('personal.index') }}">
                <img class="nav-img" src="{{ asset('img/personal/person.svg') }}" alt="home">
                <p class="nav-link-text">Личный кабинет</p>
            </a>
        </li>

        <li class="nav-item ">
            <a class="nav-link nav-link-wrap" href="{{ route('personal.liked.index') }}">
                <img class="nav-img" src="{{ asset('img/personal/like.svg') }}" alt="like">
                <span class="nav-link-text">Любимые посты</span>
            </a>
        </li>

        <li class="nav-item ">
            <a class="nav-link nav-link-wrap" href="{{ route('personal.comment.index') }}">
                <img class="nav-img" src="{{ asset('img/personal/comment.svg') }}" alt="comment">
                <span class="nav-link-text">Комментарии</span>
            </a>
        </li>

    </ul>

</div>
