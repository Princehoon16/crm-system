<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Your App</title>
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
        
        .backdrop-blur-lg {
            backdrop-filter: blur(16px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full" x-data="{ email: '' }">
        <!-- Background decoration -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-32 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float"></div>
            <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float" style="animation-delay: -2s;"></div>
            <div class="absolute top-40 left-1/2 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float" style="animation-delay: -4s;"></div>
        </div>

        <!-- Password Reset Card -->
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/60 overflow-hidden relative z-10">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-orange-500 to-red-600 px-8 py-8 text-center relative overflow-hidden">
                <!-- Animated background elements -->
                <div class="absolute top-0 left-0 w-full h-full opacity-10">
                    <div class="absolute top-4 left-10 w-12 h-12 bg-white rounded-full"></div>
                    <div class="absolute bottom-4 right-12 w-8 h-8 bg-white rounded-full"></div>
                    <div class="absolute top-1/2 left-1/3 w-6 h-6 bg-white rounded-full"></div>
                </div>
                
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>
                
                <h2 class="text-3xl font-bold text-white mb-3 relative z-10">Reset Password</h2>
                <p class="text-orange-100 relative z-10">We'll send you a reset link to your email</p>
            </div>

            <!-- Password Reset Form -->
            <div class="p-8 space-y-6">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Information Card -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-blue-700 leading-relaxed">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-3">
                        <label for="email" class=" text-sm font-semibold text-gray-800 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Email Address
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                x-model="email"
                                :value="old('email')" 
                                required 
                                autofocus
                                autocomplete="email"
                                class="form-input block w-full pl-10 pr-4 py-3.5 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200 bg-white/50" 
                                placeholder="Enter your email address"
                                x-bind:class="{ 'border-green-400 bg-green-50/30': /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) }"
                            />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <div x-show="/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)" class="text-green-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col space-y-4">
                        <button 
                            type="submit" 
                            class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
                            x-bind:disabled="!email"
                            x-bind:class="email ? 'cursor-pointer' : 'cursor-not-allowed opacity-50'"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Send Reset Link
                        </button>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 font-medium transition duration-200 group">
                                <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-gray-600 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Back to Sign In
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Additional Help -->
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 mt-6">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-gray-800 mb-1">Need help?</h4>
                            <p class="text-xs text-gray-600">
                                If you don't receive the email within a few minutes, please check your spam folder or 
                                <a href="{{ route('support') }}" class="text-blue-600 hover:text-blue-500 font-medium">contact support</a>.
                            </p>
                        </div>
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
        // Additional form enhancements
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            
            if (emailInput) {
                // Add input animation
                emailInput.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-blue-500', 'ring-opacity-20');
                });
                
                emailInput.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-20');
                });
            }
        });
    </script>
</body>
</html>