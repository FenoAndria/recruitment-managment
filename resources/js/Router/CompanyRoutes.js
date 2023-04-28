import CompanyProfileIndex from './../Views/Company/Profile/Index.vue'
import CompanyProfileEdit from './../Views/Company/Profile/Edit.vue'
import CompanyProfileCreate from './../Views/Company/Profile/Create.vue'

import CompanyJobIndex from './../Views/Company/Job/Index.vue'
import CompanyJobShow from './../Views/Company/Job/Show.vue'
import CompanyJobCreate from './../Views/Company/Job/Create.vue'
import CompanyJobEdit from './../Views/Company/Job/Edit.vue'
import CompanyDashboard from './../Views/Company/CompanyDashboard.vue'

import CandidaturesForCompanyShow from './../Views/Company/Candidature/Show.vue'

import InterviewsCompanyIndex from './../Views/Company/Interview/Index.vue'

import store from '../Stores/Index';

const CompanyRoutes = [
    {
        path: '/company/',
        name: 'Company',
        children:
            [
                {
                    path: 'dashboard',
                    name: 'CompanyDashboard',
                    component: CompanyDashboard,
                    meta: {
                        title: 'Company Dashboard',
                    },
                    beforeEnter: async (to, from, next) => {
                        if (store.getters.USER_DATA.company) {
                            next()
                        } else {
                            next({ name: 'CompanyProfileCreate' })
                        }
                    }
                },
                {
                    path: 'profile/',
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
                                if (store.getters.USER_DATA.company) {
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
                                if (store.getters.USER_DATA.company) {
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
                                if (store.getters.USER_DATA.company) {
                                    next()
                                } else {
                                    next({ name: 'CompanyProfileCreate' })
                                }
                            }
                        },
                    ],
                },
                {
                    path: 'job/',
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
                        {
                            path: 'candidatures/',
                            name: 'CandidaturesForCompany',
                            children: [
                                {
                                    path: ':candidature',
                                    name: 'CandidaturesForCompanyShow',
                                    component: CandidaturesForCompanyShow,
                                    meta: {
                                        title: 'Candidatures '
                                    }
                                }
                            ]
                        }
                    ],
                    beforeEnter: async (to, from, next) => {
                        if (store.getters.USER_DATA.company) {
                            next()
                        } else {
                            next({ name: 'CompanyProfileCreate' })
                        }
                    }
                },
                {
                    path: 'interview/',
                    name: 'CompanyInterview',
                    children: [
                        {
                            path: '',
                            name: 'InterviewsCompanyIndex',
                            component: InterviewsCompanyIndex,
                            meta: {
                                title: 'All interviews'
                            }
                        }
                    ],
                    beforeEnter: async (to, from, next) => {
                        if (store.getters.USER_DATA.company) {
                            next()
                        } else {
                            next({ name: 'CompanyProfileCreate' })
                        }
                    }
                }
            ],
        beforeEnter: (to, from, next) => {
            if (store.getters.USER_DATA.role != 'Company') {
                next({ name: 'NotFound' })
            } else {
                next()
            }
        },
    }
]
export default CompanyRoutes;