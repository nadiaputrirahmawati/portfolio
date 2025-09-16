<script setup>
import { ref } from "vue"
import { router } from "@inertiajs/vue3"
import AdminLayout from "@/Layouts/AdminLayout.vue"

const props = defineProps({
  achievement: {
    type: Object,
    required: true,
  },
})

// state form manual
const form = ref({
  title: props.achievement.title ?? "",
  status: props.achievement.status ?? "active",
  link: props.achievement.link ?? "",
  credentials: props.achievement.credentials ?? "",
  image: null,
})

// preview gambar
const imagePreview = ref(
  props.achievement.image ? `/${props.achievement.image}` : null
)

const handleImageChange = (e) => {
  const file = e.target.files[0]
  if (file) {
    form.value.image = file
    imagePreview.value = URL.createObjectURL(file)
  }
}

// submit update pakai inertia.put
const submit = () => {
  const data = new FormData()
  data.append("title", form.value.title)
  data.append("status", form.value.status)
  data.append("link", form.value.link)
  data.append("credentials", form.value.credentials)

  if (form.value.image) {
    data.append("image", form.value.image)
  }

  // penting → override method PUT
  data.append("_method", "PUT")

  router.post(route("achievements.update", props.achievement.achievements_id), data, {
    forceFormData: true,
    onSuccess: () => {
      console.log("✅ Berhasil update achievement")
    },
  })
}


</script>

<template>
  <AdminLayout>
    <div class="max-w-xl mx-auto p-6 bg-white shadow rounded">
      <h1 class="text-2xl font-bold mb-4">Edit Achievement</h1>

      <form @submit.prevent="submit" class="space-y-4">
        <!-- Title -->
        <div>
          <label class="block font-medium">Judul</label>
          <input
            v-model="form.title"
            type="text"
            class="w-full border rounded p-2"
          />
        </div>

        <!-- Image -->
        <div>
          <label class="block font-medium">Gambar</label>
          <input type="file" @change="handleImageChange" />
          <div v-if="imagePreview" class="mt-2">
            <img :src="imagePreview" alt="Preview" class="w-32 rounded" />
          </div>
        </div>

        <!-- Status -->
        <div>
          <label class="block font-medium">Status</label>
          <select v-model="form.status" class="w-full border rounded p-2">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

        <!-- Link -->
        <div>
          <label class="block font-medium">Link</label>
          <input
            v-model="form.link"
            type="text"
            class="w-full border rounded p-2"
          />
        </div>

        <!-- Credentials -->
        <div>
          <label class="block font-medium">Credentials</label>
          <input
            v-model="form.credentials"
            type="text"
            class="w-full border rounded p-2"
          />
        </div>

        <!-- Submit -->
        <div>
          <button
            type="submit"
            class="bg-green-600 text-white px-4 py-2 rounded"
          >
            Update
          </button>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>
