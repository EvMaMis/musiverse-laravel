@extends('layouts.admin')

@section('main')
    <table class="table">
        <tr>
            <th scope="row">ID</th>
            <td>{{$song->id}}</td>
        </tr>
        <tr>
            <th scope="row">Название песни</th>
            <td>{{$song->title}}</td>
        </tr>
        <tr>
            <th scope="row">Исполнитель</th>
            <td>{{$song->artist->name}}</td>
        </tr>
    </table>
@endsection
