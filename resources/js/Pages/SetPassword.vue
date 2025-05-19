<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const router = useRouter();
const token = route.params.token;
const password = ref('');
const confirmPassword = ref('');
const error = ref('');
const success = ref('');

async function submitPassword() {
    if (password.value != confirmPassword.value) {
        error.value = "Password not matched"
        return;
    }

    console.log(password.value, "", confirmPassword.value)
    try {
        await axios.post('http://localhost:8000/api/set-password', {
            token: token,
            password: password.value
        });

        success.value = "Password set successfully. You can now log in.";
        router.push('/login');
    } catch (e) {
        error.value = e.response?.data?.message || "Error setting password.";
    }
}
</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-center text-gray-800">Set Your Password</h2>
                    <p class="mt-2 text-center text-gray-600">Create a secure password for your account</p>
                </div>

                <!-- Form Content -->
                <div class="p-6 space-y-6">
                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" v-model="password" type="password"
                                class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter your password" />
                        </div>
                        <p class="text-xs text-gray-500">Password must be at least 8 characters long</p>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="space-y-2">
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="confirmPassword" v-model="confirmPassword" type="password"
                                class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Confirm your password" />
                        </div>
                    </div>

                    <!-- Password Match Indicator -->
                    <div v-if="password && confirmPassword" class="flex items-center mt-1">
                        <svg v-if="password === confirmPassword" xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500 mr-2"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <span
                            :class="{ 'text-green-700': password === confirmPassword, 'text-red-700': password !== confirmPassword }">
                            {{ password === confirmPassword ? 'Passwords match' : 'Passwords do not match' }}
                        </span>
                    </div>

                    <!-- Error Message -->
                    <div v-if="error" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
                        {{ error }}
                    </div>

                    <!-- Success Message -->
                    <div v-if="success" class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">
                        {{ success }}
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <button @click="submitPassword"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Set Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
