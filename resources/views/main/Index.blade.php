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
    <div class="flex flex-col md:flex-row h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="bg-primary w-full md:w-64 flex-shrink-0 border-r border-secondary md:block mobile-menu hidden">
            <div class="p-4">
                <h1 class="text-2xl font-bold text-lightest flex items-center">
                    <i class="fas fa-music mr-2"></i> Harmony
                </h1>
                <nav class="mt-8">
                    <ul>
                        <li class="mb-4">
                            <a href="#" class="flex items-center text-lightaccent hover:text-lightest">
                                <i class="fas fa-home mr-3"></i> Home
                            </a>
                        </li>
                        <li class="mb-4">
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="flex items-center text-gray-300 hover:text-lightest w-full">
                                    <i class="fas fa-sign-out-alt mr-3"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-gradient-to-b from-primary to-secondary">
            <!-- Mobile header -->
            <header class="md:hidden bg-primary p-4 flex justify-between items-center border-b border-secondary">
                <button id="menu-toggle" class="text-lightest">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-xl font-bold text-lightest">Harmony</h1>
                <div class="w-6"></div> <!-- Spacer for balance -->
            </header>

            <!-- Content -->
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">Good afternoon</h2>
                
                <!-- Recently played section -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold mb-4">Recently played</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4" id="recently-played">
                        <!-- Music cards will be loaded here -->
                    </div>
                </div>
                
                <!-- Made for you section -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold">Your Music</h3>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6" id="music-grid">
                        <!-- Music cards will be loaded here -->
                    </div>
                </div>
                <!-- Albums section -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold">Albums</h3>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                        @foreach($albums as $album)
                            <div class="bg-primary rounded-lg shadow-lg p-4 flex flex-col items-center hover:bg-secondary transition">
                                <img src="https://via.placeholder.com/100" alt="Album Cover" class="w-24 h-24 rounded mb-3">
                                <h4 class="text-lg font-bold mb-1">{{ $album->name }}</h4>
                                <a href="{{ route('albums.showOne', $album->id) }}" class="text-sm text-lightaccent hover:text-lightest">View Album</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Player bar -->
    <footer class="fixed bottom-0 left-0 right-0 bg-gradient-to-r from-primary to-secondary border-t border-lightaccent p-3">
        <div class="flex items-center justify-between">
            <!-- Song info -->
            <div class="flex items-center w-1/4">
                <img src="https://via.placeholder.com/50" alt="Album cover" class="w-12 h-12 rounded mr-3">
                <div>
                    <h4 class="font-medium text-sm" id="current-song-title">No song selected</h4>
                    <p class="text-gray-300 text-xs" id="current-song-artist">Select a song to play</p>
                </div>
                <button class="ml-4 text-gray-300 hover:text-lightest" id="like-button">
                    <i class="far fa-heart"></i>
                </button>
            </div>
            
            <!-- Player controls -->
            <div class="flex flex-col items-center w-2/4">
                <div class="flex items-center mb-2">
                    <button class="mx-2 text-gray-300 hover:text-lightest" id="shuffle-button">
                        <i class="fas fa-random"></i>
                    </button>
                    <button class="mx-2 text-gray-300 hover:text-lightest" id="prev-button">
                        <i class="fas fa-step-backward"></i>
                    </button>
                    <button class="mx-3 bg-lightest text-primary rounded-full w-8 h-8 flex items-center justify-center hover:scale-105" id="play-pause-button">
                        <i class="fas fa-play"></i>
                    </button>
                    <button class="mx-2 text-gray-300 hover:text-lightest" id="next-button">
                        <i class="fas fa-step-forward"></i>
                    </button>
                    <button class="mx-2 text-gray-300 hover:text-lightest" id="repeat-button">
                        <i class="fas fa-redo"></i>
                    </button>
                </div>
                <div class="w-full flex items-center">
                    <span class="text-xs text-gray-300 mr-2" id="current-time">0:00</span>
                    <div class="flex-1 bg-gray-600 rounded-full h-1 cursor-pointer" id="progress-bar">
                        <div class="bg-lightest h-1 rounded-full" id="progress" style="width: 0%"></div>
                    </div>
                    <span class="text-xs text-gray-300 ml-2" id="duration">0:00</span>
                </div>
            </div>
            
            <!-- Volume and other controls -->
            <div class="flex items-center justify-end w-1/4">
                <button class="mx-2 text-gray-300 hover:text-lightest" id="queue-button">
                    <i class="fas fa-list"></i>
                </button>
                <button class="mx-2 text-gray-300 hover:text-lightest" id="device-button">
                    <i class="fas fa-desktop"></i>
                </button>
                <button class="mx-2 text-gray-300 hover:text-lightest" id="mute-button">
                    <i class="fas fa-volume-up"></i>
                </button>
                <div class="w-20 bg-gray-600 rounded-full h-1 ml-2 cursor-pointer" id="volume-bar">
                    <div class="bg-lightest h-1 rounded-full" id="volume-level" style="width: 70%"></div>
                </div>
            </div>
        </div>
    </footer>

    <audio id="audio-player" style="display: none;" preload="metadata"></audio>

    <script>
        const csrfToken = '{{ csrf_token() }}';
        // Audio player state
        const state = {
            currentTrack: null,
            playlist: [],
            isPlaying: false,
            isShuffled: false,
            isRepeating: false,
            volume: 0.7,
            currentTime: 0
        };

        // DOM elements
        let audioPlayer = document.getElementById('audio-player');
        const playPauseButton = document.getElementById('play-pause-button');
        const prevButton = document.getElementById('prev-button');
        const nextButton = document.getElementById('next-button');
        const shuffleButton = document.getElementById('shuffle-button');
        const repeatButton = document.getElementById('repeat-button');
        const progressBar = document.getElementById('progress-bar');
        const progress = document.getElementById('progress');
        const currentTimeDisplay = document.getElementById('current-time');
        const durationDisplay = document.getElementById('duration');
        const volumeBar = document.getElementById('volume-bar');
        const volumeLevel = document.getElementById('volume-level');
        const muteButton = document.getElementById('mute-button');

        // Set up audio event listeners
        function setupAudioListeners() {
            audioPlayer.addEventListener('timeupdate', () => {
                const percent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
                progress.style.width = `${percent}%`;
                currentTimeDisplay.textContent = formatTime(audioPlayer.currentTime);
            });

            audioPlayer.addEventListener('loadedmetadata', () => {
                durationDisplay.textContent = formatTime(audioPlayer.duration);
            });

            audioPlayer.addEventListener('error', (e) => {
                console.error('Audio error:', e);
                // Try to recover from error by reloading the track
                if (state.currentTrack) {
                    const filename = state.currentTrack.media_path.split('/').pop();
                    const timestamp = new Date().getTime();
                    audioPlayer.src = `/stream/${filename}?t=${timestamp}`;
                    audioPlayer.load();
                }
            });

            audioPlayer.addEventListener('stalled', () => {
                console.log('Audio stalled - buffering...');
            });

            audioPlayer.addEventListener('waiting', () => {
                console.log('Audio waiting for data...');
            });

            audioPlayer.addEventListener('playing', () => {
                console.log('Audio playing');
            });

            audioPlayer.addEventListener('ended', () => {
                if (!state.isRepeating) {
                    const currentIndex = state.playlist.findIndex(track => track.id === state.currentTrack.id);
                    const nextIndex = (currentIndex + 1) % state.playlist.length;
                    loadTrack(nextIndex);
                    if (state.isPlaying) {
                        const playPromise = audioPlayer.play();
                        if (playPromise !== undefined) {
                            playPromise.catch(error => {
                                console.error('Playback failed:', error);
                            });
                        }
                    }
                }
            });
        }

        // Initialize audio listeners
        setupAudioListeners();

        // Load music from database
        async function loadMusic() {
            try {
                const response = await fetch('/music/list');
                const data = await response.json();
                state.playlist = data;

                if (data.length > 0) {
                    loadTrack(0);
                }
            } catch (error) {
                console.error('Error loading music:', error);
            }
        }

        // Load a track
        function loadTrack(index) {
            if (state.playlist[index]) {
                state.currentTrack = state.playlist[index];
                // Extract filename from media_path
                const filename = state.currentTrack.media_path.split('/').pop();
                
                // Create a new audio element to ensure clean state
                const newAudio = new Audio();
                newAudio.preload = 'metadata';
                
                // Add a random query parameter to prevent caching and IDM detection
                const timestamp = new Date().getTime();
                newAudio.src = `/stream/${filename}?t=${timestamp}`;
                
                // Replace the old audio element
                audioPlayer.parentNode.replaceChild(newAudio, audioPlayer);
                audioPlayer = newAudio;
                
                // Set up event listeners for the new audio element
                setupAudioListeners();
                
                document.getElementById('current-song-title').textContent = state.currentTrack.name;
                document.getElementById('current-song-artist').textContent = 'Artist Name';
                
                // Load the audio
                audioPlayer.load();
            }
        }

        // Play/Pause
        playPauseButton.addEventListener('click', () => {
            if (state.currentTrack) {
                if (state.isPlaying) {
                    audioPlayer.pause();
                    playPauseButton.innerHTML = '<i class="fas fa-play"></i>';
                } else {
                    const playPromise = audioPlayer.play();
                    if (playPromise !== undefined) {
                        playPromise.then(() => {
                            playPauseButton.innerHTML = '<i class="fas fa-pause"></i>';
                        }).catch(error => {
                            console.error('Playback failed:', error);
                        });
                    }
                }
                state.isPlaying = !state.isPlaying;
            }
        });

        // Click on progress bar
        progressBar.addEventListener('click', (e) => {
            const percent = (e.offsetX / progressBar.offsetWidth);
            audioPlayer.currentTime = percent * audioPlayer.duration;
        });

        // Volume control
        volumeBar.addEventListener('click', (e) => {
            const percent = (e.offsetX / volumeBar.offsetWidth);
            state.volume = percent;
            audioPlayer.volume = percent;
            volumeLevel.style.width = `${percent * 100}%`;
        });

        // Mute toggle
        muteButton.addEventListener('click', () => {
            if (audioPlayer.muted) {
                audioPlayer.muted = false;
                muteButton.innerHTML = '<i class="fas fa-volume-up"></i>';
            } else {
                audioPlayer.muted = true;
                muteButton.innerHTML = '<i class="fas fa-volume-mute"></i>';
            }
        });

        // Next/Previous
        nextButton.addEventListener('click', () => {
            const currentIndex = state.playlist.findIndex(track => track.id === state.currentTrack.id);
            const nextIndex = (currentIndex + 1) % state.playlist.length;
            loadTrack(nextIndex);
            if (state.isPlaying) {
                const playPromise = audioPlayer.play();
                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        console.error('Playback failed:', error);
                    });
                }
            }
        });

        prevButton.addEventListener('click', () => {
            const currentIndex = state.playlist.findIndex(track => track.id === state.currentTrack.id);
            const prevIndex = (currentIndex - 1 + state.playlist.length) % state.playlist.length;
            loadTrack(prevIndex);
            if (state.isPlaying) {
                const playPromise = audioPlayer.play();
                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        console.error('Playback failed:', error);
                    });
                }
            }
        });

        // Shuffle toggle
        shuffleButton.addEventListener('click', () => {
            state.isShuffled = !state.isShuffled;
            shuffleButton.classList.toggle('text-lightaccent');
        });

        // Repeat toggle
        repeatButton.addEventListener('click', () => {
            state.isRepeating = !state.isRepeating;
            repeatButton.classList.toggle('text-lightaccent');
            audioPlayer.loop = state.isRepeating;
        });

        // Format time
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = Math.floor(seconds % 60);
            return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
        }

        // Load recently played music and display as cards
        async function loadRecentlyPlayed() {
            try {
                const response = await fetch('/music/recently-played');
                const musics = await response.json();
                const container = document.getElementById('recently-played');
                container.innerHTML = '';
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
                        <p class="text-gray-300 text-sm">—</p>
                        <div class="flex justify-between items-center mt-2">
                            <a href="/music/${music.id}" class="text-gray-300 text-sm">Details</a>
                        </div>
                    `;
                    // Play button event
                    card.querySelector('.play-track-btn').addEventListener('click', (e) => {
                        // Find index in playlist and play
                        const idx = state.playlist.findIndex(track => track.id === music.id);
                        if (idx !== -1) {
                            loadTrack(idx);
                            const playPromise = audioPlayer.play();
                            if (playPromise !== undefined) {
                                playPromise.catch(error => {
                                    console.error('Playback failed:', error);
                                });
                            }
                            state.isPlaying = true;
                            playPauseButton.innerHTML = '<i class="fas fa-pause"></i>';
                        }
                    });
                    container.appendChild(card);
                });
            } catch (error) {
                console.error('Error loading recently played:', error);
            }
        }

        loadRecentlyPlayed();
        loadMusic();
    </script>
</body>
</html>