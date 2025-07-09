import { defineStore } from 'pinia'
import { ref } from 'vue'
import api from '../axios'

export const useCartStore = defineStore('cart', () => {
  const cartCount = ref(0)

  const fetchCartCount = async () => {
    const token = localStorage.getItem('token')
    if (!token) {
      cartCount.value = 0
      return
    }
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
