import { createRouter, createWebHistory } from 'vue-router';
import store from "../store/index.js";
import Login from "../components/Auth/Login.vue";
import Owner from "../components/Owner/Owner.vue";
import Workers from "../components/Owner/Content/Workers.vue";
import Customers from "../components/Owner/Content/Customers.vue";
import Works from "../components/Owner/Content/Works.vue";
import MaintenanceInspection from "../components/Owner/Content/MaintenanceInspection.vue"
import RecordOfWork from "../components/RecordOfWork/RecordOfWork.vue";

const routes = [

            {
                path: '/auto',
                component: RecordOfWork,
                name: 'record-of-work',
            },
            {

                path: '/owner',
                component: Owner,
                name: 'owner',
                children : [
                    {
                        path : '/workers',
                        component : Workers,
                        name : 'workers'
                    },
                    {
                        path:  '/customers',
                        component:  Customers,
                         name : 'customers'

                    },
                    {
                        path: '/Works',
                        component: Works,
                        name : 'works'
                    },
                    {
                        path: '/maintenance-inspection',
                        component: MaintenanceInspection,
                        name : 'maintenance-inspection'
                    }
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
