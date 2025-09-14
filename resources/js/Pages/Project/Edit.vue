<script setup>
import { ref } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Editor from "@tinymce/tinymce-vue";

const props = defineProps({
  project: Object,
});

const page = usePage();

// form state
const title = ref(props.project.title ?? "");
const description = ref(props.project.description ?? "");
const link = ref(props.project.link ?? "");
const code = ref(props.project.code ?? "");
const skill = ref(props.project.skill ?? []);
const status = ref(props.project.status ?? "draft");
const image = ref(null);

// image preview
const imagePreview = ref(
  props.project.image ? `/${props.project.image}` : null
);

const handleImageChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    image.value = file;
    imagePreview.value = URL.createObjectURL(file);
  }
};

// skills
const newSkill = ref("");
const addSkill = () => {
  if (newSkill.value.trim() !== "") {
    skill.value.push(newSkill.value.trim());
    newSkill.value = "";
  }
};
const removeSkill = (i) => {
  skill.value.splice(i, 1);
};

// submit
const submit = () => {
  const formData = new FormData();
  formData.append("title", title.value);
  formData.append("description", description.value);
  formData.append("link", link.value);
  formData.append("code", code.value);
  formData.append("status", status.value);

  skill.value.forEach((s, i) => {
    formData.append(`skill[${i}]`, s);
  });

  if (image.value) {
    formData.append("image", image.value);
  }

  // spoofing PUT karena pakai FormData
  formData.append("_method", "put");

  router.post(route("projects.update", props.project.project_id), formData, {
    preserveScroll: true,
    onSuccess: () => {
      console.log("Update success");
    },
    onError: (errors) => {
      console.error(errors);
    },
  });
};

// TinyMCE config
const editorInit = {
    height: 400,
    menubar: false,
    plugins: "link image media table code lists autoresize",
    toolbar:
        "undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image media | code",
    images_upload_url: "/upload",
    automatic_uploads: true,
    file_picker_types: "image",
    paste_as_text: true,
};
</script>

<template>
  <AdminLayout>
    <!-- error list -->
    <div v-if="Object.keys(page.props.errors).length" class="mb-4">
      <ul class="list-disc list-inside text-red-500 text-sm space-y-1">
        <li v-for="(error, key) in page.props.errors" :key="key">
          {{ error }}
        </li>
      </ul>
    </div>

    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
      <h2 class="text-2xl font-bold mb-6">Edit Project</h2>
      <form @submit.prevent="submit" enctype="multipart/form-data">
        <!-- Title -->
        <div>
          <label class="block text-sm font-medium">Title</label>
          <input
            v-model="title"
            type="text"
            class="w-full border rounded px-3 py-2"
          />
          <div v-if="page.props.errors.title" class="text-red-500 text-sm">
            {{ page.props.errors.title }}
          </div>
        </div>

        <!-- Description -->
        <div>
          <label class="block text-sm font-medium">Description</label>
          <Editor
            api-key="uigedyonddh1st8of03ybyznu2xdn61wkj6bzdft2zc0omvz"
            :init="editorInit"
            :model-value="description"
            @update:model-value="description = $event"
          />
          <div v-if="page.props.errors.description" class="text-red-500 text-sm">
            {{ page.props.errors.description }}
          </div>
        </div>

        <!-- Image -->
        <div>
          <label class="block text-sm font-medium">Image</label>
          <input type="file" @change="handleImageChange" accept="image/*" />
          <div v-if="page.props.errors.image" class="text-red-500 text-sm">
            {{ page.props.errors.image }}
          </div>
          <img
            v-if="imagePreview"
            :src="imagePreview"
            class="mt-2 w-40 rounded shadow"
          />
        </div>

        <!-- Link -->
        <div>
          <label class="block text-sm font-medium">Project Link</label>
          <input
            v-model="link"
            type="text"
            class="w-full border rounded px-3 py-2"
          />
          <div v-if="page.props.errors.link" class="text-red-500 text-sm">
            {{ page.props.errors.link }}
          </div>
        </div>

        <!-- Code -->
        <div>
          <label class="block text-sm font-medium">Source Code Link</label>
          <input
            v-model="code"
            type="text"
            class="w-full border rounded px-3 py-2"
          />
          <div v-if="page.props.errors.code" class="text-red-500 text-sm">
            {{ page.props.errors.code }}
          </div>
        </div>

        <!-- Skills -->
        <div>
          <label class="block text-sm font-medium">Skills</label>
          <div class="flex gap-2 mb-2">
            <input
              v-model="newSkill"
              type="text"
              placeholder="Tambah skill..."
              class="flex-1 border rounded px-3 py-2"
              @keydown.enter.prevent="addSkill"
            />
            <button
              type="button"
              @click="addSkill"
              class="px-3 py-2 bg-green-600 text-white rounded"
            >
              +
            </button>
          </div>
          <div class="flex flex-wrap gap-2">
            <span
              v-for="(s, i) in skill"
              :key="i"
              class="bg-gray-200 px-3 py-1 rounded flex items-center gap-1"
            >
              {{ s }}
              <button
                type="button"
                @click="removeSkill(i)"
                class="text-red-500 font-bold"
              >
                ×
              </button>
            </span>
          </div>
        </div>

        <!-- Status -->
        <div>
          <label class="block text-sm font-medium">Status</label>
          <select v-model="status" class="w-full border rounded px-3 py-2">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
            Update Project
          </button>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>
