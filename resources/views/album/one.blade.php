@extends('layout.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 text-lightest">
    <h1 class="text-3xl font-bold mb-4">Album: {{ $album->name }}</h1>

    @forelse($songs as $song)
        <div class="p-4 mb-3 bg-secondary bg-opacity-30 rounded">
            <div class="flex justify-between">
                <span>{{ $song->name }}</span>
                <span class="text-sm text-gray-300">{{ $song->duration }}</span>
            </div>
            <div class="text-sm text-gray-400">
                Genres: {{ $song->genres->pluck('name')->join(', ') }}
            </div>
        </div>
    @empty
        <p>No songs in this album.</p>
    @endforelse
</div>
@endsection