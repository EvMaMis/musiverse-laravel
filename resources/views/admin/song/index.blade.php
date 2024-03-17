@extends('layouts.admin')

@section('main')
    <div class="h1">Композиции</div>
    <a href="{{route('admin.genre.create')}}"><div class="btn btn-success">Добавить жанр</div></a>
    <table class="table">

    </table>
@endsection
