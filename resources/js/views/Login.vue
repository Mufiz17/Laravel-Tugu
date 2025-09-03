<script setup>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/auth";

const auth = useAuthStore();
const router = useRouter();
const form = reactive({ email: "", password: "" });
const loading = ref(false);

const submit = async () => {
    loading.value = true;
    try {
        await auth.login(form);
        router.push("/");
    } finally {
        loading.value = false;
    }
};
</script>
<template>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow p-6 space-y-4">
            <h1 class="text-2xl font-semibold">Login</h1>
            <form @submit.prevent="submit">
                <div class="space-y-2">
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
                <p v-if="auth.error" class="text-red-600 text-sm mt-2">
                    {{ auth.error }}
                </p>
                <button
                    :disabled="auth.loading"
                    class="mt-4 w-full rounded-xl px-4 py-2 bg-black text-white"
                >
                    {{ auth.loading ? "Loading..." : "Masuk" }}
                </button>
            </form>
            <router-link to="/register" class="text-sm underline"
                >Belum punya akun? Register</router-link
            >
        </div>
    </div>
</template>
