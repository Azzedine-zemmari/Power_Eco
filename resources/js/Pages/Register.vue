<template>
<div class="bg-gray-50 text-gray-800 font-sans">

    <!-- Registration Form -->
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Create your account</h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Or
                <a href="/login" class="font-medium text-green-600 hover:text-green-500">
                    sign in to your existing account
                </a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form @submit.prevent="register" class="space-y-6" action="#" method="POST">
                    <!-- Error Message -->
                    <div v-if="generalError" class="rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">{{ generalError }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Success Message -->
                    <div v-if="successMessage" class="rounded-md bg-green-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ successMessage }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="first-name" class="block text-sm font-medium text-gray-700">
                            First name
                        </label>
                        <div class="mt-1">
                            <input v-model="firstName" id="first-name" name="first-name" type="text" autocomplete="given-name" required 
                                :class="{'border-red-300': errors.firstName || generalError}"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div v-if="errors.firstName" class="text-red-600 text-xs mt-1">{{ errors.firstName[0] }}</div>
                    </div>

                    <div>
                        <label for="last-name" class="block text-sm font-medium text-gray-700">
                            Last name
                        </label>
                        <div class="mt-1">
                            <input v-model="lastName" id="last-name" name="last-name" type="text" autocomplete="family-name" required 
                                :class="{'border-red-300': errors.lastName || generalError}"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div v-if="errors.lastName" class="text-red-600 text-xs mt-1">{{ errors.lastName[0] }}</div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email address
                        </label>
                        <div class="mt-1">
                            <input v-model="email" id="email" name="email" type="email" autocomplete="email" required 
                                :class="{'border-red-300': errors.email || generalError}"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div v-if="errors.email" class="text-red-600 text-xs mt-1">{{ errors.email[0] }}</div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="mt-1">
                            <input v-model="password" id="password" name="password" type="password" autocomplete="new-password" required 
                                :class="{'border-red-300': errors.password || generalError}"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div v-if="errors.password" class="text-red-600 text-xs mt-1">
                            Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required 
                            :class="{'border-red-300': errors.terms || generalError}"
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-900">
                            I agree to the 
                            <a href="#" class="font-medium text-green-600 hover:text-green-500">Terms of Service</a>
                            and
                            <a href="#" class="font-medium text-green-600 hover:text-green-500">Privacy Policy</a>
                        </label>
                    </div>
                    <div v-if="errors.terms" class="text-red-600 text-xs mt-1">{{ errors.terms[0] }}</div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Create account
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</template>
<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

let firstName = ref('');
let lastName = ref('');
let email = ref('');
let password = ref('');
let errors = ref({});
let generalError = ref('');
let successMessage = ref('');

async function register() {
    // Reset messages
    errors.value = {};
    generalError.value = '';
    successMessage.value = '';

    try {
        const response = await axios.post('http://localhost:8000/api/UserRegister', {
            firstName: firstName.value,
            lastName: lastName.value,
            email: email.value,
            password: password.value
        });

        // Show success message and redirect
        successMessage.value = response.data.message;
        setTimeout(() => {
            router.push('/login');
        }, 2000);
    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors || {};
        } else if (error.response && error.response.data.message) {
            generalError.value = error.response.data.message;
        } else {
            generalError.value = 'Registration failed. Please try again.';
            console.error('Registration failed:', error);
        }
    }
}
</script>
