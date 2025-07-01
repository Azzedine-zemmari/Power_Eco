<template>
    <div class="min-h-screen bg-gray-50">

        <!-- Mobile Navigation Header -->
        <div class="lg:hidden bg-green-800 shadow-sm sticky top-0 z-40">
            <div class="flex items-center justify-between px-4 py-3">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true"
                        class="text-white hover:text-green-200 mr-3 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-50 rounded-md p-1">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <span class="text-white font-bold text-xl">Eco<span class="text-green-300">Move</span></span>
                </div>
            </div>
        </div>

        <div class="flex min-h-screen">
            <!-- Mobile Sidebar Overlay -->
            <div v-show="sidebarOpen" class="fixed inset-0 z-50 lg:hidden" @click="sidebarOpen = false">
                <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity duration-300"></div>
                <div class="relative flex flex-col max-w-xs w-full bg-green-800 h-full shadow-xl transform transition-transform duration-300 ease-in-out"
                    @click.stop>
                    <!-- Close button -->
                    <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button @click="sidebarOpen = false"
                            class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white bg-green-700 hover:bg-green-600 transition-colors duration-200">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Mobile Sidebar Content -->
                    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                        <div class="flex-shrink-0 flex items-center px-4 mb-8">
                            <span class="text-white font-bold text-xl">Eco<span
                                    class="text-green-300">Move</span></span>
                        </div>

                        <!-- User Info Section for Mobile -->
                        <div class="flex items-center px-4 py-4 border-b border-green-700 mb-4">
                            <div class="ml-3">
                                <p class="text-base font-medium text-white">Admin User</p>
                                <p class="text-sm font-medium text-green-200">Administrator</p>
                            </div>
                        </div>

                        <!-- Navigation Menu for Mobile -->
                        <nav class="px-2 space-y-1">
                            <a href="#"
                                class="bg-green-700 text-white group flex items-center px-2 py-2 text-base font-medium rounded-md hover:bg-green-600 transition-colors duration-200">
                                <svg class="mr-3 h-6 w-6 text-green-300" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" stroke="#949494">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M19 15C21.2091 15 23 16.7909 23 19V21H21M16 10.874C17.7252 10.4299 19 8.86383 19 6.99999C19 5.13615 17.7252 3.57005 16 3.12601M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7ZM5 15H13C15.2091 15 17 16.7909 17 19V21H1V19C1 16.7909 2.79086 15 5 15Z"
                                            stroke="#c7c7c7" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                                User Management
                            </a>
                            <div class="mt-auto pt-4">
                                <LogoutButton variant="sidebar" />
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Desktop Sidebar -->
            <div class="hidden lg:flex lg:flex-shrink-0">
                <div class="flex flex-col w-64 bg-green-800">
                    <div class="flex items-center h-16 flex-shrink-0 px-4 bg-green-900">
                        <span class="text-white font-bold text-xl">Eco<span class="text-green-300">Move</span></span>
                    </div>
                    <div class="h-0 flex-1 flex flex-col overflow-y-auto">
                        <div class="flex items-center flex-shrink-0 px-4 py-4 border-b border-green-700">
                            <div class="ml-3">
                                <p class="text-base font-medium text-white">Admin User</p>
                                <p class="text-sm font-medium text-green-200">Administrator</p>
                            </div>
                        </div>
                        <nav class="mt-5 px-2 space-y-1">
                            <a href="#"
                                class="bg-green-700 text-white group flex items-center px-2 py-2 text-base font-medium rounded-md hover:bg-green-600 transition-colors duration-200">
                                <svg class="mr-3 h-6 w-6 text-green-300" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" stroke="#949494">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M19 15C21.2091 15 23 16.7909 23 19V21H21M16 10.874C17.7252 10.4299 19 8.86383 19 6.99999C19 5.13615 17.7252 3.57005 16 3.12601M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7ZM5 15H13C15.2091 15 17 16.7909 17 19V21H1V19C1 16.7909 2.79086 15 5 15Z"
                                            stroke="#c7c7c7" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                                User Management
                            </a>
                            <div class="mt-auto pt-4">
                                <LogoutButton variant="sidebar" />
                            </div>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 overflow-hidden">
                <!-- Desktop Header -->
                <div class="hidden lg:block bg-white shadow">
                    <div
                        class="max-w-7xl mx-auto py-4 px-4 sm:py-6 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">User Management</h1>
                            <p class="text-gray-600 mt-1">Manage system users and their roles</p>
                        </div>
                        <button @click="openModal"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create User
                        </button>
                    </div>
                </div>

                <!-- Mobile Header -->
                <div class="lg:hidden bg-white shadow">
                    <div class="px-4 py-4">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div>
                                <h1 class="text-xl font-bold text-gray-900">User Management</h1>
                                <p class="text-gray-600 text-sm">Manage system users</p>
                            </div>
                            <button @click="openModal"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Create User
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <!-- Search and Filter Section -->
                            <div class="bg-white shadow rounded-lg mb-6">
                                <div class="p-4 sm:p-6">
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <div class="flex-1">
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                    </svg>
                                                </div>
                                                <input v-model="searchTerm" type="text"
                                                    class="focus:ring-green-500 focus:border-green-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md"
                                                    placeholder="Search users...">
                                            </div>
                                        </div>
                                        <div class="flex flex-col sm:flex-row gap-2">
                                            <select v-model="statusFilter"
                                                class="focus:ring-green-500 focus:border-green-500 block w-full sm:w-auto rounded-md sm:text-sm border-gray-300">
                                                <option value="">All Status</option>
                                                <option value="active">Active</option>
                                                <option value="desactive">Archived</option>
                                            </select>
                                            <select v-model="roleFilter"
                                                class="focus:ring-green-500 focus:border-green-500 block w-full sm:w-auto rounded-md sm:text-sm border-gray-300">
                                                <option :value="0">All Roles</option>
                                                <option :value="3">Commercial</option>
                                                <option :value="2">Product Manager</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Users List -->
                            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                                <!-- Desktop Table View -->
                                <div class="hidden md:block">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    User</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Email</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Role</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Created</th>
                                                <th 
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="user in filteredUsers" :key="user.id" class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <div
                                                                class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                                <span class="text-green-600 font-medium text-sm">{{
                                                                    getUserInitials(user) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{
                                                                user.firstName }} {{ user.lastName }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ user.email }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full"
                                                        :class="getRoleBadgeClass(user.role_id)">
                                                        {{ formatRole(user.role_id) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full"
                                                        :class="getStatusBadgeClass(user.status)">
                                                        {{ user.status === 'desactive' ? 'Archived' : (user.status || 'Active') }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ formatDate(user.created_at) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex space-x-1 items-center">
                                                    <button class="h-5 w-5" @click.prevent="archiveUser(user)">
                                                        <svg class="" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 12.0002C2 7.28611 2 4.92909 3.46447 3.46462C4.70529 2.2238 6.58687 2.03431 10 2.00537M22 12.0002C22 7.28611 22 4.92909 20.5355 3.46462C19.2947 2.2238 17.4131 2.03431 14 2.00537" stroke="#ae1e1e" stroke-width="1.5" stroke-linecap="round"></path> <path d="M10 22C7.19974 22 5.79961 22 4.73005 21.455C3.78924 20.9757 3.02433 20.2108 2.54497 19.27C2 18.2004 2 16.8003 2 14C2 11.1997 2 9.79961 2.54497 8.73005C3.02433 7.78924 3.78924 7.02433 4.73005 6.54497C5.79961 6 7.19974 6 10 6H14C16.8003 6 18.2004 6 19.27 6.54497C20.2108 7.02433 20.9757 7.78924 21.455 8.73005C22 9.79961 22 11.1997 22 14C22 16.8003 22 18.2004 21.455 19.27C20.9757 20.2108 20.2108 20.9757 19.27 21.455C18.2004 22 16.8003 22 14 22" stroke="#ae1e1e" stroke-width="1.5" stroke-linecap="round"></path> <path d="M12 11L12 17M12 17L14.5 14.5M12 17L9.5 14.5" stroke="#ae1e1e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                    </button>
                                                    <button class="h-5 w-5" @click.prevent="activeUser(user)">
                                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" fill="#22c55e"/>
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Mobile Card View -->
                                <div class="md:hidden">
                                    <ul class="divide-y divide-gray-200">
                                        <li v-for="user in filteredUsers" :key="user.id" class="px-4 py-4">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center flex-1 min-w-0">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <div
                                                            class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                            <span class="text-green-600 font-medium text-sm">{{
                                                                getUserInitials(user) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-3 flex-1 min-w-0">
                                                        <p class="text-sm font-medium text-gray-900 truncate">{{
                                                            user.firstName }} {{ user.lastName }}</p>
                                                        <p class="text-sm text-gray-500 truncate">{{ user.email }}</p>
                                                        <div class="mt-2 flex items-center space-x-2">
                                                            <span
                                                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full"
                                                                :class="getRoleBadgeClass(user.role_id)">
                                                                {{ formatRole(user.role_id) }}
                                                            </span>
                                                            <span
                                                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full"
                                                                :class="getStatusBadgeClass(user.status)">
                                                                {{ user.status === 'desactive' ? 'Archived' : (user.status || 'Active') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center space-x-2">
                                                        <button class="h-5 w-5" @click.prevent="archiveUser(user)">
                                                            <svg class="" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 12.0002C2 7.28611 2 4.92909 3.46447 3.46462C4.70529 2.2238 6.58687 2.03431 10 2.00537M22 12.0002C22 7.28611 22 4.92909 20.5355 3.46462C19.2947 2.2238 17.4131 2.03431 14 2.00537" stroke="#ae1e1e" stroke-width="1.5" stroke-linecap="round"></path> <path d="M10 22C7.19974 22 5.79961 22 4.73005 21.455C3.78924 20.9757 3.02433 20.2108 2.54497 19.27C2 18.2004 2 16.8003 2 14C2 11.1997 2 9.79961 2.54497 8.73005C3.02433 7.78924 3.78924 7.02433 4.73005 6.54497C5.79961 6 7.19974 6 10 6H14C16.8003 6 18.2004 6 19.27 6.54497C20.2108 7.02433 20.9757 7.78924 21.455 8.73005C22 9.79961 22 11.1997 22 14C22 16.8003 22 18.2004 21.455 19.27C20.9757 20.2108 20.2108 20.9757 19.27 21.455C18.2004 22 16.8003 22 14 22" stroke="#ae1e1e" stroke-width="1.5" stroke-linecap="round"></path> <path d="M12 11L12 17M12 17L14.5 14.5M12 17L9.5 14.5" stroke="#ae1e1e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                        </button>
                                                        <button class="h-5 w-5" @click.prevent="activeUser(user)">
                                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" fill="#22c55e"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Empty State -->
                                <div v-if="filteredUsers.length === 0" class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" stroke="#949494">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M19 15C21.2091 15 23 16.7909 23 19V21H21M16 10.874C17.7252 10.4299 19 8.86383 19 6.99999C19 5.13615 17.7252 3.57005 16 3.12601M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7ZM5 15H13C15.2091 15 17 16.7909 17 19V21H1V19C1 16.7909 2.79086 15 5 15Z"
                                                stroke="#c7c7c7" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No users found</h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ searchTerm ? 'Try adjusting your search criteria.' : 'Get started by creating a new user.' }}</p>
                                </div>

                                <!-- Pagination -->
                                <div v-if="totalPages > 1"
                                    class="bg-white px-4 py-3 flex items-center justify-end border-t border-gray-200 sm:px-6">
                                    <div class="flex items-center space-x-2">
                                        <button @click="changePage(currentPage - 1)" 
                                            :disabled="currentPage === 1"
                                            class="relative inline-flex items-center p-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </button>
                                        <span class="text-sm text-gray-700">
                                            Page {{ currentPage }} of {{ totalPages }}
                                        </span>
                                        <button @click="changePage(currentPage + 1)"
                                            :disabled="currentPage === totalPages"
                                            class="relative inline-flex items-center p-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Create/Edit User Modal -->
        <div v-if="isModalOpen" class="fixed z-50 inset-0 overflow-y-auto" @click.self="closeModal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full w-full mx-4">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Create New User</h3>
                                <div class="mt-4">
                                    <form @submit.prevent="submitForm" class="space-y-6">
                                        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                            <div>
                                                <label for="first-name"
                                                    class="block text-sm font-medium text-gray-700">First name</label>
                                                <div class="mt-1">
                                                    <input v-model="firstName" type="text" id="first-name" required
                                                        class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                            <div>
                                                <label for="last-name"
                                                    class="block text-sm font-medium text-gray-700">Last name</label>
                                                <div class="mt-1">
                                                    <input v-model="lastName" type="text" id="last-name" required
                                                        class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                            <div class="sm:col-span-2">
                                                <label for="email" class="block text-sm font-medium text-gray-700">Email
                                                    address</label>
                                                <div class="mt-1">
                                                    <input v-model="email" type="email" id="email" required
                                                        class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">User Role</label>
                                            <div class="mt-2 space-y-4">
                                                <div class="flex items-center">
                                                    <input id="role-commercial" v-model="role_id" type="radio"
                                                        :value="3"
                                                        class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300">
                                                    <label for="role-commercial"
                                                        class="ml-3 block text-sm font-medium text-gray-700">Commercial</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="role-product-manager" v-model="role_id" type="radio"
                                                        :value="2"
                                                        class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300">
                                                    <label for="role-product-manager"
                                                        class="ml-3 block text-sm font-medium text-gray-700">Product
                                                        Manager</label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" @click="submitForm" :disabled="isLoading"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                            <svg v-if="isLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Create User
                        </button>
                        <button type="button" @click="closeModal"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Notifications -->
        <div v-if="toast.show" class="fixed bottom-4 right-4 z-50">
            <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-4 max-w-sm w-full"
                :class="toast.type === 'success' ? 'border-green-200' : 'border-red-200'">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg v-if="toast.type === 'success'" class="h-5 w-5 text-green-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg v-else class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium"
                            :class="toast.type === 'success' ? 'text-green-800' : 'text-red-800'">
                            {{ toast.message }}
                        </p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button @click="toast.show = false" class="inline-flex text-gray-400 hover:text-gray-500">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'
import LogoutButton from '@/components/LogoutButton.vue'

// Reactive data
const sidebarOpen = ref(false)
const isModalOpen = ref(false)
const isLoading = ref(false)
const users = ref([])
const currentPage = ref(1)
const perPage = ref(6)
const totalPages = ref(1)
const searchTerm = ref('')
const statusFilter = ref('')
const roleFilter = ref(0)

// Form data
const firstName = ref('')
const lastName = ref('')
const email = ref('')
const role_id = ref(2)

// Toast notification
const toast = ref({
    show: false,
    message: '',
    type: 'success'
})

// Computed properties
const filteredUsers = computed(() => {
    return users.value.filter(user => {
        const matchesSearch = !searchTerm.value ||
            user.firstName.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
            user.lastName.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
            user.email.toLowerCase().includes(searchTerm.value.toLowerCase())

        const matchesStatus = !statusFilter.value || user.status === statusFilter.value
        const matchesRole = !roleFilter.value || user.role_id === roleFilter.value

        return matchesSearch && matchesStatus && matchesRole
    })
})

// Methods
const showToast = (message, type = 'success') => {
    toast.value = { show: true, message, type }
    setTimeout(() => {
        toast.value.show = false
    }, 5000)
}

const getUserInitials = (user) => {
    return `${user.firstName.charAt(0)}${user.lastName.charAt(0)}`.toUpperCase()
}

const formatRole = (role_id) => {
    const map = {
        1: 'User',
        2: 'Product Manager',
        3: 'Commercial',
        4: 'Admin'
    }
    return map[role_id] || 'Unknown'
}

const formatDate = (dateString) => {
    if (!dateString) return 'N/A'
    return new Date(dateString).toLocaleDateString()
}

const getRoleBadgeClass = (role_id) => {
    const classes = {
        3: 'bg-blue-100 text-blue-800', // Commercial
        2: 'bg-purple-100 text-purple-800', // Product Manager
        4: 'bg-red-100 text-red-800', // Admin
        1: 'bg-gray-100 text-gray-800' // User
    }
    return classes[role_id] || 'bg-gray-100 text-gray-800'
}

const getStatusBadgeClass = (status) => {
    const classes = {
        'active': 'bg-green-100 text-green-800',
        'desactive': 'bg-gray-100 text-gray-800'
    }
    return classes[status] || 'bg-green-100 text-green-800'
}

const openModal = () => {
    resetForm()
    isModalOpen.value = true
}

const closeModal = () => {
    isModalOpen.value = false
    resetForm()
}

const resetForm = () => {
    firstName.value = ''
    lastName.value = ''
    email.value = ''
    role_id.value = 2
}

const fetchUsers = async (page = 1) => {
    try {
        isLoading.value = true
        const response = await axios.get(`http://localhost:8000/api/Users?page=${page}&per_page=${perPage.value}`, {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`,
                'Accept': 'application/json'
            }
        })

        users.value = response.data.data || []
        currentPage.value = response.data.current_page || 1
        totalPages.value = response.data.last_page || 1
    } catch (error) {
        console.error('Error fetching users:', error)
        showToast('Failed to fetch users', 'error')
    } finally {
        isLoading.value = false
    }
}

const submitForm = async () => {
    if (!firstName.value || !lastName.value || !email.value || !role_id.value) {
        showToast('Please fill in all required fields', 'error')
        return
    }

    const formData = {
        firstName: firstName.value,
        lastName: lastName.value,
        email: email.value,
        role_id: parseInt(role_id.value)
    }
    console.log(formData)

    try {
        isLoading.value = true
            // Create new user
            await axios.post('http://localhost:8000/api/register', formData, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json'
                }
            })
            showToast('User created successfully!')

        closeModal()
        await fetchUsers(currentPage.value)
    } catch (error) {
        console.error('Error saving user:', error)
        showToast(error.response?.data?.message || 'Failed to save user', 'error')
    } finally {
        isLoading.value = false
    }
}
const archiveUser = async (user) => {
    try {
        isLoading.value = true;
        await axios.delete(`http://localhost:8000/api/users/${user.id}/archive`, {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`,
                'Accept': 'application/json'
            }
        });
        showToast('User archived successfully!');
        await fetchUsers(currentPage.value);
    } catch (error) {
        console.error('Error archiving user:', error);
        showToast(error.response?.data?.message || 'Failed to archive user', 'error');
    } finally {
        isLoading.value = false;
    }
}
const activeUser = async (user) => {
    try {
        isLoading.value = true;
        await axios.post(`http://localhost:8000/api/users/${user.id}/active`, {}, {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`,
                'Accept': 'application/json'
            }
        });
        showToast('User activated successfully!');
        await fetchUsers(currentPage.value);
    } catch (error) {
        console.error('Error activate user:', error);
        showToast(error.response?.data?.message || 'Failed to active user', 'error');
    } finally {
        isLoading.value = false;
    }
}
const changePage = (page) => {
    if (page < 1 || page > totalPages.value) return
    fetchUsers(page)
}

// Lifecycle
onMounted(() => {
    fetchUsers()
})
</script>