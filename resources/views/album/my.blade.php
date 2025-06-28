@extends('layout.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 text-lightest">
    <h1 class="text-3xl font-bold mb-6">My Albums</h1>

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