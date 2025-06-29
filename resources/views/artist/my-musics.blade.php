@extends('layout.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 text-lightest">
    <h1 class="text-2xl font-bold mb-6">My Songs</h1>

    <table class="w-full table-auto bg-primary bg-opacity-40 rounded">
        <thead class="text-left border-b border-lightaccent">
            <tr>
                <th class="p-3">Name</th>
                <th class="p-3">Genres</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($songs as $song)
            <tr class="border-b border-gray-600">
                <td class="p-3">{{ $song->name }}</td>
                <td class="p-3">{{ $song->genres->pluck('name')->join(', ') ?: 'None' }}</td>
                <td class="p-3 flex gap-3">
                    <a href="{{ route('music.edit', $song->id) }}" class="text-blue-400 hover:text-blue-300 text-sm">Edit</a>
                    <form action="{{ route('music.delete', $song->id) }}" method="POST" onsubmit="return confirm('Delete this song?');">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-400 hover:text-red-300 text-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
