@extends('layouts.admin')

@section('main')
    <div class="h1">Композиции</div>
    @canany(['Add', 'Suggest'])
        <a href="{{route('admin.song.create')}}">
            <div class="btn btn-success">Добавить композицию</div>
        </a>
    @endcanany
    <table class="table">
        <thead>
        <tr>
            <th scope="col" class="col-1">#</th>
            <th scope="col" class="col-5">Название</th>
            <th scope="col" class="col-3">Исполнитель</th>
            <th scope="col" class="col-3 text-center" colspan="3">Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($songs as $key => $song)
            <tr class="align-middle">
                <th scope="row">{{$key+1}}</th>
                <td>{{$song->title}}</td>
                <td>{{$song->artist->name}}</td>
                <td class="col-1 text-center"><a href="{{route('admin.song.show', $song)}}"><i
                            class="text-primary fas fa-eye"></i></a></td>
                @can('Edit')
                    <td class="col-1 text-center"><a href="{{route('admin.song.edit', $song)}}"><i
                                class="text-success fas fa-pen"></i></a></td>
                @endcan
                @can('Delete')
                    <td class="col-1 text-center">
                        <form action="{{route('admin.song.destroy', $song)}}" method="POST">
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
