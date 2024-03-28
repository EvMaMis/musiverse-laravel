@extends('layouts.admin')

@section('main')
    <div class="h1">Пользователи</div>
    <a href="{{route('admin.user.create')}}"><div class="btn btn-success">Добавить пользователя</div></a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col" class="col-1">#</th>
            <th scope="col" class="col-3">Имя</th>
            <th scope="col" class="col-3">Email</th>
            <th scope="col" class="col-2">Роль</th>
            <th scope="col" class="col-3 text-center" colspan="3">Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key=>$user)
        <tr class="align-middle">
            <th scope="row">{{$key+1}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>Пользователь</td>
            <td class="col-1 text-center"><a href="{{route('admin.user.show', $user)}}"><i class="text-primary fas fa-eye"></i></a></td>
            <td class="col-1 text-center"><a href="{{route('admin.user.edit', $user)}}"><i class="text-success fas fa-pen"></i></a></td>
            <td class="col-1 text-center">
                <form action="{{route('admin.user.destroy', $user)}}" method="POST">
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
