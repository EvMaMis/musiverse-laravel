@extends('layouts.admin')
@section('head_meta')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('main')
    <form action="{{route('admin.role.update', $role)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="col-4">
            <label for="name" class="form-check-label mb-2">Название роли</label>
            <input id="name" type="text" placeholder="Роль..." class="form-control mb-3" name="name"
                   value="{{$role->name}}">
            @error('name')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="col-4">
            <label for="permissions">Разрешения</label>
            <select id="permissions" name="permissions[]" multiple="multiple" class="js-example-basic-multiple form-control">
                @foreach($permissions as $permission)
                    <option {{in_array($permission->id, $role->permissions()->pluck('id')->all()) ? 'selected' : ''}} value="{{$permission->name}}" title="{{$permission->description}}">{{$permission->name}}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="id" value="{{$role->id}}">
        <input type="submit" class="btn btn-success" value="Обновить роль">
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
