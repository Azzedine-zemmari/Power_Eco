<template>
  <!-- Sidebar version (compact) -->
  <div v-if="variant === 'sidebar'" class="px-2 py-3 border-b border-green-700">
    <div class="flex items-center justify-center space-x-1">
      <button
        v-for="lang in languages"
        :key="lang.value"
        :class="[
          'flex items-center justify-center p-2 rounded-md transition-all duration-200',
          selectedLang === lang.value
            ? 'bg-green-600 text-white shadow-md'
            : 'bg-green-700 text-green-200 hover:bg-green-600 hover:text-white'
        ]"
        @click="switchLanguage(lang.value)"
        :aria-label="lang.label"
        :title="lang.label"
      >
        <span class="w-5 h-5">
          <component :is="lang.icon" />
        </span>
      </button>
    </div>
  </div>

  <!-- Navbar version (styled dropdown) -->
  <div v-else class="relative">
    <select 
      v-model="selectedLang" 
      @change="switchLanguage(selectedLang)"
      class="appearance-none bg-white border border-gray-300 rounded-md px-3 py-2 pr-8 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 cursor-pointer"
    >
      <option v-for="lang in languages" :key="lang.value" :value="lang.value">
        {{ lang.label }}
      </option>
    </select>
    <!-- Custom dropdown arrow -->
    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
      <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useI18n } from 'vue-i18n';
import axios from 'axios';

// Props
const props = defineProps({
  variant: {
    type: String,
    default: 'navbar', // 'sidebar' or 'navbar'
    validator: (value) => ['sidebar', 'navbar'].includes(value)
  }
});

// SVGs as Vue components
const FlagEN = {
  template: `
   
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class='w-5 h-5 rounded-sm' viewBox="0 0 7410 3900">
<path d="M0,0h7410v3900H0" fill="#b31942"/>
<path d="M0,450H7410m0,600H0m0,600H7410m0,600H0m0,600H7410m0,600H0" stroke="#FFF" stroke-width="300"/>
<path d="M0,0h2964v2100H0" fill="#0a3161"/>
<g fill="#FFF">
<g id="s18">
<g id="s9">
<g id="s5">
<g id="s4">
<path id="s" d="M247,90 317.534230,307.082039 132.873218,172.917961H361.126782L176.465770,307.082039z"/>
<use xlink:href="#s" y="420"/>
<use xlink:href="#s" y="840"/>
<use xlink:href="#s" y="1260"/>
</g>
<use xlink:href="#s" y="1680"/>
</g>
<use xlink:href="#s4" x="247" y="210"/>
</g>
<use xlink:href="#s9" x="494"/>
</g>
<use xlink:href="#s18" x="988"/>
<use xlink:href="#s9" x="1976"/>
<use xlink:href="#s5" x="2470"/>
</g>
</svg>
  `
};


const FlagFR = {
  template: `<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 36 36' class='w-5 h-5 rounded-sm'><rect width='12' height='36' fill='#0055a4'/><rect x='12' width='12' height='36' fill='#fff'/><rect x='24' width='12' height='36' fill='#ef4135'/></svg>`
};

const { locale } = useI18n();
const selectedLang = ref(localStorage.getItem('lang') || 'en');

const languages = [
  { value: 'en', label: 'English', icon: FlagEN },
  { value: 'fr', label: 'Français', icon: FlagFR }
];

function switchLanguage(lang) {
  selectedLang.value = lang;
  locale.value = lang;
  localStorage.setItem('lang', lang);
  axios.defaults.headers.common['Accept-Language'] = lang;
}

// Keep selectedLang in sync if locale changes elsewhere
watch(locale, (newLocale) => {
  selectedLang.value = newLocale;
});
</script>

<style scoped>
button {
  outline: none;
  border: none;
  cursor: pointer;
  min-width: 36px;
  min-height: 36px;
}

button:focus {
  box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.3);
}

/* Custom select styling */
select {
  background-image: none;
}
</style>