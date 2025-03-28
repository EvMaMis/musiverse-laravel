<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\SendVerifyWithQueueNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new SendVerifyWithQueueNotification());
    }

    public function hasAnyAdminPermissions()
    {
        return count($this->getAllPermissions()) > 0;
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function likedSongs()
    {
        return $this
            ->belongsToMany(Song::class, 'likes', 'user_id', 'song_id')
            ->withTimestamps()
            ->withPivot('created_at')
            ->orderByPivot('likes.created_at', 'desc');
    }

    public function listenedSongs()
    {
        return $this
            ->belongsToMany(Song::class, 'songs_listened', 'user_id', 'song_id')
            ->withTimestamps()
            ->withPivot('created_at')
            ->orderByPivot('songs_listened.created_at', 'desc');
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Artist::class, 'artist_subscriptions', 'user_id', 'artist_id');
    }
}
