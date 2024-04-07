@extends('layouts.main')
@section('head_meta')
    <title>Я лох</title>
@endsection
@section('navbar')
    <ul class="d-flex">
        <li class="nav-item">
            <a class="nav-link" href="{{route('main.index')}}">Главная</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('main.top')}}">Популярное</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('personal.playlist.index')}}">Мои плейлисты</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('personal.recommendation.index')}}">Рекомендации</a>
        </li>
    </ul>
@endsection

@section('main')
    <div class="container">
        <div>21312312</div>
    </div>
@endsection

@section('sidebar')
    @include('includes.sidebar')
@endsection
