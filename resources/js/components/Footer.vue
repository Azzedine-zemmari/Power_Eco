<script setup lang="ts">
import { RouterLink } from 'vue-router';

</script>

<template>
        <!-- Footer -->
    <footer class="bg-white">
        <div class="max-w-7xl mx-auto py-12 px-4 overflow-hidden sm:px-6 lg:px-8">
            <nav class="-mx-5 -my-2 flex flex-wrap justify-center" aria-label="Footer">
                <div class="px-5 py-2">
                    <RouterLink :to="{name:'Home'}" class="text-base text-gray-500 hover:text-gray-900">
                        {{ $t('nav.links.home') }}
                    </RouterLink>
                </div>

                <div class="px-5 py-2">
                    <RouterLink :to="{name:'products'}" class="text-base text-gray-500 hover:text-gray-900">
                        {{ $t('nav.links.products') }}
                    </RouterLink>
                </div>
            </nav>
            <p class="mt-8 text-center text-base text-gray-400">
                {{ $t('footer.copywrite') }}
            </p>
        </div>
    </footer>
</template>