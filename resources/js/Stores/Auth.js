import API from './../services/Api'

const state = {
    userData: ''
}
const getters = {
    USER_DATA: (state) => state.userData
}
const mutations = {
    SET_USER_DATA: (state, userData) => state.userData = userData,
    SET_CANDIDATE: (state, candidate) => state.userData.candidate = candidate,
    SET_COMPANY: (state, company) => state.userData.company = company,
}
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