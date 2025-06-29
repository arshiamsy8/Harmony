<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmony - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
                        dark: '#1A3A4A',
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar.collapsed {
            width: 80px;
        }
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        .sidebar.collapsed .logo-text {
            display: none;
        }
        .content {
            transition: all 0.3s ease;
        }
        .content.expanded {
            margin-left: 80px;
        }
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #1A3A4A;
        }
        ::-webkit-scrollbar-thumb {
            background: #38A3A5;
            border-radius: 3px;
        }
        .drag-drop-area {
            border: 2px dashed #38A3A5;
        }
        .drag-drop-area.active {
            border-color: #57CC99;
            background-color: rgba(87, 204, 153, 0.1);
        }
    </style>
</head>
<body class="bg-dark text-gray-100 flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="sidebar bg-primary w-64 flex-shrink-0 flex flex-col border-r border-secondary h-full">
        <div class="p-4 border-b border-secondary flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-music text-lightest text-2xl mr-2"></i>
                <span class="logo-text text-xl font-bold text-lightest">Harmony Artist</span>
            </div>
            <button id="toggle-sidebar" class="text-gray-300 hover:text-lightest">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>
        
        <div class="flex-1 overflow-y-auto py-4">
            <nav>
                <ul>
                    <li class="px-4 mt-2">
                        <a href="{{ route('music.create') }}" class="flex items-center py-3 px-3 text-gray-300 hover:text-lightest hover:bg-secondary hover:bg-opacity-20 rounded-lg">
                            <i class="fas fa-upload mr-3"></i>
                            <span class="sidebar-text">Upload Music</span>
                        </a>
                    </li>
                    <li class="px-4 mt-2">
                        <a href="{{ route('artist.musics') }}" class="flex items-center py-3 px-3 text-gray-300 hover:text-lightest hover:bg-secondary hover:bg-opacity-20 rounded-lg">
                            <i class="fas fa-music mr-3"></i>
                            <span class="sidebar-text">Manage Songs</span>
                        </a>
                    </li>
                    <li class="px-4 mt-2">
                        <a href="{{ route('albums.showAll') }}" class="flex items-center py-3 px-3 text-gray-300 hover:text-lightest hover:bg-secondary hover:bg-opacity-20 rounded-lg">
                            <i class="fas fa-list mr-3"></i>
                            <span class="sidebar-text">Albums</span>
                        </a>
                    </li>
                    <li class="px-4 mt-2">
                        <a href="{{ route('albums.show') }}" class="flex items-center py-3 px-3 text-gray-300 hover:text-lightest hover:bg-secondary hover:bg-opacity-20 rounded-lg">
                            <i class="fas fa-user mr-3"></i>
                            <span class="sidebar-text">My Albums</span>
                        </a>
                    </li>
                    <li class="px-4 mt-2">
                        <form action="{{ route('logout') }}" method="POST" class="flex items-center py-3 px-3 text-gray-300 hover:text-lightest hover:bg-secondary hover:bg-opacity-20 rounded-lg">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-lightest flex items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        
        <div class="p-4 border-t border-secondary">
            <div class="flex items-center">
                <img src="https://via.placeholder.com/40" alt="Artist" class="w-10 h-10 rounded-full mr-3">
                <div class="sidebar-text">
                    <div class="font-medium">Artist User</div>
                    <div class="text-xs text-gray-400">Artist pfp</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    @yield('content')

    <script>
        // Toggle sidebar
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.content').classList.toggle('expanded');
            
            // Change icon
            const icon = this.querySelector('i');
            if (icon.classList.contains('fa-chevron-left')) {
                icon.classList.remove('fa-chevron-left');
                icon.classList.add('fa-chevron-right');
            } else {
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-chevron-left');
            }
        });
        
        // Drag and drop functionality
        const dragDropArea = document.getElementById('drag-drop-area');
        const fileUpload = document.getElementById('file-upload');
        
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
        
        function highlight() {
            dragDropArea.classList.add('active');
        }
        
        function unhighlight() {
            dragDropArea.classList.remove('active');
        }
        
        dragDropArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }
        
        dragDropArea.addEventListener('click', () => {
            fileUpload.click();
        });
        
        fileUpload.addEventListener('change', function() {
            handleFiles(this.files);
        });
        
        function handleFiles(files) {
            console.log('Files to upload:', files);
            // In a real app, you would handle the file upload here
        }
        
        // Cover art upload preview
        document.getElementById('cover-art-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('cover-art-preview');
                    preview.src = event.target.result;
                    preview.classList.remove('hidden');
                    preview.nextElementSibling.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>