<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'artist_id',
        'image',
        'file',
        'genre_id'

    ];
    public function tags() {
        return $this->belongsToMany(Tag::class, 'song_tag', 'song_id', 'tag_id');
    }

    public function artist() {
        return $this->hasOne(Artist::class, 'id', 'artist_id');
    }
}
