import API from './../services/Api'

const state = {
    company: '',
}
const getters = {
    company: state => state.company
}
const mutations = {
    setCompany: (state, company) => state.company = company
}
const actions = {
    GetCompany: async ({ commit }) => {
        return await API().get('company')
    },
    StoreCompany: async ({ commit }, company) => {
        return await API().post('company', company)
    },
    UpdateCompany: async ({ commit }, company) => {
        return await API().post('company-update', company)
    },
}
export default {
    state,
    getters,
    mutations,
    actions,
}