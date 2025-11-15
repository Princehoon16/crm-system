<x-app-layout>
    <x-slot name="header">
        <div class=" flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Account Settings</h2>
                    <p class="text-sm text-gray-600 mt-1">Manage your profile, security, and account preferences</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                    {{ Auth::user()->role ?? 'User' }}
                </span>
                <div class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-lg">
                    {{ \Carbon\Carbon::now()->format('M j, Y • g:i A') }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            
            <!-- Profile Overview Card -->
            <!-- Profile Overview Card - UPDATED WITH STATS FROM CONTROLLER -->
<div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl shadow-2xl p-6 mb-8 text-white">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
        <div class="flex items-center space-x-4 mb-4 lg:mb-0">
            <div class="flex-shrink-0">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center text-white text-2xl font-bold border border-white/30">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
            <div>
                <h3 class="text-2xl font-bold">{{ Auth::user()->name }}</h3>
                <p class="text-blue-100 opacity-90">{{ Auth::user()->email }}</p>
                <p class="text-sm text-blue-100 opacity-80 mt-1">
                    Member since {{ Auth::user()->created_at->format('F Y') }} • 
                    <span class="font-semibold">{{ Auth::user()->hasVerifiedEmail() ? '✓ Verified' : '⚠ Unverified' }}</span>
                </p>
            </div>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 text-center">
            <!-- Orders Count from Controller -->
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                <div class="text-2xl font-bold">{{ $stats['orders_count'] }}</div>
                <div class="text-xs text-blue-100 opacity-90">Orders</div>
            </div>
            
            <!-- Tickets Count from Controller -->
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                <div class="text-2xl font-bold">{{ $stats['tickets_count'] }}</div>
                <div class="text-xs text-blue-100 opacity-90">Tickets</div>
            </div>
            
            <!-- Reward Points from Controller -->
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 border border-white/20">
                <div class="text-lg font-bold">{{ $stats['reward_points'] }}</div>
                <div class="text-xs text-blue-100 opacity-90">Reward Points</div>
            </div>
        </div>
    </div>
</div>

            <!-- Settings Navigation -->
            <div class="flex overflow-x-auto space-x-2 mb-8 pb-2 scrollbar-hide">
                <a href="#profile" class="inline-flex items-center px-4 py-2 bg-white text-blue-600 rounded-lg font-medium border border-blue-200 shadow-sm whitespace-nowrap">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profile Info
                </a>
                <a href="#security" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-600 rounded-lg font-medium border border-gray-200 hover:bg-white hover:text-blue-600 transition duration-200 whitespace-nowrap">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Security
                </a>
                <a href="#danger" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-600 rounded-lg font-medium border border-gray-200 hover:bg-white hover:text-red-600 transition duration-200 whitespace-nowrap">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Danger Zone
                </a>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="xl:col-span-2 space-y-8">
                    <!-- Profile Information Section -->
                    <div id="profile" class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-2xl">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-5 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Profile Information</h3>
                                        <p class="text-sm text-gray-600">Update your personal details and contact information</p>
                                    </div>
                                </div>
                                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse" title="Active"></div>
                            </div>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password Section -->
                    <div id="security" class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-2xl">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-5 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Security Settings</h3>
                                        <p class="text-sm text-gray-600">Manage your password and security preferences</p>
                                    </div>
                                </div>
                                <div class="w-3 h-3 bg-green-400 rounded-full" title="Active"></div>
                            </div>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
                        <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            </svg>
                            Quick Actions
                        </h4>
                        <div class="space-y-3">
                            <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition duration-200 group">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition duration-200">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700">Back to Dashboard</span>
                            </a>
                            
                            <a href="#" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-green-300 hover:bg-green-50 transition duration-200 group">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition duration-200">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700">Privacy Settings</span>
                            </a>
                            
                            <a href="#" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition duration-200 group">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition duration-200">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700">Get Help</span>
                            </a>
                        </div>
                    </div>

                    <!-- Account Status -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
                        <h4 class="font-semibold text-gray-900 mb-4">Account Status</h4>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Email Verification</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ Auth::user()->hasVerifiedEmail() ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ Auth::user()->hasVerifiedEmail() ? 'Verified' : 'Pending' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Account Created</span>
                                <span class="text-sm font-medium text-gray-900">{{ Auth::user()->created_at->format('M j, Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Last Updated</span>
                                <span class="text-sm font-medium text-gray-900">{{ Auth::user()->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Account Type</span>
                                <span class="text-sm font-medium text-gray-900 capitalize">{{ Auth::user()->role ?? 'User' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Account Section -->
                    <div id="danger" class="bg-white rounded-2xl shadow-xl border border-red-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-red-50 to-pink-50 px-6 py-5 border-b border-red-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Danger Zone</h3>
                                    <p class="text-sm text-gray-600">Permanent account actions</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
    </style>

    <script>
        // Smooth scrolling for navigation
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href^="#"]');
            
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                    
                    // Update active state
                    links.forEach(l => l.classList.remove('bg-white', 'text-blue-600', 'border-blue-200'));
                    links.forEach(l => l.classList.add('bg-gray-100', 'text-gray-600', 'border-gray-200'));
                    this.classList.remove('bg-gray-100', 'text-gray-600', 'border-gray-200');
                    this.classList.add('bg-white', 'text-blue-600', 'border-blue-200');
                });
            });
        });
    </script>
</x-app-layout>