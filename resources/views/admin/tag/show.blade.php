@extends('layouts.admin')

@section('main')
    <table class="table">
        <tr>
            <th scope="col">ID</th>
            <td>{{$tag->id}}</td>
        </tr>
        <tr>
            <th scope="row">Название тега</th>
            <td>{{$tag->title}}</td>
        </tr>
    </table>
@endsection
