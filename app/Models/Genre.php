<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $fillable = ['name'];

    public function musics(): BelongsToMany
    {
        return $this->belongsToMany(Music::class, 'genre_music')
            ->withTimestamps();
    }
}
