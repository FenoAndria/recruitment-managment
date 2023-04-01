import { createRouter, createWebHistory } from "vue-router";

import Dashboard from './../Views/Dashboard.vue'
import CompanyProfileIndex from './../Views/Company/Profile/Index.vue'
import CompanyProfileEdit from './../Views/Company/Profile/Edit.vue'
import CompanyProfileCreate from './../Views/Company/Profile/Create.vue'

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
            path: '/company/profile/',
            name: 'CompanyProfile',
            // component: CompanyProfileIndex,
            children: [
                {
                    path: '',
                    name: 'CompanyProfileIndex',
                    component: CompanyProfileIndex,
                    meta: {
                        title: 'Company Profile'
                    }
                },
                {
                    path: 'create',
                    name: 'CompanyProfileCreate',
                    component: CompanyProfileCreate,
                    meta: {
                        title: 'Company Profile | Create'
                    }
                },
                {
                    path: 'edit',
                    name: 'CompanyProfileEdit',
                    component: CompanyProfileEdit,
                    meta: {
                        title: 'Company Profile | Edit'
                    }
                },
            ]
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