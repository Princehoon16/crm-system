<section class="space-y-6">
    <!-- Header with Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-4 text-center">
            <div class="w-10 h-10 bg-blue-500 text-white rounded-lg flex items-center justify-center text-sm font-bold mx-auto mb-2">
                👤
            </div>
            <h3 class="text-sm font-semibold text-gray-900 mb-1">Profile Complete</h3>
            <p class="text-xs text-blue-600 font-medium">{{ $user->name ? '100%' : '50%' }} Updated</p>
        </div>
        
        <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl p-4 text-center">
            <div class="w-10 h-10 bg-green-500 text-white rounded-lg flex items-center justify-center text-sm font-bold mx-auto mb-2">
                ✉️
            </div>
            <h3 class="text-sm font-semibold text-gray-900 mb-1">Email Status</h3>
            <p class="text-xs {{ $user->hasVerifiedEmail() ? 'text-green-600' : 'text-orange-600' }} font-medium">
                {{ $user->hasVerifiedEmail() ? 'Verified' : 'Pending' }}
            </p>
        </div>
        
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl p-4 text-center">
            <div class="w-10 h-10 bg-purple-500 text-white rounded-lg flex items-center justify-center text-sm font-bold mx-auto mb-2">
                📅
            </div>
            <h3 class="text-sm font-semibold text-gray-900 mb-1">Member Since</h3>
            <p class="text-xs text-purple-600 font-medium">{{ $user->created_at->format('M Y') }}</p>
        </div>
    </div>

    <!-- Profile Update Form -->
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <form method="post" action="{{ route('profile.update') }}" class="p-6 space-y-6">
            @csrf
            @method('patch')

            <!-- Name Field -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <label for="name" class="block text-sm font-semibold text-gray-800 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Full Name
                    </label>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">Required</span>
                </div>
                <div class="relative group">
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        class="w-full pl-4 pr-10 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/70 backdrop-blur-sm"
                        :value="old('name', $user->name)" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="Enter your full name"
                        x-data="{ value: '{{ old('name', $user->name) }}' }"
                        x-model="value"
                        x-bind:class="{ 'border-green-400 bg-green-50/30': value.length > 2, 'border-gray-300': value.length <= 2 }"
                    />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <div x-show="value.length > 2" class="text-green-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Email Field -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <label for="email" class="block text-sm font-semibold text-gray-800 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Email Address
                    </label>
                    <span class="text-xs {{ $user->hasVerifiedEmail() ? 'text-green-600 bg-green-100' : 'text-orange-600 bg-orange-100' }} px-2 py-1 rounded-full font-medium">
                        {{ $user->hasVerifiedEmail() ? '✓ Verified' : '⚠ Unverified' }}
                    </span>
                </div>
                <div class="relative group">
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        class="w-full pl-4 pr-10 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/70 backdrop-blur-sm"
                        :value="old('email', $user->email)" 
                        required 
                        autocomplete="email"
                        placeholder="Enter your email address"
                        x-data="{ value: '{{ old('email', $user->email) }}' }"
                        x-model="value"
                        x-bind:class="{ 'border-green-400 bg-green-50/30': /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value), 'border-gray-300': !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value) }"
                    />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <div x-show="/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)" class="text-green-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                <!-- Email Verification Section -->
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="bg-gradient-to-r from-orange-50 to-amber-50 border border-orange-200 rounded-xl p-4 mt-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-orange-800 mb-1">Email Verification Required</h4>
                                <p class="text-sm text-orange-700 mb-3">
                                    {{ __('Your email address is unverified. Please verify your email to access all features.') }}
                                </p>
                                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg text-sm font-medium hover:bg-orange-600 transition duration-200 shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        {{ __('Resend Verification Email') }}
                                    </button>
                                </form>
                                
                                @if (session('status') === 'verification-link-sent')
                                    <div class="mt-3 flex items-center space-x-2 text-sm text-green-600 font-medium bg-green-50 px-3 py-2 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span>{{ __('A new verification link has been sent to your email address.') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 mt-3">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-green-800">Your email address is verified and secure.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Profile Tips -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-5">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-blue-800 mb-2">Profile Best Practices</h4>
                        <ul class="text-xs text-blue-700 space-y-1.5">
                            <li class="flex items-center">
                                <svg class="w-3 h-3 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Use your real name for better recognition and communication
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3 h-3 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Keep your email address current to receive important notifications
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3 h-3 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Ensure your email is verified for full account functionality
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:items-center gap-4 pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-500 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Last updated: 
                    <span class="font-medium text-gray-700 ml-1">
                        {{ $user->updated_at->diffForHumans() }}
                    </span>
                </div>
                
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    @if (session('status') === 'profile-updated')
                        <div
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 4000)"
                            class="flex items-center space-x-2 px-4 py-2.5 bg-green-50 text-green-700 rounded-lg text-sm font-medium border border-green-200"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>{{ __('Profile updated successfully!') }}</span>
                        </div>
                    @endif

                    <button type="submit" class="inline-flex items-center justify-center space-x-2 px-6 py-3.5 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 rounded-xl text-white font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        <span>{{ __('Save Changes') }}</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<style>
    input:focus {
        outline: none;
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }
    
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
    }
    
    .transform {
        transition: transform 0.2s ease;
    }
</style>

<script>
    document.addEventListener('alpine:init', () => {
        // Real-time validation will be handled by Alpine.js data binding
    });
</script>