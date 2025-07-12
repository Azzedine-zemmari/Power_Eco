<template>
    <button @click="logout" :class="computedClass">
    {{ $t('nav.links.logout') }}
  </button>
</template>
<script setup>
import api from '../axios';
import { useRouter } from 'vue-router';
import { computed } from 'vue';
import { useAuthStore } from '@/stores/AuthStore';

const auth = useAuthStore();

const props = defineProps({
    variant:{
        type:String,
        default:'default'
    }
})

const router = useRouter()

const computedClass = computed(()=>{
    switch(props.variant){
        case 'sidebar':
            return 'text-green-100 hover:bg-green-700 group flex items-center px-2 py-2 text-base font-medium rounded-md w-full'
        case 'default':
            return 'bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600'
    }
})

    async function logout() {
        try {
            await auth.logout();
            // Redirect to login page after successful logout
            router.push('/login');
        } catch (error) {
            console.error('Logout error:', error);
            // Even if there's an error, redirect to login
            router.push('/login');
        }
    }
</script>