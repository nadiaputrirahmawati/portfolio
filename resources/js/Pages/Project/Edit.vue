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
const pinned = ref(props.project.pinned ?? false);

// image preview
const imagePreview = ref(
    props.project.image ? `/${props.project.image}` : null,
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
    formData.append("pinned", pinned.value ? 1 : 0);

    skill.value.forEach((s, i) => {
        formData.append(`skill[${i}]`, s);
    });

    if (image.value) {
        formData.append("image", image.value);
    }

    formData.append("_method", "put");

    router.post(route("projects.update", props.project.project_id), formData, {
        preserveScroll: true,
        onSuccess: () => console.log("Update success"),
        onError: (errors) => console.error(errors),
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
        <div class="mb-2 mt-2 items-center text-center">
            <h1
                class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight"
            >
                Edit Project
            </h1>
            <p class="text-gray-700 font-medium mt-2">
                Ubah informasi project mu di bawah ini.
            </p>
        </div>
        <div class="flex p-4 md:p-8 min-h-screen font-sans justify-center">
            <!-- Header Section -->

            <!-- Error List -->
            <div
                v-if="Object.keys(page.props.errors).length"
                class="mb-6 bg-[#FECACA] border-2 border-black rounded-xl p-4 shadow-[4px_4px_0px_rgba(0,0,0,1)]"
            >
                <ul
                    class="list-disc list-inside text-black font-bold text-sm space-y-1"
                >
                    <li v-for="(error, key) in page.props.errors" :key="key">
                        {{ error }}
                    </li>
                </ul>
            </div>

            <!-- Form Card -->
            <div
                class="max-w-4xl bg-white border-2 border-black rounded-2xl shadow-[8px_8px_0px_rgba(0,0,0,1)] p-6 md:p-8"
            >
                <form
                    @submit.prevent="submit"
                    enctype="multipart/form-data"
                    class="space-y-6"
                >
                    <!-- Title -->
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-900 mb-2"
                            >Title</label
                        >
                        <input
                            v-model="title"
                            type="text"
                            class="w-full px-4 py-3 border-2 border-black rounded-xl focus:outline-none focus:ring-0 shadow-[3px_3px_0px_rgba(0,0,0,1)] transition-all font-medium"
                        />
                        <div
                            v-if="page.props.errors.title"
                            class="text-red-600 font-bold text-sm mt-1"
                        >
                            {{ page.props.errors.title }}
                        </div>
                    </div>

                    <!-- Description (TinyMCE) -->
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-900 mb-2"
                            >Description</label
                        >
                        <div
                            class="border-2 border-black rounded-xl overflow-hidden shadow-[3px_3px_0px_rgba(0,0,0,1)]"
                        >
                            <Editor
                                api-key="uigedyonddh1st8of03ybyznu2xdn61wkj6bzdft2zc0omvz"
                                :init="editorInit"
                                :model-value="description"
                                @update:model-value="description = $event"
                            />
                        </div>
                        <div
                            v-if="page.props.errors.description"
                            class="text-red-600 font-bold text-sm mt-1"
                        >
                            {{ page.props.errors.description }}
                        </div>
                    </div>

                    <!-- Layout Grid 2 Kolom -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Image Upload -->
                        <div>
                            <label
                                class="block text-sm font-bold text-gray-900 mb-2"
                                >Cover Image</label
                            >
                            <input
                                type="file"
                                @change="handleImageChange"
                                accept="image/*"
                                class="w-full text-sm text-gray-900 border-2 border-black rounded-xl cursor-pointer shadow-[3px_3px_0px_rgba(0,0,0,1)] file:mr-4 file:py-3 file:px-4 file:border-0 file:border-r-2 file:border-black file:text-sm file:font-bold file:bg-[#FDE047] file:text-black hover:file:bg-[#facc15] transition-all"
                            />
                            <div
                                v-if="page.props.errors.image"
                                class="text-red-600 font-bold text-sm mt-1"
                            >
                                {{ page.props.errors.image }}
                            </div>
                            <img
                                v-if="imagePreview"
                                :src="imagePreview"
                                class="mt-4 w-full md:w-48 h-auto object-cover rounded-xl border-2 border-black shadow-[4px_4px_0px_rgba(0,0,0,1)]"
                            />
                        </div>

                        <!-- Status & Pinned -->
                        <div class="space-y-6">
                            <div>
                                <label
                                    class="block text-sm font-bold text-gray-900 mb-2"
                                    >Status</label
                                >
                                <select
                                    v-model="status"
                                    class="w-full px-4 py-3 border-2 border-black rounded-xl focus:outline-none shadow-[3px_3px_0px_rgba(0,0,0,1)] font-bold cursor-pointer"
                                    :class="
                                        status === 'active'
                                            ? 'bg-[#86EFAC]'
                                            : 'bg-[#FECACA]'
                                    "
                                >
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <div
                                class="flex items-center gap-3 bg-[#E9D5FF] border-2 border-black p-4 rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)]"
                            >
                                <input
                                    id="pinned"
                                    type="checkbox"
                                    v-model="pinned"
                                    class="w-6 h-6 border-2 border-black rounded bg-white text-black focus:ring-0 cursor-pointer shadow-[2px_2px_0px_rgba(0,0,0,1)]"
                                />
                                <label
                                    for="pinned"
                                    class="text-sm font-bold text-gray-900 cursor-pointer select-none"
                                >
                                    Pin Project (Tampilkan di Atas)
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Links -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-sm font-bold text-gray-900 mb-2"
                                >Project Link (Live)</label
                            >
                            <input
                                v-model="link"
                                type="text"
                                class="w-full px-4 py-3 border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] font-medium"
                            />
                            <div
                                v-if="page.props.errors.link"
                                class="text-red-600 font-bold text-sm mt-1"
                            >
                                {{ page.props.errors.link }}
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-bold text-gray-900 mb-2"
                                >Source Code Link</label
                            >
                            <input
                                v-model="code"
                                type="text"
                                class="w-full px-4 py-3 border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] font-medium"
                            />
                            <div
                                v-if="page.props.errors.code"
                                class="text-red-600 font-bold text-sm mt-1"
                            >
                                {{ page.props.errors.code }}
                            </div>
                        </div>
                    </div>

                    <!-- Skills -->
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-900 mb-2"
                            >Skills</label
                        >
                        <div class="flex gap-2 mb-3">
                            <input
                                v-model="newSkill"
                                type="text"
                                placeholder="Tambah skill..."
                                class="flex-1 px-4 py-3 border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] font-medium"
                                @keydown.enter.prevent="addSkill"
                            />
                            <button
                                type="button"
                                @click="addSkill"
                                class="px-6 py-3 bg-[#86EFAC] text-black font-extrabold border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] transition-all"
                            >
                                + ADD
                            </button>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <span
                                v-for="(s, i) in skill"
                                :key="i"
                                class="flex items-center gap-2 bg-[#FEF08A] border-2 border-black text-black font-bold text-sm px-4 py-2 rounded-xl shadow-[2px_2px_0px_rgba(0,0,0,1)]"
                            >
                                {{ s }}
                                <button
                                    type="button"
                                    @click="removeSkill(i)"
                                    class="w-6 h-6 flex items-center justify-center bg-[#FECACA] border-2 border-black rounded-full hover:bg-red-500 hover:text-white transition-colors"
                                >
                                    &times;
                                </button>
                            </span>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div
                        class="pt-6 border-t-2 border-black border-dashed flex justify-end"
                    >
                        <button
                            type="submit"
                            class="w-full md:w-auto px-8 py-3 bg-[#BFDBFE] text-black font-bold text-lg border-2 border-black rounded-xl shadow-[4px_4px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all"
                        >
                            Update Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
