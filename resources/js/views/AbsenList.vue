<script setup>
import { onMounted } from "vue";
import { useAuthStore } from "../stores/auth";
import { useAbsenStore } from "../stores/absen";

const auth = useAuthStore();
const absenStore = useAbsenStore(); 

const fetch = async () => {
    await absenStore.fetchAll();
};

const remove = async (id) => {
    if (!confirm("Yakin hapus?")) return;
    await absenStore.delete(id);
};

onMounted(() => fetch());
</script>

<template>
    <div class="max-w-5xl mx-auto p-4">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold">Data Karyawan</h2>
            <div class="flex gap-2">
                <router-link
                    to="/"
                    class="px-3 py-2 rounded-xl bg-gray-600 text-white"
                >
                    Kembali
                </router-link>
                <router-link
                    v-if="auth.isAdmin"
                    to="/absen/new"
                    class="px-3 py-2 rounded-xl bg-black text-white"
                >
                    Tambah
                </router-link>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Divisi</th>
                        <th class="p-3">Keterangan</th>
                        <th v-if="auth.isAdmin" class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="item in absenStore.items"
                        :key="item.id"
                        class="border-t"
                    >
                        <td class="p-3">{{ item.nama }}</td>
                        <td class="p-3">{{ item.divisi }}</td>
                        <td class="p-3">{{ item.keterangan }}</td>
                        <td v-if="auth.isAdmin" class="p-3 space-x-2">
                            <router-link
                                :to="`/absen/${item.id}`"
                                class="px-2 py-1 rounded bg-yellow-500/90 text-white"
                                >Edit</router-link
                            >
                            <button
                                @click="remove(item.id)"
                                class="px-2 py-1 rounded bg-red-600 text-white"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-between items-center mt-4" v-if="meta">
            <button
                :disabled="!meta.prev_page_url"
                @click="fetch(meta.current_page - 1)"
                class="px-3 py-1 rounded bg-gray-200"
            >
                Prev
            </button>
            <div>Hal {{ meta.current_page }} / {{ meta.last_page }}</div>
            <button
                :disabled="!meta.next_page_url"
                @click="fetch(meta.current_page + 1)"
                class="px-3 py-1 rounded bg-gray-200"
            >
                Next
            </button>
        </div>
    </div>
</template>
