@extends('layouts.admin')

@section('main')
    <div class="h1">{{$user->name}}</div>
    <table class="table">
        <tr>
            <th scope="col">ID</th>
            <td>{{$user->id}}</td>
        </tr>
        <tr>
            <th scope="row">{{__('Username')}}</th>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <th scope="row">{{__('Email')}}</th>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <th scope="row">{{__('Roles')}}</th>
            <td>{{$user->getRoleNames()->first()}}</td>
        </tr>
    </table>
@endsection
