<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-2 sm:space-y-0">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">My Dashboard</h2>
                <p class="text-sm text-gray-600 mt-1">Welcome back, {{ Auth::user()->name }}! Here's your personal overview.</p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                    User Account
                </span>
                <div class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-lg">
                    {{ \Carbon\Carbon::now()->format('M j, Y • g:i A') }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            
            <!-- User Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- My Orders -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl shadow-xl transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-blue-100 text-sm font-medium">MY ORDERS</p>
                                <p class="text-3xl font-bold mt-2 animate-pulse">
                                    {{ $userStats['total_orders'] }}
                                </p>
                                <p class="text-blue-100 text-sm mt-1">
                                    {{ $userStats['pending_orders'] }} pending
                                </p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support Tickets -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl shadow-xl transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-green-100 text-sm font-medium">SUPPORT TICKETS</p>
                                <p class="text-3xl font-bold mt-2">
                                    {{ $userStats['support_tickets'] }}
                                </p>
                                <p class="text-green-100 text-sm mt-1">
                                    {{ $userStats['open_tickets'] }} open
                                </p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wallet Balance -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-2xl shadow-xl transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-purple-100 text-sm font-medium">WALLET BALANCE</p>
                                <p class="text-3xl font-bold mt-2">
                                    ₹{{ number_format($userStats['wallet_balance']) }}
                                </p>
                                <p class="text-purple-100 text-sm mt-1">Available funds</p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rewards Points -->
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-2xl shadow-xl transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-orange-100 text-sm font-medium">REWARDS POINTS</p>
                                <p class="text-3xl font-bold mt-2">
                                    {{ number_format($userStats['reward_points']) }}
                                </p>
                                <p class="text-orange-100 text-sm mt-1">Loyalty points</p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Column - Recent Orders & Activity -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Recent Orders - DYNAMIC -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
                            <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                                View All ({{ $userStats['total_orders'] }})
                            </a>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @forelse($recentOrders as $order)
                            <div class="p-4 hover:bg-gray-50 transition duration-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Order #{{ $order->id }}</p>
                                        <p class="text-sm text-gray-500">{{ $order->created_at->format('M j, Y • g:i A') }}</p>
                                        @if($order->notes)
                                        <p class="text-xs text-gray-400 mt-1">{{ Str::limit($order->notes, 50) }}</p>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-bold text-gray-900">₹{{ number_format($order->total_amount) }}</p>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                            {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                               ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($order->status == 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800')) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="p-6 text-center">
                                <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <p class="text-gray-500 mt-2">No orders yet</p>
                                <a href="#" class="inline-block mt-2 text-sm text-blue-600 hover:text-blue-500">
                                    Start Shopping →
                                </a>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Support Tickets - DYNAMIC -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">My Support Tickets</h3>
                            <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                                View All ({{ $userStats['support_tickets'] }})
                            </a>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @forelse($recentTickets as $ticket)
                            <div class="p-4 hover:bg-gray-50 transition duration-200">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <p class="text-sm font-medium text-gray-900">{{ $ticket->subject }}</p>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                                {{ $ticket->priority == 'urgent' ? 'bg-red-100 text-red-800' : 
                                                   ($ticket->priority == 'high' ? 'bg-orange-100 text-orange-800' : 
                                                   ($ticket->priority == 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800')) }}">
                                                {{ ucfirst($ticket->priority) }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($ticket->description, 100) }}</p>
                                        <div class="flex items-center justify-between">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                                {{ $ticket->status == 'open' ? 'bg-green-100 text-green-800' : 
                                                   ($ticket->status == 'in_progress' ? 'bg-blue-100 text-blue-800' : 
                                                   ($ticket->status == 'resolved' ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800')) }}">
                                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                            </span>
                                            <span class="text-xs text-gray-500">{{ $ticket->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="p-6 text-center">
                                <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                                <p class="text-gray-500 mt-2">No support tickets yet</p>
                                <a href="#" class="inline-block mt-2 text-sm text-blue-600 hover:text-blue-500">
                                    Create Ticket →
                                </a>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Support Actions -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-900">Get Help</h3>
                            </div>
                            <div class="p-6 space-y-4">
                                <a href="#" class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition duration-200 group">
                                    <div class="bg-blue-100 p-2 rounded-lg group-hover:bg-blue-200 transition duration-200">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Create Support Ticket</span>
                                </a>
                                
                                <a href="#" class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition duration-200 group">
                                    <div class="bg-green-100 p-2 rounded-lg group-hover:bg-green-200 transition duration-200">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">View FAQ</span>
                                </a>

                                <a href="#" class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition duration-200 group">
                                    <div class="bg-purple-100 p-2 rounded-lg group-hover:bg-purple-200 transition duration-200">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Live Chat</span>
                                </a>
                            </div>
                        </div>

                        <!-- Account Management -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-900">Account Management</h3>
                            </div>
                            <div class="p-6 space-y-4">
                                <a href="{{ route('profile.edit') }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition duration-200 group">
                                    <div class="bg-purple-100 p-2 rounded-lg group-hover:bg-purple-200 transition duration-200">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Edit Profile</span>
                                </a>
                                
                                <a href="#" class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition duration-200 group">
                                    <div class="bg-orange-100 p-2 rounded-lg group-hover:bg-orange-200 transition duration-200">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Account Settings</span>
                                </a>

                                <a href="#" class="flex items-center p-3 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition duration-200 group">
                                    <div class="bg-blue-100 p-2 rounded-lg group-hover:bg-blue-200 transition duration-200">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Security Settings</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Profile & Notifications -->
                <div class="space-y-6">
                    
                    <!-- User Profile -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900">My Profile</h3>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-xl font-semibold">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-lg font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        Member since {{ Auth::user()->created_at->format('M Y') }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mt-6 space-y-3">
                                <div class="flex justify-between items-center text-sm p-2 hover:bg-gray-50 rounded">
                                    <span class="text-gray-600">Account Status</span>
                                    <span class="font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full text-xs">Active</span>
                                </div>
                                <div class="flex justify-between items-center text-sm p-2 hover:bg-gray-50 rounded">
                                    <span class="text-gray-600">Email Verified</span>
                                    <span class="font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full text-xs">Verified</span>
                                </div>
                                <div class="flex justify-between items-center text-sm p-2 hover:bg-gray-50 rounded">
                                    <span class="text-gray-600">Phone Verified</span>
                                    <span class="font-medium text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full text-xs">Pending</span>
                                </div>
                                <div class="flex justify-between items-center text-sm p-2 hover:bg-gray-50 rounded">
                                    <span class="text-gray-600">Total Orders</span>
                                    <span class="font-medium text-blue-600">{{ $userStats['total_orders'] }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm p-2 hover:bg-gray-50 rounded">
                                    <span class="text-gray-600">Support Tickets</span>
                                    <span class="font-medium text-orange-600">{{ $userStats['support_tickets'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Notifications -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Notifications</h3>
                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                {{ count($recentTickets) + count($recentOrders) }} total
                            </span>
                        </div>
                        <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                            <!-- Order Notifications -->
                            @foreach($recentOrders->take(2) as $order)
                            <div class="flex space-x-3 p-3 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Order #{{ $order->id }}</p>
                                    <p class="text-sm text-gray-600">Status: <span class="font-medium capitalize">{{ $order->status }}</span></p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $order->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @endforeach

                            <!-- Support Ticket Notifications -->
                            @foreach($recentTickets->take(2) as $ticket)
                            <div class="flex space-x-3 p-3 bg-orange-50 rounded-lg border-l-4 border-orange-500">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">{{ Str::limit($ticket->subject, 30) }}</p>
                                    <p class="text-sm text-gray-600">Priority: <span class="font-medium capitalize">{{ $ticket->priority }}</span></p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $ticket->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @endforeach

                            <!-- System Notifications -->
                            <div class="flex space-x-3 p-3 bg-green-50 rounded-lg border-l-4 border-green-500">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Welcome to CRM!</p>
                                    <p class="text-sm text-gray-600">Your account is active and ready to use</p>
                                    <p class="text-xs text-gray-500 mt-1">Just now</p>
                                </div>
                            </div>

                            @if(count($recentOrders) == 0 && count($recentTickets) == 0)
                            <div class="text-center py-4">
                                <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-gray-500 mt-2">No notifications</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-gradient-to-br from-purple-500 to-pink-600 text-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                Quick Stats
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-purple-100">This Month Orders</span>
                                    <span class="font-bold">{{ $recentOrders->where('created_at', '>=', now()->startOfMonth())->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-purple-100">Active Tickets</span>
                                    <span class="font-bold">{{ $userStats['open_tickets'] }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-purple-100">Success Rate</span>
                                    <span class="font-bold">
                                        @php
                                            $completedOrders = $recentOrders->where('status', 'completed')->count();
                                            $totalOrders = $recentOrders->count();
                                            $successRate = $totalOrders > 0 ? round(($completedOrders / $totalOrders) * 100) : 0;
                                        @endphp
                                        {{ $successRate }}%
                                    </span>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-purple-400 border-opacity-30">
                                <a href="#" class="inline-block w-full bg-white text-purple-600 text-center px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100 transition duration-200">
                                    View Detailed Report
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
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
        
        .transform {
            transition-property: transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
    </style>
</x-app-layout>