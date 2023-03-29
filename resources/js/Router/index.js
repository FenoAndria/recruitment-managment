import { createRouter, createWebHistory } from "vue-router";

import Dashboard from './../Views/Dashboard.vue'

import Login from './../Views/Auth/Login.vue'
import Register from './../Views/Auth/Register.vue'

import NotFound from './../Views/NotFound.vue'
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/register',
            name: 'Register',
            component: Register,
            meta: {
                middleware: 'guest',
                title: 'Register'
            }
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
            meta: {
                middleware: 'guest',
                title: 'Login'
            }
        },
        {
            path: '/dashboard',
            name: 'Dashboard',
            component: Dashboard,
            meta: {
                title: 'Dashboard'
            }
        },
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
            next({name:'Dashboard'})
        } else {
            next()
        }
    } else {
        if (userToken) {
            next()
        } else {
            // Redirect if not authenticated
            next({name:'Login'})
        }
    }
})

export default router;