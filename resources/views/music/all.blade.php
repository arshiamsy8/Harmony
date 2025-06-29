<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Songs – Harmony</title>
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
    <script src="https://kit.fontawesome.com/27f03b5f1f.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary text-lightest min-h-screen p-6">

    <h1 class="text-3xl font-bold mb-8 text-center">All Songs</h1>

    <div id="music-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Music cards will be injected here by JavaScript -->
    </div>

    
    <div id="player" class="fixed bottom-0 left-0 right-0 bg-secondary p-4 hidden">
        <div class="flex justify-between items-center">
            <div id="player-title" class="font-semibold">Now Playing</div>
            <audio id="audio" controls class="w-full ml-4"></audio>
        </div>
    </div>

    <script>
        const csrfToken = '{{ csrf_token() }}';
        const musicGrid = document.getElementById('music-grid');
        const player = document.getElementById('player');
        const playerTitle = document.getElementById('player-title');
        const audio = document.getElementById('audio');

        async function loadMusics() {
            const response = await fetch('/music/list');
            const musics = await response.json();

            musics.forEach(music => {
                const card = document.createElement('div');
                card.className = 'bg-primary bg-opacity-30 hover:bg-opacity-50 transition p-4 rounded-lg cursor-pointer group';
                card.innerHTML = `
                    <div class="relative mb-4">
                        <img src="https://via.placeholder.com/300" alt="Music cover" class="w-full rounded shadow-lg">
                        <button class="absolute bottom-2 right-2 bg-accent text-primary rounded-full w-10 h-10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg hover:scale-105 play-track-btn">
                            <i class="fas fa-play"></i>
                        </button>
                    </div>
                    <h4 class="font-medium mb-1">${music.name}</h4>
                    <p class="text-gray-300 text-sm">${music.duration}</p>
                    <div class="flex justify-between items-center mt-2">
                        <a href="/music/${music.id}" class="text-sm text-lightaccent hover:underline">Details</a>
                        <div class="flex gap-3">
                            <a href="/music/${music.id}/edit" class="text-sm text-blue-300 hover:text-blue-100">Edit</a>
                            <form method="POST" action="/music/${music.id}" onsubmit="return confirm('Delete this music?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <button type="submit" class="text-sm text-red-400 hover:text-red-300">Delete</button>
                            </form>
                        </div>
                    </div>
                `;

                card.querySelector('.play-track-btn').addEventListener('click', (e) => {
                    e.stopPropagation();
                    audio.src = `/audio/${music.file || 'example.mp3'}`; // Replace with actual file path if needed
                    audio.play();
                    playerTitle.textContent = music.name;
                    player.classList.remove('hidden');
                });

                musicGrid.appendChild(card);
            });
        }

        loadMusics();
    </script>

</body>
</html>
