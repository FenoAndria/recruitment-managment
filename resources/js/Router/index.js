import { createRouter, createWebHistory } from "vue-router";

import CompanyRoutes from "./CompanyRoutes";
import AuthRoutes from "./AuthRoutes";
import JobRoutes from "./JobRoutes";
import CandidateRoutes from "./CandidateRoutes";

import NotFound from './../Views/NotFound.vue'
import store from "../Stores/Index";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            redirect: { name: 'Login' }
        },
        {
            path: '/:pathMatch(.*)*',
            name: 'NotFound',
            component: NotFound,
            meta: {
                title: 'Page Not Found'
            }
        },
        ...AuthRoutes,
        ...CompanyRoutes,
        JobRoutes,
        ...CandidateRoutes
    ]
})

const userToken = localStorage.getItem('userToken')
router.beforeEach((to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware == 'guest') {
        if (userToken && (to.name == 'Login' || to.name == 'Register')) {
            //Redirect to Dashboard if user is authenticated
            if (store.getters.USER_DATA.role == 'Company') {
                next({ name: 'CompanyDashboard' })
            } else {
                next({ name: 'CandidateDashboard' })
            }
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