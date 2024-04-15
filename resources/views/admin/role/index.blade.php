@extends('layouts.admin')

@section('main')
    <div class="h1">{{__('User roles')}}</div>
    <a href="{{route('admin.role.create')}}"><div class="btn btn-success">{{__('Add role')}}</div></a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col" class="col-1">#</th>
            <th scope="col" class="col-4 text-center">{{__('Role title')}}</th>
            <th scope="col" class="col-2 text-center">{{__('Number of permissions')}}</th>
            <th scope="col" class="col-2 text-center">{{__('Number of users')}}</th>
            <th scope="col" class="col-3 text-center" colspan="3">{{__('Manage')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $key=>$role)
        <tr class="align-middle">
            <th scope="row">{{$key+1}}</th>
            <td class="text-center">{{$role->name}}</td>
            <td class="text-center">{{$role->permissions_count}}</td>
            <td class="text-center">{{$role->users_count}}</td>
            <td class="col-1 text-center"><a href="{{route('admin.role.show', $role)}}"><i class="text-primary fas fa-eye"></i></a></td>
            <td class="col-1 text-center"><a href="{{route('admin.role.edit', $role)}}"><i class="text-success fas fa-pen"></i></a></td>
            <td class="col-1 text-center">
                <form action="{{route('admin.role.destroy', $role)}}" method="POST">
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
