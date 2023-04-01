import { createRouter, createWebHistory } from "vue-router";
import store from './../Stores/Index'
import Dashboard from './../Views/Dashboard.vue'


import CompanyRoutes from "./CompanyRoutes";
import AuthRoutes from "./AuthRoutes";

import NotFound from './../Views/NotFound.vue'
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/dashboard',
            name: 'Dashboard',
            component: Dashboard,
            meta: {
                title: 'Dashboard'
            }
        },
        ...AuthRoutes,
        CompanyRoutes,
        {
            path: '/:pathMatch(.*)*',
            name: 'NotFound',
            component: NotFound,
            meta: {
                title: 'Page Not Found'
            }
        },
    ]
})

const userToken = localStorage.getItem('userToken')
router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware == 'guest') {
        if (userToken && (to.name == 'Login' || to.name == 'Register')) {
            //Redirect to Dashboard if user is authenticated
            next({ name: 'Dashboard' })
        } else {
            next()
        }
    } else {
        if (userToken) {
            next()
        } else {
            // Redirect if not authenticated
            next({ name: 'Login' })
        }
    }
})

export default router;