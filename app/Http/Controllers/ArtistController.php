<?php

namespace App\Http\Controllers;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::all();
        return view('artists.index', compact('artists'));
    }

    public function create()
    {
        return view('artist.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:artists',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $artist = Artist::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('main.login')->with('success', 'Artist account created successfully. Please login.');
    }
}
