<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Editor from "@tinymce/tinymce-vue";

// Import STACKS dari folder contacts
import { STACKS } from "@/constants/stack";

const availableSkills = Object.keys(STACKS);

// Form Inertia
const form = useForm({
    title: "",
    description: "",
    image: null, // Berisi object File atau string URL
    gallery: [],
    link: "",
    code: "",
    skill: [],
    pinned: false,
    status: "active",
});

// Pilihan mode input gambar utama: 'upload' atau 'text'
const imageInputType = ref("upload");
const imagePreview = ref(null);

// Ganti mode input gambar utama
const switchImageType = (type) => {
    imageInputType.value = type;
    form.image = null;
    imagePreview.value = null;
};

// Handler Upload File
const handleImageFile = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.image = file;
        imagePreview.value = URL.createObjectURL(file);
    }
};

// Handler Input Text URL
const handleImageText = (e) => {
    const url = e.target.value;
    form.image = url;
    imagePreview.value = url;
};

// Skill dari Dropdown STACKS
const selectedSkill = ref("");

const addSkill = () => {
    if (selectedSkill.value && !form.skill.includes(selectedSkill.value)) {
        form.skill.push(selectedSkill.value);
        selectedSkill.value = "";
    }
};

const removeSkill = (index) => {
    form.skill.splice(index, 1);
};

// Gallery Tambahan
const newGalleryUrl = ref("");

const addGalleryImage = () => {
    if (newGalleryUrl.value.trim() !== "") {
        form.gallery.push(newGalleryUrl.value.trim());
        newGalleryUrl.value = "";
    }
};

const removeGalleryImage = (index) => {
    form.gallery.splice(index, 1);
};

// Submit Form
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
</script>

<template>
    <AdminLayout>
        <div class="mb-2 mt-2 items-center text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                Create Project
            </h1>
            <p class="text-gray-700 font-medium mt-2">
                Tambahkan karya terbaikmu ke dalam portfolio.
            </p>
        </div>

        <div class="flex justify-center p-4 md:p-8 min-h-screen font-sans">
            <!-- Form Card -->
            <div class="w-full max-w-4xl bg-white border-2 border-black rounded-2xl shadow-[8px_8px_0px_rgba(0,0,0,1)] p-6 md:p-8">
                
                <!-- Error Alert -->
                <div
                    v-if="Object.keys(form.errors).length"
                    class="mb-6 bg-[#FECACA] border-2 border-black rounded-xl p-4 shadow-[4px_4px_0px_rgba(0,0,0,1)]"
                >
                    <ul class="list-disc list-inside text-black font-bold text-sm space-y-1">
                        <li v-for="(error, key) in form.errors" :key="key">{{ error }}</li>
                    </ul>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-2">Title</label>
                        <input
                            v-model="form.title"
                            type="text"
                            class="w-full px-4 py-3 border-2 border-black rounded-xl focus:outline-none shadow-[3px_3px_0px_rgba(0,0,0,1)] font-medium"
                            placeholder="Masukkan nama project..."
                        />
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-2">Description</label>
                        <div class="border-2 border-black rounded-xl overflow-hidden shadow-[3px_3px_0px_rgba(0,0,0,1)]">
                            <Editor
                                api-key="uigedyonddh1st8of03ybyznu2xdn61wkj6bzdft2zc0omvz"
                                v-model="form.description"
                                :init="editorInit"
                            />
                        </div>
                    </div>

                    <!-- Input Gambar Utama (Ada Pilihan File atau Text/Link) -->
                    <div class="p-5 bg-[#F8FAFC] border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)]">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-900">
                                    Thumbnail Image (Utama)
                                </label>
                                <p class="text-xs text-gray-600 mt-0.5">
                                    Pilih mau upload file langsung atau pakai link text URL.
                                </p>
                            </div>

                            <!-- Tombol Switcher Pilihan -->
                            <div class="inline-flex border-2 border-black rounded-xl overflow-hidden bg-white p-1 gap-1">
                                <button
                                    type="button"
                                    @click="switchImageType('upload')"
                                    class="px-4 py-1.5 text-xs font-bold rounded-lg transition-all"
                                    :class="imageInputType === 'upload' ? 'bg-[#FDE047] text-black border border-black shadow-[2px_2px_0px_rgba(0,0,0,1)]' : 'text-gray-500 hover:text-black'"
                                >
                                    Upload File
                                </button>
                                <button
                                    type="button"
                                    @click="switchImageType('text')"
                                    class="px-4 py-1.5 text-xs font-bold rounded-lg transition-all"
                                    :class="imageInputType === 'text' ? 'bg-[#FDE047] text-black border border-black shadow-[2px_2px_0px_rgba(0,0,0,1)]' : 'text-gray-500 hover:text-black'"
                                >
                                    Link / URL Text
                                </button>
                            </div>
                        </div>

                        <!-- Pilihan 1: Jika memilih Upload File -->
                        <div v-if="imageInputType === 'upload'">
                            <input
                                type="file"
                                @change="handleImageFile"
                                accept="image/*"
                                class="w-full text-sm text-gray-900 border-2 border-black rounded-xl cursor-pointer shadow-[3px_3px_0px_rgba(0,0,0,1)] bg-white file:mr-4 file:py-3 file:px-4 file:border-0 file:border-r-2 file:border-black file:text-sm file:font-bold file:bg-[#FDE047] file:text-black hover:file:bg-[#facc15] transition-all"
                            />
                        </div>

                        <!-- Pilihan 2: Jika memilih Text / URL Link -->
                        <div v-else>
                            <input
                                type="url"
                                :value="form.image"
                                @input="handleImageText"
                                placeholder="https://res.cloudinary.com/... atau link gambar web"
                                class="w-full px-4 py-3 border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] font-medium text-sm bg-white focus:outline-none"
                            />
                        </div>

                        <!-- Error Message -->
                        <div v-if="form.errors.image" class="text-red-600 font-bold text-sm mt-2">
                            {{ form.errors.image }}
                        </div>

                        <!-- Preview Gambar -->
                        <div v-if="imagePreview" class="mt-4">
                            <p class="text-xs font-bold text-gray-700 mb-2">Preview Thumbnail:</p>
                            <img
                                :src="imagePreview"
                                class="w-full sm:w-56 h-36 object-cover rounded-xl border-2 border-black shadow-[4px_4px_0px_rgba(0,0,0,1)] bg-white"
                            />
                        </div>
                    </div>

                    <!-- Gallery Tambahan (JSON Link) -->
                    <div class="p-4 bg-[#F1F5F9] border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)]">
                        <label class="block text-sm font-bold text-gray-900 mb-1">
                            Foto Tambahan / Gallery (Disimpan sebagai JSON)
                        </label>
                        <p class="text-xs text-gray-600 mb-3">
                            Masukkan link gambar (Cloudinary/CDN), lalu klik tombol tambah.
                        </p>
                        <div class="flex gap-2 mb-3">
                            <input
                                v-model="newGalleryUrl"
                                type="url"
                                placeholder="https://res.cloudinary.com/..."
                                class="flex-1 px-4 py-2 border-2 border-black rounded-xl shadow-[2px_2px_0px_rgba(0,0,0,1)] font-medium text-sm focus:outline-none"
                                @keydown.enter.prevent="addGalleryImage"
                            />
                            <button
                                type="button"
                                @click="addGalleryImage"
                                class="px-5 py-2 bg-[#93C5FD] text-black font-extrabold border-2 border-black rounded-xl shadow-[2px_2px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all text-sm"
                            >
                                + URL
                            </button>
                        </div>

                        <!-- Preview List Gallery -->
                        <div v-if="form.gallery.length" class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-3">
                            <div
                                v-for="(imgUrl, idx) in form.gallery"
                                :key="idx"
                                class="relative group border-2 border-black rounded-xl overflow-hidden shadow-[2px_2px_0px_rgba(0,0,0,1)] bg-white aspect-video"
                            >
                                <img :src="imgUrl" class="w-full h-full object-cover" />
                                <button
                                    type="button"
                                    @click="removeGalleryImage(idx)"
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold border border-black shadow"
                                >
                                    &times;
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Status & Pinned -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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

                        <div class="flex items-center gap-3 bg-[#E9D5FF] border-2 border-black p-4 rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] mt-auto">
                            <input
                                id="pinned"
                                v-model="form.pinned"
                                type="checkbox"
                                class="w-6 h-6 border-2 border-black rounded bg-white text-black focus:ring-0 cursor-pointer shadow-[2px_2px_0px_rgba(0,0,0,1)]"
                            />
                            <label for="pinned" class="text-sm font-bold text-gray-900 cursor-pointer select-none">
                                Pin Project (Tampilkan di Atas)
                            </label>
                        </div>
                    </div>

                    <!-- Links: Project & Code -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-900 mb-2">Project Link (Live)</label>
                            <input
                                v-model="form.link"
                                type="text"
                                class="w-full px-4 py-3 border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] font-medium"
                                placeholder="https://..."
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-900 mb-2">Source Code Link</label>
                            <input
                                v-model="form.code"
                                type="text"
                                class="w-full px-4 py-3 border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] font-medium"
                                placeholder="https://github.com/..."
                            />
                        </div>
                    </div>

                    <!-- Skills (Dropdown dari STACKS) -->
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-2">Skills (Tech Stack)</label>
                        <div class="flex gap-2 mb-3">
                            <select
                                v-model="selectedSkill"
                                class="flex-1 px-4 py-3 border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] font-bold bg-white focus:outline-none cursor-pointer"
                            >
                                <option value="" disabled>-- Pilih Skill dari Stack --</option>
                                <option
                                    v-for="skillKey in availableSkills"
                                    :key="skillKey"
                                    :value="skillKey"
                                >
                                    {{ STACKS[skillKey].text || skillKey }}
                                </option>
                            </select>
                            <button
                                type="button"
                                @click="addSkill"
                                class="px-6 py-3 bg-[#86EFAC] text-black font-extrabold border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] transition-all"
                            >
                                + ADD
                            </button>
                        </div>

                        <!-- Badges Skill -->
                        <div class="flex flex-wrap gap-3">
                            <span
                                v-for="(s, index) in form.skill"
                                :key="index"
                                class="flex items-center gap-2 bg-[#FEF08A] border-2 border-black text-black font-bold text-sm px-4 py-2 rounded-xl shadow-[2px_2px_0px_rgba(0,0,0,1)]"
                            >
                                {{ STACKS[s]?.text || s }}
                                <button
                                    type="button"
                                    @click="removeSkill(index)"
                                    class="w-6 h-6 flex items-center justify-center bg-[#FECACA] border-2 border-black rounded-full hover:bg-red-500 hover:text-white transition-colors"
                                >
                                    &times;
                                </button>
                            </span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6 border-t-2 border-black border-dashed flex justify-end">
                        <button
                            type="submit"
                            class="w-full md:w-auto px-8 py-3 bg-[#BFDBFE] text-black font-bold text-lg border-2 border-black rounded-xl shadow-[4px_4px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all"
                            :disabled="form.processing"
                        >
                            {{ form.processing ? "Menyimpan..." : "Save Project" }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>