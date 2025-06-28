<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Harmony</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#22577A',
                        secondary: '#38A3A5',
                        accent: '#57CC99',
                        lightaccent: '#80ED99',
                        lightest: '#C7F9CC',
                    }
                }
            }
        };
    </script>
</head>
{{auth('artist')->user()->id}}
<body class="bg-primary text-lightest min-h-screen p-6">
    <div class="max-w-3xl mx-auto bg-primary bg-opacity-90 p-6 rounded-xl shadow-xl">
        <h1 class="text-3xl font-bold mb-6">Select Songs for Album: {{ $album->name }}</h1>

        <form action="{{ route('album.attachSongs', $album->id) }}" method="POST">
            @csrf
            <div class="space-y-4 max-h-96 overflow-y-auto">
                @foreach($songs as $song)
                    <label class="block p-4 rounded bg-secondary bg-opacity-20 cursor-pointer hover:bg-opacity-40">
                        <input type="checkbox" name="song_ids[]" value="{{ $song->id }}" class="mr-3">
                        <span class="text-lg font-medium">{{ $song->name }}</span>
                        <span class="text-sm text-lightaccent ml-2">({{ $song->duration }})</span>
                    </label>
                @endforeach
            </div>

            <button type="submit" class="mt-6 w-full bg-accent text-primary py-3 rounded-full font-bold hover:bg-lightaccent transition">
                Add Selected Songs
            </button>
        </form>
    </div>
</body>
</html>
