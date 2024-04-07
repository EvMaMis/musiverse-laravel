@extends('layouts.admin')
@section('head_meta')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection


@section('main')
    <form action="{{route('admin.user.store')}}" method="POST">
        @csrf
        <div class="col-6 form-group">
            <label for="name" class="form-label">Имя пользователя</label>
            <input id="name" type="text" placeholder="Имя пользователя..." class="form-control" name="name"
                   value="{{old('name')}}">
            @error('name')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="col-6 form-group">
            <label for="email" class="form-label">Email пользователя</label>
            <input id="email" type="email" placeholder="Email пользователя" class="form-control" name="email"
                   value="{{old('email')}}">
            @error('email')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="col-6 form-group mb-3">
            <label for="role" class="form-label">Роль пользователя</label>
            <select id="role" name="role" class="js-example-basic-single form-select">
                @foreach($roles as $role)
                    <option value="{{$role->name}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" class="btn btn-success" value="Добавить пользователя">
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
