<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up for Harmony</title>
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
        .signup-bg {
            background: linear-gradient(135deg, #22577A 0%, #38A3A5 50%, #57CC99 100%);
        }
        .input-field:focus {
            outline: none;
            box-shadow: 0 0 0 2px #80ED99;
        }
        .password-strength {
            height: 4px;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body class="signup-bg min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <i class="fas fa-music text-lightest text-5xl mb-2"></i>
            <h1 class="text-3xl font-bold text-lightest">Harmony</h1>
            <p class="text-gray-300 mt-2">Sign up to start listening</p>
        </div>
        
        <!-- Signup Card -->
        <div class="bg-primary bg-opacity-90 backdrop-blur-sm rounded-xl shadow-2xl p-8 border border-secondary">
            <h2 class="text-2xl font-bold text-lightest mb-6 text-center">Sign up for free</h2>
            
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- Social Signup -->
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
            
            <!-- Email Signup -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-300 mb-2">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full bg-primary border border-gray-600 rounded-lg py-3 px-4 text-white input-field focus:border-lightaccent" placeholder="Your name" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-300 mb-2">Email address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full bg-primary border border-gray-600 rounded-lg py-3 px-4 text-white input-field focus:border-lightaccent" placeholder="name@example.com" required>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="block text-gray-300 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="w-full bg-primary border border-gray-600 rounded-lg py-3 px-4 text-white input-field focus:border-lightaccent" placeholder="Create a password" required>
                        <button type="button" id="toggle-password" class="absolute right-3 top-3 text-gray-400 hover:text-lightest">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <div class="mt-2">
                        <div class="flex mb-1">
                            <div id="strength-1" class="password-strength bg-gray-600 rounded-full mr-1 flex-1"></div>
                            <div id="strength-2" class="password-strength bg-gray-600 rounded-full mr-1 flex-1"></div>
                            <div id="strength-3" class="password-strength bg-gray-600 rounded-full mr-1 flex-1"></div>
                            <div id="strength-4" class="password-strength bg-gray-600 rounded-full flex-1"></div>
                        </div>
                        <p id="password-hint" class="text-xs text-gray-500"></p>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-300 mb-2">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-primary border border-gray-600 rounded-lg py-3 px-4 text-white input-field focus:border-lightaccent" placeholder="Confirm your password" required>
                </div>
                
                <div class="mb-6">
                    <div class="flex items-start">
                        <input type="checkbox" id="terms" name="terms" class="h-4 w-4 text-accent rounded border-gray-600 bg-primary focus:ring-lightaccent mt-1" required>
                        <label for="terms" class="ml-2 text-gray-300 text-sm">
                            I agree to Harmony's <a href="#" class="text-lightaccent hover:text-lightest">Terms and Conditions</a> and <a href="#" class="text-lightaccent hover:text-lightest">Privacy Policy</a>
                        </label>
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-accent text-primary py-3 rounded-full font-bold hover:bg-lightaccent transition mb-4">
                    Sign Up
                </button>
                
                <div class="text-center text-gray-400">
                    Already have an account? <a href="{{ route('main.login') }}" class="text-lightaccent hover:text-lightest font-medium">Log in</a>
                </div>
                <div class="text-center text-gray-400">
                    Sign up as an artist? <a href="{{ route('artist.create') }}" class="text-lightaccent hover:text-lightest font-medium">Sign up</a>
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

    <script>
        // Toggle password visibility
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBars = [
                document.getElementById('strength-1'),
                document.getElementById('strength-2'),
                document.getElementById('strength-3'),
                document.getElementById('strength-4')
            ];
            const hint = document.getElementById('password-hint');
            
            // Reset
            strengthBars.forEach(bar => {
                bar.style.width = '0%';
                bar.classList.remove('bg-red-500', 'bg-yellow-500', 'bg-lightaccent', 'bg-accent');
            });
            
            if (!password) {
                hint.textContent = '';
                return;
            }
            
            // Very simple strength check (in a real app, use a proper library)
            let strength = 0;
            if (password.length >= 4) strength++;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/\d/.test(password) || /[^A-Za-z0-9]/.test(password)) strength++;
            
            // Update bars
            for (let i = 0; i < strength; i++) {
                strengthBars[i].style.width = '100%';
                
                if (strength === 1) {
                    strengthBars[i].classList.add('bg-red-500');
                    hint.textContent = 'Weak password';
                } else if (strength === 2) {
                    strengthBars[i].classList.add('bg-yellow-500');
                    hint.textContent = 'Moderate password';
                } else if (strength === 3) {
                    strengthBars[i].classList.add('bg-lightaccent');
                    hint.textContent = 'Good password';
                } else if (strength >= 4) {
                    strengthBars[i].classList.add('bg-accent');
                    hint.textContent = 'Strong password';
                }
            }
        });
    </script>
</body>
</html>