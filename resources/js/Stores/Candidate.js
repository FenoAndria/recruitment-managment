import API from './../services/Api'

const state = {
    candidate: '',
}
const getters = {
    candidate: state => state.candidate
}
const mutations = {
    setCandidate: (state, candidate) => state.candidate = candidate
}
const actions = {
    GetCandidate: async ({ commit }) => {
        return await API().get('candidate')
    },
    StoreCandidate: async ({ commit }, candidate) => {
        return await API().post('candidate', candidate)
    },
    UpdateCandidate: async ({ commit }, candidate) => {
        return await API().post('candidate-update', candidate)
    },
}
export default {
    state,
    getters,
    mutations,
    actions,
}