@extends('layouts.admin')

@section('main')
    <div class="h1">{{$user->name}}</div>
    <table class="table">
        <tr>
            <th scope="col">ID</th>
            <td>{{$user->id}}</td>
        </tr>
        <tr>
            <th scope="row">Имя пользователя</th>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <th scope="row">Почта</th>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <th scope="row">Роль</th>
            <td>{{$user->getRoleNames()->first()}}</td>
        </tr>
    </table>
@endsection
