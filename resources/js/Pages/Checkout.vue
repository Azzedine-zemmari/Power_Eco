<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <Navbar/>
        <!-- Page Header -->
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start xl:gap-x-16">
                <!-- Checkout Form -->
                <section aria-labelledby="checkout-heading" class="lg:col-span-7">
                    <h2 id="checkout-heading" class="sr-only">Checkout form</h2>

                    <form @submit.prevent="checkout">
                        <!-- Contact Information -->
                        <div class="bg-white shadow-sm rounded-lg p-6 mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                <div class="sm:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                    <div class="mt-1">
                                        <input 
                                            type="email" 
                                            v-model="formData.email" 
                                            id="email" 
                                            name="email" 
                                            autocomplete="email"
                                            required
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300': errors.email }">
                                        <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email[0] }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>
                                    <div class="mt-1">
                                        <input 
                                            type="text" 
                                            v-model="formData.first_name" 
                                            id="first-name" 
                                            name="first-name" 
                                            autocomplete="given-name"
                                            required
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300': errors.first_name }">
                                        <p v-if="errors.first_name" class="mt-1 text-sm text-red-600">{{ errors.first_name[0] }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Last name</label>
                                    <div class="mt-1">
                                        <input 
                                            type="text" 
                                            id="last-name" 
                                            v-model="formData.last_name" 
                                            name="last-name" 
                                            autocomplete="family-name"
                                            required
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300': errors.last_name }">
                                        <p v-if="errors.last_name" class="mt-1 text-sm text-red-600">{{ errors.last_name[0] }}</p>
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                    <div class="mt-1">
                                        <input 
                                            type="tel" 
                                            id="phone" 
                                            v-model="formData.phone" 
                                            name="phone" 
                                            autocomplete="tel"
                                            required
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300': errors.phone }">
                                        <p v-if="errors.phone" class="mt-1 text-sm text-red-600">{{ errors.phone[0] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="bg-white shadow-sm rounded-lg p-6 mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Shipping Address</h3>
                            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                <div class="sm:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                    <div class="mt-1">
                                        <input 
                                            type="text" 
                                            v-model="formData.address" 
                                            id="address" 
                                            name="address" 
                                            autocomplete="street-address"
                                            required
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300': errors.address }">
                                        <p v-if="errors.address" class="mt-1 text-sm text-red-600">{{ errors.address[0] }}</p>
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="apartment" class="block text-sm font-medium text-gray-700">Apartment, suite, etc.</label>
                                    <div class="mt-1">
                                        <input 
                                            type="text" 
                                            id="apartment" 
                                            name="apartment" 
                                            v-model="formData.apartment"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300': errors.apartment }">
                                        <p v-if="errors.apartment" class="mt-1 text-sm text-red-600">{{ errors.apartment[0] }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                    <div class="mt-1">
                                        <input 
                                            type="text" 
                                            id="city" 
                                            name="city" 
                                            v-model="formData.city" 
                                            autocomplete="address-level2"
                                            required
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300': errors.city }">
                                        <p v-if="errors.city" class="mt-1 text-sm text-red-600">{{ errors.city[0] }}</p>
                                    </div>
                                </div>

                                <div>
                                    <label for="postal-code" class="block text-sm font-medium text-gray-700">Postal code</label>
                                    <div class="mt-1">
                                        <input 
                                            type="text" 
                                            id="postal-code" 
                                            v-model="formData.postal_code" 
                                            name="postal-code"
                                            autocomplete="postal-code"
                                            required
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                            :class="{ 'border-red-300': errors.postal_code }">
                                        <p v-if="errors.postal_code" class="mt-1 text-sm text-red-600">{{ errors.postal_code[0] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        <div class="bg-white shadow-sm rounded-lg p-6 mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Notes</h3>
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700">Order notes (optional)</label>
                                <div class="mt-1">
                                    <textarea 
                                        id="notes" 
                                        name="notes" 
                                        v-model="formData.notes" 
                                        rows="3"
                                        placeholder="Special delivery instructions, gift message, etc."
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                        :class="{ 'border-red-300': errors.notes }"></textarea>
                                    <p v-if="errors.notes" class="mt-1 text-sm text-red-600">{{ errors.notes[0] }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <div class="bg-white shadow-sm rounded-lg p-6">
                            <button 
                                type="submit"
                                :disabled="isProcessing || items.length === 0"
                                class="w-full bg-green-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg v-if="isProcessing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ isProcessing ? 'Processing...' : 'Place Order' }}
                            </button>
                        </div>
                    </form>
                </section>

                <!-- Order Summary -->
                <section aria-labelledby="summary-heading"
                    class="mt-16 bg-white rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5">
                    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>

                    <div v-if="items.length > 0" class="mt-6 space-y-4">
                        <div v-for="item in items" :key="item.id" class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="flex items-center text-sm text-gray-600">
                                <span>{{ item.product_name }} ({{ item.quantity }})</span>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">MAD {{ parseFloat(item.product_price).toFixed(2) }}</dd>
                        </div>
                        
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="text-base font-medium text-gray-900">Order total</dt>
                            <dd class="text-base font-medium text-gray-900">MAD {{ total.toFixed(2) }}</dd>
                        </div>
                    </div>

                    <div v-else class="mt-6 text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Your cart is empty</h3>
                        <p class="mt-1 text-sm text-gray-500">Add some products to continue with checkout.</p>
                        <div class="mt-6">
                            <a href="/products" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                Continue Shopping
                            </a>
                        </div>
                    </div>

                    <!-- Eco-friendly message -->
                    <div v-if="items.length > 0" class="mt-8 border-t border-gray-200 pt-6">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="ml-2 text-sm text-gray-500">
                                Your purchase helps reduce carbon emissions and supports sustainable living.
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
                                Secure checkout
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
import { ref,onMounted, computed,reactive } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

let items = ref([])
const isProcessing = ref(false);
const errors = ref({});

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

const router = useRouter();

const cartItems = async () => {
    try {
        const response = await axios.get('/api/cart', {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        
        items.value = response.data.cart_items;
        console.log(items.value);
    } catch (error) {
        console.error(error);
        alert('Failed to load cart');
    }
}

const total = computed(()=>{
    return items.value.reduce((sum,item)=>{
        return sum+(parseFloat(item.product_price) * parseInt(item.quantity))
    },0)
})

// Add toast ref
const toast = ref({
    show: false,
    message: '',
    type: 'success'
})

// Add showToast method
const showToast = (message, type = 'success') => {
    toast.value = { show: true, message, type }
    setTimeout(() => {
        toast.value.show = false
    }, 5000)
}

const checkout = async () => {
    // Get CSRF cookie from Laravel Sanctum
    await axios.get('http://localhost:8000/sanctum/csrf-cookie', { withCredentials: true });
    if (isProcessing.value) return;
    
    // Clear previous errors
    errors.value = {};
    
    // Check if cart is empty
    if (items.value.length === 0) {
        showToast('Your cart is empty. Please add some products before checkout.', 'error');
        return;
    }
    
    isProcessing.value = true;
    
    try {
        const response = await axios.post('/api/checkout', formData, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`,
                'Content-Type': 'application/json'
            }
        });
        
        // Handle successful checkout
        if (response.data.message) {
            showToast('Order placed successfully!', 'success');
            
            // Clear the cart items from frontend
            items.value = [];
            
            // Reset form
            Object.keys(formData).forEach(key => {
                if (key !== 'email' && key !== 'first_name' && key !== 'last_name') {
                    formData[key] = '';
                }
            });
            
            // Use router to navigate after showing toast
            setTimeout(() => {
                router.push('/');
            }, 2000);
        }
        
    } catch (error) {
        console.error('Checkout failed:', error);
        
        if (error.response && error.response.status === 422) {
            // Handle validation errors
            errors.value = error.response.data.errors || {};
        } else if (error.response && error.response.status === 400) {
            // Handle cart empty error
            showToast(error.response.data.message || 'Cart is empty', 'error');
        } else {
            showToast('Checkout failed. Please try again.', 'error');
        }
    } finally {
        isProcessing.value = false;
    }
}
onMounted(() => {
    cartItems();
});
</script>