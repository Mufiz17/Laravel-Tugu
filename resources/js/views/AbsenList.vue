<script setup>
import { onMounted, ref } from "vue";
import { useAuthStore } from "../stores/auth";
import { useAbsenStore } from "../stores/absen";

const auth = useAuthStore();
const absenStore = useAbsenStore(); 

const showModal = ref(false);
const selectedId = ref(null);

const fetch = async () => {
    await absenStore.fetchAll();
};

const confirmDelete = (id) => {
    selectedId.value = id;
    showModal.value = true;
};

const remove = async () => {
    if (selectedId.value) {
        await absenStore.delete(selectedId.value);
        selectedId.value = null;
        showModal.value = false;
    }
};

const cancelDelete = () => {
    selectedId.value = null;
    showModal.value = false;
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
                    class="px-3 py-2 rounded-xl bg-gray-600 text-white 
                           hover:bg-gray-700 active:bg-gray-800
                           transition-all duration-200 ease-in-out hover:scale-105"
                >
                    Kembali
                </router-link>
                <router-link
                    v-if="auth.isAdmin"
                    to="/absen/new"
                    class="px-3 py-2 rounded-xl bg-black text-white 
                           hover:bg-gray-800 active:bg-gray-900
                           transition-all duration-200 ease-in-out hover:scale-105"
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
                        class="border-t hover:bg-gray-50 transition-colors duration-200"
                    >
                        <td class="p-3">{{ item.nama }}</td>
                        <td class="p-3">{{ item.divisi }}</td>
                        <td class="p-3">{{ item.keterangan }}</td>
                        <td v-if="auth.isAdmin" class="p-3 space-x-2">
                            <router-link
                                :to="`/absen/${item.id}`"
                                class="inline-block px-2 py-1 rounded bg-yellow-500/90 text-white 
                                       hover:bg-yellow-600 active:bg-yellow-700
                                       transition-all duration-200 ease-in-out hover:scale-105"
                            >
                                Edit
                            </router-link>
                            <button
                                @click="confirmDelete(item.id)"
                                class="inline-block px-2 py-1 rounded bg-red-600 text-white 
                                       hover:bg-red-700 active:bg-red-800
                                       transition-all duration-200 ease-in-out hover:scale-105"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal Konfirmasi -->
        <div
            v-if="showModal"
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
        >
            <div
                class="bg-white rounded-xl shadow-lg p-6 w-full max-w-sm animate-fadeIn"
            >
                <h3 class="text-lg font-semibold mb-2">Konfirmasi Hapus</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Apakah kamu yakin ingin menghapus data ini?
                </p>
                <div class="flex justify-end gap-2">
                    <button
                        @click="cancelDelete"
                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 transition"
                    >
                        Batal
                    </button>
                    <button
                        @click="remove"
                        class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700 transition"
                    >
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.95); }
  to { opacity: 1; transform: scale(1); }
}
.animate-fadeIn {
  animation: fadeIn 0.2s ease-out;
}
</style>
