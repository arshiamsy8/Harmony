@extends('layout.app')

@section('content')
<div class="max-w-xl mx-auto p-6 text-lightest">
    <h1 class="text-2xl font-bold mb-6">Edit Music: {{ $music->name }}</h1>

    <form method="POST" action="{{ route('music.update', $music->id) }}">
        @csrf
        @method('PUT')

        <!-- Music Name -->
        <div class="mb-4">
            <label class="block mb-1">Name</label>
            <input type="text" name="name" value="{{ $music->name }}" class="w-full p-2 rounded text-primary">
        </div>

        <!-- Duration -->
        <input type="text" name="duration" value="{{ $music->duration }}" class="hidden">

        <!-- Genre (optional) -->
        <div class="mb-4">
            <label class="block mb-2">Select Genres</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach ($genres as $genre)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                            {{ in_array($genre->id, $selectedGenres) ? 'checked' : '' }}>
                        <span>{{ $genre->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit" class="bg-accent text-primary py-2 px-4 rounded hover:bg-lightaccent">
            Save Changes
        </button>
    </form>
</div>
@endsection