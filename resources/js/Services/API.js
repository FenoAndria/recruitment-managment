import axios from 'axios'

const API = axios.create({
  baseURL: `http://localhost:8000/api`,
  headers: {
    "Content-Type": "application/x-www-form-urlencoded",
    "Access-Control-Allow-Origin": "*",
    "Access-Control-Allow-Headers": "*",
    "X-Requested-With": "XMLHttpRequest",
    // "X-CSRF-TOKEN": window.Laravel.csrfToken,
    "Authorization": 'Bearer ' + localStorage.userToken
  }
})
// API.defaults.withCredentials = true
export default () => {
  return API
}
