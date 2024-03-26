@extends('layouts.admin')
@section('head_meta')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('main')
    <div class="h1 mt-3">Добавить композицию</div>
<form action="{{route('admin.song.store')}}" method="POST">
    <div class="form-group col-6 mt-3">
        <label for="title" class="form-label">Название песни</label>
        <input type="text" class="form-control" name="title" value="{{old('title')}}">
    </div>

    <input type="submit" class="btn btn-success" value="Добавить">
</form>
@endsection
