import './bootstrap';
// main.js or app.js
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router';
import { createI18n } from 'vue-i18n';
import en from './i18n/en';
import fr from './i18n/fr';
import validation from './i18n/validation';

const lang = window.appLocale || 'en';
const i18n = createI18n({
    legacy: false,
    locale: lang, // or 'en'
    fallbackLocale: 'en',
    messages: {
        en: { ...en, ...validation },
        fr: { ...fr, ...validation },
    },
});


const pinia = createPinia();

createApp(App).use(router).use(pinia).use(i18n).mount('#app');
