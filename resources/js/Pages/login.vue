<template>
<div class="bg-gray-50 text-gray-800 font-sans">
    <!-- Login Form -->
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">{{ $t('ui.home_title') }}</h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                {{ $t('ui.or') }}
                <a href="/register" class="font-medium text-green-600 hover:text-green-500">
                    {{ $t('auth.create_account') }}
                </a>
            </p>

        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form @submit.prevent="login" class="space-y-6" action="#" method="POST">
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
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            {{ $t('auth.email') }}
                        </label>
                        <div class="mt-1">
                            <input v-model="email" id="email" name="email" type="email" autocomplete="email" required 
                                :class="{'border-red-300': errors.email || generalError}"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            <div v-if="errors.email" class="text-red-600 text-sm mt-1">{{ errors.email[0] }}</div>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            {{ $t('auth.password') }}
                        </label>
                        <div class="mt-1">
                            <input v-model="password" id="password" name="password" type="password" autocomplete="current-password" required 
                                :class="{'border-red-300': errors.password || generalError}"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            <div v-if="errors.password" class="text-red-600 text-sm mt-1">{{ errors.password[0] }}</div>
                        </div>
                    </div>
                     <div class="text-sm">
                            <a href="/user/forgetPassword" class="font-medium text-green-600 hover:text-green-500">
                                {{ $t('auth.forgot_password') }}
                            </a>
                        </div>
                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            {{ $t('auth.sign_in') }}
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
    import { useRouter, useRoute } from 'vue-router';
    import axios from 'axios';

    const router = useRouter();
    const route = useRoute();
    let email = ref('');
    let password = ref('');
    let errors = ref({});
    let generalError = ref('');
    const API_BASE_URL = 'http://localhost:8000';


    async function login(){
        // Reset errors
        errors.value = {};
        generalError.value = '';

        try{
            const response = await axios.post(`${API_BASE_URL}/api/login`,{
                email:email.value,
                password:password.value
            })
            console.log(response.data)

            const role = response.data.user.role_id
            const token = response.data.token

            // save token and role to localStorage for later requests
            localStorage.setItem('token',token)
            localStorage.setItem('role',role)
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

            const redirectPath = route.query.redirect;
            if (redirectPath) {
                router.push(redirectPath);
                return;
            }
            
            switch (role) {
                case 4:
                    router.push('/admin/users/management');
                    break;
                case 1:
                    router.push('/');
                    break;
                case 3:
                    router.push('/saleList');
                    break;
                case 2:
                    router.push('/productManager/dashboard');
                    break;
                default:
                    console.log('unknown role');
            }
        }
        catch (error) {
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors;
            } else if (error.response && error.response.status === 403) {
                generalError.value = error.response.data.message;
            } else if (error.response && error.response.status === 401) {
                generalError.value = error.response.data.message;
            } else {
                generalError.value = 'An unexpected error occurred. Please try again.';
                console.error('login failed', error);
            }
        }
    }
</script>