<?php

namespace App\Service;

use App\Models\Song;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SongService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();
            $data['image'] = Storage::disk('public')->put('/covers', $data['cover']);
            $data['file'] = Storage::disk('public')->put('/music', $data['file']);
            if (isset($data['tags'])) {
                $tags = $data['tags'];
                unset($data['tags']);
            }
            $song = Song::create($data);
            if (isset($tags))
                $song->tags()->attach($tags);

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
