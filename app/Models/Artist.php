<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Artist extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get all the music associated with this artist.
     */
    public function musics(): BelongsToMany
    {
        return $this->belongsToMany(Music::class, 'artist_music')
            ->withTimestamps();
    }
}
