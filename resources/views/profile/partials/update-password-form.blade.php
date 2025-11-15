<section class="space-y-6" x-data="passwordForm()">
    <!-- Security Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-gradient-to-br from-green-50 to-emerald-100 border border-green-200 rounded-xl p-4 text-center">
            <div class="w-10 h-10 bg-green-500 text-white rounded-lg flex items-center justify-center text-sm font-bold mx-auto mb-2">
                🔒
            </div>
            <h3 class="text-sm font-semibold text-gray-900 mb-1">Password Strength</h3>
            <p class="text-xs text-green-600 font-medium" x-text="getStrengthText()"></p>
        </div>
        
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-4 text-center">
            <div class="w-10 h-10 bg-blue-500 text-white rounded-lg flex items-center justify-center text-sm font-bold mx-auto mb-2">
                ⚡
            </div>
            <h3 class="text-sm font-semibold text-gray-900 mb-1">Last Changed</h3>
            <p class="text-xs text-blue-600 font-medium">{{ Auth::user()->updated_at->diffForHumans() }}</p>
        </div>
        
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl p-4 text-center">
            <div class="w-10 h-10 bg-purple-500 text-white rounded-lg flex items-center justify-center text-sm font-bold mx-auto mb-2">
                🔄
            </div>
            <h3 class="text-sm font-semibold text-gray-900 mb-1">Recommended</h3>
            <p class="text-xs text-purple-600 font-medium">Every 90 days</p>
        </div>
    </div>

    <!-- Password Update Form -->
    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <form method="post" action="{{ route('password.update') }}" class="p-6 space-y-6" @submit="validateForm">
            @csrf
            @method('put')

            <!-- Current Password -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <label for="update_password_current_password" class="block text-sm font-semibold text-gray-800 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Current Password
                    </label>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">Required</span>
                </div>
                <div class="relative group">
                    <input 
                        id="update_password_current_password" 
                        name="current_password" 
                        x-bind:type="showCurrentPassword ? 'text' : 'password'"
                        class="w-full pl-4 pr-12 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/70 backdrop-blur-sm"
                        placeholder="Enter your current password"
                        autocomplete="current-password"
                        required
                        x-model="currentPassword"
                    />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center space-x-2">
                        <button type="button" @click="showCurrentPassword = !showCurrentPassword" class="text-gray-400 hover:text-blue-500 transition duration-200">
                            <svg x-show="!showCurrentPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showCurrentPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <!-- New Password -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <label for="update_password_password" class="block text-sm font-semibold text-gray-800 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        New Password
                    </label>
                    <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full font-medium">Strong password recommended</span>
                </div>
                <div class="relative group">
                    <input 
                        id="update_password_password" 
                        name="password" 
                        x-bind:type="showNewPassword ? 'text' : 'password'"
                        class="w-full pl-4 pr-12 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white/70 backdrop-blur-sm"
                        placeholder="Create a new strong password"
                        autocomplete="new-password"
                        required
                        x-model="newPassword"
                        @input="checkPasswordStrength"
                    />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center space-x-2">
                        <button type="button" @click="showNewPassword = !showNewPassword" class="text-gray-400 hover:text-green-500 transition duration-200">
                            <svg x-show="!showNewPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showNewPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Password Strength Indicator -->
                <div x-show="newPassword.length > 0" class="space-y-3 mt-4">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-gray-600">Password strength:</span>
                        <span class="font-medium" x-bind:class="getStrengthColor()" x-text="getStrengthText()"></span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="h-2 rounded-full transition-all duration-500" 
                             x-bind:class="getStrengthBarColor()"
                             x-bind:style="'width: ' + passwordStrength + '%'"></div>
                    </div>
                    
                    <!-- Password Requirements -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-xs">
                        <div class="flex items-center space-x-2" x-bind:class="newPassword.length >= 8 ? 'text-green-600' : 'text-gray-400'">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>8+ characters</span>
                        </div>
                        <div class="flex items-center space-x-2" x-bind:class="hasUppercase && hasLowercase ? 'text-green-600' : 'text-gray-400'">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Mixed case letters</span>
                        </div>
                        <div class="flex items-center space-x-2" x-bind:class="hasNumbers ? 'text-green-600' : 'text-gray-400'">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Numbers (0-9)</span>
                        </div>
                        <div class="flex items-center space-x-2" x-bind:class="hasSpecialChars ? 'text-green-600' : 'text-gray-400'">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Special characters</span>
                        </div>
                    </div>
                </div>
                
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-800 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Confirm New Password
                    </label>
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">Must match new password</span>
                </div>
                <div class="relative group">
                    <input 
                        id="update_password_password_confirmation" 
                        name="password_confirmation" 
                        x-bind:type="showConfirmPassword ? 'text' : 'password'"
                        class="w-full pl-4 pr-12 py-3.5 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/70 backdrop-blur-sm"
                        x-bind:class="confirmPassword === newPassword && newPassword.length > 0 ? 'border-green-400 bg-green-50/30' : 'border-gray-300'"
                        placeholder="Confirm your new password"
                        autocomplete="new-password"
                        required
                        x-model="confirmPassword"
                    />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center space-x-2">
                        <div x-show="confirmPassword === newPassword && newPassword.length > 0" class="text-green-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="text-gray-400 hover:text-blue-500 transition duration-200">
                            <svg x-show="!showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Security Tips -->
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
                        <h4 class="text-sm font-semibold text-blue-800 mb-2">Password Security Tips</h4>
                        <ul class="text-xs text-blue-700 space-y-1.5">
                            <li class="flex items-center">
                                <svg class="w-3 h-3 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Use at least 12 characters with mixed case letters
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3 h-3 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Include numbers and special characters (!@#$%)
                            </li>
                            <li class="flex items-center">
                                <svg class="w-3 h-3 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Avoid using personal information or common words
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
                    Last changed: 
                    <span class="font-medium text-gray-700 ml-1">
                        {{ Auth::user()->updated_at->diffForHumans() }}
                    </span>
                </div>
                
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    @if (session('status') === 'password-updated')
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
                            <span>{{ __('Password updated successfully!') }}</span>
                        </div>
                    @endif

                    <button type="submit" class="inline-flex items-center justify-center space-x-2 px-6 py-3.5 bg-gradient-to-r from-green-600 to-blue-600 hover:from-green-700 hover:to-blue-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-200 rounded-xl text-white font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>{{ __('Update Password') }}</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    function passwordForm() {
        return {
            showCurrentPassword: false,
            showNewPassword: false,
            showConfirmPassword: false,
            currentPassword: '',
            newPassword: '',
            confirmPassword: '',
            passwordStrength: 0,
            hasUppercase: false,
            hasLowercase: false,
            hasNumbers: false,
            hasSpecialChars: false,
            
            checkPasswordStrength() {
                let strength = 0;
                this.hasUppercase = /[A-Z]/.test(this.newPassword);
                this.hasLowercase = /[a-z]/.test(this.newPassword);
                this.hasNumbers = /\d/.test(this.newPassword);
                this.hasSpecialChars = /[^A-Za-z0-9]/.test(this.newPassword);
                
                if (this.newPassword.length >= 8) strength += 25;
                if (this.hasUppercase && this.hasLowercase) strength += 25;
                if (this.hasNumbers) strength += 25;
                if (this.hasSpecialChars) strength += 25;
                
                this.passwordStrength = strength;
            },
            
            getStrengthText() {
                if (this.passwordStrength < 25) return 'Very Weak';
                if (this.passwordStrength < 50) return 'Weak';
                if (this.passwordStrength < 75) return 'Good';
                if (this.passwordStrength < 100) return 'Strong';
                return 'Very Strong';
            },
            
            getStrengthColor() {
                if (this.passwordStrength < 25) return 'text-red-600';
                if (this.passwordStrength < 50) return 'text-orange-600';
                if (this.passwordStrength < 75) return 'text-yellow-600';
                return 'text-green-600';
            },
            
            getStrengthBarColor() {
                if (this.passwordStrength < 25) return 'bg-red-500';
                if (this.passwordStrength < 50) return 'bg-orange-500';
                if (this.passwordStrength < 75) return 'bg-yellow-500';
                return 'bg-green-500';
            },
            
            validateForm(e) {
                if (this.newPassword !== this.confirmPassword) {
                    e.preventDefault();
                    alert('New password and confirmation password do not match.');
                    return false;
                }
                return true;
            }
        }
    }
</script>

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