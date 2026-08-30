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
        <!-- Header -->
        <div class="mb-2 mt-2 text-center">
            <h1
                class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight"
            >
                Tambah Achievement
            </h1>
            <p class="text-gray-700 font-medium mt-2">
                Masukkan data sertifikat/pencapaian baru.
            </p>
        </div>
        <div class="flex p-4 md:p-8 min-h-screen font-sans justify-center">
            <!-- Error Validation Box -->
            <div
                v-if="Object.keys(errors).length"
                class="mb-6 bg-[#FECACA] border-2 border-black rounded-xl p-4 shadow-[4px_4px_0px_rgba(0,0,0,1)] max-w-4xl"
            >
                <ul
                    class="list-disc list-inside text-black font-bold text-sm space-y-1"
                >
                    <li v-for="(error, key) in errors" :key="key">
                        {{ error }}
                    </li>
                </ul>
            </div>

            <!-- Form Card -->
            <div
                class="max-w-4xl bg-white border-2 border-black rounded-2xl shadow-[8px_8px_0px_rgba(0,0,0,1)] p-6 md:p-8"
            >
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Judul -->
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-900 mb-2"
                            >Judul Sertifikat</label
                        >
                        <input
                            v-model="title"
                            type="text"
                            placeholder="Contoh: AWS Certified Cloud Practitioner"
                            class="w-full px-4 py-3 border-2 border-black rounded-xl focus:outline-none focus:ring-0 shadow-[3px_3px_0px_rgba(0,0,0,1)] font-medium transition-all"
                        />
                        <div
                            v-if="errors.title"
                            class="text-red-600 font-bold text-sm mt-1"
                        >
                            {{ errors.title }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Image -->
                        <div>
                            <label
                                class="block text-sm font-bold text-gray-900 mb-2"
                                >Upload Gambar</label
                            >
                            <input
                                type="file"
                                @change="handleImageChange"
                                accept="image/*"
                                class="w-full text-sm text-gray-900 border-2 border-black rounded-xl cursor-pointer shadow-[3px_3px_0px_rgba(0,0,0,1)] file:mr-4 file:py-3 file:px-4 file:border-0 file:border-r-2 file:border-black file:text-sm file:font-bold file:bg-[#FDE047] file:text-black hover:file:bg-[#facc15] transition-all"
                            />
                            <div
                                v-if="errors.image"
                                class="text-red-600 font-bold text-sm mt-1"
                            >
                                {{ errors.image }}
                            </div>

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
                                <div
                                    v-if="errors.status"
                                    class="text-red-600 font-bold text-sm mt-1"
                                >
                                    {{ errors.status }}
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-bold text-gray-900 mb-2"
                                    >Credential ID</label
                                >
                                <input
                                    v-model="credentials"
                                    type="text"
                                    placeholder="ID Sertifikat (Opsional)"
                                    class="w-full px-4 py-3 border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] font-medium"
                                />
                                <div
                                    v-if="errors.credentials"
                                    class="text-red-600 font-bold text-sm mt-1"
                                >
                                    {{ errors.credentials }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Link -->
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-900 mb-2"
                            >Link Verifikasi (URL)</label
                        >
                        <input
                            v-model="link"
                            type="text"
                            placeholder="https://..."
                            class="w-full px-4 py-3 border-2 border-black rounded-xl shadow-[3px_3px_0px_rgba(0,0,0,1)] font-medium"
                        />
                        <div
                            v-if="errors.link"
                            class="text-red-600 font-bold text-sm mt-1"
                        >
                            {{ errors.link }}
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
                            Simpan Achievement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
