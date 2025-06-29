@extends('layout.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 text-lightest">
    <h1 class="text-3xl font-bold mb-6">All Albums</h1>

    @foreach($albums as $album)
        <a href="{{ route('albums.showOne', $album->id) }}" class="block bg-primary bg-opacity-30 rounded p-4 hover:bg-opacity-50 mb-4">
            <div class="flex justify-between">
                <span>{{ $album->name }}</span>
                <span class="text-sm text-gray-400">by {{ \App\Models\Artist::find($album->artist_id)->name ?? 'Unknown Artist' }}</span>
            </div>
        </a>
    @endforeach
</div>
@endsection