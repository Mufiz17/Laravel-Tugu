<template>
    <div class="max-w-6xl mx-auto p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                Dashboard
            </h1>
            <div class="flex items-center gap-3">
                <span
                    class="text-sm font-medium px-3 py-2 rounded-xl shadow-sm"
                    :class="
                        auth.user?.utype === 'adm'
                            ? 'bg-red-500 text-white'
                            : 'bg-gray-200 text-gray-800'
                    "
                >
                    {{ auth.user?.name }}
                </span>

                <button
                    @click="logout"
                    class="px-4 py-2 rounded-xl bg-gray-900 text-white font-medium hover:bg-gray-800 active:bg-gray-950 transition-all duration-200 ease-in-out hover:scale-105 shadow"
                >
                    Logout
                </button>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <router-link
                to="/absen"
                class="group block bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-200 ease-in-out"
            >
                <div class="flex items-center justify-between mb-2">
                    <div class="text-lg font-semibold text-gray-900">
                        Data Karyawan
                    </div>
                </div>
                <p class="text-sm text-gray-600">
                    Read untuk semua user. CUD hanya admin.
                </p>
            </router-link>

            <div
                v-if="auth.isAdmin"
                class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-200 ease-in-out"
            >
                <div class="flex items-center justify-between mb-2">
                    <div class="text-lg font-semibold text-gray-900">
                        Menu Admin
                    </div>
                </div>
                <p class="text-sm text-gray-600">
                    Sebagai admin anda dapat menambah, edit, hapus data.
                </p>
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
