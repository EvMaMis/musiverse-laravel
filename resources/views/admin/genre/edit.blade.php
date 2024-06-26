@extends('layouts.admin')

@section('main')
    <form action="{{route('admin.genre.update', $genre)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-4">
                <label for="title" class="form-check-label mb-2">{{__('Genre title')}}</label>
                <input id="title" type="text" placeholder="{{__('Title')}}" class="form-control mb-3" name="title" value="{{$genre->title}}">
                @error('title')
                <div class="text-danger">{{$message}}</div>
                @enderror
                <input type="hidden" name="id" value="{{$genre->id}}">
            </div>
        </div>
        <input type="submit" class="btn btn-success" value="{{__('Update genre')}}">
    </form>
@endsection
