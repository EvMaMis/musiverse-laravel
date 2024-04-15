@extends('layouts.admin')

@section('main')
    <form action="{{route('admin.genre.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-4">
                <label for="title" class="form-check-label mb-2">{{__('Genre title')}}</label>
                <input id="title" type="text" placeholder="{{__('Title')}}" class="form-control mb-3" name="title" value="{{old('title')}}">
                @error('title')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <input type="submit" class="btn btn-success" value="{{__('Add genre')}}">
    </form>
@endsection
