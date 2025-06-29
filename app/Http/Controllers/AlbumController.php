<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Music;
use App\Models\User;

class AlbumController extends Controller
{
    public function create()
    {
        return view('album.create');
    }

    public function store(Request $request)
    {
        $name = $request->name;

        $album = new Album();
        $album->name = $name;
        $album->artist_id = auth('artist')->user()->id;
        $album->save();

        return redirect()->route('album.selectSongs', $album->id);
    }

    public function selectSongs(Album $album)
    {
        $artist = auth('artist')->user();
        $songs = $artist->musics ?? collect();
        return view('album.select-songs', compact('album', 'songs'));
    }

    public function attachSongs(Request $request, Album $album)
    {
        $songIds = $request->input('song_ids', []);

        $album->musics()->sync($songIds);

        $id = auth('artist')->user()->id;

        return redirect()->route('albums.show', $id)->with('success', 'Songs added to the album!');
    }

    public function showAll()
    {
        $albums = Album::all();
        return view('album.all', compact('albums'));
    }

    public function showOne(Album $album)
    {
        $songs = $album->musics()->with('genres')->get();
        return view('album.one', compact('album', 'songs'));
    }

    public function show()
    {
        $albums = Album::where('artist_id', auth('artist')->user()->id)->get();
        return view('album.my', compact('albums'));
    }

    public function edit(Album $album)
    {
        $songs = auth('artist')->user()->musics()->get();

        $selected = $album->musics()->pluck('music_id')->toArray();
        return view('album.edit', compact('album', 'songs', 'selected'));
    }

    public function update(Request $request, Album $album)
    {
        $album->name = $request->name;
        $album->save();

        $album->musics()->sync($request->musics ?? []);

        $id = auth('artist')->user()->id;
        return redirect()->route('albums.show', $id)->with('success', 'Album updated');
    }

    public function destroy(Album $album)
    {
        $album->delete();

        $id = auth('artist')->user()->id;
        return redirect()->route('albums.show', $id)->with('success', 'Album deleted.');
    }
}
