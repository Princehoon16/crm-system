<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
            <div class="animate-fade-in">
                <h2 class="text-2xl font-bold text-gray-900">Sales Dashboard</h2>
                <p class="text-sm text-gray-600 mt-1">Sales performance and team management</p>
            </div>
            <div class="flex items-center space-x-3 animate-slide-in-right">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 animate-pulse">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                    {{ Auth::user()->role === 'sales_manager' ? 'Sales Manager' : 'Sales Representative' }}
                </span>
                <div class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-lg">
                    {{ \Carbon\Carbon::now()->format('M j, Y • g:i A') }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            
            <!-- Sales Stats Grid with Real Data -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
                @php
                    $salesStatsData = [
                        [
                            'title' => 'MONTHLY REVENUE',
                            'value' => '₹' . number_format($salesStats['monthly_revenue']),
                            'subtitle' => $salesStats['monthly_sales'] . ' sales this month',
                            'gradient' => 'from-blue-500 to-blue-600',
                            'icon' => 'currency',
                            'trend' => '+12%'
                        ],
                        [
                            'title' => 'TOTAL REVENUE', 
                            'value' => '₹' . number_format($salesStats['total_revenue']),
                            'subtitle' => 'All time earnings',
                            'gradient' => 'from-green-500 to-green-600',
                            'icon' => 'currency',
                            'trend' => '+8%'
                        ],
                        [
                            'title' => 'ACTIVE LEADS',
                            'value' => $salesStats['total_leads'],
                            'subtitle' => $salesStats['new_leads_this_week'] . ' new this week',
                            'gradient' => 'from-purple-500 to-purple-600',
                            'icon' => 'leads',
                            'trend' => '+5%'
                        ],
                        [
                            'title' => 'CONVERSION RATE',
                            'value' => round($salesStats['conversion_rate'], 1) . '%',
                            'subtitle' => 'Lead to sale conversion',
                            'gradient' => 'from-orange-500 to-orange-600',
                            'icon' => 'conversion',
                            'trend' => $salesStats['conversion_rate'] > 20 ? '+2%' : '-2%'
                        ]
                    ];
                @endphp
                
                @foreach($salesStatsData as $index => $stat)
                <div class="bg-gradient-to-br {{ $stat['gradient'] }} text-white rounded-2xl shadow-xl transform hover:scale-105 transition-all duration-300 animate-fade-in-up" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="text-opacity-90 text-sm font-medium">{{ $stat['title'] }}</p>
                                <p class="text-3xl font-bold mt-2 animate-count-up">{{ $stat['value'] }}</p>
                                <div class="flex items-center mt-1">
                                    <p class="text-opacity-90 text-sm">{{ $stat['subtitle'] }}</p>
                                    <span class="ml-2 px-2 py-1 text-xs bg-white bg-opacity-20 rounded-full">
                                        {{ $stat['trend'] }}
                                    </span>
                                </div>
                            </div>
                            <div class="bg-white bg-opacity-20 p-3 rounded-xl animate-bounce-slow">
                                @if($stat['icon'] == 'currency')
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                                @elseif($stat['icon'] == 'leads')
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                
                <!-- Left Column - Sales Data -->
                <div class="xl:col-span-2 space-y-6">
                    
                    <!-- Recent Sales with Real Data -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-left">
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Recent Sales</h3>
                                <p class="text-sm text-gray-600 mt-1">Your latest sales transactions</p>
                            </div>
                            <span class="text-sm font-medium text-blue-600">
                                {{ $salesStats['recent_sales']->count() }} Sales
                            </span>
                        </div>
                        <div class="overflow-x-auto custom-scrollbar">
                            <table class="w-full min-w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($salesStats['recent_sales'] as $sale)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200 group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                                    {{ strtoupper(substr($sale->customer_name, 0, 1)) }}
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900 group-hover:text-blue-600">
                                                        {{ $sale->customer_name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">{{ $sale->customer_email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $sale->product_service }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">₹{{ number_format($sale->amount) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $sale->sale_date->format('M j, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $sale->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                                   ($sale->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($sale->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                <p class="text-lg font-medium text-gray-900">No sales recorded yet</p>
                                                <p class="text-sm text-gray-600 mt-1">Start making sales to see them here</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Sales Tools & Team Performance -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Quick Actions -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-up">
                            <div class="px-6 py-4 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-900">Sales Tools</h3>
                                <p class="text-sm text-gray-600 mt-1">Quick access to essential tools</p>
                            </div>
                            <div class="p-6 grid grid-cols-2 gap-4">
                                @php
                                    $tools = [
                                        ['icon' => 'users', 'label' => 'Add Lead', 'color' => 'blue', 'href' => '#'],
                                        ['icon' => 'plus', 'label' => 'New Sale', 'color' => 'green', 'href' => '#'],
                                        ['icon' => 'target', 'label' => 'Set Targets', 'color' => 'purple', 'href' => '#'],
                                        ['icon' => 'currency', 'label' => 'Commissions', 'color' => 'orange', 'href' => '#'],
                                    ];
                                @endphp
                                
                                @foreach($tools as $tool)
                                <a href="{{ $tool['href'] }}" class="p-4 border-2 border-gray-200 rounded-xl hover:border-{{ $tool['color'] }}-500 hover:bg-{{ $tool['color'] }}-50 transition-all duration-300 transform hover:scale-105 text-center group">
                                    <div class="w-12 h-12 bg-{{ $tool['color'] }}-100 rounded-lg flex items-center justify-center mx-auto mb-3 group-hover:bg-{{ $tool['color'] }}-200 transition-colors duration-200">
                                        @if($tool['icon'] == 'users')
                                        <svg class="w-6 h-6 text-{{ $tool['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                        </svg>
                                        @elseif($tool['icon'] == 'plus')
                                        <svg class="w-6 h-6 text-{{ $tool['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        @elseif($tool['icon'] == 'target')
                                        <svg class="w-6 h-6 text-{{ $tool['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        @else
                                        <svg class="w-6 h-6 text-{{ $tool['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                        @endif
                                    </div>
                                    <span class="block text-sm font-semibold text-gray-700 group-hover:text-{{ $tool['color'] }}-700 transition-colors duration-200">{{ $tool['label'] }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Team Performance (Only for Sales Manager) -->
                        @if(Auth::user()->role === 'sales_manager' && !empty($salesStats['team_data']['team_members']))
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s">
                            <div class="px-6 py-4 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-900">Team Performance</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $salesStats['team_data']['team_size'] }} team members</p>
                            </div>
                            <div class="p-6 space-y-4">
                                @foreach($salesStats['team_data']['team_members'] as $member)
                                <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-200 transform hover:scale-105">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                            {{ strtoupper(substr($member['name'], 0, 2)) }}
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-sm font-medium text-gray-900 truncate">{{ $member['name'] }}</span>
                                            <span class="text-sm font-bold text-gray-700">₹{{ number_format($member['sales']) }}</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-green-400 to-green-600 h-2 rounded-full transition-all duration-500" style="width: {{ $member['progress'] }}%"></div>
                                        </div>
                                        <div class="flex justify-between items-center mt-1">
                                            <span class="text-xs text-gray-500">{{ $member['progress'] }}% of target</span>
                                            <span class="text-xs font-medium {{ $member['progress'] >= 90 ? 'text-green-600' : ($member['progress'] >= 75 ? 'text-yellow-600' : 'text-red-600') }}">
                                                {{ $member['deals_count'] }} deals
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @else
                        <!-- Personal Performance for Sales Rep -->
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s">
                            <div class="px-6 py-4 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-900">Your Performance</h3>
                                <p class="text-sm text-gray-600 mt-1">Monthly target achievement</p>
                            </div>
                            <div class="p-6">
                                <div class="text-center mb-4">
                                    <div class="text-3xl font-bold text-gray-900">{{ $salesStats['target_achievement'] }}%</div>
                                    <p class="text-sm text-gray-600">Target Achievement</p>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-4 mb-2">
                                    <div class="bg-gradient-to-r from-green-400 to-green-600 h-4 rounded-full transition-all duration-1000" style="width: {{ $salesStats['target_achievement'] }}%"></div>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>₹0</span>
                                    <span>₹50,000</span>
                                </div>
                                <div class="mt-4 grid grid-cols-2 gap-4 text-center">
                                    <div class="p-3 bg-blue-50 rounded-lg">
                                        <div class="text-lg font-bold text-blue-600">{{ $salesStats['monthly_sales'] }}</div>
                                        <div class="text-xs text-blue-600">Monthly Sales</div>
                                    </div>
                                    <div class="p-3 bg-green-50 rounded-lg">
                                        <div class="text-lg font-bold text-green-600">{{ $salesStats['total_leads'] }}</div>
                                        <div class="text-xs text-green-600">Total Leads</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Right Column - Sales Profile & Metrics -->
                <div class="space-y-6">
                    
                    <!-- Sales Profile -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-right">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ Auth::user()->role === 'sales_manager' ? 'Sales Manager' : 'Sales Representative' }}
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0 relative">
                                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white text-xl font-semibold shadow-lg">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 border-2 border-white rounded-full"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-lg font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ Auth::user()->role === 'sales_manager' ? 'Sales Manager' : 'Sales Representative' }} • 
                                        {{ Auth::user()->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mt-6 space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center p-3 bg-blue-50 rounded-lg">
                                        <p class="text-xl font-bold text-blue-600">₹{{ number_format($salesStats['monthly_revenue']) }}</p>
                                        <p class="text-xs text-blue-600">This Month</p>
                                    </div>
                                    <div class="text-center p-3 bg-gray-50 rounded-lg">
                                        <p class="text-xl font-bold text-gray-600">₹{{ number_format($salesStats['total_revenue']) }}</p>
                                        <p class="text-xs text-gray-600">All Time</p>
                                    </div>
                                </div>
                                <div class="bg-gradient-to-r from-green-400 to-green-600 h-2 rounded-full">
                                    <div class="bg-white bg-opacity-30 h-2 rounded-full" style="width: {{ $salesStats['target_achievement'] }}%"></div>
                                </div>
                                <div class="text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        {{ $salesStats['target_achievement'] >= 80 ? 'bg-green-100 text-green-800' : 
                                           ($salesStats['target_achievement'] >= 50 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $salesStats['target_achievement'] }}% Target Achieved
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Metrics -->
                    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-2xl shadow-xl overflow-hidden animate-fade-in-right" style="animation-delay: 0.2s">
                        <div class="px-6 py-4 border-b border-white border-opacity-20">
                            <h3 class="text-lg font-semibold flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                                Performance Metrics
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-2 gap-4 text-center">
                                <div class="bg-white bg-opacity-20 p-4 rounded-xl backdrop-blur-sm">
                                    <p class="text-2xl font-bold">{{ $salesStats['target_achievement'] }}%</p>
                                    <p class="text-sm opacity-90">Target</p>
                                </div>
                                <div class="bg-white bg-opacity-20 p-4 rounded-xl backdrop-blur-sm">
                                    <p class="text-2xl font-bold">{{ round($salesStats['conversion_rate'], 1) }}%</p>
                                    <p class="text-sm opacity-90">Conversion</p>
                                </div>
                                <div class="bg-white bg-opacity-20 p-4 rounded-xl backdrop-blur-sm">
                                    <p class="text-2xl font-bold">{{ $salesStats['monthly_sales'] }}</p>
                                    <p class="text-sm opacity-90">Sales</p>
                                </div>
                                <div class="bg-white bg-opacity-20 p-4 rounded-xl backdrop-blur-sm">
                                    <p class="text-2xl font-bold">{{ $salesStats['total_leads'] }}</p>
                                    <p class="text-sm opacity-90">Leads</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-right" style="animation-delay: 0.3s">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900">Quick Stats</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-700">Monthly Target</span>
                                <span class="text-sm font-bold text-gray-900">₹50,000</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-700">Achieved</span>
                                <span class="text-sm font-bold text-green-600">₹{{ number_format($salesStats['monthly_revenue']) }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-700">Pending</span>
                                <span class="text-sm font-bold text-orange-600">₹{{ number_format(50000 - $salesStats['monthly_revenue']) }}</span>
                            </div>
                            @if(Auth::user()->role === 'sales_manager' && !empty($salesStats['team_data']))
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-700">Team Revenue</span>
                                <span class="text-sm font-bold text-blue-600">₹{{ number_format($salesStats['team_data']['team_revenue']) }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        .animate-fade-in-left {
            animation: fadeInLeft 0.6s ease-out;
        }
        .animate-fade-in-right {
            animation: fadeInRight 0.6s ease-out;
        }
        .animate-slide-in-right {
            animation: slideInRight 0.5s ease-out;
        }
        .animate-bounce-slow {
            animation: bounceSlow 2s infinite;
        }
        .animate-count-up {
            animation: countUp 0.8s ease-out;
        }
        .animate-pulse {
            animation: pulse 2s infinite;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes bounceSlow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        @keyframes countUp {
            from { opacity: 0; transform: scale(0.5); }
            to { opacity: 1; transform: scale(1); }
        }

        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</x-app-layout>