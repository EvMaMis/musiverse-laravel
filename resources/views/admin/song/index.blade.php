@extends('layouts.admin')

@section('main')
    <div class="h1">Композиции</div>
    <a href="{{route('admin.song.create')}}"><div class="btn btn-success">Добавить композицию</div></a>
    <table class="table">

    </table>
@endsection
