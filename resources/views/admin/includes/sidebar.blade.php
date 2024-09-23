<div class="col-2 bg-primary-subtle pt-5" style="height: 100vh;">

    <ul class="nav flex-column text-black">
        <li class="nav-item ">
            <a class="nav-link active" aria-current="page" href="{{ route('admin.categories.index') }}">
                <i class="bi bi-card-checklist"></i>
                <span class="px-3">Категории</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.tags.index') }}">
                <i class="bi bi-tag"></i>
                <span class="px-3">Теги</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.posts.index') }}">
                <i class="bi bi-chat-right-text"></i>
                <span class="px-3">Посты</span>
            </a>
        </li>
    </ul>

</div>
