@extends('layouts.admin')
@section('head_meta')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection


@section('main')
    <form action="{{route('admin.user.update', $user)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="col-6 form-group">
            <label for="name" class="form-label">{{__('Username')}}</label>
            <input id="name" type="text" placeholder="{{__('Username')}}" class="form-control" name="name"
                   value="{{$user->name}}">
            @error('name')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="col-6 form-group">
            <label for="email" class="form-label">{{__('Email')}}</label>
            <input id="email" type="email" placeholder="{{__('Email')}}" class="form-control" name="email"
                   value="{{$user->email}}">
            @error('email')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="col-6 form-group mb-3">
            <label for="role" class="form-label">{{__('Role')}}</label>
            <select id="role" name="role" class="js-example-basic-single form-select">
                @foreach($roles as $role)
                    <option value="{{$role->name}}" {{$role->name === $user->getRoleNames()->first() ? 'selected' : ''}}>{{$role->name}}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="id" value="{{$user->id}}">
        <input type="submit" class="btn btn-success" value="{{__('Update user')}}">
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
