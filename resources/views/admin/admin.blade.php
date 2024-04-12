@extends('layouts.admin')

@section('main')
    <div class="h1 text-center">Админ панель</div>
    <div class="row row-cols-1 justify-content-center row-cols-md-2 row-cols-xxl-3 justify-content-lg-between p-4">
        @canany(['Add', 'Suggest', 'Delete', 'Edit'])
            <div class="col card text-white bg-dark mb-3" style="max-width: 18rem;">
                <a href="{{route('admin.genre.index')}}" class="nav-link">
                    <div class="card-header">Genres</div>
                    <div class="card-body">
                        <h5 class="card-title">Music Genres</h5>
                        <p class="card-text">Add, Remove, Edit music genres.</p>
                    </div>
                </a>
            </div>
            <div class="col card text-white bg-dark mb-3" style="max-width: 18rem;">
                <a href="{{route('admin.tag.index')}}" class="nav-link">
                    <div class="card-header">Tags</div>
                    <div class="card-body">
                        <h5 class="card-title">Tags for music</h5>
                        <p class="card-text">Add, Remove, Edit tags of music</p>
                    </div>
                </a>
            </div>
            <div class="col card text-white bg-dark mb-3" style="max-width: 18rem;">
                <a href="{{route('admin.artist.index')}}" class="nav-link">
                    <div class="card-header">Artists</div>
                    <div class="card-body">
                        <h5 class="card-title">Artists and Groups</h5>
                        <p class="card-text">Add, Remove, Edit artists and groups for songs</p>
                    </div>
                </a>
            </div>
            <div class="col card text-white bg-dark mb-3" style="max-width: 18rem;">
                <a href="{{route('admin.song.index')}}" class="nav-link">
                    <div class="card-header">Songs</div>
                    <div class="card-body">
                        <h5 class="card-title">Songs, tracks, compositions</h5>
                        <p class="card-text">Add, Remove, Edit songs</p>
                    </div>
                </a>
            </div>
        @endcanany
        @can('Manage roles')
            <div class="col card text-white bg-dark mb-3" style="max-width: 18rem;">
                <a href="{{route('admin.role.index')}}" class="nav-link">
                    <div class="card-header">Roles</div>
                    <div class="card-body">
                        <h5 class="card-title">Set permissions and roles for users</h5>
                        <p class="card-text">Add, Remove, Edit permissions for roles of users</p>
                    </div>
                </a>
            </div>
            <div class="col card text-white bg-dark mb-3" style="max-width: 18rem;">
                <a href="{{route('admin.user.index')}}" class="nav-link">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        <h5 class="card-title">Accounts base</h5>
                        <p class="card-text">Add, Remove, Edit accounts and their roles</p>
                    </div>
                </a>
            </div>
        @endcan
    </div>
@endsection
