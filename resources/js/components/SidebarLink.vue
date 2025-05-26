<template>
    <a :href="to" :class="[
        'group flex items-center px-2 py-2 text-base font-medium rounded-md',
        active ? 'bg-green-700 text-white' : 'text-green-100 hover:bg-green-700'
    ]">
        <component :is="iconComponent" class="mr-3 h-6 w-6 text-green-300" />
        {{ label }}
    </a>
</template>
<script setup>
import { computed } from 'vue';
import {
  HomeIcon,
  FolderIcon,
  CubeIcon,
  CogIcon,
  ChartBarIcon
} from '@heroicons/vue/24/outline'


const props = defineProps({
    to:String,
    label:String,
    icon:String,
    active:Boolean
})

const iconComponent =  computed(()=>{
    switch(props.icon){
        case 'home':return HomeIcon
        case 'folder':return FolderIcon
        case 'cube':return CubeIcon
        case 'cog':return CogIcon
        case 'chart-bar':return ChartBarIcon
        default:return HomeIcon
    }
})
</script>