@extends('layouts.admin')
@section('head_meta')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('main')
    <div class="h1 mt-3">{{__('Add playlist')}}</div>
<form action="{{route('admin.playlist.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group col-6 mt-3">
        <label for="title" class="form-label">{{__('Playlist title')}}</label>
        <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="{{__('Title')}}">
        @error('title')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="mt-3 col-6">
        <label for="File" class="form-label">{{__('Cover')}}</label>
        <input class="form-control" type="file" id="File" name="cover">
        @error('cover')
        <div class="text-danger">{{$message}}</div>
        @enderror
    </div>
    <div class="playlist-manager">
        <div class="songs-list" id="songs-list">
            <h2>All Songs</h2>
            @foreach($songs as $song)
                <div class="song-item" draggable="true" data-id="{{ $song->id }}">
                    {{ $song->title }}
                </div>
            @endforeach
        </div>
        <div class="playlist" id="playlist">
            <h2>Playlist</h2>
        </div>
    </div>
    <input type="hidden" name="playlist_songs" id="playlist_songs">
    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
    <input type="submit" class="btn btn-success mt-2" value="{{__('Add playlist')}}">
</form>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $('.js-example-basic-multiple').select2();
    });
</script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const songsList = document.getElementById('songs-list');
            const playlist = document.getElementById('playlist');
            const playlistSongsInput = document.getElementById('playlist_songs');
            let draggedElement = null;

            songsList.addEventListener('dragstart', handleDragStart);
            playlist.addEventListener('dragstart', handleDragStart);
            playlist.addEventListener('dragover', handleDragOver);
            playlist.addEventListener('drop', handleDrop);
            playlist.addEventListener('dragend', handleDragEnd);

            function handleDragStart(e) {
                draggedElement = e.target;
                e.dataTransfer.setData('text/plain', e.target.dataset.id);
                e.dataTransfer.effectAllowed = 'move';
            }

            function handleDragOver(e) {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'move';
            }

            function handleDrop(e) {
                e.preventDefault();
                const songId = e.dataTransfer.getData('text/plain');
                const songElement = document.querySelector(`.song-item[data-id='${songId}']`);
                if (songElement && !playlist.contains(songElement)) {
                    const clonedElement = songElement.cloneNode(true);
                    playlist.appendChild(clonedElement);
                    clonedElement.addEventListener('dragstart', handleDragStart);
                    updatePlaylistInput();
                }
            }

            function handleDragEnd(e) {
                if (!isInsidePlaylist(e.clientX, e.clientY) && playlist.contains(draggedElement)) {
                    playlist.removeChild(draggedElement);
                    updatePlaylistInput();
                }
                draggedElement = null;
            }

            function isInsidePlaylist(x, y) {
                const rect = playlist.getBoundingClientRect();
                return x >= rect.left && x <= rect.right && y >= rect.top && y <= rect.bottom;
            }

            function updatePlaylistInput() {
                const songElements = playlist.querySelectorAll('.song-item');
                const songIds = Array.from(songElements).map(el => el.dataset.id);
                playlistSongsInput.value = songIds.join(',');
            }
        });

    </script>
@endsection
