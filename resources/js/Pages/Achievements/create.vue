<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const title = ref("");
const image = ref(null);
const status = ref("active");
const link = ref("");
const credentials = ref("");
const errors = ref({});
const imagePreview = ref(null);

const handleImageChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    image.value = file;
    imagePreview.value = URL.createObjectURL(file);
  }
};

const submit = () => {
  const formData = new FormData();
  formData.append("title", title.value);
  formData.append("status", status.value);
  formData.append("link", link.value);
  formData.append("credentials", credentials.value);

  if (image.value) {
    formData.append("image", image.value);
  }

  router.post(route("achievements.store"), formData, {
    forceFormData: true,
    onSuccess: () => {
      title.value = "";
      status.value = "active";
      link.value = "";
      credentials.value = "";
      image.value = null;
      imagePreview.value = null;
      errors.value = {};
    },
    onError: (err) => {
      errors.value = err;
    },
  });
};
</script>

<template>
  <AdminLayout>
    <div class="max-w-xl mx-auto p-6 bg-white shadow rounded">
      <h1 class="text-2xl font-bold mb-4">Tambah Achievement</h1>

      <form @submit.prevent="submit" class="space-y-4">
        <!-- Title -->
        <div>
          <label class="block font-medium">Judul</label>
          <input
            v-model="title"
            type="text"
            class="w-full border rounded p-2"
          />
          <div v-if="errors.title" class="text-red-500 text-sm">
            {{ errors.title }}
          </div>
        </div>

        <!-- Image -->
        <div>
          <label class="block font-medium">Gambar</label>
          <input type="file" @change="handleImageChange" />
          <div v-if="imagePreview" class="mt-2">
            <img :src="imagePreview" alt="Preview" class="w-32 rounded" />
          </div>
          <div v-if="errors.image" class="text-red-500 text-sm">
            {{ errors.image }}
          </div>
        </div>

        <!-- Status -->
        <div>
          <label class="block font-medium">Status</label>
          <select v-model="status" class="w-full border rounded p-2">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
          <div v-if="errors.status" class="text-red-500 text-sm">
            {{ errors.status }}
          </div>
        </div>

        <!-- Link -->
        <div>
          <label class="block font-medium">Link</label>
          <input
            v-model="link"
            type="text"
            class="w-full border rounded p-2"
          />
          <div v-if="errors.link" class="text-red-500 text-sm">
            {{ errors.link }}
          </div>
        </div>

        <!-- Credentials -->
        <div>
          <label class="block font-medium">Credentials</label>
          <input
            v-model="credentials"
            type="text"
            class="w-full border rounded p-2"
          />
          <div v-if="errors.credentials" class="text-red-500 text-sm">
            {{ errors.credentials }}
          </div>
        </div>

        <!-- Submit -->
        <div>
          <button
            type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded"
          >
            Simpan
          </button>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>
