<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model\hasMany;

class Album extends Model
{
    protected static function booted()
    {
        static::deleting(function ($album) {
            $album->musics()->detach();
        });
    }
    
    protected $fillable = [
        'name',
        'artist_id'
    ];

    public function musics()
    {
        return $this->belongsToMany(Music::class, 'album_music');
    }
}
