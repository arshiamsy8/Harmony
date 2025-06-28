<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User - Harmony</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{asset('assets/js/tailwind.js')}}" rel="stylesheet">
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
        .form-bg {
            background: linear-gradient(135deg, #22577A 0%, #38A3A5 50%, #57CC99 100%);
        }
        .input-field:focus {
            outline: none;
            box-shadow: 0 0 0 2px #80ED99;
        }
    </style>
</head>
<body class="form-bg min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <i class="fas fa-user-plus text-lightest text-5xl mb-2"></i>
            <h1 class="text-3xl font-bold text-lightest">Add New User</h1>
        </div>
        
        <!-- Form Card -->
        <div class="bg-primary bg-opacity-90 backdrop-blur-sm rounded-xl shadow-2xl p-8 border border-secondary">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Name -->
                <div>
                    <label for="name" class="block text-gray-300 mb-2">Full Name</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="w-full bg-primary border border-gray-600 rounded-lg py-3 px-4 text-white input-field focus:border-lightaccent" 
                           placeholder="Enter full name"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-300 mb-2">Email Address</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="w-full bg-primary border border-gray-600 rounded-lg py-3 px-4 text-white input-field focus:border-lightaccent" 
                           placeholder="Enter email address"
                           required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-gray-300 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="w-full bg-primary border border-gray-600 rounded-lg py-3 px-4 text-white input-field focus:border-lightaccent" 
                               placeholder="Create a password"
                               required>
                        <button type="button" 
                                onclick="togglePassword()" 
                                class="absolute right-3 top-3 text-gray-400 hover:text-lightest">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-accent text-primary py-3 rounded-full font-bold hover:bg-lightaccent transition">
                    Create Account
                </button>
            </form>
            
            <!-- Back Link -->
            <div class="mt-6 text-center">
                <a href="{{ route('main.index') }}" class="text-lightaccent hover:text-lightest">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Users
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = document.querySelector('.fa-eye');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }
    </script>
</body>
</html>