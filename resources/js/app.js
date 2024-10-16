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

import AppComponent from './components/AppComponent.vue'

import router from "../js/router/router";
import store from "./store/index";






const app = createApp({});
app.component('app-component', AppComponent );
app.use(PrimeVue);
app.use(router);
app.use(store);
app.component('font-awesome-icon', FontAwesomeIcon);

app.config.globalProperties.$axios = axios;


app.mount('#app');





