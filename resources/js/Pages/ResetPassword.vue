<template>
    <div
        class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Logo -->
            <div class="flex justify-center">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h1 class="text-3xl font-bold text-gray-900">
                            MOBILE<span class="text-green-600">SUN</span>
                        </h1>
                    </div>
                </div>
            </div>

            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Reset your password
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Enter your new password below to complete the reset process
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-xl sm:rounded-lg sm:px-10 border border-gray-200">
                <form @submit.prevent="resetPassword" class="space-y-6">
                    <!-- New Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            New Password
                        </label>
                        <div class="mt-1 relative">
                            <input id="password" v-model="password" :type="showPassword ? 'text' : 'password'" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="Enter your new password" />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" @click="showPassword = !showPassword"
                                    class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500">
                                    <svg v-if="showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                                    </svg>
                                    <svg v-else class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- Password strength indicator -->
                        <div class="mt-2">
                            <div class="flex space-x-1">
                                <div v-for="i in 4" :key="i" class="h-1 flex-1 rounded-full"
                                    :class="getPasswordStrengthColor(i)"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ getPasswordStrengthText() }}
                            </p>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                            Confirm New Password
                        </label>
                        <div class="mt-1 relative">
                            <input id="password_confirmation" v-model="password_confirmation"
                                :type="showConfirmPassword ? 'text' : 'password'" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                :class="{
                                    'border-red-300 focus:border-red-500 focus:ring-red-500': password_confirmation && password !== password_confirmation,
                                    'border-green-300 focus:border-green-500 focus:ring-green-500': password_confirmation && password === password_confirmation
                                }" placeholder="Confirm your new password" />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                                    class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500">
                                    <svg v-if="showConfirmPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                                    </svg>
                                    <svg v-else class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <!-- Password match indicator -->
                        <div v-if="password_confirmation" class="mt-1">
                            <p v-if="password === password_confirmation"
                                class="text-xs text-green-600 flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Passwords match
                            </p>
                            <p v-else class="text-xs text-red-600 flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Passwords do not match
                            </p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" :disabled="isLoading || !isFormValid"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg v-if="!isLoading" class="h-5 w-5 text-green-500 group-hover:text-green-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <svg v-else class="animate-spin h-5 w-5 text-green-500"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </span>
                            {{ isLoading ? 'Resetting Password...' : 'Reset Password' }}
                        </button>
                    </div>

                    <!-- Success/Error Messages -->
                    <div v-if="message" class="rounded-md p-4"
                        :class="messageType === 'success' ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200'">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg v-if="messageType === 'success'" class="h-5 w-5 text-green-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <svg v-else class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium"
                                    :class="messageType === 'success' ? 'text-green-800' : 'text-red-800'">
                                    {{ message }}
                                </p>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Back to Login Link -->
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">or</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <router-link to="/login"
                            class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                            <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Login
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'
import { useRoute } from 'vue-router'
import api from '../axios'

const route = useRoute()
const email = ref('')
const token = ref('')
const password = ref('')
const password_confirmation = ref('')
const message = ref('')
const messageType = ref('error')
const isLoading = ref(false)
const showPassword = ref(false)
const showConfirmPassword = ref(false)

onMounted(() => {
    token.value = route.params.token || ''
    email.value = route.query.email || ''
})

// Password strength calculation
const passwordStrength = computed(() => {
    const pwd = password.value
    let strength = 0

    if (pwd.length >= 8) strength++
    if (/[a-z]/.test(pwd) && /[A-Z]/.test(pwd)) strength++
    if (/\d/.test(pwd)) strength++
    if (/[^A-Za-z0-9]/.test(pwd)) strength++

    return strength
})

// Form validation
const isFormValid = computed(() => {
    return password.value.length >= 8 &&
        password.value === password_confirmation.value &&
        passwordStrength.value >= 2
})

function getPasswordStrengthColor(index) {
    const strength = passwordStrength.value
    if (index <= strength) {
        if (strength <= 1) return 'bg-red-400'
        if (strength <= 2) return 'bg-yellow-400'
        if (strength <= 3) return 'bg-blue-400'
        return 'bg-green-400'
    }
    return 'bg-gray-200'
}

function getPasswordStrengthText() {
    const strength = passwordStrength.value
    if (password.value.length === 0) return 'Enter a password'
    if (strength <= 1) return 'Weak password'
    if (strength <= 2) return 'Fair password'
    if (strength <= 3) return 'Good password'
    return 'Strong password'
}

const resetPassword = async () => {
    if (!isFormValid.value) return

    isLoading.value = true
    message.value = ''

    try {
        const res = await api.post('/reset-password', {
            email: email.value,
            token: token.value,
            password: password.value,
            password_confirmation: password_confirmation.value
        })

        message.value = res.data.status || 'Password reset successfully!'
        messageType.value = 'success'

        // Optionally redirect to login after a delay
        setTimeout(() => {
            // router.push('/login')
        }, 2000)

    } catch (err) {
        message.value = err.response?.data?.message || "Reset failed. Please try again."
        messageType.value = 'error'
    } finally {
        isLoading.value = false
    }
}
</script>