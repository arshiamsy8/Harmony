<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Music extends Model
{
    protected $table = 'musics';
    
    protected $fillable = [
        'name',
        'duration',
        'media_path',
        'plays'
    ];

    /**
     * Get all the artists associated with this music.
     */
    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class, 'artist_music')
            ->withTimestamps();
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_music')
            ->withTimestamps();
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_music');
    }
}
