import Vuex from 'vuex'
import Auth from './Auth'
import Company from './Company'
import Job from './Job'

const store = new Vuex.Store({
    modules: {
        Auth,
        Company,
        Job
    }
})
export default store;
