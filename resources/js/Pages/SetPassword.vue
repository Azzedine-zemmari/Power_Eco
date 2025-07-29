<script setup>
import { ref, onMounted, computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';
import { watch } from 'vue';

const route = useRoute();
const router = useRouter();
const token = route.params.token;
const password = ref('');
const confirmPassword = ref('');
const error = ref('');
const success = ref('');
const passwordStrength = computed(() => {
    const pwd = password.value
    let strength = 0

    if (pwd.length >= 8) strength++
    if (/[a-z]/.test(pwd) && /[A-Z]/.test(pwd)) strength++
    if (/\d/.test(pwd)) strength++
    if (/[^A-Za-z0-9]/.test(pwd)) strength++

    return strength
})

const submitPassword = async () => {
    if (password.value != confirmPassword.value) {
        error.value = "Password not matched"
        return;
    }

    try {
        await axios.post('http://localhost:8000/api/set-password', {
            token: token,
            password: password.value
        });

        success.value = "Password set successfully. You can now log in.";
        // localStorage.removeItem('token');
        // localStorage.removeItem('role');
        router.push('/login');
    } catch (e) {
        error.value = e.response?.data?.message || "Error setting password.";
    }
}

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

onMounted(() => {
    password.value = '';
    confirmPassword.value = '';
    error.value = '';
    success.value = '';
});

</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Logo/Header -->
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
                            Eco<span class="text-green-600">Move</span>
                        </h1>
                    </div>
                </div>
            </div>

            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Set your password
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Create a secure password for your account
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-xl sm:rounded-lg sm:px-10 border border-gray-200">
                <form @submit.prevent="submitPassword" class="space-y-6">
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="mt-1 relative">
                            <input id="password" v-model="password" type="password" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                placeholder="Enter your password" />
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
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700">
                            Confirm Password
                        </label>
                        <div class="mt-1 relative">
                            <input id="confirmPassword" v-model="confirmPassword" type="password" required
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                :class="{
                                    'border-red-300 focus:border-red-500 focus:ring-red-500': confirmPassword && password !== confirmPassword,
                                    'border-green-300 focus:border-green-500 focus:ring-green-500': confirmPassword && password === confirmPassword
                                }"
                                placeholder="Confirm your password" />
                        </div>
                        <!-- Password match indicator -->
                        <div v-if="confirmPassword" class="mt-1">
                            <p v-if="password === confirmPassword" class="text-xs text-green-600 flex items-center">
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

                    <!-- Error Message -->
                    <div v-if="error" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
                        {{ error }}
                    </div>

                    <!-- Success Message -->
                    <div v-if="success" class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">
                        {{ success }}
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                            Set Password
                        </button>
                    </div>
                </form>

                <!-- Back to Login Link -->
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
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
