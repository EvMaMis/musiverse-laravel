@extends('layouts.app')


@section('content')
    <div class="row flex-nowrap">
        @include('admin.includes.sidebar')
        <div class="col">
            @yield('main')
        </div>
    </div>
@endsection
