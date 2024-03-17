@extends('layouts.app')


@section('content')
    <div class="row vw-100">
        <div class="col-3" style="height: 95vh">
            @include('admin.includes.sidebar')
        </div>
        <div class="col-9">
            @yield('main')
        </div>
    </div>

    <div class="footer">
        @yield('footer')
    </div>
@endsection
