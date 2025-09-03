<script setup>
import { reactive, onMounted, computed } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useAbsenStore } from "../stores/absen";
import axios from "axios";

const route = useRoute();
const router = useRouter();
const absenStore = useAbsenStore();

const form = reactive({ nama: "", divisi: "", keterangan: "" });
const isEdit = computed(() => !!route.params.id);

onMounted(async () => {
  if (isEdit.value) {
    const { data } = await axios.get(`/absen/${route.params.id}`);
    Object.assign(form, data);
  }
});

const submit = async () => {
  if (isEdit.value) {
    await absenStore.update(route.params.id, form);
  } else {
    await absenStore.create(form);
  }
  router.push("/absen");
};

</script>

<template>
  <div class="max-w-2xl mx-auto p-4">
    <h2 class="text-xl font-semibold mb-4">
      {{ isEdit ? "Edit" : "Tambah" }} Karyawan
    </h2>

    <form @submit.prevent="submit" class="bg-white p-5 rounded shadow space-y-4">
      <div>
        <label class="block mb-1">Nama</label>
        <input v-model="form.nama" class="w-full border rounded px-3 py-2" required />
      </div>
      <div>
        <label class="block mb-1">Divisi</label>
        <input v-model="form.divisi" class="w-full border rounded px-3 py-2" required />
      </div>
      <div>
        <label class="block mb-1">Keterangan</label>
        <textarea v-model="form.keterangan" class="w-full border rounded px-3 py-2"></textarea>
      </div>
      <div class="flex gap-2">
        <button class="px-4 py-2 bg-black text-white rounded">Simpan</button>
        <router-link to="/absen" class="px-4 py-2 bg-gray-200 rounded">Batal</router-link>
      </div>
    </form>
  </div>
</template>
