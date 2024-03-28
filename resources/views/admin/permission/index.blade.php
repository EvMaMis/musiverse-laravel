@extends('layouts.admin')

@section('main')
    <div class="h1">Разрешения ролей</div>
    <a href="{{route('admin.permission.create')}}"><div class="btn btn-success">Добавить разрешение</div></a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col" class="col-1">#</th>
            <th scope="col" class="col-3">Название</th>
            <th scope="col" class="col-5">Описание</th>
            <th scope="col" class="col-3 text-center" colspan="3">Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $key=>$permission)
        <tr class="align-middle">
            <th scope="row">{{$key+1}}</th>
            <td>{{$permission->name}}</td>
            <td>{{$permission->description}}</td>
            <td class="col-1 text-center"><a href="{{route('admin.permission.show', $permission)}}"><i class="text-primary fas fa-eye"></i></a></td>
            <td class="col-1 text-center"><a href="{{route('admin.permission.edit', $permission)}}"><i class="text-success fas fa-pen"></i></a></td>
            <td class="col-1 text-center">
                <form action="{{route('admin.permission.destroy', $permission)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn"><i class="text-danger fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
