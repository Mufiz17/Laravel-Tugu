import { defineStore } from 'pinia'
import axios from 'axios'
export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: localStorage.getItem('token') || null,
        loading: false,
        error: null,
    }),
    getters: {
        isAuthenticated: (s) => !!s.token,
        isAdmin: (s) => s.user?.utype === 'adm',
    },
    actions: {
        async register(payload) {
            this.error = null
            await axios.post('/auth/register', payload)
        },
        async login(credentials) {
            this.loading = true
            this.error = null
            try {
                const { data } = await axios.post('/auth/login', credentials)
                this.token = data.access_token
                localStorage.setItem('token', this.token)
                axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
                await this.getProfile()
            } catch (e) {
                this.error = e?.response?.data?.message || 'Login gagal'
                throw e
            } finally {
                this.loading = false
            }
        },
        async getProfile() {
            const { data } = await axios.post('/auth/profile')
            this.user = data
        },
        async logout() {
            try { await axios.post('/auth/logout') } catch { }
            this.user = null
            this.token = null
            delete axios.defaults.headers.common['Authorization']
            localStorage.removeItem('token')
        }
    }
})
