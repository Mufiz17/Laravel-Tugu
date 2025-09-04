import { defineStore } from 'pinia'
import axios from '../bootstrap'
import { useRouter } from 'vue-router';
import router from '../router'
export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        loading: false,
        initialized: false,
        errror: null,
    }),
    getters: {
        isAuthenticated: (state) => !!state.user,
        isAdmin: (state) => state.user?.utype === 'adm',
    },
    actions: {
        async init() {
            if (this.initialized) return
            this.initialized = true

            try {
                await this.fetchUser()
            } catch {
                this.user = null
            }
        },
        async register(form) {
            this.error = null
            try {
                const { data } = await axios.post('/register', form)
                return data
            } catch (err) {
                this.error = err.response?.data?.message || 'Register gagal'
                throw err
            }
        },
        async fetchUser() {
            this.loading = true
            try {
                const { data } = await axios.get('/profile', { withCredentials: true })
                this.user = data
            } catch (e) {
                this.user = null
                this.error = e.response?.data?.message || "Gagal mengambil data"
                throw e
            } finally {
                this.loading = false
            }
        },
        async login(form) {
            try {
                await axios.post('/login', form)
                await this.fetchUser()
            } catch (e) {
                this.error = e.response?.data?.message || "Login gagal"
                throw e
            }

        },
        async logout() {
            try {
                await axios.post('/logout', {}, { withCredentials: true })
                this.user = null
                router.push('/login')
            } catch (e) {
                this.error = e.response?.data?.message || "Logout Gagal"
                throw e
            }
        },
    }
})
