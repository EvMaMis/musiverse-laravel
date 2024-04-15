@extends('layouts.admin')

@section('main')
    <table class="table">
        <tr>
            <th scope="row">ID</th>
            <td>{{$artist->id}}</td>
        </tr>
        <tr>
            <th scope="row">{{__('Artist name')}}</th>
            <td>{{$artist->name}}</td>
        </tr>
        <tr>
            <th scope="row">{{__('Description')}}</th>
            <td>{!! $artist->description !!}</td>
        </tr>
    </table>
@endsection
