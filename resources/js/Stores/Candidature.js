import API from './../services/Api'

const state = {
    candidaturesForCompany: '',
    candidaturesByCandidate: '',
    candidature: ''
}
const getters = {
    candidaturesForCompany: state => state.candidaturesForCompany,
    candidaturesByCandidate: state => state.candidaturesByCandidate,
    candidature: state => state.candidature
}
const mutations = {
    setCandidaturesForCompany: (state, candidaturesForCompany) => state.candidaturesForCompany = candidaturesForCompany,
    setCandidaturesByCandidate: (state, candidaturesByCandidate) => state.candidaturesByCandidate = candidaturesByCandidate,
    setCandidature: (state, candidature) => state.candidature = candidature
}
const actions = {
    GetCandidaturesByCandidate: async ({ commit }) => {
        return await API().get('candidature/by-candidate')
    },
    GetCandidatureForCompanyShow: ({ commit }, candidature) => {
        return API().get('candidature/for-company/' + candidature)
    },
    UpdateCandidature: ({ commit }, candidature) => {
        return API().put('candidature/' + candidature.id , candidature)
    },
    StoreCandidature: ({ commit }, job) => {
        return API().post('candidature/' + job.id , job)
    },
}
export default {
    state,
    getters,
    mutations,
    actions,
}