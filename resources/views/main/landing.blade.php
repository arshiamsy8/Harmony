<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmony - Stream Music You Love</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{asset('assets/js/tailwind.js')}} " rel="stylesheet">
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

        /* Hero section background */
        .hero-gradient {
            background: linear-gradient(135deg, #22577A 0%, #38A3A5 50%, #57CC99 100%);
        }

        /* Floating animation for headphones */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-primary text-white font-sans">
    <!-- Navigation -->
    <nav class="bg-primary bg-opacity-90 backdrop-blur-sm fixed w-full z-50 border-b border-secondary">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-music text-lightest text-2xl mr-2"></i>
                <span class="text-xl font-bold text-lightest">Harmony</span>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <a href="#" class="hover:text-lightaccent transition">Premium</a>
                <a href="#" class="hover:text-lightaccent transition">Support</a>
                <a href="#" class="hover:text-lightaccent transition">Download</a>
                <span class="text-gray-400">|</span>
                <a href="signup.html" class="hover:text-lightaccent transition">Sign up</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{route('main.login')}}" class="bg-white text-primary px-6 py-2 rounded-full font-medium hover:bg-gray-100 transition">Log in</a>
                <button class="md:hidden text-lightest focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient min-h-screen flex items-center pt-16 pb-20">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-12 md:mb-0">
                <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
                    Music for everyone.
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-100">
                    Millions of songs. No credit card needed.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="signup.html" class="bg-accent text-primary px-8 py-4 rounded-full font-bold text-center hover:bg-lightaccent transition transform hover:scale-105">
                        GET HARMONY FREE
                    </a>
                    <a href="/premium" class="border-2 border-white px-8 py-4 rounded-full font-bold text-center hover:bg-white hover:text-primary transition transform hover:scale-105">
                        VIEW PREMIUM PLANS
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="https://cdn-icons-png.flaticon.com/512/3659/3659899.png" alt="Music illustration" class="w-64 md:w-96 floating">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-primary">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-16">Why choose Harmony?</h2>

            <div class="grid md:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div class="bg-secondary bg-opacity-20 p-8 rounded-xl hover:bg-opacity-30 transition">
                    <div class="w-16 h-16 bg-accent rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-music text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Your music, everywhere</h3>
                    <p class="text-gray-300">
                        Listen on your computer, mobile, tablet and other devices. Download your favorites to listen offline.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-secondary bg-opacity-20 p-8 rounded-xl hover:bg-opacity-30 transition">
                    <div class="w-16 h-16 bg-accent rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-sliders-h text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Perfect sound</h3>
                    <p class="text-gray-300">
                        Adjust the sound to your preferences with our equalizer. Set the perfect balance with our audio settings.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-secondary bg-opacity-20 p-8 rounded-xl hover:bg-opacity-30 transition">
                    <div class="w-16 h-16 bg-accent rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-heart text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Made for you</h3>
                    <p class="text-gray-300">
                        Get personalized recommendations based on your taste. Discover new music you'll love.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Premium Section -->
    <section class="py-20 bg-gradient-to-r from-primary to-secondary">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-12 md:mb-0">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Go Premium. Be happy.</h2>
                    <p class="text-xl mb-8 text-gray-100">
                        Listen without limits on your phone, speaker, and other devices.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <div class="bg-white bg-opacity-10 p-4 rounded-lg backdrop-blur-sm">
                            <h4 class="font-bold mb-2">Individual</h4>
                            <p class="text-gray-300 mb-2">$9.99/month</p>
                            <button class="bg-accent text-primary px-4 py-2 rounded-full text-sm font-bold hover:bg-lightaccent transition">
                                TRY FOR FREE
                            </button>
                        </div>
                        <div class="bg-white bg-opacity-10 p-4 rounded-lg backdrop-blur-sm">
                            <h4 class="font-bold mb-2">Duo</h4>
                            <p class="text-gray-300 mb-2">$12.99/month</p>
                            <button class="bg-accent text-primary px-4 py-2 rounded-full text-sm font-bold hover:bg-lightaccent transition">
                                TRY FOR FREE
                            </button>
                        </div>
                        <div class="bg-white bg-opacity-10 p-4 rounded-lg backdrop-blur-sm">
                            <h4 class="font-bold mb-2">Family</h4>
                            <p class="text-gray-300 mb-2">$15.99/month</p>
                            <button class="bg-accent text-primary px-4 py-2 rounded-full text-sm font-bold hover:bg-lightaccent transition">
                                TRY FOR FREE
                            </button>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/2933/2933245.png" alt="Premium illustration" class="w-64 md:w-80">
                </div>
            </div>
        </div>
    </section>

    <!-- App Download Section -->
    <section class="py-20 bg-primary">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-12 md:mb-0 flex justify-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/2965/2965300.png" alt="Mobile app" class="w-64 md:w-80">
                </div>
                <div class="md:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Even better on the app</h2>
                    <p class="text-xl mb-8 text-gray-100">
                        Download the Harmony app and take your music anywhere.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#" class="bg-black text-white px-6 py-3 rounded-lg flex items-center justify-center hover:bg-gray-900 transition">
                            <i class="fab fa-apple text-2xl mr-3"></i>
                            <div>
                                <div class="text-xs">Download on the</div>
                                <div class="text-lg font-semibold">App Store</div>
                            </div>
                        </a>
                        <a href="#" class="bg-black text-white px-6 py-3 rounded-lg flex items-center justify-center hover:bg-gray-900 transition">
                            <i class="fab fa-google-play text-2xl mr-3"></i>
                            <div>
                                <div class="text-xs">Get it on</div>
                                <div class="text-lg font-semibold">Google Play</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-secondary">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to start listening?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Sign up now to enjoy unlimited music with Harmony. No credit card required.
            </p>
            <a href="/signup" class="bg-accent text-primary px-8 py-4 rounded-full font-bold inline-block hover:bg-lightaccent transition transform hover:scale-105">
                GET HARMONY FREE
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary border-t border-secondary py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-8 md:mb-0">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-music text-lightest text-2xl mr-2"></i>
                        <span class="text-xl font-bold text-lightest">Harmony</span>
                    </div>
                    <div class="flex space-x-4 mb-4">
                        <a href="#" class="text-gray-400 hover:text-lightest"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-lightest"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-lightest"><i class="fab fa-facebook text-xl"></i></a>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div>
                        <h4 class="text-gray-400 uppercase text-sm font-bold mb-4">Company</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-lightaccent">About</a></li>
                            <li><a href="#" class="hover:text-lightaccent">Jobs</a></li>
                            <li><a href="#" class="hover:text-lightaccent">For the Record</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-gray-400 uppercase text-sm font-bold mb-4">Communities</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-lightaccent">For Artists</a></li>
                            <li><a href="#" class="hover:text-lightaccent">Developers</a></li>
                            <li><a href="#" class="hover:text-lightaccent">Advertising</a></li>
                            <li><a href="#" class="hover:text-lightaccent">Investors</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-gray-400 uppercase text-sm font-bold mb-4">Useful links</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-lightaccent">Support</a></li>
                            <li><a href="#" class="hover:text-lightaccent">Web Player</a></li>
                            <li><a href="#" class="hover:text-lightaccent">Free Mobile App</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-gray-400 uppercase text-sm font-bold mb-4">Legal</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-lightaccent">Privacy Center</a></li>
                            <li><a href="#" class="hover:text-lightaccent">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-lightaccent">Cookies</a></li>
                            <li><a href="#" class="hover:text-lightaccent">About Ads</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-t border-secondary mt-12 pt-8 text-gray-400 text-sm">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <a href="#" class="hover:text-lightaccent">Legal</a>
                        <a href="#" class="hover:text-lightaccent ml-4">Privacy Center</a>
                        <a href="#" class="hover:text-lightaccent ml-4">Privacy Policy</a>
                        <a href="#" class="hover:text-lightaccent ml-4">Cookies</a>
                    </div>
                    <div>
                        &copy; 2023 Harmony Music
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Simple animation for premium cards on hover
        const premiumCards = document.querySelectorAll('.bg-white\\/10');
        premiumCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('shadow-lg');
                card.classList.add('transform');
                card.classList.add('scale-105');
            });
            card.addEventListener('mouseleave', () => {
                card.classList.remove('shadow-lg');
                card.classList.remove('transform');
                card.classList.remove('scale-105');
            });
        });
    </script>
</body>
</html>
