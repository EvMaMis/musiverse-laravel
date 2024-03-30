@extends('layouts.app')


@section('content')
    <div class="row" style="margin: 0;">
        @include('admin.includes.sidebar')
        <div class="col">
            @yield('main')
        </div>
    </div>
@endsection
