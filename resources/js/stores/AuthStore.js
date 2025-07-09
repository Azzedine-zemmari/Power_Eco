// stores/authStore.js
import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import router from '../router'

export const useAuthStore = defineStore('auth', () => {
    const token = ref(localStorage.getItem('token') || null)
    const role = ref(localStorage.getItem('role') || null)

    const isAuthenticated = computed(() => !!token.value)

    const setAuth = (newToken, newRole) => {
        token.value = newToken
        role.value = newRole
        localStorage.setItem('token', newToken)
        localStorage.setItem('role', newRole)
    }

    const clearAuth = () => {
        token.value = null
        role.value = null
        localStorage.removeItem('token')
        localStorage.removeItem('role')
    }

    const logout = async () => {
        try {
            await axios.post('/api/logout', {}, {
                headers: {
                    Authorization: `Bearer ${token.value}`
                }
            })
        } catch (err) {
            console.error('Logout error:', err)
        } finally {
            clearAuth()
            router.push('/login')
        }
    }

    return {
        token,
        role,
        isAuthenticated,
        setAuth,
        clearAuth,
        logout
    }
})
