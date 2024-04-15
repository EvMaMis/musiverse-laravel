@extends('layouts.admin')

@section('main')
    <div class="h1">{{__('Music genres')}}</div>
    @canany(['Add', 'Suggest'])
        <a href="{{route('admin.genre.create')}}">
            <div class="btn btn-success">{{__('Add genre')}}</div>
        </a>
    @endcanany
    <table class="table">
        <thead>
        <tr>
            <th scope="col" class="col-1">#</th>
            <th scope="col" class="col-6 ">{{__('Genre')}}</th>
            <th scope="col" class="col-2 text-center">{{__('Number of tracks')}}</th>
            <th scope="col" class="col-3 text-center" colspan="3">{{__('Manage')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($genres as $key=>$genre)
            <tr class="align-middle">
                <th scope="row">{{$key+1}}</th>
                <td class="">{{$genre->title}}</td>
                <td class="text-center">{{$genre->songs_count}}</td>
                <td class="col-1 text-center"><a href="{{route('admin.genre.show', $genre)}}"><i
                            class="text-primary fas fa-eye"></i></a></td>
                @can('Edit')
                    <td class="col-1 text-center"><a href="{{route('admin.genre.edit', $genre)}}"><i
                                class="text-success fas fa-pen"></i></a></td>
                @endcan
                @can('Delete')
                    <td class="col-1 text-center">
                        <form action="{{route('admin.genre.destroy', $genre)}}" method="POST">
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
