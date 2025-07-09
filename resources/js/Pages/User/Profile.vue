<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <div class="flex h-screen overflow-hidden">
            <UserSideBar/>
            <!-- Main content -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
                    <button type="button" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500">
                        <span class="sr-only">{{$t('profile.open_sidebar') || 'Open sidebar'}}</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <!-- Top header -->
                <div class="flex-shrink-0 flex h-16 bg-white shadow">
                    <div class="flex-1 px-4 flex justify-between">
                        <div class="flex-1 flex">
                            <h1 class="text-xl md:text-2xl font-semibold text-gray-900 self-center">{{$t('profile.title')}}</h1>
                        </div>
                    </div>
                </div>
                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-4 md:py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Loading State with Pulse Animation -->
                            <div v-if="loading" class="flex flex-col items-center justify-center py-12 space-y-4">
                                <div class="h-6 bg-gray-200 rounded w-32 pulse-animation mb-4"></div>
                                
                                <!-- Profile Card Skeleton with Pulse -->
                                <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-6 mt-8">
                                    <div class="flex justify-between items-center mb-6">
                                        <div class="h-6 bg-gray-200 rounded w-48 pulse-animation"></div>
                                        <div class="h-10 bg-gray-200 rounded w-24 pulse-animation"></div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="space-y-4">
                                            <div class="h-4 bg-gray-200 rounded w-24 pulse-animation"></div>
                                            <div class="h-10 bg-gray-200 rounded w-full pulse-animation"></div>
                                        </div>
                                        <div class="space-y-4">
                                            <div class="h-4 bg-gray-200 rounded w-24 pulse-animation"></div>
                                            <div class="h-10 bg-gray-200 rounded w-full pulse-animation"></div>
                                        </div>
                                        <div class="md:col-span-2 space-y-4">
                                            <div class="h-4 bg-gray-200 rounded w-16 pulse-animation"></div>
                                            <div class="h-10 bg-gray-200 rounded w-full pulse-animation"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Error State -->
                            <div v-else-if="error" class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">{{$t('profile.error_loading')}}</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p>{{ error }}</p>
                                        </div>
                                        <div class="mt-4">
                                            <button @click="fetchProfile" class="bg-red-100 px-3 py-2 rounded-md text-sm font-medium text-red-800 hover:bg-red-200 transition-colors duration-200">
                                                {{$t('profile.try_again')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Profile Content -->
                            <div v-else>
                                <h1 class="text-xl md:text-2xl font-semibold text-gray-900 mb-4">
                                    {{$t('profile.welcome', { name: profile.firstName || 'User' })}}
                                </h1>
                            </div>
                        </div>
                        
                        <div v-if="!loading && !error" class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Profile Information Section -->
                            <div class="bg-white shadow rounded-lg transition-all duration-300 hover:shadow-lg">
                                <!-- Profile Header -->
                                <div class="px-4 md:px-6 py-4 md:py-5 border-b border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                                    <h2 class="text-lg font-medium text-gray-900">{{$t('profile.info_title')}}</h2>
                                    <button
                                        @click="toggleEdit"
                                        :disabled="saving"
                                        :class="isEditing ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700'"
                                        class="w-full md:w-auto inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed transform hover:scale-105 active:scale-95"
                                    >
                                        <svg v-if="!isEditing" class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        <svg v-else class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        {{ isEditing ? $t('profile.cancel') : $t('profile.edit') }}
                                    </button>
                                </div>
                                
                                <!-- Profile Content -->
                                <div class="px-4 md:px-6 py-4 md:py-5">
                                    <form @submit.prevent="saveProfile">
                                        <div class="grid grid-cols-1 gap-6">
                                            <!-- Profile Details -->
                                            <div>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                                    <!-- First Name -->
                                                    <div class="transition-all duration-200">
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">{{$t('profile.first_name')}}</label>
                                                        <input
                                                            v-if="isEditing"
                                                            v-model="editProfile.firstName"
                                                            type="text"
                                                            required
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                                                            :class="{ 'border-red-300': validationErrors.firstName }"
                                                        >
                                                        <p v-else class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md transition-colors duration-200">
                                                            {{ profile.firstName || $t('profile.not_provided') }}
                                                        </p>
                                                        <p v-if="validationErrors.firstName" class="mt-1 text-sm text-red-600">
                                                            {{ validationErrors.firstName }}
                                                        </p>
                                                    </div>
                                                    
                                                    <!-- Last Name -->
                                                    <div class="transition-all duration-200">
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">{{$t('profile.last_name')}}</label>
                                                        <input
                                                            v-if="isEditing"
                                                            v-model="editProfile.lastName"
                                                            type="text"
                                                            required
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                                                            :class="{ 'border-red-300': validationErrors.lastName }"
                                                        >
                                                        <p v-else class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md transition-colors duration-200">
                                                            {{ profile.lastName || $t('profile.not_provided') }}
                                                        </p>
                                                        <p v-if="validationErrors.lastName" class="mt-1 text-sm text-red-600">
                                                            {{ validationErrors.lastName }}
                                                        </p>
                                                    </div>
                                                    
                                                    <!-- Email -->
                                                    <div class="md:col-span-2 transition-all duration-200">
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">{{$t('profile.email')}}</label>
                                                        <input
                                                            v-if="isEditing"
                                                            v-model="editProfile.email"
                                                            type="email"
                                                            required
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                                                            :class="{ 'border-red-300': validationErrors.email }"
                                                        >
                                                        <p v-else class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md transition-colors duration-200">
                                                            {{ profile.email || $t('profile.not_provided') }}
                                                        </p>
                                                        <p v-if="validationErrors.email" class="mt-1 text-sm text-red-600">
                                                            {{ validationErrors.email }}
                                                        </p>
                                                    </div>
                                                    
                                                    <!-- Role (Read-only) -->
                                                    <div class="transition-all duration-200">
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">{{$t('profile.role')}}</label>
                                                        <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md capitalize transition-colors duration-200">
                                                            {{ $t('profile.roles.' + (profile.selectedRole || 1)) }}
                                                        </p>
                                                    </div>
                                                    
                                                    <!-- Status (Read-only) -->
                                                    <div class="transition-all duration-200">
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">{{$t('profile.status')}}</label>
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition-all duration-200"
                                                              :class="profile.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
                                                            {{ profile.status ? $t('profile.active') : $t('profile.not_provided') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                                <!-- Member Since -->
                                                <div class="mt-6 transition-all duration-200">
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">{{$t('profile.member_since')}}</label>
                                                    <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md transition-colors duration-200">
                                                        {{ formatDate(profile.joinDate || profile.created_at) }}
                                                    </p>
                                                </div>
                                                
                                                <!-- Save Button (only visible when editing) -->
                                                <div v-if="isEditing" class="mt-6 flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                                                    <button
                                                        type="button"
                                                        @click="toggleEdit"
                                                        :disabled="saving"
                                                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-105 active:scale-95"
                                                    >
                                                        {{$t('profile.cancel')}}
                                                    </button>
                                                    <button
                                                        type="submit"
                                                        :disabled="saving"
                                                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-105 active:scale-95"
                                                    >
                                                        <div v-if="saving" class="w-4 h-4 bg-white rounded pulse-animation mr-2"></div>
                                                        <svg v-else class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        {{ saving ? $t('profile.saving') : $t('profile.save_changes') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Success Message -->
                            <div v-if="successMessage" class="mt-6 bg-green-50 border border-green-200 rounded-md p-4 transition-all duration-300 transform">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">{{ successMessage }}</p>
                                    </div>
                                    <div class="ml-auto pl-3">
                                        <button @click="successMessage = ''" class="inline-flex text-green-400 hover:text-green-500 transition-colors duration-200">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import UserSideBar from '../../components/UserSideBar.vue';
import axios from 'axios';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const isEditing = ref(false);
const loading = ref(true);
const saving = ref(false);
const error = ref('');
const successMessage = ref('');
const validationErrors = ref({});

const API_BASE_URL = 'http://localhost:8000';

const profile = reactive({
    firstName: '',
    lastName: '',
    email: '',
    selectedRole: '',
    role: '',
    status: '',
    joinDate: '',
    created_at: ''
});

const editProfile = reactive({
    firstName: '',
    lastName: '',
    email: '',
});

// Fetch user data from API 
const fetchProfile = async () => {
    loading.value = true;
    error.value = '';
    
    try {
        console.log('Fetching profile data...');
        
        const token = localStorage.getItem('token');
        if (!token) {
            throw new Error('No authentication token found. Please log in again.');
        }

        // Try multiple possible endpoints
        let response;
        try {
            // First try the user data endpoint
            response = await axios.get(`${API_BASE_URL}/api/user/data`, {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            });
        } catch (err) {
            // If that fails, try the user endpoint
            console.log('First endpoint failed, trying /api/user');
            response = await axios.get(`${API_BASE_URL}/api/user`, {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            });
        }
        
        console.log('API response:', response.data);
        
        // Handle different response structures
        let userData;
        if (response.data.user) {
            userData = response.data.user;
        } else if (response.data.data) {
            userData = response.data.data;
        } else {
            userData = response.data;
        }
        
        console.log('User data:', userData);
        
        // Update profile with fetched data
        Object.assign(profile, {
            firstName: userData.firstName || '',
            lastName: userData.lastName ||  '',
            email: userData.email || '',
            selectedRole: userData.role_id || '',
            status: userData.status || 'active',
            joinDate: userData.created_at || '',
            created_at: userData.created_at || ''
        });
        
        // Update edit profile
        Object.assign(editProfile, {
            firstName: profile.firstName,
            lastName: profile.lastName,
            email: profile.email,
        });
        
        console.log('Profile updated:', profile);
    } catch (err) {
        console.error('Error fetching profile:', err);
        
        if (err.response) {
            if (err.response.status === 401) {
                error.value = 'Authentication failed. Please log in again.';
                // Optionally redirect to login
                // router.push('/login');
            } else if (err.response.status === 404) {
                error.value = 'User profile not found.';
            } else {
                error.value = err.response.data?.message || 'Failed to load profile data.';
            }
        } else if (err.message) {
            error.value = err.message;
        } else {
            error.value = 'Network error. Please check your connection.';
        }
    } finally {
        loading.value = false;
    }
};

const toggleEdit = () => {
    if (isEditing.value) {
        // Reset edit profile to original values when canceling
        Object.assign(editProfile, {
            firstName: profile.firstName,
            lastName: profile.lastName,
            email: profile.email,
        });
        validationErrors.value = {};
    }
    isEditing.value = !isEditing.value;
    successMessage.value = '';
};

const containsHTML = (str) => {
    return /<[^>]*>/g.test(str);
};

const validateForm = () => {
    validationErrors.value = {};
    if (!editProfile.firstName.trim()) {
        validationErrors.value.firstName = t('profile.error_required_first');
    } else if (containsHTML(editProfile.firstName)) {
        validationErrors.value.firstName = "HTML tags are not allowed.";
    }
    if (!editProfile.lastName.trim()) {
        validationErrors.value.lastName = t('profile.error_required_last');
    } else if (containsHTML(editProfile.lastName)) {
        validationErrors.value.lastName = "HTML tags are not allowed.";
    }
    if (!editProfile.email.trim()) {
        validationErrors.value.email = t('profile.error_required_email');
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(editProfile.email)) {
        validationErrors.value.email = t('profile.error_invalid_email');
    } else if (containsHTML(editProfile.email)) {
        validationErrors.value.email = "HTML tags are not allowed.";
    }
    return Object.keys(validationErrors.value).length === 0;
};

const saveProfile = async () => {
    if (!validateForm()) {
        return;
    }
    
    saving.value = true;
    error.value = '';
    
    try {
        console.log('Saving profile:', editProfile);
        
        const token = localStorage.getItem('token');
        if (!token) {
            throw new Error('No authentication token found');
        }

        // Try different possible update endpoints
        let response;
        try {
            response = await axios.put(`${API_BASE_URL}/api/user/data/update`, {
                firstName: editProfile.firstName.trim(),
                lastName: editProfile.lastName.trim(),
                email: editProfile.email.trim(),
            }, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            });
        } catch (err) {
            // Try alternative endpoint
            console.log('First update endpoint failed, trying /api/user/update');
            response = await axios.put(`${API_BASE_URL}/api/user/update`, {
                firstName: editProfile.firstName.trim(),
                lastName: editProfile.lastName.trim(),
                email: editProfile.email.trim(),
            }, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`
                }
            });
        }
        
        console.log('Update response:', response.data);
        
        // Update the main profile with edited values
        Object.assign(profile, {
            firstName: editProfile.firstName.trim(),
            lastName: editProfile.lastName.trim(),
            email: editProfile.email.trim(),
        });
        
        isEditing.value = false;
        successMessage.value = t('profile.updated_success');
        
        // Clear success message after 5 seconds
        setTimeout(() => {
            successMessage.value = '';
        }, 5000);
    } catch (err) {
        console.error('Error saving profile:', err);
        
        if (err.response) {
            if (err.response.status === 422) {
                // Handle validation errors from server
                const serverErrors = err.response.data.errors || {};
                Object.keys(serverErrors).forEach(field => {
                    validationErrors.value[field] = Array.isArray(serverErrors[field])
                        ? serverErrors[field][0]
                        : serverErrors[field];
                });
            } else if (err.response.status === 401) {
                error.value = t('auth.no_account');
            } else {
                error.value = err.response.data?.message || t('profile.error_loading');
            }
        } else {
            error.value = err.message || t('checkout.toast_network_error');
        }
    } finally {
        saving.value = false;
    }
};

const formatDate = (dateString) => {
    if (!dateString) return t('profile.not_provided');
    
    try {
        return new Date(dateString).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    } catch (err) {
        return t('profile.not_provided');
    }
};

onMounted(() => {
    fetchProfile();
});
</script>

<style scoped>
/* Pulse Animation */
.pulse-animation {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.4;
    }
}

/* Smooth transitions for all interactive elements */
* {
    transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 200ms;
}
</style>
