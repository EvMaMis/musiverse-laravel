@extends('layouts.admin')

@section('main')
    <form action="{{route('admin.tag.update', $tag)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-4">
                <label for="title" class="form-check-label mb-2">Введите название тега</label>
                <input id="title" type="text" placeholder="Название тега" class="form-control mb-3" name="title"
                       value="{{$tag->title}}">
                @error('title')
                <div class="text-danger">{{$message}}</div>
                @enderror
                <input type="hidden" name="id" value{{$tag->id}}">
            </div>
        </div>
        <input type="submit" class="btn btn-success" value="Обновить тег">
    </form>
@endsection
