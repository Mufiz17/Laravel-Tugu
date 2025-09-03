import axios from 'axios'
axios.defaults.baseURL = '/api'
axios.defaults.headers.common['Accept'] = 'application/json'

// inject Authorization dari localStorage jika ada
const token = localStorage.getItem('token')
if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
}

// auto redirect ke /login kalau 401
import router from './router'
axios.interceptors.response.use(
    r => r,
    err => {
        if (err?.response?.status === 401) {
            localStorage.removeItem('token')
            router.push('/login')
        }
        return Promise.reject(err)
    }
)
export default axios
