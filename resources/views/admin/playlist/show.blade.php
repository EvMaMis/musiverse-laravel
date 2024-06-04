@extends('layouts.admin')

@section('main')
    <table class="table">
        <tr>
            <th scope="row">ID</th>
            <td>{{$song->id}}</td>
        </tr>
        <tr>
            <th scope="row">{{__('Title')}}</th>
            <td>{{$song->title}}</td>
        </tr>
        <tr>
            <th scope="row">{{__('Artist')}}</th>
            <td>{{$song->artist->name}}</td>
        </tr>
        <tr>
            <th scope="row">{{__('Music file')}}</th>
            <td><audio controls src="{{asset('storage/' . $song->file)}}"></audio></td>
        </tr>
    </table>
@endsection
