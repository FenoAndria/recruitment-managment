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
        },
        {
            path: ':job',
            name: 'JobShow',
            component: JobShow,
            meta: {
                title: 'Job'
            },
        },
        
    ]
}
export default JobRoutes;