<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmony - Music Streaming</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{asset('assets/js/tailwind.js')}}" rel="stylesheet">
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
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #22577A;
        }
        ::-webkit-scrollbar-thumb {
            background: #38A3A5;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #57CC99;
        }
        
        /* For mobile menu toggle */
        .mobile-menu {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-primary text-white font-sans">
    <div class="max-w-3xl mx-auto p-6 text-lightest text-center">
        <h1 class="text-2xl font-bold mb-6">All Users</h1>

        <table class="w-full table-auto bg-primary bg-opacity-40 rounded">
            <thead class="text-left border-b border-lightaccent">
                <tr>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="border-b border-gray-600">
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?');">
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
</body>
</html>