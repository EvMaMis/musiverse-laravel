<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'artists';

    protected $guarded = false;

    public function songs() {
        return $this->hasMany(Song::class);
    }

        public function subscriptions() {
        return $this->belongsToMany(User::class, 'artist_subscriptions', 'artist_id', 'user_id');
    }

    public function likes() {
        return $this->songs()->withCount('likes')->get()->sum('likes_count');
    }

    public function plays() {
        return $this->songs()->withCount('plays')->get()->sum('plays_count');
    }

}
