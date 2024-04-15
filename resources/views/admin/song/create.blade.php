@extends('layouts.admin')
@section('head_meta')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('main')
    <div class="h1 mt-3">{{__('Add track')}}</div>
<form action="{{route('admin.song.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group col-6 mt-3">
        <label for="title" class="form-label">{{__('Track title')}}</label>
        <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="{{__('Title')}}">
        @error('title')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group col-6 mt-3">
        <label for="artist-select" class="form-label">{{__('Artist name')}}</label>
        <select name="artist_id" id="artist-select" class="js-example-basic-single form-control">
            @foreach($artists as $artist)
                <option value="{{$artist->id}}">{{$artist->name}}</option>
            @endforeach
        </select>
        @error('artist_id')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group col-6 mt-3">
        <label for="genre_id" class="form-label">{{__('Genre')}}</label>
        <select name="genre_id" id="genre-select" class="js-example-basic-single form-control">
            @foreach($genres as $genre)
            <option value="{{$genre->id}}">{{$genre->title}}</option>
            @endforeach
        </select>
        @error('genre_id')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="form-group col-6 mt-3">
        <label for="tags" class="form-label">{{__('Tags')}}</label>
        <select name="tags[]" id="tags" class="js-example-basic-multiple form-control" multiple="multiple">
            @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->title}}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-3 col-6">
        <label for="File" class="form-label">{{__('Cover')}}</label>
        <input class="form-control" type="file" id="File" name="cover">
        @error('cover')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="mt-3 col-6">
        <label for="formFile" class="form-label">{{__('Music file')}}</label>
        <input class="form-control" type="file" id="formFile" name="file">
        @error('file')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>

    <input type="submit" class="btn btn-success mt-2" value="{{__('Add track')}}">
</form>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection
