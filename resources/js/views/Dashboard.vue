<template>
    <div class="max-w-5xl mx-auto p-4">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Dashboard</h1>
            <div class="flex items-center gap-3">
                <span
                    class="text-sm px-2 py-1 rounded"
                    :class="
                        auth.user?.utype === 'adm'
                            ? 'px-3 py-2 rounded-xl bg-red-500 text-white'
                            : 'px-3 py-2 rounded-xl bg-gray-200 text-black'
                    "
                >
                    {{ auth.user?.name }}
                </span>

                <button
                    @click="logout"
                    class="px-3 py-2 rounded-xl bg-gray-900 text-white"
                >
                    Logout
                </button>
            </div>
        </div>
        <div class="mt-6 grid gap-4">
            <router-link
                to="/absen"
                class="block bg-white rounded-2xl shadow p-5 hover:shadow-md transition"
            >
                <div class="font-medium">Data Karyawan</div>
                <div class="text-sm text-gray-600">
                    Read untuk semua user. CUD hanya admin.
                </div>
            </router-link>
            <div v-if="auth.isAdmin" class="bg-white rounded-2xl shadow p-5">
                <div class="font-medium">Menu Admin</div>
                <div class="text-sm text-gray-600">
                    Anda dapat menambah, edit, hapus data.
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { useAuthStore } from "../stores/auth";
import { useRouter } from "vue-router";

const auth = useAuthStore();
const router = useRouter();
const logout = async () => {
    await auth.logout();
    router.push("/login");
};
</script>
