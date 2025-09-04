<script setup>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/auth";

const router = useRouter();
const auth = useAuthStore();
const error = ref(null);
const loading = ref(false);

const form = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    utype: "usr",
});

const submit = async () => {
    loading.value = true;
    try {
        await auth.register(form);
        await auth.login({ email: form.email, password: form.password });
        router.push("/");
    } catch (e) {
        error.value = auth.error;
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow p-6 space-y-4">
            <h1 class="text-2xl font-semibold">Register</h1>
            <form @submit.prevent="submit">
                <div class="space-y-2">
                    <label class="block">Nama</label>
                    <input
                        v-model="form.name"
                        class="w-full border rounded px-3 py-2"
                        required
                    />
                </div>
                <div class="space-y-2 mt-3">
                    <label class="block">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        class="w-full border rounded px-3 py-2"
                        required
                    />
                </div>
                <div class="space-y-2 mt-3">
                    <label class="block">Password</label>
                    <input
                        v-model="form.password"
                        type="password"
                        class="w-full border rounded px-3 py-2"
                        required
                    />
                </div>
                <div class="space-y-2 mt-3">
                    <label class="block">Konfirmasi Password</label>
                    <input
                        v-model="form.password_confirmation"
                        type="password"
                        class="w-full border rounded px-3 py-2"
                        required
                    />
                </div>
                <p v-if="error" class="text-red-600 text-sm mt-2">
                    {{ error }}
                </p>
                <button
                    type="submit"
                    :disabled="loading"
                    class="mt-4 w-full rounded-xl px-4 py-2 text-white transition-colors duration-300 
                        disabled:opacity-60 disabled:cursor-not-allowed
                        bg-black hover:bg-gray-800 active:bg-gray-900"
                >
                    <span v-if="loading" class="flex items-center justify-center gap-2">
                        <svg
                            class="animate-spin h-4 w-4 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                        </svg>
                        Loading...
                    </span>
                    <span v-else>Daftar</span>
                </button>
            </form>
            <router-link to="/login" class="text-sm underline"
                >Sudah punya akun? Login</router-link
            >
        </div>
    </div>
</template>
