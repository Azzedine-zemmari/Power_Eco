import { defineStore } from 'pinia'
import { ref } from 'vue'
import api from '../axios'

export const useCartStore = defineStore('cart', () => {
  const cartCount = ref(0)

  const fetchCartCount = async () => {
    try {
      const res = await api.get('/cart/count') 
      cartCount.value = res.data ?? 0
    } catch (error) {
      console.error(error)
      cartCount.value = 0
    }
  }

  return { cartCount, fetchCartCount }
})
