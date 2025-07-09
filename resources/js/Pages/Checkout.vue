<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <Navbar/>
        
        <!-- Page Header -->
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">{{$t('checkout.checkout')}}</h1>
            </div>
        </div>
        
        <!-- Checkout Form -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start xl:gap-x-16">
                <!-- Checkout Form -->
                <section aria-labelledby="checkout-heading" class="lg:col-span-7">
                    <h2 id="checkout-heading" class="sr-only">{{$t('checkout.checkout_form')}}</h2>
                    
                    <!-- Form Loading Skeleton -->
                    <div v-if="loading">
                        <!-- Contact Information Skeleton -->
                        <div class="bg-white shadow-sm rounded-lg p-6 mb-8 animate-pulse">
                            <div class="h-6 bg-gray-200 rounded w-48 mb-4"></div>
                            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                <div class="sm:col-span-2">
                                    <div class="h-4 bg-gray-200 rounded w-24 mb-2"></div>
                                    <div class="h-10 bg-gray-200 rounded"></div>
                                </div>
                                <div>
                                    <div class="h-4 bg-gray-200 rounded w-20 mb-2"></div>
                                    <div class="h-10 bg-gray-200 rounded"></div>
                                </div>
                                <div>
                                    <div class="h-4 bg-gray-200 rounded w-20 mb-2"></div>
                                    <div class="h-10 bg-gray-200 rounded"></div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="h-4 bg-gray-200 rounded w-16 mb-2"></div>
                                    <div class="h-10 bg-gray-200 rounded"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Shipping Address Skeleton -->
                        <div class="bg-white shadow-sm rounded-lg p-6 mb-8 animate-pulse">
                            <div class="h-6 bg-gray-200 rounded w-40 mb-4"></div>
                            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                <div class="sm:col-span-2">
                                    <div class="h-4 bg-gray-200 rounded w-16 mb-2"></div>
                                    <div class="h-10 bg-gray-200 rounded"></div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="h-4 bg-gray-200 rounded w-20 mb-2"></div>
                                    <div class="h-10 bg-gray-200 rounded"></div>
                                </div>
                                <div>
                                    <div class="h-4 bg-gray-200 rounded w-12 mb-2"></div>
                                    <div class="h-10 bg-gray-200 rounded"></div>
                                </div>
                                <div>
                                    <div class="h-4 bg-gray-200 rounded w-24 mb-2"></div>
                                    <div class="h-10 bg-gray-200 rounded"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Notes Skeleton -->
                        <div class="bg-white shadow-sm rounded-lg p-6 mb-8 animate-pulse">
                            <div class="h-6 bg-gray-200 rounded w-36 mb-4"></div>
                            <div class="h-4 bg-gray-200 rounded w-24 mb-2"></div>
                            <div class="h-24 bg-gray-200 rounded"></div>
                        </div>
                        
                        <!-- Place Order Button Skeleton -->
                        <div class="bg-white shadow-sm rounded-lg p-6 animate-pulse">
                            <div class="h-12 bg-gray-200 rounded"></div>
                        </div>
                    </div>

                    <!-- Actual Form -->
                    <form v-else @submit.prevent="checkout" ref="checkoutForm">
                        <!-- Contact Information -->
                        <div class="bg-white shadow-sm rounded-lg p-6 mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{$t('checkout.contact_information')}}</h3>
                            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                <div class="sm:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                        {{$t('checkout.email_address')}} <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-1">
                                        <input
                                            type="email"
                                            v-model.trim="formData.email"
                                            id="email"
                                            name="email"
                                            autocomplete="email"
                                            required
                                            @blur="validateField('email')"
                                            @input="clearFieldError('email')"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.email }">
                                        <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email }}</p>
                                    </div>
                                </div>
                                <div>
                                    <label for="first-name" class="block text-sm font-medium text-gray-700">
                                        {{$t('checkout.first_name')}} <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-1">
                                        <input
                                            type="text"
                                            v-model.trim="formData.first_name"
                                            id="first-name"
                                            name="first-name"
                                            autocomplete="given-name"
                                            required
                                            @blur="validateField('first_name')"
                                            @input="clearFieldError('first_name')"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.first_name }">
                                        <p v-if="errors.first_name" class="mt-1 text-sm text-red-600">{{ errors.first_name }}</p>
                                    </div>
                                </div>
                                <div>
                                    <label for="last-name" class="block text-sm font-medium text-gray-700">
                                        {{$t('checkout.last_name')}} <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-1">
                                        <input
                                            type="text"
                                            id="last-name"
                                            v-model.trim="formData.last_name"
                                            name="last-name"
                                            autocomplete="family-name"
                                            required
                                            @blur="validateField('last_name')"
                                            @input="clearFieldError('last_name')"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.last_name }">
                                        <p v-if="errors.last_name" class="mt-1 text-sm text-red-600">{{ errors.last_name }}</p>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">
                                        {{$t('checkout.phone')}} <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-1">
                                        <input
                                            type="tel"
                                            id="phone"
                                            v-model.trim="formData.phone"
                                            name="phone"
                                            autocomplete="tel"
                                            required
                                            @blur="validateField('phone')"
                                            @input="clearFieldError('phone')"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.phone }">
                                        <p v-if="errors.phone" class="mt-1 text-sm text-red-600">{{ errors.phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Shipping Address -->
                        <div class="bg-white shadow-sm rounded-lg p-6 mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{$t('checkout.shipping_address')}}</h3>
                            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                <div class="sm:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700">
                                        {{$t('checkout.address')}} <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-1">
                                        <input
                                            type="text"
                                            v-model.trim="formData.address"
                                            id="address"
                                            name="address"
                                            autocomplete="street-address"
                                            required
                                            @blur="validateField('address')"
                                            @input="clearFieldError('address')"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.address }">
                                        <p v-if="errors.address" class="mt-1 text-sm text-red-600">{{ errors.address }}</p>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="apartment" class="block text-sm font-medium text-gray-700">{{$t('checkout.apartment')}}</label>
                                    <div class="mt-1">
                                        <input
                                            type="text"
                                            id="apartment"
                                            name="apartment"
                                            v-model.trim="formData.apartment"
                                            @input="clearFieldError('apartment')"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.apartment }">
                                        <p v-if="errors.apartment" class="mt-1 text-sm text-red-600">{{ errors.apartment }}</p>
                                    </div>
                                </div>
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700">
                                        {{$t('checkout.city')}} <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-1">
                                        <input
                                            type="text"
                                            id="city"
                                            name="city"
                                            v-model.trim="formData.city"
                                            autocomplete="address-level2"
                                            required
                                            @blur="validateField('city')"
                                            @input="clearFieldError('city')"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.city }">
                                        <p v-if="errors.city" class="mt-1 text-sm text-red-600">{{ errors.city }}</p>
                                    </div>
                                </div>
                                <div>
                                    <label for="postal-code" class="block text-sm font-medium text-gray-700">
                                        {{$t('checkout.postal_code')}} <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-1">
                                        <input
                                            type="text"
                                            id="postal-code"
                                            v-model.trim="formData.postal_code"
                                            name="postal-code"
                                            autocomplete="postal-code"
                                            required
                                            @blur="validateField('postal_code')"
                                            @input="clearFieldError('postal_code')"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.postal_code }">
                                        <p v-if="errors.postal_code" class="mt-1 text-sm text-red-600">{{ errors.postal_code }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Notes -->
                        <div class="bg-white shadow-sm rounded-lg p-6 mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{$t('checkout.additional_notes')}}</h3>
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700">{{$t('checkout.order_notes')}}</label>
                                <div class="mt-1">
                                    <textarea
                                        id="notes"
                                        name="notes"
                                        v-model.trim="formData.notes"
                                        rows="3"
                                        :placeholder="$t('checkout.placeholder_notes')"
                                        @input="clearFieldError('notes')"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500': errors.notes }"></textarea>
                                    <p v-if="errors.notes" class="mt-1 text-sm text-red-600">{{ errors.notes }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Place Order Button -->
                        <div class="bg-white shadow-sm rounded-lg p-6">
                            <button
                                type="submit"
                                :disabled="isProcessing || items.length === 0 || !isFormValid || loading"
                                class="w-full bg-green-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
                                <svg v-if="isProcessing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ isProcessing ? $t('checkout.processing') : (loading ? 'Loading...' : $t('checkout.place_order')) }}
                            </button>
                            
                            <!-- Form validation summary -->
                            <div v-if="!isFormValid && Object.keys(errors).length > 0" class="mt-4 p-3 bg-red-50 border border-red-200 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">{{$t('checkout.form_errors')}}</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <ul class="list-disc pl-5 space-y-1">
                                                <li v-for="(error, field) in errors" :key="field">{{ error }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
                
                <!-- Order Summary -->
                <section aria-labelledby="summary-heading"
                    class="mt-16 bg-white rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5">
                    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">{{$t('checkout.order_summary')}}</h2>
                    
                    <!-- Order Summary Loading Skeleton -->
                    <div v-if="loading" class="mt-6 space-y-4 animate-pulse">
                        <!-- Item skeletons -->
                        <div v-for="n in 3" :key="n" class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <div class="flex items-center text-sm">
                                <div class="h-4 bg-gray-200 rounded w-32"></div>
                            </div>
                            <div class="h-4 bg-gray-200 rounded w-16"></div>
                        </div>
                        <!-- Total skeleton -->
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <div class="h-5 bg-gray-200 rounded w-24"></div>
                            <div class="h-5 bg-gray-200 rounded w-20"></div>
                        </div>
                        <!-- Eco message skeleton -->
                        <div class="mt-8 border-t border-gray-200 pt-6 space-y-4">
                            <div class="flex items-center">
                                <div class="h-5 w-5 bg-gray-200 rounded mr-2"></div>
                                <div class="h-4 bg-gray-200 rounded w-48"></div>
                            </div>
                            <div class="flex items-center">
                                <div class="h-5 w-5 bg-gray-200 rounded mr-2"></div>
                                <div class="h-4 bg-gray-200 rounded w-32"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Actual Order Summary -->
                    <div v-else-if="items.length > 0" class="mt-6 space-y-4">
                        <div v-for="item in items" :key="item.id" class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="flex items-center text-sm text-gray-600">
                                <span>{{ item.product_name }} ({{ item.quantity }})</span>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">{{ formatPrice(item.product_price) }} MAD</dd>
                        </div>
                        
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="text-base font-medium text-gray-900">{{$t('checkout.order_total')}}</dt>
                            <dd class="text-base font-medium text-gray-900">{{ formatPrice(total) }} MAD</dd>
                        </div>
                    </div>
                    
                    <!-- Empty Cart State -->
                    <div v-else-if="!loading" class="mt-6 text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">{{$t('checkout.empty_cart')}}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{$t('checkout.add_products')}}</p>
                        <div class="mt-6">
                            <a href="/products" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                {{$t('checkout.continue_shopping')}}
                            </a>
                        </div>
                    </div>
                    
                    <!-- Eco-friendly message -->
                    <div v-if="!loading && items.length > 0" class="mt-8 border-t border-gray-200 pt-6">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="ml-2 text-sm text-gray-500">
                                {{$t('checkout.eco_message')}}
                            </p>
                        </div>
                        <div class="flex items-center mt-4">
                            <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="ml-2 text-sm text-gray-500">
                                {{$t('checkout.secure_checkout')}}
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        
        <Footer/>
        
        <!-- Toast Notifications -->
        <div v-if="toast.show" class="fixed bottom-4 right-4 z-50">
            <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-4 max-w-sm w-full"
                :class="toast.type === 'success' ? 'border-green-200' : 'border-red-200'">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg v-if="toast.type === 'success'" class="h-5 w-5 text-green-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg v-else class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium"
                            :class="toast.type === 'success' ? 'text-green-800' : 'text-red-800'">
                            {{ toast.message }}
                        </p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button @click="toast.show = false" class="inline-flex text-gray-400 hover:text-gray-500">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import { ref, onMounted, computed, reactive, watch } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useI18n } from 'vue-i18n';
import api from '../axios';

const { t } = useI18n();
const router = useRouter();

const items = ref([]);
const loading = ref(false);
const isProcessing = ref(false);
const errors = ref({});
const checkoutForm = ref(null);

const toast = ref({
    show: false,
    message: '',
    type: 'success'
});

const formData = reactive({
    email: '',
    first_name: '',
    last_name: '',
    phone: '',
    address: '',
    apartment: '',
    city: '',
    postal_code: '',
    notes: ''
});

// Configure axios base URL at the top of the script
const API_BASE_URL = 'http://localhost:8000';

// Utility functions
const formatPrice = (price) => {
    const numPrice = parseFloat(price) || 0;
    return new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(numPrice);
};

// Validation rules
const validationRules = {
    email: {
        required: true,
        pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        message: 'Please enter a valid email address'
    },
    first_name: {
        required: true,
        minLength: 2,
        message: 'First name must be at least 2 characters'
    },
    last_name: {
        required: true,
        minLength: 2,
        message: 'Last name must be at least 2 characters'
    },
    phone: {
        required: true,
        pattern: /^[\+]?[0-9\s\-()]{10,}$/,
        message: 'Please enter a valid phone number'
    },
    address: {
        required: true,
        minLength: 5,
        message: 'Address must be at least 5 characters'
    },
    city: {
        required: true,
        minLength: 2,
        message: 'City must be at least 2 characters'
    },
    postal_code: {
        required: true,
        minLength: 3,
        message: 'Please enter a valid postal code'
    }
};

// Validate individual field
const validateField = (fieldName) => {
    const rule = validationRules[fieldName];
    const value = formData[fieldName];
    
    if (!rule) return true;
    
    // Check required
    if (rule.required && (!value || value.trim() === '')) {
        errors.value[fieldName] = `${fieldName.replace('_', ' ')} is required`;
        return false;
    }
    
    // Check minimum length
    if (rule.minLength && value && value.trim().length < rule.minLength) {
        errors.value[fieldName] = rule.message;
        return false;
    }
    
    // Check pattern
    if (rule.pattern && value && !rule.pattern.test(value.trim())) {
        errors.value[fieldName] = rule.message;
        return false;
    }
    
    // Clear error if validation passes
    delete errors.value[fieldName];
    return true;
};

// Clear field error
const clearFieldError = (fieldName) => {
    if (errors.value[fieldName]) {
        delete errors.value[fieldName];
    }
};

// Validate entire form
const validateForm = () => {
    const requiredFields = Object.keys(validationRules);
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });
    
    return isValid;
};

// Computed property to check if form is valid
const isFormValid = computed(() => {
    const requiredFields = Object.keys(validationRules);
    
    // Check if all required fields are filled
    const allFieldsFilled = requiredFields.every(field => {
        const value = formData[field];
        return value && value.trim() !== '';
    });
    
    // Check if there are no validation errors
    const noErrors = Object.keys(errors.value).length === 0;
    
    return allFieldsFilled && noErrors;
});

// Update the cartItems function
const cartItems = async () => {
    loading.value = true;
    try {
        const response = await api.get(`/cart`);
        
        items.value = response.data.cart_items || [];
        console.log('Cart items loaded:', items.value);
    } catch (error) {
        console.error('Failed to load cart:', error);
        showToast(t('checkout.toast_load_cart_failed'), 'error');
    } finally {
        loading.value = false;
    }
};

const total = computed(() => {
    return items.value.reduce((sum, item) => {
        return sum + (parseFloat(item.product_price) * parseInt(item.quantity));
    }, 0);
});

const showToast = (message, type = 'success') => {
    toast.value = { show: true, message, type };
    setTimeout(() => {
        toast.value.show = false;
    }, 5000);
};

// Update the checkout function
const checkout = async () => {
    console.log('Checkout function called');
    
    // Prevent double submission
    if (isProcessing.value) {
        console.log('Already processing, returning');
        return;
    }
    
    // Clear previous errors
    errors.value = {};
    
    // Check if cart is empty
    if (items.value.length === 0) {
        showToast(t('checkout.toast_cart_empty'), 'error');
        return;
    }
    
    // Validate form
    if (!validateForm()) {
        console.log('Form validation failed:', errors.value);
        showToast(t('checkout.toast_form_invalid'), 'error');
        return;
    }
    
    isProcessing.value = true;
    
    try {
        console.log('Sending checkout request with data:', formData);
        
        const response = await api.post(`/checkout`, formData);
        
        console.log('Checkout response:', response.data);
        
        // Handle successful checkout
        if (response.data.success || response.data.message) {
            showToast(t('checkout.toast_order_success'), 'success');
            // Clear the cart items from frontend only on success
            items.value = [];
            // Reset form
            Object.keys(formData).forEach(key => {
                formData[key] = '';
            });
            // Navigate to success page or home
            setTimeout(() => {
                router.push('/');
            }, 2000);
        }
        
    } catch (error) {
        console.error('Checkout failed:', error);
        
        if (error.response) {
            console.log('Error response:', error.response.data);
            
            if (error.response.status === 422) {
                // Handle validation errors from server
                const serverErrors = error.response.data.errors || {};
                Object.keys(serverErrors).forEach(field => {
                    errors.value[field] = Array.isArray(serverErrors[field])
                        ? serverErrors[field][0]
                        : serverErrors[field];
                });
                showToast(t('checkout.toast_check_form_errors'), 'error');
            } else if (error.response.status === 400) {
                showToast(error.response.data.message || t('checkout.toast_cart_empty'), 'error');
            } else if (error.response.status === 401) {
                showToast(t('checkout.toast_login_required'), 'error');
                router.push('/login');
            } else {
                showToast(t('checkout.toast_checkout_failed'), 'error');
            }
        } else if (error.code === 'ERR_NETWORK') {
            showToast(t('checkout.toast_server_unreachable'), 'error');
        } else {
            showToast(t('checkout.toast_network_error'), 'error');
        }
        console.error('Checkout error details:', error);
    } finally {
        isProcessing.value = false;
    }
};

// Watch for form changes to validate in real-time
watch(formData, () => {
    // Debounce validation to avoid excessive calls
    clearTimeout(window.validationTimeout);
    window.validationTimeout = setTimeout(() => {
        Object.keys(validationRules).forEach(field => {
            if (formData[field] && formData[field].trim() !== '') {
                validateField(field);
            }
        });
    }, 300);
}, { deep: true });

onMounted(() => {
    cartItems();
});
</script>

<style scoped>
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
