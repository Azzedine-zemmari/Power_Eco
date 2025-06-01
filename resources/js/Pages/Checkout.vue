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

                    <form>
                        <!-- Contact Information -->
                        <div class="bg-white shadow-sm rounded-lg p-6 mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
                            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                <div class="sm:col-span-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email
                                        address</label>
                                    <div class="mt-1">
                                        <input type="email" id="email" name="email" autocomplete="email"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label for="first-name" class="block text-sm font-medium text-gray-700">First
                                        name</label>
                                    <div class="mt-1">
                                        <input type="text" id="first-name" name="first-name" autocomplete="given-name"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Last
                                        name</label>
                                    <div class="mt-1">
                                        <input type="text" id="last-name" name="last-name" autocomplete="family-name"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                    <div class="mt-1">
                                        <input type="text" id="phone" name="phone" autocomplete="tel"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
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
                                        <input type="text" id="address" name="address" autocomplete="street-address"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="apartment" class="block text-sm font-medium text-gray-700">Apartment,
                                        suite, etc.</label>
                                    <div class="mt-1">
                                        <input type="text" id="apartment" name="apartment"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                    <div class="mt-1">
                                        <input type="text" id="city" name="city" autocomplete="address-level2"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label for="state" class="block text-sm font-medium text-gray-700">State /
                                        Province</label>
                                    <div class="mt-1">
                                        <input type="text" id="state" name="state" autocomplete="address-level1"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label for="postal-code" class="block text-sm font-medium text-gray-700">Postal
                                        code</label>
                                    <div class="mt-1">
                                        <input type="text" id="postal-code" name="postal-code"
                                            autocomplete="postal-code"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                    <div class="mt-1">
                                        <select id="country" name="country" autocomplete="country-name"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            <option>United States</option>
                                            <option>Canada</option>
                                            <option>Mexico</option>
                                            <option>United Kingdom</option>
                                            <option>Germany</option>
                                            <option>France</option>
                                            <option>Australia</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <div class="flex items-center">
                                        <input id="same-billing" name="same-billing" type="checkbox" checked
                                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                        <label for="same-billing" class="ml-2 block text-sm text-gray-700">
                                            Billing address is the same as shipping address
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Notes -->
                        <div class="bg-white shadow-sm rounded-lg p-6 mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Notes</h3>
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700">Order notes
                                    (optional)</label>
                                <div class="mt-1">
                                    <textarea id="notes" name="notes" rows="3"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>

                <!-- Order Summary -->
                <section aria-labelledby="summary-heading"
                    class="mt-16 bg-white rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5">
                    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>

                    <div class="mt-6 space-y-4">
                        <div v-for="item in items" :key="item.id" class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="flex items-center text-sm text-gray-600">
                                <span>{{ item.product_name }} ({{ item.quantity }})</span>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">MAD {{ item.product_price }} </dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="text-base font-medium text-gray-900">Order total</dt>
                            <dd class="text-base font-medium text-gray-900">${{ total.toFixed(2) }}</dd>
                        </div>
                    </div>

                    <!-- Promo Code -->
                    <!-- <div class="mt-6">
                        <div class="flex items-center">
                            <input type="text" id="promo-code" name="promo-code" placeholder="Promo code"
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            <button type="button"
                                class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Apply
                            </button>
                        </div>
                    </div> -->

                    <!-- Place Order Button -->
                    <div class="mt-6">
                        <button type="submit"
                            class="w-full bg-green-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 flex items-center justify-center">
                            Place Order
                        </button>
                    </div>

                    <!-- Eco-friendly message -->
                    <div class="mt-8 border-t border-gray-200 pt-6">
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
    </div>
</template>
<script setup>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import { ref,onMounted, computed } from 'vue';

let items = ref([])
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

onMounted(() => {
    cartItems();
});
</script>