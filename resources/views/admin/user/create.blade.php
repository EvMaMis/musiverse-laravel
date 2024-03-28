@extends('layouts.admin')

@section('main')
    <form action="{{route('admin.user.store')}}" method="POST">
        @csrf
        <div class="col-6 form-group">
            <label for="name" class="form-label">Имя пользователя</label>
            <input id="name" type="text" placeholder="Имя пользователя" class="form-control" name="name"
                   value="{{old('name')}}">
            @error('name')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="col-6 form-group">
            <label for="email" class="form-label">Email пользователя</label>
            <input id="email" type="email" placeholder="Email пользователя" class="form-control" name="email"
                   value="{{old('email')}}">
        </div>
        <input type="submit" class="btn btn-success" value="Добавить пользователя">
    </form>
@endsection
