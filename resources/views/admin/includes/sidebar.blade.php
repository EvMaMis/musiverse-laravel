<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="{{route('admin.main.index')}}"
           class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Admin panel</span>
        </a>

        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start w-100" id="menu">
            <li class="nav-item w-100">
                <a href="{{route('admin.main.index')}}" class="nav-link align-middle px-0">
                    <i class="fs-4 fas fa-solid fa-house"></i> <span
                        class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li>
            @canany(['Edit', 'Add', 'Suggest', 'Delete'])
                <li class="nav-item w-100">
                    <a href="{{route('admin.genre.index')}}"
                       class="nav-link px-0 align-middle {{str_contains(url()->current(), 'genres') ? 'active' : ''}}">
                        <i class="fs-4 fas fa-solid fa-guitar"></i> <span
                            class="ms-1 d-none d-sm-inline">{{__('Genres')}}</span> </a>
                </li>

                <li class="nav-item w-100">
                    <a href="{{route('admin.tag.index')}}"
                       class="nav-link px-0 align-middle {{str_contains(url()->current(), 'tags') ? 'active' : ''}}">
                        <i class="fs-4 fas fa-solid fa-tag"></i> <span
                            class="ms-1 d-none d-sm-inline">{{__('Tags')}}</span></a>
                </li>
                <li class="nav-item w-100">
                    <a href="{{route('admin.artist.index')}}"
                       class="nav-link px-0 align-middle {{str_contains(url()->current(), 'artist') ? 'active' : ''}}">
                        <i class="fs-4 fas fa-solid fa-user"></i> <span
                            class="ms-1 d-none d-sm-inline">{{__('Artists')}}</span></a>
                </li>
                <li class="nav-item w-100">
                    <a href="{{route('admin.song.index')}}"
                       class="nav-link px-0 align-middle {{str_contains(url()->current(), 'song') ? 'active' : ''}}">
                        <i class="fs-4 fas fa-solid fa-music"></i> <span
                            class="ms-1 d-none d-sm-inline">{{__('Tracks')}}</span></a>
                </li>
                <li class="nav-item w-100">
                    <a href="{{route('admin.playlist.index')}}"
                       class="nav-link px-0 align-middle {{str_contains(url()->current(), 'playlist') ? 'active' : ''}}">
                        <i class="fs-4 fas fa-solid fa-headphones-simple"></i> <span
                            class="ms-1 d-none d-sm-inline">{{__('Playlists')}}</span></a>
                </li>
            @endcanany
            @can('Manage roles')
                <li class="nav-item w-100">
                    <a href="{{route('admin.role.index')}}"
                       class="nav-link px-0 align-middle {{str_contains(url()->current(), 'roles') ? 'active' : ''}}">
                        <i class="fs-4 fas fa-solid fa-pen-ruler"></i> <span
                            class="ms-1 d-none d-sm-inline">{{__('Roles')}}</span>
                    </a>
                </li>
                <li class="nav-item w-100">
                    <a href="{{route('admin.user.index')}}"
                       class="nav-link px-0 align-middle {{str_contains(url()->current(), 'users') ? 'active' : ''}}">
                        <i class="fs-4 fas fa-solid fa-user-tie"></i> <span
                            class="ms-1 d-none d-sm-inline">{{__('Users')}}</span>
                    </a>
                </li>

            @endcan

        </ul>
    </div>
</div>
