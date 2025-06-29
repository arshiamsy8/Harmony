@extends('layout.app')

@section('content')
<div class="max-w-xl mx-auto p-6 text-lightest">
    <h1 class="text-2xl font-bold mb-4">Edit Album</h1>

    <form method="POST" action="{{ route('albums.update', $album->id) }}">
        @csrf
        @method('PUT')

        <!-- Album name -->
        <div class="mb-4">
            <label class="block mb-2">Album Name:</label>
            <input type="text" name="name" value="{{ $album->name }}" class="w-full p-2 rounded text-primary">
        </div>

        <!-- Song selection -->
        <div class="mb-4">
            <label class="block mb-2">Select Songs:</label>
            @forelse($songs as $song)
                <div class="flex items-center mb-2">
                    <input type="checkbox" name="musics[]" value="{{ $song->id }}"
                        {{ in_array($song->id, $selected) ? 'checked' : '' }}>
                    <span class="ml-2">{{ $song->name }}</span>
                </div>
            @empty
                <p class="text-gray-400">You have no songs to add.</p>
            @endforelse
        </div>

        <button type="submit" class="bg-accent text-primary py-2 px-4 rounded hover:bg-lightaccent">
            Update Album
        </button>
    </form>
</div>
@endsection