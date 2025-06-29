<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Harmony</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
        }
    </script>
</head>
<body class="bg-gradient-to-br from-primary to-secondary min-h-screen text-white">
    <div class="container mx-auto py-10 px-4">
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-3xl font-bold flex items-center">
                <i class="fas fa-shield-alt mr-3"></i> Admin Dashboard
            </h1>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-semibold">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </form>
        </div>
        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-primary rounded-lg p-6 shadow flex flex-col items-center">
                <i class="fas fa-users fa-2x mb-2 text-lightaccent"></i>
                <div class="text-2xl font-bold">{{ $stats['users'] }}</div>
                <div class="text-lightaccent">Users</div>
            </div>
            <div class="bg-primary rounded-lg p-6 shadow flex flex-col items-center">
                <i class="fas fa-microphone-alt fa-2x mb-2 text-lightaccent"></i>
                <div class="text-2xl font-bold">{{ $stats['artists'] }}</div>
                <div class="text-lightaccent">Artists</div>
            </div>
            <div class="bg-primary rounded-lg p-6 shadow flex flex-col items-center">
                <i class="fas fa-music fa-2x mb-2 text-lightaccent"></i>
                <div class="text-2xl font-bold">{{ $stats['songs'] }}</div>
                <div class="text-lightaccent">Songs</div>
            </div>
            <div class="bg-primary rounded-lg p-6 shadow flex flex-col items-center">
                <i class="fas fa-compact-disc fa-2x mb-2 text-lightaccent"></i>
                <div class="text-2xl font-bold">{{ $stats['albums'] }}</div>
                <div class="text-lightaccent">Albums</div>
            </div>
        </div>
        <!-- Recent Activity -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <h2 class="text-xl font-semibold mb-4">Recent Users</h2>
                <ul class="bg-primary rounded-lg p-4 shadow divide-y divide-secondary">
                    @foreach($recentUsers as $user)
                        <li class="py-2 flex items-center justify-between">
                            <span><i class="fas fa-user mr-2"></i>{{ $user->name }}</span>
                            <span class="text-xs text-gray-300">{{ $user->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('admin.users') }}" class=" bg-primary rounded-lg p-4 shadow mt-56">See users</a>
            </div>
            <div class="text-center">
                <h2 class="text-xl font-semibold mb-4">Recent Artists</h2>
                <ul class="bg-primary rounded-lg p-4 shadow divide-y divide-secondary">
                    @foreach($recentArtists as $artist)
                        <li class="py-2 flex items-center justify-between">
                            <span><i class="fas fa-microphone-alt mr-2"></i>{{ $artist->name }}</span>
                            <span class="text-xs text-gray-300">{{ $artist->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('admin.artists') }}" class=" bg-primary rounded-lg p-4 shadow mt-56">See artists</a>
            </div>
            <div class="text-center">
                <h2 class="text-xl font-semibold mb-4">Recent Songs</h2>
                <ul class="bg-primary rounded-lg p-4 shadow divide-y divide-secondary">
                    @foreach($recentSongs as $song)
                        <li class="py-2 flex items-center justify-between">
                            <span><i class="fas fa-music mr-2"></i>{{ $song->name }}</span>
                            <span class="text-xs text-gray-300">{{ $song->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('admin.songs') }}" class=" bg-primary rounded-lg p-4 shadow mt-56">See songs</a>
            </div>
        </div>
    </div>
</body>
</html> 