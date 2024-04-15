@extends('layouts.admin')

@section('head_meta')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endsection

@section('main')
    <form action="{{route('admin.artist.update', $artist)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-4">
                <label for="name" class="form-check-label mb-2">{{__('Artist name')}}</label>
                <input id="name" type="text" placeholder="{{__('Name')}}" class="form-control mb-3" name="name"
                       value="{{$artist->name}}">
                @error('name')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="col-10">
                <label for="summernote" class="form-check-label mb-2">{{__('Biography')}}</label>
                <textarea class="summernote" id="summernote" type="text" placeholder="{{__('Description')}}"
                          name="description">{{$artist->description}}</textarea>
                @error('description')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            <input type="hidden" name="id" value="{{$artist->id}}">

        </div>
        <input type="submit" class="btn btn-success" value="{{__('Update artist')}}">
    </form>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#summernote').summernote()
            $('.dropdown-toggle').dropdown()
        });
    </script>
@endsection
