import axios from 'axios';
import router from './router';
import { useAuthStore } from '../js/stores/AuthStore'

const api = axios.create({
    baseURL:'http://localhost:8000/api',
    headers:{
        Accept:'application/json'
    }
})

// automatic add token to requests 
api.interceptors.request.use(config=>{
    const token = localStorage.getItem('token');
    if(token){
        config.headers.Authorization = `Bearer ${token}`
    }
    return config;
})

// Interceptor to handle token expiration 
api.interceptors.response.use(
    response => response,
    error => {
        const originalRequest = error.config;

        //if token expired , logout and redirect
        if(error.response && error.response.status === 401){
            const message = error.response.data.message;

            if(message && message.toLowerCase().includes('token expired')){
                // clear auth info
                const authStore = useAuthStore();
                authStore.clearAuth(); 
                delete api.defaults.headers.common['Authorization'];

                // redirect to login 
                router.push('/')
                return Promise.reject(error)
            }
        }
        return Promise.reject(error);
    }
)

export default api;