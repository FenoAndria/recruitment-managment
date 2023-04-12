import API from './../services/Api'

const state = {
    jobs: '',
    job: '',
}
const getters = {
    jobs: state => state.jobs,
    job: state => state.job,
}
const mutations = {
    SetJobs: (state, jobs) => state.jobs = jobs,
    SetJob: (state, job) => state.job = job,
}
const actions = {
    GetJobs: () => {
        return API().get('job')
    },
    GetJob: ({ commit }, job) => {
        return API().get('job/' + job)
    },
    SaveJob: ({ commit }, job) => {
        return API().post('job/', job)
    },
    GetCompanyJobs: () => {
        return API().get('company-job')
    },
}
export default {
    state,
    getters,
    mutations,
    actions,
}