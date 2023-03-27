import API from './../services/Api'

const state = {}
const getters = {}
const mutations = {}
const actions = {
    LOGIN: async ({ commit }, user) => {
        return await API().post('auth/login', user)
    },
    REGISTER: async ({ commit }, user) => {
        return await API().post('auth/register', user)
    },
    LOGOUT: async ({ commit }) => {
        return await API().post('auth/logout')
    }
}
export default {
    state,
    getters,
    mutations,
    actions,
}