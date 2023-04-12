import CompanyProfileIndex from './../Views/Company/Profile/Index.vue'
import CompanyProfileEdit from './../Views/Company/Profile/Edit.vue'
import CompanyProfileCreate from './../Views/Company/Profile/Create.vue'

import CompanyJobIndex from './../Views/Company/Job/Index.vue'
import CompanyJobShow from './../Views/Company/Job/Show.vue'
import CompanyJobCreate from './../Views/Company/Job/Create.vue'
import CompanyJobEdit from './../Views/Company/Job/Edit.vue'

import store from '../Stores/Index';

let isCompany = async () => {
    let company;
    await store.dispatch('GetCompany').then((result) => {
        company = result.data.company
    })
    return company
};

const CompanyRoutes = [
    {
        path: '/company/profile/',
        name: 'CompanyProfile',
        children: [
            {
                path: '',
                name: 'CompanyProfileIndex',
                component: CompanyProfileIndex,
                meta: {
                    title: 'Company Profile'
                },
                beforeEnter: async (to, from, next) => {
                    if (await isCompany()) {
                        next()
                    } else {
                        next({ name: 'CompanyProfileCreate' })
                    }
                }
            },
            {
                path: 'create',
                name: 'CompanyProfileCreate',
                component: CompanyProfileCreate,
                meta: {
                    title: 'Company Profile | Create'
                },
                beforeEnter: async (to, from, next) => {
                    if (await isCompany()) {
                        next({ name: 'CompanyProfileIndex' })
                    } else {
                        next()
                    }
                }
            },
            {
                path: 'edit',
                name: 'CompanyProfileEdit',
                component: CompanyProfileEdit,
                meta: {
                    title: 'Company Profile | Edit'
                },
                beforeEnter: async (to, from, next) => {
                    if (await isCompany()) {
                        next()
                    } else {
                        next({ name: 'CompanyProfileCreate' })
                    }
                }
            },
        ]
    },
    {
        path: '/company/job/',
        name: 'CompanyJobs',
        children: [
            {
                path: '',
                name: 'CompanyJobsIndex',
                component: CompanyJobIndex,
                meta: {
                    title: 'Company\'s Jobs'
                }
            },
            {
                path: ':job',
                name: 'CompanyJobShow',
                component: CompanyJobShow,
                meta: {
                    title: 'Company\'s Job '
                }
            },
            {
                path: ':job/edit',
                name: 'CompanyJobEdit',
                component: CompanyJobEdit,
                meta: {
                    title: 'Edit Company\'s Job '
                }
            },
            {
                path: 'create',
                name: 'CompanyJobCreate',
                component: CompanyJobCreate,
                meta: {
                    title: 'Create Company\'s Job '
                }
            },
        ]
    }
]
export default CompanyRoutes;