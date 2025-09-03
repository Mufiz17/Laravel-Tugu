import { defineStore } from 'pinia'
import axios from 'axios'

export const useAbsenStore = defineStore('absen', {
    state: () => ({
        items: [],
        meta: null,
        loading: false,
    }),
    actions: {
        async fetchAll() {
            this.loading = true
            try {
                const { data } = await axios.get("/absen")
                this.items = data
            } finally {
                this.loading = false
            }

        },
        async create(payload) {
            await axios.post('/absen', payload)
            await this.fetchAll()
        },
        async update(id, payload) {
            await axios.put(`/absen/${id}`, payload)
            await this.fetchAll()
        },
        async delete(id) {
            await axios.delete(`/absen/${id}`)
            this.items = this.items.filter(i => i.id !== id)
        }
    }
})
