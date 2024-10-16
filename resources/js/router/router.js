import { createRouter, createWebHistory } from 'vue-router';
import store from "../store/index.js";
import MultiStepForm from "../components/RecordOfWork/MultiStepForm.vue";
import Login from "../components/Auth/Login.vue";
import AppComponent from "../components/AppComponent.vue";
import Owner from "../components/Owner/Owner.vue";
import Workers from "../components/Owner/MainLayout/Workers.vue";

const routes = [
    {
        path: '/',
        component: AppComponent,
        children: [
            {
                path: '/auto',
                component: MultiStepForm,
                name: 'multistep',
            },
            {

                path: '/owner',
                component: Owner,
                name: 'owner'
            },
            {
                path: '/workers',
                component: Workers,
                name: 'workers',
            },
            // {
            //     path: '/work',
            //     component: Work,
            //     name: 'works',
            // },
            // {
            //     path: '/customer',
            //     component: Customer,
            //     name: 'customers',
            // },
        ]
    },

    {
        path: '/login',
        component: Login,
        name: 'login',
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});


router.beforeEach(async (to, from, next) => {
    try {
        await store.dispatch('authenticate');
        if (store.getters.authenticated || to.name === 'login') {
            next();
        } else {
            next({ name: 'login' });
        }
    } catch (error) {
        console.error('Authentication error:', error);
        next({ name: 'login' });
    }
});

export default router;
