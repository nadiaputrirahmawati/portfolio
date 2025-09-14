<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Editor from "@tinymce/tinymce-vue";

// Form Inertia
const form = useForm({
    title: "",
    description: "",
    image: null,
    link: "",
    code: "",
    skill: [],
    pinned: false,
    status: "active",
});

const imagePreview = ref(null);

// Upload image preview
const handleImageChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.image = file;
        imagePreview.value = URL.createObjectURL(file);
    }
};

// Skills dinamis
const newSkill = ref("");

const addSkill = () => {
    if (newSkill.value.trim() !== "") {
        form.skill.push(newSkill.value.trim());
        newSkill.value = "";
    }
};

const removeSkill = (index) => {
    form.skill.splice(index, 1);
};

// Submit
const submit = () => {
    form.post("/projects", {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
            imagePreview.value = null;
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
const TINYMCE_API_KEY = import.meta.env.VITE_TINYMCE_API_KEY;
</script>

<template>
    <AdminLayout>
        <div v-if="Object.keys(form.errors).length" class="mb-4">
            <ul class="list-disc list-inside text-red-500 text-sm space-y-1">
                <li v-for="(error, key) in form.errors" :key="key">
                    {{ error }}
                </li>
            </ul>
        </div>
        <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-6">Create Project</h2>
            <form @submit.prevent="submit" class="space-y-4">
                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Title</label
                    >
                    <input
                        v-model="form.title"
                        type="text"
                        class="w-full px-3 py-2 border rounded-lg"
                    />
                    <div v-if="form.errors.title" class="text-red-500 text-sm">
                        {{ form.errors.title }}
                    </div>
                </div>

                <!-- Description (TinyMCE) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Description</label
                    >
                    <Editor
                        api-key="uigedyonddh1st8of03ybyznu2xdn61wkj6bzdft2zc0omvz"
                        v-model="form.description"
                        :init="editorInit"
                    />

                    <div
                        v-if="form.errors.description"
                        class="text-red-500 text-sm"
                    >
                        {{ form.errors.description }}
                    </div>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Image</label
                    >
                    <input
                        type="file"
                        @change="handleImageChange"
                        class="w-full px-3 py-2 border rounded-lg"
                        accept="image/*"
                    />
                    <div v-if="form.errors.image" class="text-red-500 text-sm">
                        {{ form.errors.image }}
                    </div>
                    <img
                        v-if="imagePreview"
                        :src="imagePreview"
                        class="mt-2 w-40 rounded-lg shadow"
                    />
                </div>

                <!-- Link -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Pin Project
                    </label>
                    <input
                        v-model="form.pinned"
                        type="checkbox"
                        class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    />
                    <div
                        v-if="form.errors.pinned"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.pinned }}
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Project Link</label
                    >
                    <input
                        v-model="form.link"
                        type="text"
                        class="w-full px-3 py-2 border rounded-lg"
                    />
                    <div v-if="form.errors.link" class="text-red-500 text-sm">
                        {{ form.errors.link }}
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Code</label
                    >
                    <input
                        v-model="form.code"
                        type="text"
                        class="w-full px-3 py-2 border rounded-lg"
                    />
                    <div v-if="form.errors.link" class="text-red-500 text-sm">
                        {{ form.errors.link }}
                    </div>
                </div>

                <!-- Skills -->
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Skills</label
                    >
                    <div class="flex gap-2 mb-2">
                        <input
                            v-model="newSkill"
                            type="text"
                            placeholder="Tambah skill..."
                            class="flex-1 px-3 py-2 border rounded-lg"
                            @keydown.enter.prevent="addSkill"
                        />
                        <button
                            type="button"
                            @click="addSkill"
                            class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
                        >
                            +
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span
                            v-for="(s, index) in form.skill"
                            :key="index"
                            class="flex items-center gap-1 bg-gray-200 text-sm px-3 py-1 rounded-lg"
                        >
                            {{ s }}
                            <button
                                type="button"
                                @click="removeSkill(index)"
                                class="text-red-500 font-bold hover:text-red-700"
                            >
                                ×
                            </button>
                        </span>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700"
                        >Status</label
                    >
                    <select
                        v-model="form.status"
                        class="w-full px-3 py-2 border rounded-lg"
                    >
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                        :disabled="form.processing"
                    >
                        Save Project
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
