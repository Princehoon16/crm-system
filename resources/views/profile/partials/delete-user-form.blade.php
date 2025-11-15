<section class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-red-50 to-orange-50 border-l-4 border-red-500 rounded-lg p-6 shadow-sm">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    {{ __('Account Deletion') }}
                    <span class="ml-2 px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                        Irreversible Action
                    </span>
                </h2>
                <p class="mt-2 text-sm text-gray-700 leading-relaxed">
                    {{ __('Once your account is deleted, all of your personal data, files, and information will be permanently removed from our systems. This action cannot be undone.') }}
                </p>
                <div class="mt-3 flex items-center text-sm text-red-600 font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    Important: Download your data before proceeding
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Steps -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white border border-orange-200 rounded-lg p-4 text-center">
            <div class="w-8 h-8 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center text-sm font-bold mx-auto mb-2">
                1
            </div>
            <h3 class="text-sm font-semibold text-gray-900 mb-1">Data Backup</h3>
            <p class="text-xs text-gray-600">Export your important data and files</p>
        </div>
        
        <div class="bg-white border border-red-200 rounded-lg p-4 text-center">
            <div class="w-8 h-8 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-sm font-bold mx-auto mb-2">
                2
            </div>
            <h3 class="text-sm font-semibold text-gray-900 mb-1">Confirm Action</h3>
            <p class="text-xs text-gray-600">Verify your identity with password</p>
        </div>
        
        <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
            <div class="w-8 h-8 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold mx-auto mb-2">
                3
            </div>
            <h3 class="text-sm font-semibold text-gray-900 mb-1">Permanent Deletion</h3>
            <p class="text-xs text-gray-600">All data will be permanently erased</p>
        </div>
    </div>

    <!-- Additional Warning Content -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
        <div class="flex items-start space-x-3">
            <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
            </svg>
            <div>
                <h4 class="text-lg font-semibold text-yellow-800 mb-2">Before You Delete</h4>
                <ul class="text-sm text-yellow-700 space-y-1">
                    <li>• Ensure you have exported all important data and files</li>
                    <li>• Cancel any active subscriptions or services</li>
                    <li>• Inform your team members if you're in a shared workspace</li>
                    <li>• This action will immediately log you out from all devices</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Delete Button - NOW AT THE BOTTOM -->
    <div class="pt-6 border-t border-gray-200">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-6 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Ready to delete your account?</h3>
                <p class="text-sm text-gray-600">This is your final step. Click below to begin the account deletion process.</p>
            </div>
            <x-danger-button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="flex items-center justify-center space-x-2 px-8 py-3 w-full lg:w-auto bg-red-600 hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                <span class="font-semibold">{{ __('Delete My Account') }}</span>
            </x-danger-button>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        {{ __('Final Confirmation Required') }}
                    </h2>
                    <p class="text-sm text-red-600 font-medium">This action cannot be undone</p>
                </div>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                @csrf
                @method('delete')

                <!-- Warning Message -->
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                What will be deleted permanently:
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Your personal profile information</li>
                                    <li>Account preferences and settings</li>
                                    <li>All associated data and files</li>
                                    <li>Access history and activity logs</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Password Confirmation -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <x-input-label for="password" value="{{ __('Confirm Password') }}" class="text-sm font-medium text-gray-700" />
                        <span class="text-xs text-gray-500">Required for security verification</span>
                    </div>
                    
                    <div class="relative">
                        <x-text-input
                            id="password"
                            name="password"
                            type="password"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200"
                            placeholder="{{ __('Enter your current password') }}"
                            required
                            autocomplete="current-password"
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <!-- Final Warning -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <strong>Note:</strong> Account deletion is immediate and permanent. You will be logged out automatically and won't be able to recover any data.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-3 space-y-3 sm:space-y-0 pt-4">
                    <x-secondary-button 
                        x-on:click="$dispatch('close')"
                        class="w-full sm:w-auto justify-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 transition duration-200"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button 
                        type="submit"
                        class="w-full sm:w-auto justify-center px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        {{ __('Permanently Delete Account') }}
                    </x-danger-button>
                </div>
            </form>
        </div>
    </x-modal>
</section>