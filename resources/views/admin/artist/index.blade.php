@extends('layouts.admin')

@section('main')
    <div class="h1">{{__('Artists')}}</div>
    @canany(['Add', 'Suggest'])
        <a href="{{route('admin.artist.create')}}">
            <div class="btn btn-success">{{__('Add artist')}}</div>
        </a>
    @endcanany
    <table class="table">
        <thead>
        <tr>
            <th scope="col" class="col-1">#</th>
            <th scope="col" class="col-6">{{__('Artist')}}</th>
            <th scope="col" class="col-2">{{__('Number of tracks')}}</th>
            <th scope="col" class="col-3 text-center" colspan="3">{{__('Manage')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($artists as $key=>$artist)
            <tr class="align-middle">
                <th scope="row">{{$key+1}}</th>
                <td>{{$artist->name}}</td>
                <td>{{$artist->songs_count}}</td>
                <td class="col-1 text-center"><a href="{{route('admin.artist.show', $artist)}}"><i
                            class="text-primary fas fa-eye"></i></a></td>
                @can('Edit')
                    <td class="col-1 text-center"><a href="{{route('admin.artist.edit', $artist)}}"><i
                                class="text-success fas fa-pen"></i></a></td>
                @endcan
                @can('Delete')
                    <td class="col-1 text-center">
                        <form action="{{route('admin.artist.destroy', $artist)}}" method="POST">
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
