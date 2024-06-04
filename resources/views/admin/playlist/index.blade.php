@extends('layouts.admin')

@section('main')
    <div class="h1">{{__('Playlists')}}</div>
    @canany(['Add', 'Suggest'])
        <a href="{{route('admin.playlist.create')}}">
            <div class="btn btn-success">{{__('Add playlist')}}</div>
        </a>
    @endcanany
    <table class="table">
        <thead>
        <tr>
            <th scope="col" class="col-1">#</th>
            <th scope="col" class="col-5">{{__('Title')}}</th>
            <th scope="col" class="col-3">{{__('# of songs')}}</th>
            <th scope="col" class="col-3 text-center" colspan="3">{{__('Manage')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($playlists as $key => $playlist)
            <tr class="align-middle">
                <th scope="row">{{$key+1}}</th>
                <td>{{$playlist->title}}</td>
                <td>{{count($playlist->songs)}}</td>
                <td class="col-1 text-center"><a href="{{route('admin.playlist.show', $playlist)}}"><i
                            class="text-primary fas fa-eye"></i></a></td>
                @can('Edit')
                    <td class="col-1 text-center"><a href="{{route('admin.playlist.edit', $playlist)}}"><i
                                class="text-success fas fa-pen"></i></a></td>
                @endcan
                @can('Delete')
                    <td class="col-1 text-center">
                        <form action="{{route('admin.playlist.destroy', $playlist)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn"><i class="text-danger fas fa-trash"></i></button>
                        </form>
                    </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
