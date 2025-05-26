<template>
    <button @click="logout" :class="computedClass">
    Logout
  </button>
</template>
<script setup>
import axios from 'axios';
import { useRouter } from 'vue-router';
import { ref,computed } from 'vue';

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
    try{
        const token = localStorage.getItem('token')

        await axios.post('http://localhost:8000/api/logout',{},{
            headers : {
                Authorization : `Bearer ${token}`
            }
        })

        localStorage.removeItem('token')
        localStorage.removeItem('role')
        router.push('/login')
    }catch(error){
        console.error('Logout failed: ',error)
        alert('Logout failed .')
    }
}
</script>