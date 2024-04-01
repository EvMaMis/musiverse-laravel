@extends('layouts.app')
@section('content')
    @yield('header')
    <div class="row" style="margin: 0;">
        @yield('sidebar')
        <div class="col">
            @yield('main')
        </div>
    </div>
    @yield('footer')
@endsection
