import { defineStore } from 'pinia'
import axios from '../bootstrap'
import { useRouter } from 'vue-router';
import router from '../router'
export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        loading: false,
        initialized: false,
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
        async fetchUser() {
            this.loading = true
            try {
                const { data } = await axios.get('/profile', { withCredentials: true })
                this.user = data
            } catch (e) {
                this.user = null
            } finally {
                this.loading = false
            }
        },
        async login(form) {
            await axios.post('/login', form)
            await this.fetchUser()
        },
        async logout() {
            await axios.post('/logout', {}, { withCredentials: true })
            this.user = null
            router.push('/login')
        },
    }
})
