<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Artist;
use App\Models\Music;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'artists' => Artist::count(),
            'songs' => Music::count(),
            'albums' => Album::count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentArtists = Artist::latest()->take(5)->get();
        $recentSongs = Music::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentArtists', 'recentSongs'));
    }

    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function artists()
    {
        $artists = Artist::latest()->paginate(15);
        return view('admin.artists', compact('artists'));
    }

    public function songs()
    {
        $songs = Music::with(['artists', 'genres'])->latest()->paginate(15);
        return view('admin.songs', compact('songs'));
    }

    public function albums()
    {
        $albums = Album::with(['musics', 'artist'])->latest()->paginate(15);
        return view('admin.albums', compact('albums'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }

    public function deleteArtist(Artist $artist)
    {
        $artist->delete();
        return redirect()->route('admin.artists')->with('success', 'Artist deleted successfully');
    }

    public function deleteSong(Music $music)
    {
        $music->delete();
        return redirect()->route('admin.songs')->with('success', 'Song deleted successfully');
    }

    public function deleteAlbum(Album $album)
    {
        $album->delete();
        return redirect()->route('admin.albums')->with('success', 'Album deleted successfully');
    }
} 