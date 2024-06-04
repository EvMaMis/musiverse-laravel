<?php

namespace App\Service;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PlaylistService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();
            $data['image'] = Storage::disk('public')->put('/covers', $data['cover']);
            unset($data['cover']);
            $data['playlist_songs'] = explode(',', $data['playlist_songs']);
            if (isset($data['playlist_songs'])) {
                $songs = $data['playlist_songs'];
                unset($data['playlist_songs']);
            }
            $playlist = Playlist::create($data);
            if (isset($songs))
                $playlist->songs()->attach($songs);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception);
        }
    }

    public function update(Song $song, $data)
    {
        try {
            DB::beginTransaction();
            if (isset($data['cover'])) {
                Storage::disk('public')->delete($song->image);
                $data['image'] = Storage::disk('public')->put('/covers', $data['cover']);
            }
            if (isset($data['file'])) {
                Storage::disk('public')->delete($song->file);
                $data['file'] = Storage::disk('public')->put('/music', $data['file']);
            }
            if (isset($data['tags'])) {
                $tagIds = $data['tags'];
                unset($data['tags']);
            }
            $song->update($data);
            isset($tagIds) ? $song->tags()->sync($tagIds) : $song->tags()->detach();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception);
        }
    }
}
