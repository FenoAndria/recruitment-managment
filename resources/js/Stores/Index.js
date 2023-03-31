import Vuex from 'vuex'
import Auth from './Auth'
import Company from './Company'

const store = new Vuex.Store({
    modules: {
        Auth,
        Company
    }
})
export default store;
