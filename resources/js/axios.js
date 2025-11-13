import axios from 'axios';
import router from './router';
import { useAuthStore } from '../js/stores/AuthStore'

const api = axios.create({
    baseURL:'https://powerEco.onrender.com/api',
    withCredentials: true, // This is crucial for sending cookies!
    headers:{
        Accept:'application/json'
    }
})

// Interceptor to handle authentication errors
api.interceptors.response.use(
    response => response,
    error => {
        const originalRequest = error.config;

        // Handle 401 Unauthorized errors
        if(error.response && error.response.status === 401){
            const message = error.response.data.message;

            if(message && message.toLowerCase().includes('token expired')){
                // Clear auth info
                const authStore = useAuthStore();
                authStore.clearAuth();

                // Redirect to login
                router.push('/login');
                return Promise.reject(error);
            }
        }
        return Promise.reject(error);
    }
)

export default api;