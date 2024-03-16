@extends('layouts.app')

@section('head_meta')
    <script src="https://kit.fontawesome.com/40087f1b88.js" crossorigin="anonymous"></script>
@endsection

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
