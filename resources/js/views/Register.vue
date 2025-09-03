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
            class="wfull border rounded px-3 py-2"
            required
          />
        </div>
        <button class="mt-4 w-full rounded-xl px-4 py-2 bg-black text-white">
          Daftar
        </button>
      </form>
      <router-link to="/login" class="text-sm underline"
        >Sudah punya akun? Login</router-link
      >
    </div>
  </div>
</template>

<script setup>
import { reactive } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/auth";

const router = useRouter();
const auth = useAuthStore();
const form = reactive({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  utype: "usr",
});

const submit = async () => {
  await auth.register(form);
  await auth.login({ email: form.email, password: form.password });
  router.push("/");
};
</script>   