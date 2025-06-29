<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
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

<body class="bg-primary text-lightest min-h-screen p-6">
    <div class="max-w-2xl mx-auto bg-primary bg-opacity-90 backdrop-blur-sm p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-4">{{ $musics->name }}</h1>
        <p class="mb-2"><strong>Duration:</strong> {{ $musics->duration }}</p>
        <p class="mb-2"><strong>Created At:</strong> {{ $musics->created_at->format('F j, Y') }}</p>
        <p class="mb-2"><strong>Genres:</strong>
            @foreach($musics->genres as $genre)
                {{ $genre->name }}
            @endforeach
        </p>
        <p class="mb-2"><strong>Artists:</strong>
            @foreach($musics->artists as $artist)
                {{ $artist->name }}
            @endforeach
        </p>

        <a href="{{ url()->previous() }}" class="inline-block mt-6 text-lightaccent hover:text-lightest font-medium">
            Back
        </a>
    </div>
</body>
</html>
