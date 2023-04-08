import CompanyProfileIndex from './../Views/Company/Profile/Index.vue'
import CompanyProfileEdit from './../Views/Company/Profile/Edit.vue'
import CompanyProfileCreate from './../Views/Company/Profile/Create.vue'
import store from '../Stores/Index';

let isCompany = async () => {
    let company;
    await store.dispatch('GetCompany').then((result) => {
        company = result.data.company
    })
    return company
};

const CompanyRoutes = {
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
}
export default CompanyRoutes;