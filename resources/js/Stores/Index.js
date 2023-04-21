import Vuex from 'vuex'
import Auth from './Auth'
import Company from './Company'
import Candidate from './Candidate'
import Candidature from './Candidature'
import Job from './Job'

import { VuexPersistence } from 'vuex-persist'

const vuexLocal = new VuexPersistence({
    key: 'vuex',
    storage: window.localStorage
})

const store = new Vuex.Store({
    modules: {
        Auth,
        Company,
        Candidate,
        Job,
        Candidature,
    },
    plugins: [vuexLocal.plugin]
})
export default store;
