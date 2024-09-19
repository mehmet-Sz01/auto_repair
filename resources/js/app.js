import './bootstrap';
import { createApp } from 'vue';
import PrimeVue from 'primevue/config';
import 'primeicons/primeicons.css';
import 'primevue/resources/themes/saga-blue/theme.css';
import 'primevue/resources/primevue.min.css';
import axios from 'axios';

import AppComponent from './components/AppComponent.vue'

import router from "../js/router/router";
import store from "./store/index";


const app = createApp({});
app.component('app-component', AppComponent );
app.use(PrimeVue);
app.use(router);
app.use(store);


app.config.globalProperties.$axios = axios;


app.mount('#app');
