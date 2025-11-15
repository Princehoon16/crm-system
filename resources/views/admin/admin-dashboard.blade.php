<x-app-layout>
    <x-slot name="header">
    <div class="w-full bg-white border-b border-gray-200">
        <div class="w-full px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex w-full flex-col sm:flex-row justify-between items-start sm:items-center space-y-2 sm:space-y-0">
                <div class="animate-fade-in">
                    <h2 class="text-2xl font-bold text-gray-900">Admin Dashboard</h2>
                    <p class="text-sm text-gray-600 mt-1">System overview and management</p>
                </div>
                <div class="flex items-center space-x-3 animate-slide-in-right">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 animate-pulse">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        Admin Access
                    </span>
                    <div class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-lg">
                        {{ \Carbon\Carbon::now()->format('M j, Y • g:i A') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-slot>

    <div class="py-6">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            
            <!-- Admin Stats Grid with Dynamic Data -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
                @php
                    $dashboardStats = [
                        [
                            'title' => 'TOTAL USERS',
                            'value' => $stats['total_users'],
                            'subtitle' => $stats['new_users_this_month'] . ' new this month',
                            'gradient' => 'from-blue-500 to-blue-600',
                            'icon' => 'users'
                        ],
                        [
                            'title' => 'TOTAL REVENUE', 
                            'value' => '₹' . number_format($stats['total_revenue']),
                            'subtitle' => $stats['monthly_transactions'] . ' transactions',
                            'gradient' => 'from-green-500 to-green-600',
                            'icon' => 'currency'
                        ],
                        [
                            'title' => 'ACTIVE PROJECTS',
                            'value' => $stats['active_projects'],
                            'subtitle' => $stats['pending_orders'] . ' pending',
                            'gradient' => 'from-purple-500 to-purple-600', 
                            'icon' => 'projects'
                        ],
                        [
                            'title' => 'SYSTEM HEALTH',
                            'value' => $stats['system_health'] . '%',
                            'subtitle' => $stats['system_health'] >= 90 ? 'All systems operational' : 'Some issues detected',
                            'gradient' => $stats['system_health'] >= 90 ? 'from-green-500 to-green-600' : 
                                         ($stats['system_health'] >= 80 ? 'from-yellow-500 to-yellow-600' : 'from-red-500 to-red-600'),
                            'icon' => 'health'
                        ]
                    ];
                @endphp
                
                @foreach($dashboardStats as $index => $stat)
                <div class="bg-gradient-to-br {{ $stat['gradient'] }} text-white rounded-2xl shadow-xl transform hover:scale-105 transition-all duration-300 animate-fade-in-up" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-opacity-90 text-sm font-medium">{{ $stat['title'] }}</p>
                                <p class="text-3xl font-bold mt-2 animate-count-up">{{ $stat['value'] }}</p>
                                <p class="text-opacity-90 text-sm mt-1">
                                    {{ $stat['subtitle'] }}
                                </p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-3 rounded-xl animate-bounce-slow">
                                <!-- Icons remain same -->
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                
                <!-- Left Column -->
                <div class="xl:col-span-2 space-y-6">
                    
                    <!-- Recent Users Table with Dynamic Data -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-left">
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Users</h3>
                            <span class="text-sm font-medium text-blue-600 animate-pulse">
                                {{ $stats['total_users'] - 1 }} Users
                            </span>
                        </div>
                        <div class="overflow-x-auto custom-scrollbar">
                            <table class="w-full min-w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($stats['recent_users'] as $user)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800' : 
                                                   ($user->role == 'sales_manager' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $user->email_verified_at ? 'Active' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->created_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                            No users found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- System Management -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Quick Actions -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-up">
                            <div class="px-6 py-4 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                            </div>
                            <div class="p-6 grid grid-cols-2 gap-4">
                                @php
                                    $actions = [
                                        ['icon' => 'users', 'label' => 'Add User', 'color' => 'blue', 'route' => '#'],
                                        ['icon' => 'settings', 'label' => 'Settings', 'color' => 'green', 'route' => '#'],
                                        ['icon' => 'reports', 'label' => 'Reports', 'color' => 'purple', 'route' => '#'],
                                        ['icon' => 'backup', 'label' => 'Backup', 'color' => 'orange', 'route' => '#']
                                    ];
                                @endphp
                                
                                @foreach($actions as $action)
                                <a href="{{ $action['route'] }}" class="p-4 border border-gray-200 rounded-lg hover:border-{{ $action['color'] }}-500 hover:bg-{{ $action['color'] }}-50 transition-all duration-300 transform hover:scale-105 text-center group animate-fade-in-up">
                                    <!-- Icons remain same -->
                                    <span class="block mt-2 text-sm font-medium text-gray-700 group-hover:text-{{ $action['color'] }}-700 transition-colors duration-300">{{ $action['label'] }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- System Status with Dynamic Data -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-up" style="animation-delay: 0.2s">
                            <div class="px-6 py-4 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-900">System Status</h3>
                                <p class="text-sm text-gray-600 mt-1">Live system monitoring</p>
                            </div>
                            <div class="p-6 space-y-4">
                                @foreach($stats['system_stats'] as $label => $stat)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 rounded-full
                                            {{ $stat['status'] == 'online' ? 'bg-green-500' : 
                                               ($stat['status'] == 'warning' ? 'bg-yellow-500' : 'bg-red-500') }}"></div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-700">{{ ucfirst($label) }}</span>
                                            @if(isset($stat['size']))
                                            <span class="text-xs text-gray-500 block">{{ $stat['size'] }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="text-sm {{ $stat['status'] == 'online' ? 'text-green-600' : 'text-yellow-600' }} font-medium">
                                        {{ $stat['value'] }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    
                    <!-- Admin Profile -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-right">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900">Admin Profile</h3>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white text-xl font-semibold">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-lg font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        Administrator • {{ Auth::user()->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mt-6 space-y-3">
                                <a href="{{ route('profile.edit') }}" class="w-full flex items-center justify-center p-3 border border-gray-300 rounded-lg text-gray-700 hover:border-blue-500 hover:text-blue-600 transition-all duration-300">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Manage Profile
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity with Dynamic Data -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-right" style="animation-delay: 0.1s">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
                            <p class="text-sm text-gray-600 mt-1">System activities log</p>
                        </div>
                        <div class="p-6 space-y-4">
                            @forelse($stats['admin_activities'] as $index => $activity)
                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-200 animate-fade-in-right" style="animation-delay: {{ 0.2 + ($index * 0.1) }}s">
                                <span class="text-lg">{{ $activity['icon'] }}</span>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $activity['action'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $activity['time'] }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center text-gray-500 py-4">
                                No recent activities
                            </div>
                            @endforelse
                        </div>
                    </div>

                   
                    <!-- System Status Overview -->
<div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl shadow-xl overflow-hidden animate-fade-in-right" style="animation-delay: 0.3s">
    <div class="px-6 py-4 border-b border-orange-400 border-opacity-30">
        <h3 class="text-lg font-semibold text-white flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            System Overview
        </h3>
    </div>
    <div class="p-6">
        <div class="space-y-4">
            @php
                $systemOverview = [
                    [
                        'title' => 'Storage Usage',
                        'message' => '75% of storage used',
                        'value' => '75%',
                        'status' => 'Warning',
                        'type' => 'warning',
                        'titleColor' => 'text-yellow-300',
                        'textColor' => 'text-yellow-200'
                    ],
                    [
                        'title' => 'Active Users',
                        'message' => $stats['total_users'] . ' users online',
                        'value' => $stats['total_users'],
                        'status' => 'Good',
                        'type' => 'success',
                        'titleColor' => 'text-green-300', 
                        'textColor' => 'text-green-200'
                    ],
                    [
                        'title' => 'System Load',
                        'message' => 'Optimal performance',
                        'value' => '28%',
                        'status' => 'Good',
                        'type' => 'success',
                        'titleColor' => 'text-green-300',
                        'textColor' => 'text-green-200'
                    ]
                ];
            @endphp
            
            @foreach($systemOverview as $alert)
            <div class="flex items-center justify-between p-4 bg-white bg-opacity-15 rounded-xl backdrop-blur-sm hover:bg-opacity-25 transition-all duration-300">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full
                        {{ $alert['type'] == 'success' ? 'bg-green-400' : 
                           ($alert['type'] == 'warning' ? 'bg-yellow-400' : 'bg-red-400') }}"></div>
                    <div>
                        <span class="text-sm font-semibold {{ $alert['titleColor'] }} block">{{ $alert['title'] }}</span>
                        <span class="text-xs {{ $alert['textColor'] }}">{{ $alert['message'] }}</span>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-sm font-bold {{ $alert['titleColor'] }}">{{ $alert['value'] }}</span>
                    <span class="text-xs {{ $alert['textColor'] }} block">{{ $alert['status'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Animations CSS -->
    <style>
        /* Styles remain the same */
    </style>
</x-app-layout>