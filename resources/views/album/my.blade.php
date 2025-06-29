@extends('layout.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 text-lightest">
    <!-- Add Album Button (Top-left corner) -->
    <div class="flex flex-col items-center">
        <h1 class="text-3xl font-bold">My Albums</h1>

        <div class="flex items-center my-6 ">
            <a href="{{ route('album.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
                Add Album
            </a>
        </div>
    </div>

    @foreach($albums as $album)
        <a href="{{ route('albums.showOne', $album->id) }}" class="block bg-accent bg-opacity-30 rounded p-4 hover:bg-opacity-50">
            <div class="flex justify-between">
                <span>{{ $album->name }}</span>
                <span class="text-sm text-gray-400">{{ $album->created_at->format('Y-m-d') }}</span>
            </div>
        </a>
        <div class="flex justify-between mb-4">
            <form action="{{ route('albums.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this album?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm text-red-400 hover:text-red-300">Delete</button>
            </form>

            <a href="{{ route('albums.edit', $album->id) }}" class="text-sm text-blue-400 hover:text-blue-300">Edit</a>
        </div>
    @endforeach
</div>
@endsection