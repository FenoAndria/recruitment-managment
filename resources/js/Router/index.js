import { createRouter, createWebHistory } from "vue-router";

import Main from './../Components/Main.vue'
import Dashboard from './../Components/Dashboard.vue'
import Login from './../Views/Auth/Login.vue'
import Register from './../Views/Auth/Register.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/main',
            name: 'Main',
            component: Main
        },
        {
            path: '/register',
            name: 'Register',
            component: Register
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/dashboard',
            name: 'Dashboard',
            component: Dashboard
        },
    ]
})
export default router;