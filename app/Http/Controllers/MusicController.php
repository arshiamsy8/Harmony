<?php

namespace App\Http\Controllers;
use App\Models\Music;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MusicController extends Controller
{
    public function index()
    {
        $musics = Music::all();
        $albums = \App\Models\Album::all();
        return view('main.index', compact('musics', 'albums'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('music.dashboard', compact('genres'));
    }

    public function store(Request $request)
    {
        ini_set('upload_max_filesize', '20M');
        ini_set('post_max_size', '20M');
        ini_set('memory_limit', '256M');
        ini_set('max_execution_time', '300');
        ini_set('max_input_time', '300');

        Log::info('Music upload request received', [
            'all_data' => $request->all(),
            'has_file' => $request->hasFile('media'),
            'file_info' => $request->hasFile('media') ? [
                'name' => $request->file('media')->getClientOriginalName(),
                'size' => $request->file('media')->getSize(),
                'mime' => $request->file('media')->getMimeType(),
                'extension' => $request->file('media')->getClientOriginalExtension()
            ] : null
        ]);

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'duration' => 'required|numeric',
                'genres' => 'required|array|min:1',
                'genres.*' => 'exists:genres,id'
            ]);

            if (!$request->hasFile('media')) {
                throw new \Exception('No file was uploaded');
            }

            $file = $request->file('media');
            
            $allowedTypes = ['audio/mpeg', 'audio/wav', 'audio/x-wav', 'audio/flac', 'audio/aac'];
            $mimeType = $file->getMimeType();
            
            if (!in_array($mimeType, $allowedTypes)) {
                throw new \Exception('Invalid file type. Allowed types: MP3, WAV, FLAC, AAC');
            }

            if ($file->getSize() > 20 * 1024 * 1024) { // 20MB in bytes
                throw new \Exception('File size exceeds 20MB limit');
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $path = $file->storeAs('music', $filename, [
                'disk' => 'public',
                'visibility' => 'public'
            ]);
            
            if (!$path) {
                throw new \Exception('Failed to store file');
            }

            $music = Music::create([
                'name' => $request->name,
                'duration' => $request->duration,
                'media_path' => $path
            ]);

            $music->genres()->attach($request->genres);
            

            
            if (auth('artist')->check()) {
                $music->artists()->attach(auth('artist')->user()->id);
            }

            Log::info('Music created successfully', [
                'music' => $music,
                'file_path' => $path,
                'genres' => $request->genres
            ]);

            return redirect()->route('music.dashboard')->with('success', 'Music uploaded successfully');
        } catch (\Exception $e) {
            Log::error('Error creating music', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            
            return back()->with('error', 'Failed to upload music: ' . $e->getMessage());
        }
    }

    public function list()
    {
        $musics = Music::orderBy('created_at', 'desc')->get();
        return response()->json($musics);
    }

    public function recentlyPlayed()
    {
        $musics = Music::orderBy('plays', 'desc')->take(5)->get();
        return response()->json($musics);
    }

    public function edit(Music $music)
    {
        $genres = Genre::all(); // all available genres
        $selectedGenres = $music->genres->pluck('id')->toArray(); // current ones

        return view('music.edit', compact('music', 'genres', 'selectedGenres'));
    }

    public function update(Request $request, Music $music)
    {
        $music->update([
            'name' => $request->name,
            'duration' => $request->duration,
        ]);

        $music->genres()->sync($request->genres ?? []);

        return redirect()->route('artist.musics')->with('success', 'Music updated.');
    }

    public function delete(Music $music)
    {
        $music->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function show($id)
    {
        $music = Music::with(['genres', 'artists'])->findOrFail($id);

        return view('music.show', ['musics' => $music]);
    }

    public function all()
    {
        $musics = Music::all();
        return view('music.all', compact('musics'));
    }

    public function listAll()
    {
        $musics = Music::with('genres', 'artists')->get();
        return response()->json($musics);
    }

    public function myMusics()
    {
        $artist = auth()->user(); // assumes user IS artist
        $songs = $artist->musics()->with('genres')->get();

        return view('artist.my-musics', compact('songs'));
    }
}
