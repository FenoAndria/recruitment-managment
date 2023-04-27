import API from './../services/Api'

const state = {
    companyInterviews: '',
    candidateInterviews: '',
}
const getters = {
    CompanyInterviews: state => state.companyInterviews,
    CandidateInterviews: state => state.candidateInterviews,
}
const mutations = {
    SetCompanyInterviews: (state, companyInterviews) => state.companyInterviews = companyInterviews,
    SetCandidateInterviews: (state, candidateInterviews) => state.candidateInterviews = candidateInterviews,
}
const actions = {
    GetCompanyInterviews: async ({ commit }) => {
        return await API().get('interview/company')
    },
    GetCandidateInterviews: async ({ commit }) => {
        return await API().get('interview/candidate')
    },
    CompanyShowInterview: async ({ commit }, candidature) => {
        return await API().get('interview/company/' + candidature)
    },
    StoreInterview: async ({ commit }, payload) => {
        return await API().post('interview/' + payload.candidature.id, payload.interview)
    },
}
export default {
    state,
    getters,
    mutations,
    actions,
}