<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 100%">
    <a href="{{route('admin.main.index')}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Админ панель</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{route('admin.genre.index')}}" class="nav-link {{str_contains(url()->current(), 'genres') ? 'active' : ''}}" aria-current="page">
                <i class="fas fa-solid fa-guitar"></i>
                Жанры
            </a>
            <a href="{{route('admin.song.index')}}" class="nav-link {{str_contains(url()->current(), 'song') ? 'active' : ''}}" aria-current="page">
                <i class="fas fa-solid fa-music"></i>
                Композиции
            </a>
        </li>
    </ul>
</div>
