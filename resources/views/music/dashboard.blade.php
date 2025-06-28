@extends('layout.app')

@section('content')
<div class="content flex-1 flex flex-col overflow-hidden">
        <!-- Top Navigation -->
        <header class="bg-primary border-b border-secondary p-4 flex items-center justify-between">
            <div class="flex items-center">
                <h1 class="text-xl font-semibold">Music Dashboard</h1>
            </div>
            <div class="flex items-center space-x-4">
                <button class="text-gray-300 hover:text-lightest">
                    <i class="fas fa-bell"></i>
                </button>
                <button class="text-gray-300 hover:text-lightest">
                    <i class="fas fa-envelope"></i>
                </button>
                <div class="w-px h-6 bg-gray-600"></div>
                <button class="text-gray-300 hover:text-lightest flex items-center">
                    <i class="fas fa-search mr-2"></i>
                    <span>Search</span>
                </button>
                <div class="w-px h-6 bg-gray-600"></div>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="text-gray-300 hover:text-lightest flex items-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-6 bg-dark">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-primary rounded-lg p-6 border border-secondary">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400">Total Songs</p>
                            <h3 class="text-2xl font-bold mt-1">12,456</h3>
                        </div>
                        <div class="bg-accent bg-opacity-20 text-accent p-3 rounded-full">
                            <i class="fas fa-music text-xl"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 mt-3"><span class="text-lightaccent">+12.5%</span> from last month</p>
                </div>
                
                <div class="bg-primary rounded-lg p-6 border border-secondary">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400">Active Artists</p>
                            <h3 class="text-2xl font-bold mt-1">1,234</h3>
                        </div>
                        <div class="bg-secondary bg-opacity-20 text-secondary p-3 rounded-full">
                            <i class="fas fa-user-friends text-xl"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 mt-3"><span class="text-lightaccent">+8.3%</span> from last month</p>
                </div>
                
                <div class="bg-primary rounded-lg p-6 border border-secondary">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400">Total Plays</p>
                            <h3 class="text-2xl font-bold mt-1">5.2M</h3>
                        </div>
                        <div class="bg-lightaccent bg-opacity-20 text-lightaccent p-3 rounded-full">
                            <i class="fas fa-play text-xl"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 mt-3"><span class="text-lightaccent">+24.7%</span> from last month</p>
                </div>
                
                <div class="bg-primary rounded-lg p-6 border border-secondary">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400">Revenue</p>
                            <h3 class="text-2xl font-bold mt-1">$42,580</h3>
                        </div>
                        <div class="bg-lightest bg-opacity-20 text-lightest p-3 rounded-full">
                            <i class="fas fa-dollar-sign text-xl"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 mt-3"><span class="text-lightaccent">+15.2%</span> from last month</p>
                </div>
            </div>

            <!-- Upload Music Section -->
            <div class="bg-primary rounded-lg p-6 border border-secondary mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold">Upload New Music</h2>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('artist.create') }}" class="bg-secondary text-white px-4 py-2 rounded-lg hover:bg-secondary/80 transition">
                            <i class="fas fa-plus mr-2"></i> Add artist
                        </a>
                        <button class="bg-accent text-primary px-4 py-2 rounded-lg hover:bg-lightaccent transition">
                            <i class="fas fa-save mr-2"></i> Save All
                        </button>
                    </div>
                </div>
                
                <!-- Upload Form -->
                <form action="{{ route('music.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="upload-form">
                    @csrf
                    @if(session('error'))
                        <div class="bg-red-500/20 text-red-500 p-4 rounded-lg mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="bg-green-500/20 text-green-500 p-4 rounded-lg mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                <!-- Drag & Drop Area -->
                <div id="drag-drop-area" class="drag-drop-area rounded-lg p-8 text-center mb-6">
                    <div id="drag-drop-default">
                        <i class="fas fa-cloud-upload-alt text-4xl text-secondary mb-3"></i>
                        <h3 class="text-xl font-medium mb-2">Drag & Drop your music files here</h3>
                        <p class="text-gray-400 mb-4">Supports MP3, WAV, FLAC, AAC</p>
                        <button type="button" id="select-file-btn" class="bg-secondary text-white px-6 py-2 rounded-lg hover:bg-secondary/80 transition">
                            Or select files
                        </button>
                    </div>
                    <div id="drag-drop-fileinfo" style="display:none;"></div>
                    <input type="file" name="media" id="file-upload" class="hidden" accept=".mp3,.wav,.flac,.aac" required>
                    <input type="hidden" name="duration" id="duration-input">
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Song Details -->
                    <div class="lg:col-span-2">
                        <h3 class="text-lg font-medium mb-4">Song Details</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-400 mb-2">Song Title</label>
                                    <input type="text" name="name" id="song-title" class="w-full bg-dark border border-gray-600 rounded-lg py-2 px-4 text-white focus:border-lightaccent focus:outline-none" placeholder="Enter song title" required>
                            </div>
                            <div>
                                <label class="block text-gray-400 mb-2">Genres</label>
                                <select name="genres[]" id="genres" class="w-full bg-dark border border-gray-600 rounded-lg py-2 px-4 text-white focus:border-lightaccent focus:outline-none" multiple required>
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-sm text-gray-400 mt-1">Hold Ctrl/Cmd to select multiple genres</p>
                            </div>
                                <div>
                                    <label class="block text-gray-400 mb-2">Duration</label>
                                    <input type="text" id="duration-display" class="w-full bg-dark border border-gray-600 rounded-lg py-2 px-4 text-white" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary/80 transition">
                            Upload Music
                        </button>
                    </div>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const fileInput = document.getElementById('file-upload');
                        const dragDropArea = document.getElementById('drag-drop-area');
                        const durationInput = document.getElementById('duration-input');
                        const durationDisplay = document.getElementById('duration-display');
                        const songTitle = document.getElementById('song-title');
                        const fileInfoBox = document.getElementById('drag-drop-fileinfo');
                        const uploadForm = document.getElementById('upload-form');
                        const defaultBox = document.getElementById('drag-drop-default');
                        const selectFileBtn = document.getElementById('select-file-btn');

                        let selectedFile = null;

                        // Handle file selection button click
                        selectFileBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            fileInput.click();
                        });

                        // Handle drag and drop
                        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                            dragDropArea.addEventListener(eventName, preventDefaults, false);
                        });

                        function preventDefaults(e) {
                            e.preventDefault();
                            e.stopPropagation();
                        }

                        ['dragenter', 'dragover'].forEach(eventName => {
                            dragDropArea.addEventListener(eventName, highlight, false);
                        });

                        ['dragleave', 'drop'].forEach(eventName => {
                            dragDropArea.addEventListener(eventName, unhighlight, false);
                        });

                        function highlight(e) {
                            dragDropArea.classList.add('border-secondary');
                        }

                        function unhighlight(e) {
                            dragDropArea.classList.remove('border-secondary');
                        }

                        dragDropArea.addEventListener('drop', handleDrop, false);

                        function handleDrop(e) {
                            const dt = e.dataTransfer;
                            const files = dt.files;
                            handleFiles(files);
                        }

                        // Handle file selection
                        fileInput.addEventListener('change', function() {
                            handleFiles(this.files);
                        });

                        function handleFiles(files) {
                            if (files.length > 0) {
                                selectedFile = files[0];
                                
                                // Validate file type
                                const allowedTypes = ['audio/mpeg', 'audio/wav', 'audio/x-wav', 'audio/flac', 'audio/aac'];
                                if (!allowedTypes.includes(selectedFile.type)) {
                                    showError('Invalid file type. Please upload MP3, WAV, FLAC, or AAC files.');
                                    return;
                                }

                                // Validate file size (20MB)
                                if (selectedFile.size > 20 * 1024 * 1024) {
                                    showError('File size exceeds 20MB limit');
                                    return;
                                }

                                // Show file info in the green box
                                defaultBox.style.display = 'none';
                                fileInfoBox.style.display = '';
                                
                                // Get audio duration and metadata
                                const audio = new Audio();
                                audio.src = URL.createObjectURL(selectedFile);
                                
                                audio.addEventListener('loadedmetadata', function() {
                                    const duration = audio.duration;
                                    durationInput.value = duration.toFixed(2);
                                    durationDisplay.value = formatDuration(duration);
                                    
                                    // Extract filename without extension as default title
                                    const fileName = selectedFile.name.replace(/\.[^/.]+$/, "");
                                    songTitle.value = fileName;
                                    
                                    // Display file information
                                    const fileSize = formatFileSize(selectedFile.size);
                                    const fileType = selectedFile.type;
                                    fileInfoBox.innerHTML = `
                                        <div class='flex flex-col items-center justify-center'>
                                            <i class='fas fa-file-audio text-4xl text-green-400 mb-2'></i>
                                            <div class='font-semibold text-lg mb-1'>${selectedFile.name}</div>
                                            <div class='text-sm text-gray-300 mb-1'>${fileType} &bull; ${fileSize}</div>
                                            <div class='text-sm text-gray-300 mb-1'>Duration: ${formatDuration(duration)}</div>
                                            <button type='button' class='mt-2 text-xs text-red-400 underline' id='remove-file-btn'>Remove file</button>
                                        </div>
                                    `;
                                    // Remove file button
                                    document.getElementById('remove-file-btn').onclick = function() {
                                        selectedFile = null;
                                        fileInput.value = '';
                                        durationInput.value = '';
                                        durationDisplay.value = '';
                                        songTitle.value = '';
                                        fileInfoBox.innerHTML = '';
                                        fileInfoBox.style.display = 'none';
                                        defaultBox.style.display = '';
                                    };
                                });

                                audio.addEventListener('error', function() {
                                    showError('Error loading audio file. Please try another file.');
                                    selectedFile = null;
                                    fileInput.value = '';
                                    fileInfoBox.innerHTML = '';
                                    fileInfoBox.style.display = 'none';
                                    defaultBox.style.display = '';
                                });
                            }
                        }

                        function formatDuration(seconds) {
                            const minutes = Math.floor(seconds / 60);
                            const remainingSeconds = Math.floor(seconds % 60);
                            return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
                        }

                        function formatFileSize(bytes) {
                            if (bytes === 0) return '0 Bytes';
                            const k = 1024;
                            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                            const i = Math.floor(Math.log(bytes) / Math.log(k));
                            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                        }

                        // Add form submission handler
                        uploadForm.addEventListener('submit', function(e) {
                            e.preventDefault();

                            // Validation
                            if (!selectedFile) {
                                showError('Please select a file to upload');
                                return;
                            }

                            const formData = new FormData(uploadForm);
                            formData.set('media', selectedFile);

                            // Show loading state
                            const submitButton = uploadForm.querySelector('button[type="submit"]');
                            const originalText = submitButton.innerHTML;
                            submitButton.disabled = true;
                            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';

                            fetch(uploadForm.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.text();
                            })
                            .then(data => {
                                showSuccess('Music uploaded successfully!');
                                // Clear the form fields
                                selectedFile = null;
                                fileInput.value = '';
                                durationInput.value = '';
                                durationDisplay.value = '';
                                songTitle.value = '';
                                fileInfoBox.innerHTML = '';
                                fileInfoBox.style.display = 'none';
                                defaultBox.style.display = '';
                            })
                            .catch(error => {
                                showError('Upload failed: ' + error.message);
                            })
                            .finally(() => {
                                // Reset button state
                                submitButton.disabled = false;
                                submitButton.innerHTML = originalText;
                            });
                        });

                        function clearMessages() {
                            const prevError = document.querySelector('.error-message');
                            if (prevError) prevError.remove();
                            const prevSuccess = document.querySelector('.success-message');
                            if (prevSuccess) prevSuccess.remove();
                        }

                        function showError(message) {
                            clearMessages();
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'error-message bg-red-500/20 text-red-500 p-4 rounded-lg mb-4';
                            errorDiv.textContent = message;
                            uploadForm.insertBefore(errorDiv, uploadForm.firstChild);
                            setTimeout(() => {
                                const msg = document.querySelector('.error-message');
                                if (msg) msg.remove();
                            }, 4000);
                        }

                        function showSuccess(message) {
                            clearMessages();
                            const successDiv = document.createElement('div');
                            successDiv.className = 'success-message bg-green-500/20 text-green-500 p-4 rounded-lg mb-4';
                            successDiv.textContent = message;
                            uploadForm.insertBefore(successDiv, uploadForm.firstChild);
                            setTimeout(() => {
                                const msg = document.querySelector('.success-message');
                                if (msg) msg.remove();
                            }, 4000);
                        }
                    });
                </script>
            </div>
        </main>
    </div>
@endsection