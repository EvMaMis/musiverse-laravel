@extends('layouts.admin')
@section('head_meta')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('main')
    <div class="h1 mt-3">Добавить композицию</div>
<form action="{{route('admin.song.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group col-6 mt-3">
        <label for="title" class="form-label">Название песни</label>
        <input type="text" class="form-control" name="title" value="{{old('title')}}">
        @error('title')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="form-group col-6 mt-3">
        <label for="artist-select" class="form-label">Исполнитель</label>
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
        <label for="genre_id" class="form-label">Жанр композиции</label>
        <select name="genre_id" id="genre-select" class="js-example-basic-single form-control">
            @foreach($genres as $genre)
            <option value="{{$genre->id}}">{{$genre->title}}</option>
            @endforeach
        </select>
        @error('genre_id')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="mt-3 col-6">
        <label for="formFile" class="form-label">Обложка</label>
        <input class="form-control" type="file" id="formFile" name="cover">
        @error('cover')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>

    <div class="mt-3 col-6">
        <label for="formFile" class="form-label">Файл композиции</label>
        <input class="form-control" type="file" id="formFile" name="file">
        @error('file')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>

    <input type="submit" class="btn btn-success" value="Добавить">
</form>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endsection
