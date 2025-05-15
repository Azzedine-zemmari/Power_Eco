<template>
    <div>
        <h2>Home</h2>
        <router-link to="/test">Test router</router-link>
        <button @click.prevent="getValue()">Trigger button</button>
        <p v-if="response">{{ response.data }}</p>
    </div>
</template>
<script setup>
import axios from "axios";
import { ref } from "vue";

const response = ref();
const getValue = async () => {
    try {
        response.value = await axios.get("/api/test")
    } catch (error) {
        console.log(error)
    }
}
</script>