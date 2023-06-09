import store from '../Stores/Index'
import CandidateDashboard from './../Views/Candidate/CandidateDashboard.vue'
import CandidateProfileIndex from './../Views/Candidate/Profile/Index.vue'
import CandidateProfileEdit from './../Views/Candidate/Profile/Edit.vue'
import CandidateProfileCreate from './../Views/Candidate/Profile/Create.vue'

import CandidatureIndex from './../Views/Candidate/Candidature/Index.vue'

import InterviewsCandidateIndex from './../Views/Candidate/Interview/Index.vue'

const CandidateRoutes = [
    {
        path: '/candidate/',
        name: 'Candidate',
        children:
            [
                {
                    path: 'dashboard',
                    name: 'CandidateDashboard',
                    component: CandidateDashboard,
                    meta: {
                        title: 'Candidate Dashboard',
                    },
                    beforeEnter: async (to, from, next) => {
                        if (store.getters.USER_DATA.candidate) {
                            next()
                        } else {
                            next({ name: 'CandidateProfileCreate' })
                        }
                    }
                },
                {
                    path: 'profile/',
                    name: 'CandidateProfile',
                    children: [
                        {
                            path: '',
                            name: 'CandidateProfileIndex',
                            component: CandidateProfileIndex,
                            meta: {
                                title: 'Candidate Profile ',
                            },
                            beforeEnter: async (to, from, next) => {
                                if (store.getters.USER_DATA.candidate) {
                                    next()
                                } else {
                                    next({ name: 'CandidateProfileCreate' })
                                }
                            }
                        },
                        {
                            path: 'create',
                            name: 'CandidateProfileCreate',
                            component: CandidateProfileCreate,
                            meta: {
                                title: 'Candidate Profile | Create',
                            },
                            beforeEnter: async (to, from, next) => {
                                if (store.getters.USER_DATA.candidate) {
                                    next({ name: 'CandidateProfileIndex' })
                                } else {
                                    next()
                                }
                            }
                        },
                        {
                            path: 'edit',
                            name: 'CandidateProfileEdit',
                            component: CandidateProfileEdit,
                            meta: {
                                title: 'Candidate Profile | Edit',
                            },
                            beforeEnter: async (to, from, next) => {
                                if (store.getters.USER_DATA.candidate) {
                                    next()
                                } else {
                                    next({ name: 'CandidateProfileCreate' })
                                }
                            }
                        },
                    ]
                },
                {
                    path: 'candidatures/',
                    name: 'Candidature',
                    children:
                        [
                            {
                                path: '',
                                name: 'CandidatureIndex',
                                component: CandidatureIndex,
                                meta: {
                                    title: 'Candidatures',
                                },
                            }
                        ],
                    beforeEnter: async (to, from, next) => {
                        if (store.getters.USER_DATA.candidate) {
                            next()
                        } else {
                            next({ name: 'CandidateProfileCreate' })
                        }
                    }
                },
                {
                    path: 'interview/',
                    name: 'CandidateInterview',
                    children: [
                        {
                            path: '',
                            name: 'InterviewsCandidateIndex',
                            component: InterviewsCandidateIndex,
                            meta: {
                                title: 'All interviews'
                            }
                        }
                    ],
                    beforeEnter: async (to, from, next) => {
                        if (store.getters.USER_DATA.candidate) {
                            next()
                        } else {
                            next({ name: 'CandidateProfileCreate' })
                        }
                    }
                }
            ],
        beforeEnter: (to, from, next) => {
            if (store.getters.USER_DATA.role != 'Candidate') {
                next({ name: 'NotFound' })
            } else {
                next()
            }
        }
    },
    {
        path: '/:resume',
        name: 'CandidateResume',
    }
]
export default CandidateRoutes