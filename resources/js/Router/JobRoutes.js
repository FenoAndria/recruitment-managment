import store from '../Stores/Index'
import JobIndex from './../Views/Job/Index.vue'
import JobShow from './../Views/Job/Show.vue'

const JobRoutes = {
    path: '/job/',
    name: 'Job',
    children: [
        {
            path: '',
            name: 'JobIndex',
            component: JobIndex,
            meta: {
                title: 'Jobs'
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
            path: ':job',
            name: 'JobShow',
            component: JobShow,
            meta: {
                title: 'Job'
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
}
export default JobRoutes;