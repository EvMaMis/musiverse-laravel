@extends('layouts.app')
@section('content')
    <div id="app">
    <div class="row" style="margin: 0;">
        @yield('sidebar')
        <div class="col" style="padding: 0;">
            @yield('main')
        </div>
    </div>
    </div>
@endsection
