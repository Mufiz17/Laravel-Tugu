import axios from 'axios'
import router from './router'

axios.defaults.baseURL = '/api'
axios.defaults.withCredentials = true
axios.defaults.headers.common['Accept'] = 'application/json'

// auto redirect ke /login kalau 401
axios.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response?.status === 401) {
            if (router.currentRoute.value.path !== '/login') {
                router.push('/login')
            }
        }
        return Promise.reject(error)
    }
)
export default axios
