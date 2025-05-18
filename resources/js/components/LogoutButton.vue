<template>
    <button @click="logout" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
    Logout
  </button>
</template>
<script setup>
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter()

async function logout() {
    try{
        const token = localStorage.getItem('token')

        await axios.post('http://localhost:8000/api/logout',{},{
            headers : {
                Authorization : `Bearer ${token}`
            }
        })

        localStorage.removeItem('token')
        router.push('/login')
    }catch(error){
        console.error('Logout failed: ',error)
        alert('Logout failed .')
    }
}
</script>