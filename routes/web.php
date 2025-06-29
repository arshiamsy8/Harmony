<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\AlbumController;

// Publicly accessible routes
Route::get('/', function () {
    return view('main/landing');
})->name('main.landing');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('main.login');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/signup', [UserController::class, 'showRegistrationForm'])->name('main.signup');
Route::post('/signup', [UserController::class, 'register'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/music/all', [MusicController::class, 'all'])->name('music.all');
Route::get('/music/list', [MusicController::class, 'listAll']);

// User-only route
Route::middleware(['auth:web'])->group(function () {
    Route::get('/index', [MusicController::class, 'index'])->name('main.index');
});

// Artist-only routes
Route::get('/artist/create', [ArtistController::class, 'create'])->name('artist.create');
Route::post('/artist/store', [ArtistController::class, 'store'])->name('artist.store');

Route::middleware(['auth:artist'])->group(function () {
    Route::get('/artist/index', [MusicController::class, 'create'])->name('artist.index');

    Route::get('/music/create', [MusicController::class, 'create'])->name('music.create');
    Route::post('/music/store', [MusicController::class, 'store'])->name('music.store');
    Route::get('/music/list', [MusicController::class, 'list'])->name('music.list');
    Route::get('/stream/{filename}', [StreamController::class, 'stream'])->name('stream');
    Route::get('/music/recently-played', [MusicController::class, 'recentlyPlayed'])->name('music.recentlyPlayed');
    Route::get('/music/edit/{music}', [MusicController::class, 'edit'])->name('music.edit');
    Route::put('/music/update/{music}', [MusicController::class, 'update'])->name('music.update');
    Route::delete('/music/delete/{music}', [MusicController::class, 'delete'])->name('music.delete');
    Route::get('/music/{music}', [MusicController::class, 'show'])->name('music.show');
    Route::get('artist/my-musics', [MusicController::class, 'myMusics'])->name('artist.musics');

    Route::get('/albums/{album}/select-songs', [AlbumController::class, 'selectSongs'])->name('album.selectSongs');
    Route::post('/albums/{album}/attach-songs', [AlbumController::class, 'attachSongs'])->name('album.attachSongs');
    Route::get('/albums/create', [AlbumController::class, 'create'])->name('album.create');
    Route::post('/albums/store', [AlbumController::class, 'store'])->name('album.store');
    Route::get('/myalbums', [AlbumController::class, 'show'])->name('albums.show');
    Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
    Route::put('/albums/{album}', [AlbumController::class, 'update'])->name('albums.update');
    Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])->name('albums.destroy');
});

// Public: Every album from every artist
Route::get('/albums', [AlbumController::class, 'showAll'])->name('albums.showAll');
Route::get('/albums/{album}', [AlbumController::class, 'showOne'])->name('albums.showOne');

// Admin Routes (completely separate)
Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.post');
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
        
        // User Management
        Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
        Route::delete('/users/{user}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.users.delete');
        
        // Artist Management
        Route::get('/artists', [App\Http\Controllers\AdminController::class, 'artists'])->name('admin.artists');
        Route::delete('/artists/{artist}', [App\Http\Controllers\AdminController::class, 'deleteArtist'])->name('admin.artists.delete');
        
        // Music Management
        Route::get('/songs', [App\Http\Controllers\AdminController::class, 'songs'])->name('admin.songs');
        Route::delete('/songs/{music}', [App\Http\Controllers\AdminController::class, 'deleteSong'])->name('admin.songs.delete');
        
        // Album Management
        Route::get('/albums', [App\Http\Controllers\AdminController::class, 'albums'])->name('admin.albums');
        Route::delete('/albums/{album}', [App\Http\Controllers\AdminController::class, 'deleteAlbum'])->name('admin.albums.delete');
    });
});
