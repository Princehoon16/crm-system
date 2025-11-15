<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - {{ config('app.name') }}</title>
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
        
        .password-strength {
            transition: all 0.3s ease;
        }
        
        .backdrop-blur-lg {
            backdrop-filter: blur(16px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full" x-data="{
        password: '',
        confirmPassword: '',
        showPassword: false,
        showConfirmPassword: false,
        passwordStrength: 0,
        checkPasswordStrength() {
            let strength = 0;
            if (this.password.length >= 8) strength += 25;
            if (this.password.match(/[a-z]+/)) strength += 25;
            if (this.password.match(/[A-Z]+/)) strength += 25;
            if (this.password.match(/[0-9]+/)) strength += 25;
            this.passwordStrength = strength;
        }
    }" x-init="checkPasswordStrength()">
        
        <!-- Background decoration -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-32 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float"></div>
            <div class="absolute -bottom-40 -left-32 w-80 h-80 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float" style="animation-delay: -2s;"></div>
            <div class="absolute top-40 left-1/2 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float" style="animation-delay: -4s;"></div>
        </div>

        <!-- Reset Password Card -->
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/60 overflow-hidden relative z-10">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-8 text-center relative overflow-hidden">
                <!-- Animated background elements -->
                <div class="absolute top-0 left-0 w-full h-full opacity-10">
                    <div class="absolute top-4 left-10 w-12 h-12 bg-white rounded-full"></div>
                    <div class="absolute bottom-4 right-12 w-8 h-8 bg-white rounded-full"></div>
                    <div class="absolute top-1/2 left-1/3 w-6 h-6 bg-white rounded-full"></div>
                </div>
                
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                    </div>
                </div>
                
                <h2 class="text-3xl font-bold text-white mb-3 relative z-10">Reset Password</h2>
                <p class="text-green-100 relative z-10">Create your new secure password</p>
            </div>

            <!-- Reset Password Form -->
            <div class="p-8 space-y-6">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 border border-green-200 rounded-xl p-4">
                        {{ session('status') }}
                    </div>
                @endif

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
                                Create a strong password with at least 8 characters including uppercase, lowercase, numbers, and special characters.
                            </p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ session('reset_password_token') ?? $request->route('token') }}">

                    <!-- Email Address (Hidden but included) -->
                    <input type="hidden" name="email" value="{{ session('reset_password_email') ?? old('email', $request->email) }}">

                    <!-- Email Display (Read-only) -->
                    <div class="space-y-3">
                        <label class="text-sm font-semibold text-gray-800 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Account Email
                        </label>
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                            <p class="text-sm font-medium text-gray-700">{{ session('reset_password_email') ?? old('email', $request->email) }}</p>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="space-y-3">
                        <label for="password" class="text-sm font-semibold text-gray-800 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            New Password
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input 
                                id="password" 
                                x-model="password"
                                x-on:input="checkPasswordStrength()"
                                :type="showPassword ? 'text' : 'password'"
                                name="password" 
                                required 
                                autocomplete="new-password"
                                class="form-input block w-full pl-10 pr-12 py-3.5 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200 bg-white/50" 
                                placeholder="Enter your new password"
                            />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" @click="showPassword = !showPassword" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Password Strength Meter -->
                        <div class="space-y-2" x-show="password.length > 0">
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-gray-600">Password strength</span>
                                <span x-text="passwordStrength === 100 ? 'Strong' : passwordStrength >= 75 ? 'Good' : passwordStrength >= 50 ? 'Fair' : 'Weak'" 
                                      :class="{
                                          'text-red-500': passwordStrength < 50,
                                          'text-yellow-500': passwordStrength >= 50 && passwordStrength < 75,
                                          'text-blue-500': passwordStrength >= 75 && passwordStrength < 100,
                                          'text-green-500': passwordStrength === 100
                                      }"></span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full transition-all duration-300 password-strength"
                                     :class="{
                                         'bg-red-500 w-1/4': passwordStrength < 50,
                                         'bg-yellow-500 w-1/2': passwordStrength >= 50 && passwordStrength < 75,
                                         'bg-blue-500 w-3/4': passwordStrength >= 75 && passwordStrength < 100,
                                         'bg-green-500 w-full': passwordStrength === 100
                                     }"></div>
                            </div>
                        </div>

                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-3">
                        <label for="password_confirmation" class="text-sm font-semibold text-gray-800 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Confirm New Password
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <input 
                                id="password_confirmation" 
                                x-model="confirmPassword"
                                :type="showConfirmPassword ? 'text' : 'password'"
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                class="form-input block w-full pl-10 pr-12 py-3.5 border border-gray-300 rounded-xl focus:outline-none transition-all duration-200 bg-white/50" 
                                placeholder="Confirm your new password"
                                :class="{ 'border-green-400 bg-green-50/30': password === confirmPassword && confirmPassword.length > 0 }"
                            />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center space-x-2">
                                <div x-show="password === confirmPassword && confirmPassword.length > 0" class="text-green-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                                    <svg x-show="!showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg x-show="showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col space-y-4">
                        <button 
                            type="submit" 
                            class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
                            x-bind:disabled="!password || !confirmPassword || password !== confirmPassword"
                            x-bind:class="(password && confirmPassword && password === confirmPassword) ? 'cursor-pointer' : 'cursor-not-allowed opacity-50'"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Reset Password
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
            </div>
        </div>
        
        <!-- Footer Note -->
        <div class="text-center mt-6 text-gray-600 text-sm relative z-10">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Additional form enhancements
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input[type="password"], input[type="email"]');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-blue-500', 'ring-opacity-20');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-20');
                });
            });
        });
    </script>
</body>
</html>