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
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h1 class="text-3xl font-bold text-gray-900">
                            Eco<span class="text-green-600">Move</span>
                        </h1>
                    </div>
                </div>
            </div>

            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Forgot your password?
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600 max-w-sm mx-auto">
                No worries! Enter your email address and we'll send you a link to reset your password.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-xl sm:rounded-lg sm:px-10 border border-gray-200">
                <!-- Success State -->
                <div v-if="emailSent" class="text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                        <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Check your email</h3>
                    <p class="text-sm text-gray-600 mb-6">
                        We've sent a password reset link to <span class="font-medium text-gray-900">{{ email }}</span>
                    </p>
                    <div class="space-y-3">
                        <button @click="resetForm"
                            class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                            Send to different email
                        </button>
                        <RouterLink :to="{name:'login'}"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                            Back to Login
                        </RouterLink>
                    </div>
                </div>

                <!-- Form State -->
                <form v-else @submit.prevent="submitEmail" class="space-y-6">
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email address
                        </label>
                        <div class="mt-1 relative">
                            <input id="email" v-model="email" type="email" required
                                class="appearance-none block w-full px-3 py-2 pl-10 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                :class="{
                                    'border-red-300 focus:border-red-500 focus:ring-red-500': hasError,
                                    'border-green-300 focus:border-green-500 focus:ring-green-500': isValidEmail && !hasError
                                }" placeholder="Enter your email address" />
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <!-- Email validation icon -->
                            <div v-if="email" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg v-if="isValidEmail && !hasError" class="h-5 w-5 text-green-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <svg v-else-if="hasError" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                        <!-- Email validation message -->
                        <div v-if="email && !isValidEmail" class="mt-1">
                            <p class="text-xs text-red-600">Please enter a valid email address</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" :disabled="isLoading || !isValidEmail"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg v-if="!isLoading" class="h-5 w-5 text-green-500 group-hover:text-green-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
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
                            {{ isLoading ? 'Sending...' : 'Send Reset Link' }}
                        </button>
                    </div>

                    <!-- Error Message -->
                    <div v-if="message && hasError" class="rounded-md bg-red-50 border border-red-200 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">
                                    {{ message }}
                                </p>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Back to Login Link -->
                <div v-if="!emailSent" class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300" />
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">or</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <RouterLink :to="{name:'login'}"
                            class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                            <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Login
                        </RouterLink>
                    </div>
                </div>

                <!-- Help Text -->
                <div v-if="!emailSent" class="mt-6 text-center">
                    <p class="text-xs text-gray-500">
                        Remember your password?
                        <RouterLink :to="{name:'register'}" class="font-medium text-green-600 hover:text-green-500">
                            Sign in here
                        </RouterLink>
                    </p>
                </div>
            </div>

            <!-- Additional Help -->
            <div v-if="emailSent" class="mt-6 text-center">
                <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">
                                Didn't receive the email?
                            </h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Check your spam or junk folder</li>
                                    <li>Make sure you entered the correct email address</li>
                                    <li>Wait a few minutes for the email to arrive</li>
                                </ul>
                            </div>
                            <div class="mt-4">
                                <button @click="resendEmail" :disabled="resendCooldown > 0"
                                    class="text-sm font-medium text-blue-600 hover:text-blue-500 disabled:text-blue-400 disabled:cursor-not-allowed">
                                    {{ resendCooldown > 0 ? `Resend in ${resendCooldown}s` : 'Resend email' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onUnmounted } from 'vue'
import axios from 'axios'
import { RouterLink } from 'vue-router'

const email = ref('')
const message = ref('')
const isLoading = ref(false)
const emailSent = ref(false)
const hasError = ref(false)
const resendCooldown = ref(0)
let resendTimer = null

// Email validation
const isValidEmail = computed(() => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    return emailRegex.test(email.value)
})

const submitEmail = async () => {
    if (!isValidEmail.value) return

    isLoading.value = true
    hasError.value = false
    message.value = ''

    try {
        const res = await axios.post('/api/forgot-password', { email: email.value })
        message.value = res.data.status || 'Reset link sent successfully!'
        emailSent.value = true
        startResendCooldown()
    } catch (err) {
        hasError.value = true
        message.value = err.response?.data?.message || "Something went wrong. Please try again."
    } finally {
        isLoading.value = false
    }
}

const resendEmail = async () => {
    if (resendCooldown.value > 0) return
    await submitEmail()
}

const resetForm = () => {
    emailSent.value = false
    email.value = ''
    message.value = ''
    hasError.value = false
    if (resendTimer) {
        clearInterval(resendTimer)
        resendCooldown.value = 0
    }
}

const startResendCooldown = () => {
    resendCooldown.value = 60 // 60 seconds cooldown
    resendTimer = setInterval(() => {
        resendCooldown.value--
        if (resendCooldown.value <= 0) {
            clearInterval(resendTimer)
        }
    }, 1000)
}

onUnmounted(() => {
    if (resendTimer) {
        clearInterval(resendTimer)
    }
})
</script>