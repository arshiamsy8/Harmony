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
    <div class="max-w-xl mx-auto bg-primary bg-opacity-90 backdrop-blur-sm p-6 rounded-xl shadow-xl">
        <h2 class="text-2xl font-bold mb-4">Create a New Album</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('album.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block mb-1 text-lightaccent">Album Name</label>
                <input type="text" id="name" name="name" class="w-full bg-primary border border-lightaccent rounded-lg py-3 px-4 text-white input-field focus:border-lightaccent" required>
            </div>
            <button type="submit" class="w-full bg-accent text-primary py-3 rounded-full font-bold hover:bg-lightaccent transition">
                Add Album
            </button>
        </form>
    </div>
</body>
</html>
