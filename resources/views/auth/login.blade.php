<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Your App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            border-color: #6366f1;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full" x-data="{ showPassword: false }">
        <!-- Background decoration -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-32 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float"></div>
            <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float" style="animation-delay: -2s;"></div>
            <div class="absolute top-40 left-1/2 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float" style="animation-delay: -4s;"></div>
        </div>

        <!-- Login Card -->
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/60 overflow-hidden relative z-10">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-700 px-8 py-8 text-center relative overflow-hidden">
                <!-- Animated background elements -->
                <div class="absolute top-0 left-0 w-full h-full opacity-10">
                    <div class="absolute top-4 left-10 w-12 h-12 bg-white rounded-full"></div>
                    <div class="absolute bottom-4 right-12 w-8 h-8 bg-white rounded-full"></div>
                    <div class="absolute top-1/2 left-1/3 w-6 h-6 bg-white rounded-full"></div>
                </div>
                
                <h2 class="text-3xl font-bold text-white mb-3 relative z-10">Welcome Back</h2>
                <p class="text-blue-100 relative z-10">Sign in to your account to continue</p>
            </div>

            <!-- Login Form -->
            <div class="p-8 space-y-6">
                <!-- Session Status -->
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="hidden">
                    <!-- This will be populated by x-auth-session-status -->
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-3">
                        <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required 
                                autofocus 
                                autocomplete="email"
                                class="form-input block w-full pl-10 pr-4 py-3.5 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200 bg-white/50" 
                                placeholder="Enter your email address"
                            >
                        </div>
                        <div class="text-sm text-red-600 mt-1 min-h-[20px]">
                            <!-- Error messages will appear here -->
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-sm text-blue-600 hover:text-blue-500 font-medium transition duration-200 hover:underline" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input 
                                id="password" 
                                x-bind:type="showPassword ? 'text' : 'password'"
                                name="password"
                                required 
                                autocomplete="current-password"
                                class="form-input block w-full pl-10 pr-12 py-3.5 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200 bg-white/50" 
                                placeholder="Enter your password"
                            >
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" @click="showPassword = !showPassword" class="text-gray-400 hover:text-blue-500 focus:outline-none transition-colors duration-200">
                                    <svg x-show="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="text-sm text-red-600 mt-1 min-h-[20px]">
                            <!-- Error messages will appear here -->
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-2">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <div class="relative">
                                <input 
                                    id="remember_me" 
                                    type="checkbox" 
                                    class="sr-only" 
                                    name="remember"
                                >
                                <div class="w-4 h-4 border-2 border-gray-300 rounded-sm bg-white group-hover:border-blue-400 transition-colors duration-200 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-blue-600 opacity-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-800 transition-colors duration-200">Remember me</span>
                        </label>
                    </div>

                    <!-- Login Button -->
                    <div class="pt-4">
                        <button 
                            type="submit" 
                            class="w-full flex justify-center items-center py-4 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-purple-700 hover:from-blue-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Sign in to your account
                        </button>
                    </div>
                </form>

                <!-- Register Link -->
                @if (Route::has('register'))
                    <div class="text-center pt-6 border-t border-gray-200/60">
                        <p class="text-sm text-gray-600">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-500 transition duration-200 hover:underline">
                                Create one now
                            </a>
                        </p>
                    </div>
                @endif

                <!-- Social Login -->
                <div class="pt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300/50"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-3 bg-white/80 text-gray-500">Or continue with</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 grid grid-cols-3 gap-3">
                        <a href="{{ url('/auth/google') }}" class="w-full inline-flex justify-center py-3 px-4 border border-gray-300/70 rounded-xl shadow-sm bg-white/50 text-sm font-medium text-gray-700 hover:bg-white transition-all duration-200 transform hover:scale-105">
                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12.24 10.285V14.4h6.806c-.275 1.765-2.056 5.174-6.806 5.174-4.095 0-7.439-3.389-7.439-7.574s3.345-7.574 7.439-7.574c2.33 0 3.891.989 4.785 1.849l3.254-3.138C18.189 1.186 15.479 0 12.24 0c-6.635 0-12 5.365-12 12s5.365 12 12 12c6.926 0 11.52-4.869 11.52-11.726 0-.788-.085-1.39-.189-1.989H12.24z"/>
                            </svg>
                        </a>
                        <a href="{{ url('/auth/facebook') }}" class="w-full inline-flex justify-center py-3 px-4 border border-gray-300/70 rounded-xl shadow-sm bg-white/50 text-sm font-medium text-gray-700 hover:bg-white transition-all duration-200 transform hover:scale-105">
                            <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="{{ url('/auth/twitter') }}" class="w-full inline-flex justify-center py-3 px-4 border border-gray-300/70 rounded-xl shadow-sm bg-white/50 text-sm font-medium text-gray-700 hover:bg-white transition-all duration-200 transform hover:scale-105">
                            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Note -->
        <div class="text-center mt-6 text-gray-600 text-sm relative z-10">
            <p>© {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Custom checkbox behavior
        document.addEventListener('DOMContentLoaded', function() {
            const rememberMeCheckbox = document.getElementById('remember_me');
            const rememberMeVisual = rememberMeCheckbox.nextElementSibling;
            
            rememberMeCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    rememberMeVisual.querySelector('svg').classList.remove('opacity-0');
                } else {
                    rememberMeVisual.querySelector('svg').classList.add('opacity-0');
                }
            });
            
            // Initialize checkbox state
            if (rememberMeCheckbox.checked) {
                rememberMeVisual.querySelector('svg').classList.remove('opacity-0');
            }
        });
    </script>
</body>
</html>