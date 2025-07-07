<template>
    <div>
        <p>this is router</p>
        <div v-if="products.length">
            <ul>
                <li v-for="product in products" :key="product.id">{{ product.name }}</li>
            </ul>
        </div>
        <div v-else>
            Loading...
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const products = ref([])

onMounted(async () => {
    try {
        const response = await axios.get('http://localhost:8000/debug-products')
        products.value = response.data
    } catch (error) {
        console.error(error)
    }
})
</script>