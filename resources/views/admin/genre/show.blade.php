@extends('layouts.admin')

@section('main')
    <table class="table">
        <tr>
            <th scope="col">ID</th>
            <td>{{$genre->id}}</td>
        </tr>
        <tr>
            <th scope="row">{{__('Genre title')}}</th>
            <td>{{$genre->title}}</td>
        </tr>
    </table>
@endsection
