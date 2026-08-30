<script setup>
import { ref } from "vue"
import { router, usePage } from "@inertiajs/vue3"
import AdminLayout from "@/Layouts/AdminLayout.vue"

const props = defineProps({
  achievement: {
    type: Object,
    required: true,
  },
})

const page = usePage() // Untuk error handling inertia

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

// submit update pakai inertia.post (spoofed method)
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
    preserveScroll: true,
    onSuccess: () => {
      console.log("✅ Berhasil update achievement")
    },
  })
}
</script>

<template>
  <AdminLayout>
          <!-- Header -->
      <div class="mb-2 mt-2 text-center">
          <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
              Edit Achievement
          </h1>
          <p class="text-gray-700 font-medium mt-2">Perbarui data sertifikat/pencapaianmu di bawah ini.</p>
      </div>
    <div class="p-4 md:p-8 min-h-screen font-sans flex justify-center">
      


      <!-- Error Validation Box (Dari props errors Inertia) -->
      <div v-if="Object.keys(page.props.errors).length" class="mb-6 bg-[#FECACA] border-2 border-black rounded-xl p-4 shadow-[4px_4px_0px_rgba(0,0,0,1)] max-w-4xl">
          <ul class="list-disc list-inside text-black font-bold text-sm space-y-1">
              <li v-for="(error, key) in page.props.errors" :key="key">
                  {{ error }}
              </li>
          </ul>
      </div>

      <!-- Form Card -->
      <div class="max-w-4xl bg-white border-2 border-black rounded-2xl shadow-[8px_8px_0px_rgba(0,0,0,1)] p-6 md:p-8">
        <form @submit.prevent="submit" class="space-y-6">
          
          <!-- Judul -->
          <div>
            <label class="block text-sm font-bold text-gray-900 mb-2">Judul Sertifikat</label>
            <input
              v-model="form.title"
              type="text"
              class="w-full px-4 py-3 border-2 border-black rounded-xl focus:outline-none focus:ring-0 shadow-[3px_3px_0px_rgba(0,0,0,1)] font-medium transition-all"
            />
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Image -->
            <div>
              <label class="block text-sm font-bold text-gray-900 mb-2">Ganti Gambar (Opsional)</label>
              <input 
                type="file" 
                @change="handleImageChange"
                accept="image/*"
                class="w-full text-sm text-gray-900 border-2 border-black rounded-xl cursor-pointer shadow-[3px_3px_0px_rgba(0,0,0,1)] file:mr-4 file:py-3 file:px-4 file:border-0 file:border-r-2 file:border-black file:text-sm file:font-bold file:bg-[#FDE047] file:text-black hover:file:bg-[#facc15] transition-all"
              />
              
              <img 
                v-if="imagePreview" 
                :src="imagePreview" 
                alt="Preview" 
                class="mt-4 w-full md:w-48 h-auto object-cover rounded-xl border-2 border-black shadow-[4px_4px_0px_rgba(0,0,0,1)]" 
              />
            </div>

            <!-- Status & Credentials -->
            <div class="space-y-6">
              <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">Status</label>
                <select 
                  v-model="form.status" 
                  class="w-full px-4 py-3 border-2 border-black rounded-xl focus:outline-none shadow-[3px_3px_0px_rgba(0,0,0,1)] font-bold cursor-pointer"
                  :class="form.status === 'active' ? 'bg-[#86EFAC]' : 'bg-[#FECACA]'"
                >
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div>

              <div>
                <label class="block text-sm font-bold text-gray-900 mb-2">Credential ID</label>
                <input
                  v-model="form.credentials"
                  type="text"
                  class="w-full px-4 py-3 border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] font-medium"
                />
              </div>
            </div>
          </div>

          <!-- Link -->
          <div>
            <label class="block text-sm font-bold text-gray-900 mb-2">Link Verifikasi (URL)</label>
            <input
              v-model="form.link"
              type="text"
              class="w-full px-4 py-3 border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] font-medium"
            />
          </div>

          <!-- Submit -->
          <div class="pt-6 border-t-2 border-black border-dashed flex justify-end">
            <button
              type="submit"
              class="w-full md:w-auto px-8 py-3 bg-[#BFDBFE] text-black font-bold text-lg border-2 border-black rounded-xl shadow-[4px_4px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all"
            >
              Update Achievement
            </button>
          </div>
        </form>
      </div>

    </div>
  </AdminLayout>
</template>