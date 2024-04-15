@extends('layouts.admin')

@section('main')
    <table class="table">
        <tr>
            <th scope="row">ID</th>
            <td>{{$role->id}}</td>
        </tr>
        <tr>
            <th scope="row">{{__('Role title')}}</th>
            <td>{{$role->name}}</td>
        </tr>
        <tr>
            <th scope="row">{{__('Role permissions')}}</th>
            <td>
                <ul class="list-unstyled list-group">
                    @foreach($role->permissions as $permission)
                        <li class="list-group-item w-50" title="{{__($permission->description)}}">{{__($permission->name)}}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        @if(count($users) > 0)
            <tr>
                <th scope="row">{{__('Users')}}</th>
                <td>
                    <ul class="list-unstyled list-group">
                        @foreach($users as $user)
                            <li class="list-group-item w-50">{{$user->name}}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endif
    </table>
@endsection
