@extends('layouts.admin')

@section('main')
    <table class="table">
        <tr>
            <th scope="row">ID</th>
            <td>{{$artist->id}}</td>
        </tr>
        <tr>
            <th scope="row">Имя исполнителя</th>
            <td>{{$artist->name}}</td>
        </tr>
        <tr>
            <th scope="row">Описание</th>
            <td>{!! $artist->description !!}</td>
        </tr>
    </table>
@endsection
