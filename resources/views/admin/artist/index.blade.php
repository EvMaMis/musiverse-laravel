@extends('layouts.admin')

@section('main')
    <div class="h1">Исполнители</div>
    @canany(['Add', 'Suggest'])
        <a href="{{route('admin.artist.create')}}">
            <div class="btn btn-success">Добавить исполнителя</div>
        </a>
    @endcanany
    <table class="table">
        <thead>
        <tr>
            <th scope="col" class="col-1">#</th>
            <th scope="col" class="col-6">Исполнитель</th>
            <th scope="col" class="col-2">Количество произведений</th>
            <th scope="col" class="col-3 text-center" colspan="3">Управление</th>
        </tr>
        </thead>
        <tbody>
        @foreach($artists as $key=>$artist)
            <tr class="align-middle">
                <th scope="row">{{$key+1}}</th>
                <td>{{$artist->name}}</td>
                <td>{{random_int(1,100)}}</td>
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
