import API from './../services/Api'

const state = {
    candidaturesForCompany: '',
    candidaturesByCandidate: '',
}
const getters = {
    candidaturesForCompany: state => state.candidaturesForCompany,
    candidaturesByCandidate: state => state.candidaturesByCandidate,
}
const mutations = {
    setCandidaturesForCompany: (state, candidaturesForCompany) => state.candidaturesForCompany = candidaturesForCompany,
    setCandidaturesByCandidate: (state, candidaturesByCandidate) => state.candidaturesByCandidate = candidaturesByCandidate,
}
const actions = {
    GetCandidaturesByCandidate: async ({ commit }) => {
        return await API().get('candidature/by-candidate')
    },
}
export default {
    state,
    getters,
    mutations,
    actions,
}