<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in to Harmony</title>
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
        .login-bg {
            background: linear-gradient(135deg, #22577A 0%, #38A3A5 50%, #57CC99 100%);
        }
        .input-field:focus {
            outline: none;
            box-shadow: 0 0 0 2px #80ED99;
        }
    </style>
</head>
<body class="login-bg min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <i class="fas fa-music text-lightest text-5xl mb-2"></i>
            <h1 class="text-3xl font-bold text-lightest">Harmony</h1>
        </div>
        
        <!-- Login Card -->
        <div class="bg-primary bg-opacity-90 backdrop-blur-sm rounded-xl shadow-2xl p-8 border border-secondary">
            <h2 class="text-2xl font-bold text-lightest mb-6 text-center">Log in to Harmony</h2>
            
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- Social Login -->
            <div class="mb-6">
                <button class="w-full bg-black text-white py-3 rounded-full font-medium flex items-center justify-center mb-3 hover:bg-gray-800 transition">
                    <i class="fab fa-google mr-2"></i> Continue with Google
                </button>
                <button class="w-full bg-black text-white py-3 rounded-full font-medium flex items-center justify-center hover:bg-gray-800 transition">
                    <i class="fab fa-facebook mr-2"></i> Continue with Facebook
                </button>
            </div>
            
            <div class="flex items-center my-6">
                <div class="flex-1 border-t border-gray-600"></div>
                <span class="px-4 text-gray-400">or</span>
                <div class="flex-1 border-t border-gray-600"></div>
            </div>
            
            <!-- Email Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="account_type" class="block text-gray-300 mb-2">Account Type</label>
                    <select id="account_type" name="account_type" class="w-full bg-primary border border-gray-600 rounded-lg py-3 px-4 text-white input-field focus:border-lightaccent" required>
                        <option value="user">User</option>
                        <option value="artist">Artist</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-300 mb-2">Email address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-primary border border-gray-600 rounded-lg py-3 px-4 text-white input-field focus:border-lightaccent" placeholder="name@example.com" required>
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-gray-300 mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full bg-primary border border-gray-600 rounded-lg py-3 px-4 text-white input-field focus:border-lightaccent" placeholder="Your password" required>
                </div>
                
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-accent rounded border-gray-600 bg-primary focus:ring-lightaccent">
                        <label for="remember" class="ml-2 text-gray-300">Remember me</label>
                    </div>
                    <a href="#" class="text-lightaccent hover:text-lightest text-sm">Forgot password?</a>
                </div>
                
                <button type="submit" class="w-full bg-accent text-primary py-3 rounded-full font-bold hover:bg-lightaccent transition mb-4">
                    Log In
                </button>
                
                <div class="text-center text-gray-400">
                    Don't have an account? <a href="{{ route('main.signup') }}" class="text-lightaccent hover:text-lightest font-medium">Sign up for Harmony</a>
                </div>
            </form>
        </div>
        
        <!-- Footer Links -->
        <div class="mt-8 text-center text-gray-400 text-sm">
            <a href="#" class="hover:text-lightest mx-2">Terms of Use</a>
            <a href="#" class="hover:text-lightest mx-2">Privacy Policy</a>
            <a href="#" class="hover:text-lightest mx-2">Cookies</a>
        </div>
    </div>
</body>
</html>