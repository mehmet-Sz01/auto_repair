import './bootstrap';
import { createApp } from 'vue';
import PrimeVue from 'primevue/config';
import 'primeicons/primeicons.css';
import 'primevue/resources/themes/saga-blue/theme.css';
import 'primevue/resources/primevue.min.css';
import axios from 'axios';

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';

library.add(fas);


import router from "../js/router/router";
import store from "./store/index";
import MainLayout from "./components/Owner/MainLayout.vue";
import { VueReCaptcha } from 'vue-recaptcha-v3';






const app = createApp({});
app.component('main-layout', MainLayout );
app.use(PrimeVue);
app.use(VueReCaptcha, {
    siteKey: import.meta.env.VITE_RECAPTCHA_SITE_KEY,
});
app.use(router);
app.use(store);
app.component('font-awesome-icon', FontAwesomeIcon);

app.config.globalProperties.$axios = axios;


app.mount('#app');

const script = document.createElement('script');
script.src = 'https://www.google.com/recaptcha/api.js';
script.async = true;
script.defer = true;
document.head.appendChild(script);



