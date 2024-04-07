@extends('layouts.app')
@section('content')
    @yield('header')
    <div class="row" style="margin: 0;">
        @yield('sidebar')
        <div class="col" style="padding: 0;">
            @yield('main')
        </div>
    </div>
    @yield('footer')
@endsection
