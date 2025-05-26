<template>
    <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-64 bg-green-800">
            <!-- Logo -->
            <div class="flex items-center h-16 flex-shrink-0 px-4 bg-green-900">
                <span class="text-white font-bold text-xl">
                    Eco<span class="text-green-300">Move</span>
                </span>
            </div>

            <div class="h-0 flex-1 flex flex-col overflow-y-auto">
                <!-- User Info -->
                <div class="flex items-center flex-shrink-0 px-4 py-4 border-b border-green-700">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full"
                            src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e" alt="" />
                    </div>
                    <div class="ml-3">
                        <p class="text-base font-medium text-white">Michael Roberts</p>
                        <p class="text-sm font-medium text-green-200">Product Manager</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="mt-5 px-2 space-y-1">
                    <SidebarLink to="/productManager/dashboard" icon="home" label="Dashboard"
                        :active="current === '/productManager/dashboard'" />
                    <SidebarLink to="/productManager/Product/Category" icon="folder" label="Categories"
                        :active="current === '/productManager/Product/Category'" />
                    <SidebarLink to="/productManager/Products" icon="cube" label="Products"
                        :active="current === '/productManager/Products'" />
                    <SidebarLink to="#" icon="chart-bar" label="Analytics" :active="false" />
                    <SidebarLink to="#" icon="cog" label="Settings" :active="false" />
                    <LogoutButton variant="sidebar" />
                </nav>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useRoute } from 'vue-router'
import SidebarLink from './SidebarLink.vue'
import LogoutButton from './LogoutButton.vue'

const route = useRoute()
const current = route.path
</script>
