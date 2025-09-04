<script setup>
import { reactive, onMounted, computed, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useAbsenStore } from "../stores/absen";
import axios from "axios";

const route = useRoute();
const router = useRouter();
const absenStore = useAbsenStore();

const form = reactive({ nama: "", divisi: "", keterangan: "" });
const isEdit = computed(() => !!route.params.id);
const loading = ref(false);

onMounted(async () => {
    if (isEdit.value) {
        const { data } = await axios.get(`/absen/${route.params.id}`);
        Object.assign(form, data);
    }
});

const submit = async () => {
    loading.value = true;
    try {
        if (isEdit.value) {
            await absenStore.update(route.params.id, form);
        } else {
            await absenStore.create(form);
        }
        router.push("/absen");
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <div class="max-w-2xl mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">
            {{ isEdit ? "Edit" : "Tambah" }} Karyawan
        </h2>

        <form
            @submit.prevent="submit"
            class="bg-white p-5 rounded shadow space-y-4"
        >
            <div>
                <label class="block mb-1">Nama</label>
                <input
                    v-model="form.nama"
                    class="w-full border rounded px-3 py-2"
                    required
                />
            </div>
            <div>
                <label class="block mb-1">Divisi</label>
                <input
                    v-model="form.divisi"
                    class="w-full border rounded px-3 py-2"
                    required
                />
            </div>
            <div>
                <label class="block mb-1">Keterangan</label>
                <textarea
                    v-model="form.keterangan"
                    class="w-full border rounded px-3 py-2"
                ></textarea>
            </div>
            <div class="flex gap-2">
                <button
                    type="submit"
                    :disabled="loading"
                    class="px-4 py-2 rounded text-white transition-colors duration-300 
                        disabled:opacity-60 disabled:cursor-not-allowed
                        bg-black hover:bg-gray-800 active:bg-gray-900"
                >
                    <span v-if="loading" class="flex items-center gap-2">
                        <svg
                            class="animate-spin h-4 w-4 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                            ></path>
                        </svg>
                        Menyimpan...
                    </span>
                    <span v-else>Simpan</span>
                </button>
                <router-link
                    to="/absen"
                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition-colors"
                >
                    Batal
                </router-link>
            </div>
        </form>
    </div>
</template>
