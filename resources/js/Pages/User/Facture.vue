<template>
    <div class="bg-gray-50 text-gray-800 font-sans">
        <div class="flex h-screen overflow-hidden">
            <UserSideBar/>
            <!-- Main content -->
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <!-- Top header -->
                <div class="flex-shrink-0 flex h-16 bg-white shadow">
                    <div class="flex-1 px-4 flex justify-between items-center">
                        <div class="flex-1 flex">
                            <h1 class="text-xl md:text-2xl font-semibold text-gray-900 self-center">{{$t('invoice.title')}}</h1>
                        </div>
                        <!-- Refresh button -->
                        <button 
                            @click="fetchData"
                            :disabled="loading"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                        >
                            <svg :class="loading ? 'animate-pulse' : ''" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            {{ loading ? $t('invoice.refreshing') : $t('invoice.refresh') }}
                        </button>
                    </div>
                </div>

                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-4 md:py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Loading State with Pulse Animation -->
                            <div v-if="loading" class="bg-white shadow rounded-lg overflow-hidden">
                                <!-- Header Skeleton -->
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="h-6 bg-gray-200 rounded w-32 mb-2 animate-pulse"></div>
                                            <div class="h-4 bg-gray-200 rounded w-24 animate-pulse"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Table Skeleton -->
                                <div class="hidden md:block">
                                    <!-- Table Header -->
                                    <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                                        <div class="grid grid-cols-5 gap-4">
                                            <div class="h-4 bg-gray-200 rounded animate-pulse"></div>
                                            <div class="h-4 bg-gray-200 rounded animate-pulse"></div>
                                            <div class="h-4 bg-gray-200 rounded animate-pulse"></div>
                                            <div class="h-4 bg-gray-200 rounded animate-pulse"></div>
                                            <div class="h-4 bg-gray-200 rounded animate-pulse"></div>
                                        </div>
                                    </div>
                                    <!-- Table Rows -->
                                    <div v-for="n in 5" :key="n" class="px-6 py-4 border-b border-gray-200">
                                        <div class="grid grid-cols-5 gap-4 items-center">
                                            <div class="h-4 bg-gray-200 rounded animate-pulse" :style="{ animationDelay: n * 100 + 'ms' }"></div>
                                            <div class="h-4 bg-gray-200 rounded animate-pulse" :style="{ animationDelay: n * 100 + 50 + 'ms' }"></div>
                                            <div class="h-4 bg-gray-200 rounded animate-pulse" :style="{ animationDelay: n * 100 + 100 + 'ms' }"></div>
                                            <div class="h-6 bg-gray-200 rounded-full w-20 animate-pulse" :style="{ animationDelay: n * 100 + 150 + 'ms' }"></div>
                                            <div class="flex space-x-2">
                                                <div class="h-8 w-8 bg-gray-200 rounded animate-pulse" :style="{ animationDelay: n * 100 + 200 + 'ms' }"></div>
                                                <div class="h-8 w-8 bg-gray-200 rounded animate-pulse" :style="{ animationDelay: n * 100 + 250 + 'ms' }"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mobile Cards Skeleton -->
                                <div class="md:hidden divide-y divide-gray-200">
                                    <div v-for="n in 3" :key="n" class="p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <div class="h-4 bg-gray-200 rounded w-24 mb-1 animate-pulse" :style="{ animationDelay: n * 150 + 'ms' }"></div>
                                                <div class="h-3 bg-gray-200 rounded w-20 animate-pulse" :style="{ animationDelay: n * 150 + 50 + 'ms' }"></div>
                                            </div>
                                            <div class="h-6 bg-gray-200 rounded-full w-16 animate-pulse" :style="{ animationDelay: n * 150 + 100 + 'ms' }"></div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="h-5 bg-gray-200 rounded w-20 animate-pulse" :style="{ animationDelay: n * 150 + 150 + 'ms' }"></div>
                                        </div>
                                        <div class="flex space-x-3">
                                            <div class="flex-1 h-8 bg-gray-200 rounded animate-pulse" :style="{ animationDelay: n * 150 + 200 + 'ms' }"></div>
                                            <div class="flex-1 h-8 bg-gray-200 rounded animate-pulse" :style="{ animationDelay: n * 150 + 250 + 'ms' }"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Error State -->
                            <div v-else-if="error" class="bg-red-50 border border-red-200 rounded-md p-4 mb-6 animate-fade-in">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">{{$t('invoice.error.title')}}</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p>{{ error }}</p>
                                        </div>
                                        <div class="mt-4">
                                            <button @click="fetchData" class="bg-red-100 px-3 py-2 rounded-md text-sm font-medium text-red-800 hover:bg-red-200 transition-colors duration-200">
                                                {{$t('invoice.retry')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Empty State -->
                            <div v-else-if="!loading && orders.length === 0" class="bg-white shadow rounded-lg animate-fade-in">
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">{{$t('invoice.empty.title')}}</h3>
                                    <p class="mt-1 text-sm text-gray-500">{{$t('invoice.empty.description')}}</p>
                                </div>
                            </div>

                            <!-- Factures List -->
                            <div v-else class="bg-white shadow rounded-lg overflow-hidden animate-fade-in">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center">
                                    <div>
                                        <h2 class="text-lg font-medium text-gray-900">{{$t('invoice.list.title')}}</h2>
                                        <p class="mt-1 text-sm text-gray-500">{{$t('invoice.list.count', { count: orders.length })}}</p>
                                    </div>
                                </div>
                                
                                <!-- Desktop Table -->
                                <div class="hidden md:block overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{$t('invoice.list.id')}}
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{$t('invoice.list.date')}}
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{$t('invoice.list.total')}}
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{$t('invoice.list.status')}}
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    {{$t('invoice.list.actions')}}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="(order, index) in orders" :key="order.orderId" 
                                                class="hover:bg-gray-50 transition-all duration-200 animate-slide-up"
                                                :style="{ animationDelay: index * 100 + 'ms' }">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    #ORD_{{ order.orderId }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ formatDate(order.created_at) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ formatPrice(order.totalPrice) }} DH
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span :class="[
                                                        'px-2 inline-flex text-xs leading-5 font-semibold rounded-full transition-all duration-200',
                                                        order.status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                                        order.status === 'completed' ? 'bg-green-100 text-green-800' :
                                                        'bg-red-100 text-red-800'
                                                    ]">
                                                        {{ formatStatus(order.status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="flex space-x-3">
                                                        <button
                                                            @click="openModal(order)"
                                                            :disabled="modalLoading"
                                                            class="text-green-600 hover:text-green-900 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 hover:scale-110"
                                                            :title="$t('invoice.list.actions')"
                                                        >
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                        </button>
                                                        <button
                                                            @click="downloadPDF(order)"
                                                            :disabled="downloadingIds.includes(order.orderId)"
                                                            class="text-blue-600 hover:text-blue-900 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 hover:scale-110"
                                                            :title="$t('invoice.modal.download')"
                                                        >
                                                            <div v-if="downloadingIds.includes(order.orderId)" class="flex items-center space-x-1">
                                                                <div class="w-1 h-1 bg-blue-600 rounded-full animate-pulse"></div>
                                                                <div class="w-1 h-1 bg-blue-600 rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
                                                                <div class="w-1 h-1 bg-blue-600 rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
                                                            </div>
                                                            <svg v-else class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Mobile Card View -->
                                <div class="md:hidden">
                                    <div class="divide-y divide-gray-200">
                                        <div v-for="(order, index) in orders" :key="order.orderId" 
                                             class="p-4 hover:bg-gray-50 transition-all duration-200 animate-slide-up"
                                             :style="{ animationDelay: index * 150 + 'ms' }">
                                            <div class="flex justify-between items-start mb-2">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">#ORD_{{ order.orderId }}</p>
                                                    <p class="text-xs text-gray-500">{{ formatDate(order.created_at) }}</p>
                                                </div>
                                                <span :class="[
                                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full transition-all duration-200',
                                                    order.status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                                    order.status === 'completed' ? 'bg-green-100 text-green-800' :
                                                    'bg-red-100 text-red-800'
                                                ]">
                                                    {{ formatStatus(order.status) }}
                                                </span>
                                            </div>
                                            <div class="mb-3">
                                                <p class="text-sm font-semibold text-gray-900">{{ formatPrice(order.totalPrice) }} DH</p>
                                            </div>
                                            <div class="flex space-x-3">
                                                <button
                                                    @click="openModal(order)"
                                                    :disabled="modalLoading"
                                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                                                >
                                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    {{$t('invoice.modal.title')}}
                                                </button>
                                                <button
                                                    @click="downloadPDF(order)"
                                                    :disabled="downloadingIds.includes(order.orderId)"
                                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                                                >
                                                    <div v-if="downloadingIds.includes(order.orderId)" class="flex items-center space-x-1 mr-2">
                                                        <div class="w-1 h-1 bg-blue-700 rounded-full animate-pulse"></div>
                                                        <div class="w-1 h-1 bg-blue-700 rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
                                                        <div class="w-1 h-1 bg-blue-700 rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
                                                    </div>
                                                    <svg v-else class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                    {{ downloadingIds.includes(order.orderId) ? $t('invoice.modal.downloading') : $t('invoice.modal.download') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pagination -->
                            <div v-if="!loading && orders.length > 0 && lastPage > 1" class="mt-6 bg-white shadow rounded-lg">
                                <div class="px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                    <!-- Mobile pagination info -->
                                    <div class="flex-1 flex justify-between items-center sm:hidden">
                                        <button
                                            @click="changePage(currentPage - 1)"
                                            :disabled="currentPage === 1"
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                                        >
                                            {{ $t('pagination.previous') }}
                                        </button>
                                        <div class="text-sm text-gray-700">
                                            {{ $t('pagination.page_info', { current: currentPage, total: lastPage }) }}
                                        </div>
                                        <button
                                            @click="changePage(currentPage + 1)"
                                            :disabled="currentPage === lastPage"
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                                        >
                                            {{ $t('pagination.next') }}
                                        </button>
                                    </div>
                                    
                                    <!-- Desktop pagination -->
                                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm text-gray-700">
                                                {{ $t('pagination.showing', { from: ((currentPage - 1) * perPage) + 1, to: Math.min(currentPage * perPage, total), total: total }) }}
                                            </p>
                                        </div>
                                        <div>
                                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                                <!-- Previous button -->
                                                <button
                                                    @click="changePage(currentPage - 1)"
                                                    :disabled="currentPage === 1"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                                                >
                                                    <span class="sr-only">{{ $t('pagination.previous') }}</span>
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                                    </svg>
                                                </button>
                                                
                                                <!-- Page numbers -->
                                                <template v-for="page in getPageNumbers()" :key="page">
                                                    <button
                                                        v-if="page !== '...'"
                                                        @click="changePage(page)"
                                                        :class="[
                                                            'relative inline-flex items-center px-4 py-2 border text-sm font-medium transition-all duration-200',
                                                            page === currentPage
                                                                ? 'z-10 bg-green-50 border-green-500 text-green-600'
                                                                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'
                                                        ]"
                                                    >
                                                        {{ page }}
                                                    </button>
                                                    <span
                                                        v-else
                                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700"
                                                    >
                                                        ...
                                                    </span>
                                                </template>
                                                
                                                <!-- Next button -->
                                                <button
                                                    @click="changePage(currentPage + 1)"
                                                    :disabled="currentPage === lastPage"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                                                >
                                                    <span class="sr-only">{{ $t('pagination.next') }}</span>
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                </button>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Success Message -->
                            <div v-if="successMessage" class="mt-6 bg-green-50 border border-green-200 rounded-md p-4 animate-fade-in">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">{{ successMessage }}</p>
                                    </div>
                                    <div class="ml-auto pl-3">
                                        <button @click="successMessage = ''" class="inline-flex text-green-400 hover:text-green-500 transition-colors duration-200">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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

        <!-- Invoice Modal -->
        <div v-if="showModal" class="fixed inset-0 z-50 overflow-y-auto animate-fade-in" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="closeModal"></div>
                
                <!-- Modal panel -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full animate-scale-up">
                    <!-- Modal Loading State -->
                    <div v-if="modalLoading" class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="space-y-4">
                            <!-- Header Skeleton -->
                            <div class="border-b border-gray-200 pb-4 mb-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="h-8 bg-gray-200 rounded w-32 mb-2 animate-pulse"></div>
                                        <div class="h-4 bg-gray-200 rounded w-24 animate-pulse"></div>
                                    </div>
                                    <div class="text-right">
                                        <div class="h-4 bg-gray-200 rounded w-28 mb-1 animate-pulse"></div>
                                        <div class="h-4 bg-gray-200 rounded w-20 animate-pulse"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Customer Info Skeleton -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <div class="h-6 bg-gray-200 rounded w-24 mb-2 animate-pulse"></div>
                                    <div class="space-y-1">
                                        <div class="h-4 bg-gray-200 rounded w-32 animate-pulse"></div>
                                        <div class="h-4 bg-gray-200 rounded w-40 animate-pulse"></div>
                                        <div class="h-4 bg-gray-200 rounded w-28 animate-pulse"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Table Skeleton -->
                            <div class="space-y-3">
                                <div class="bg-gray-50 p-3 rounded">
                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="h-4 bg-gray-200 rounded animate-pulse"></div>
                                        <div class="h-4 bg-gray-200 rounded animate-pulse"></div>
                                        <div class="h-4 bg-gray-200 rounded animate-pulse"></div>
                                        <div class="h-4 bg-gray-200 rounded animate-pulse"></div>
                                    </div>
                                </div>
                                <div v-for="n in 3" :key="n" class="p-3 border-b">
                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="h-4 bg-gray-200 rounded animate-pulse" :style="{ animationDelay: n * 100 + 'ms' }"></div>
                                        <div class="h-4 bg-gray-200 rounded animate-pulse" :style="{ animationDelay: n * 100 + 50 + 'ms' }"></div>
                                        <div class="h-4 bg-gray-200 rounded animate-pulse" :style="{ animationDelay: n * 100 + 100 + 'ms' }"></div>
                                        <div class="h-4 bg-gray-200 rounded animate-pulse" :style="{ animationDelay: n * 100 + 150 + 'ms' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Content -->
                    <div v-else class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!-- Invoice Header -->
                        <div class="border-b border-gray-200 pb-4 mb-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900">{{$t('invoice.modal.title')}}</h2>
                                    <p class="text-gray-600">#ORD_{{ selectedOrder?.orderId }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-600">{{$t('invoice.modal.date')}}: {{ formatDate(selectedOrder?.created_at) }}</p>
                                    <p class="text-gray-600">{{$t('invoice.modal.status')}}: {{ formatStatus(selectedOrder?.status) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">{{$t('invoice.modal.client')}}</h3>
                                <p class="text-gray-600">{{ selectedOrder?.firstname }} {{ selectedOrder?.lastname }}</p>
                                <p class="text-gray-600">{{ selectedOrder?.email }}</p>
                                <p class="text-gray-600">{{ selectedOrder?.phone }}</p>
                            </div>
                        </div>

                        <!-- Products Table -->
                        <div class="mt-6 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{$t('invoice.modal.product')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{$t('invoice.modal.quantity')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{$t('invoice.modal.unitPrice')}}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{$t('invoice.modal.total')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="product in selectedOrder?.products" :key="product.productId">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{$t('invoice.modal.product')}} #{{ product.productId }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ product.quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ formatPrice(product.price) }} DH
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                            {{ formatPrice(product.price * product.quantity) }} DH
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-900">
                                            {{$t('invoice.modal.total')}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                            {{ formatPrice(selectedOrder?.totalPrice) }} DH
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button
                            type="button"
                            @click="downloadPDF(selectedOrder)"
                            :disabled="downloadingIds.includes(selectedOrder?.orderId)"
                            class="w-full inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                        >
                            <div v-if="downloadingIds.includes(selectedOrder?.orderId)" class="flex items-center space-x-1 mr-2">
                                <div class="w-1 h-1 bg-white rounded-full animate-pulse"></div>
                                <div class="w-1 h-1 bg-white rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
                                <div class="w-1 h-1 bg-white rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
                            </div>
                            <svg v-else class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            {{ downloadingIds.includes(selectedOrder?.orderId) ? $t('invoice.modal.downloading') : $t('invoice.modal.download') }}
                        </button>
                        <button
                            type="button"
                            @click="closeModal"
                            :disabled="modalLoading"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                        >
                            {{$t('invoice.modal.close')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import UserSideBar from '../../components/UserSideBar.vue';
import { jsPDF } from 'jspdf';
import autoTable from 'jspdf-autotable';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const orders = ref([]);
const showModal = ref(false);
const selectedOrder = ref(null);
const loading = ref(true);
const modalLoading = ref(false);
const downloadingIds = ref([]);
const error = ref('');
const successMessage = ref('');

// Pagination state
const currentPage = ref(1);
const lastPage = ref(1);
const perPage = ref(10);
const total = ref(0);
const loadingMore = ref(false);

const fetchData = async (page = 1, append = false) => {
    if (page === 1) {
        loading.value = true;
    } else {
        loadingMore.value = true;
    }
    error.value = '';
    
    try {
        const response = await axios.get(`http://localhost:8000/api/factures?page=${page}&per_page=${perPage.value}`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        
        const responseData = response.data;
        
        if (append && page > 1) {
            // Append new data for infinite scroll or pagination
            orders.value.push(...(responseData.data || []));
        } else {
            // Replace data for first page or filter changes
            orders.value = responseData.data || [];
        }
        
        // Update pagination info
        currentPage.value = responseData.current_page || page;
        lastPage.value = responseData.last_page || 1;
        total.value = responseData.total || 0;
        perPage.value = responseData.per_page || 10;
        
    } catch (err) {
        console.error('Error fetching orders:', err);
        
        if (err.response) {
            if (err.response.status === 401) {
                error.value = t('invoice.error.expired');
            } else if (err.response.status === 404) {
                error.value = t('invoice.error.notFound');
            } else {
                error.value = err.response.data?.message || t('invoice.error.general');
            }
        } else if (err.code === 'ERR_NETWORK') {
            error.value = t('invoice.error.network');
        } else {
            error.value = t('checkout.toast_network_error');
        }
    } finally {
        loading.value = false;
        loadingMore.value = false;
    }
};

const formatDate = (dateString) => {
    if (!dateString) return 'Date inconnue';
    
    try {
        return new Date(dateString).toLocaleDateString('fr-FR', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    } catch (err) {
        return 'Date invalide';
    }
};

const formatPrice = (price) => {
    const numPrice = parseFloat(price) || 0;
    return new Intl.NumberFormat('fr-FR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(numPrice);
};

const formatStatus = (status) => {
    const statusMap = {
        'pending': t('invoice.status.pending'),
        'completed': t('invoice.status.completed'),
        'cancelled': t('invoice.status.cancelled'),
    };
    return statusMap[status] || status;
};

const openModal = (order) => {
    modalLoading.value = true;
    selectedOrder.value = order;
    showModal.value = true;
    
    // Simulate loading time for modal content
    setTimeout(() => {
        modalLoading.value = false;
    }, 500);
};

const closeModal = () => {
    showModal.value = false;
    selectedOrder.value = null;
    modalLoading.value = false;
};

const downloadPDF = async (order) => {
    // Add order ID to downloading list
    downloadingIds.value.push(order.orderId);
    
    try {
        const doc = new jsPDF();
        
        // Add company logo or header
        doc.setFontSize(20);
        doc.text('EcoMove - ' + t('invoice.modal.title'), 105, 20, { align: 'center' });
        
        // Add order information
        doc.setFontSize(12);
        doc.text(`${t('invoice.list.id')} #ORD_${order.orderId}`, 20, 40);
        doc.text(`${t('invoice.modal.date')}: ${formatDate(order.created_at)}`, 20, 50);
        doc.text(`${t('invoice.modal.status')}: ${formatStatus(order.status)}`, 20, 60);
        
        // Add customer information
        doc.text(t('invoice.modal.client') + ':', 20, 80);
        doc.text(`${order.firstname} ${order.lastname}`, 20, 90);
        doc.text(`Email: ${order.email}`, 20, 100);
        doc.text(`Téléphone: ${order.phone}`, 20, 110);
        
        // Add products table
        const tableColumn = [
            t('invoice.modal.product'),
            t('invoice.modal.quantity'),
            t('invoice.modal.unitPrice'),
            t('invoice.modal.total')
        ];
        const tableRows = order.products.map(product => [
            t('invoice.modal.product') + ' #' + product.productId,
            product.quantity.toString(),
            `${formatPrice(product.price)} DH`,
            `${formatPrice(product.price * product.quantity)} DH`
        ]);
        
        // Add total row
        tableRows.push(['', '', t('invoice.modal.total'), `${formatPrice(order.totalPrice)} DH`]);
        
        autoTable(doc, {
            startY: 130,
            head: [tableColumn],
            body: tableRows,
            theme: 'grid',
            styles: {
                fontSize: 10,
                cellPadding: 5,
            },
            headStyles: {
                fillColor: [22, 163, 74], // Green color
                textColor: 255,
                fontStyle: 'bold',
            },
            footStyles: {
                fillColor: [22, 163, 74],
                textColor: 255,
                fontStyle: 'bold',
            },
            alternateRowStyles: {
                fillColor: [245, 245, 245],
            },
        });
        
        // Add footer
        const pageHeight = doc.internal.pageSize.height;
        doc.setFontSize(8);
        doc.text('EcoMove - Solutions écologiques pour un avenir durable', 105, pageHeight - 20, { align: 'center' });
        doc.text(`${t('invoice.modal.download')} ${new Date().toLocaleDateString('fr-FR')}`, 105, pageHeight - 10, { align: 'center' });
        
        // Save the PDF
        doc.save(`${t('invoice.modal.title').toLowerCase()}_ORD_${order.orderId}.pdf`);
        
        // Show success message
        successMessage.value = t('invoice.success.download', { id: order.orderId });
        setTimeout(() => {
            successMessage.value = '';
        }, 3000);
        
    } catch (err) {
        console.error('Error generating PDF:', err);
        error.value = t('invoice.error.pdf');
        setTimeout(() => {
            error.value = '';
        }, 5000);
    } finally {
        // Remove order ID from downloading list
        downloadingIds.value = downloadingIds.value.filter(id => id !== order.orderId);
    }
};

const changePage = (page) => {
    if (page >= 1 && page <= lastPage.value) {
        fetchData(page);
    }
};

const getPageNumbers = () => {
    const pages = [];
    if (lastPage.value <= 5) {
        for (let i = 1; i <= lastPage.value; i++) {
            pages.push(i);
        }
    } else {
        pages.push(1);
        if (currentPage.value > 3) {
            pages.push('...');
        }
        for (let i = Math.max(1, currentPage.value - 1); i <= Math.min(lastPage.value, currentPage.value + 1); i++) {
            pages.push(i);
        }
        if (currentPage.value < lastPage.value - 2) {
            pages.push('...');
        }
        pages.push(lastPage.value);
    }
    return pages;
};

onMounted(fetchData);
</script>

<style scoped>
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slide-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scale-up {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

.animate-slide-up {
    animation: slide-up 0.4s ease-out forwards;
    opacity: 0;
}

.animate-scale-up {
    animation: scale-up 0.2s ease-out;
}
</style>
