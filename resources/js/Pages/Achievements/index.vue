<script setup lang="ts">
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps<{
    achievements: Array<{
        achievements_id: number;
        title: string;
        credentials: string;
        image: string;
        status: string;
    }>;
}>();

const form = useForm({});
</script>

<template>
    <AdminLayout>
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Daftar Sertifikat</h1>
                <a
                    :href="route('achievements.create')"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700"
                >
                    Tambah Sertifikat
                </a>
            </div>

            <div v-if="props.achievements.length > 0">
                <table
                    class="w-full border border-gray-300 rounded-lg overflow-hidden text-left"
                >
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">Nama Sertifikat</th>
                            <th class="px-4 py-2 border">Kode Sertifikat</th>
                            <th class="px-4 py-2 border">Image</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="(data, index) in props.achievements"
                            :key="data.achievements_id"
                            class="hover:bg-gray-50"
                        >
                            <td class="px-4 py-2 border">{{ index + 1 }}</td>
                            <td class="px-4 py-2 border">{{ data.title }}</td>
                            <td class="px-4 py-2 border">{{ data.credentials }}</td>
                            <td class="px-4 py-2 border">
                                <img
                                    :src="data.image"
                                    alt="Sertifikat"
                                    class="w-20 h-auto rounded"
                                />
                            </td>
                            <td class="px-4 py-2 border">
                                <span
                                    :class="data.status === 'active' ? 'text-green-600' : 'text-red-600'"
                                >
                                    {{ data.status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border space-x-2">
                                <a
                                    :href="route('achievements.edit', data.achievements_id)"
                                    class="text-blue-600 hover:underline"
                                >
                                    Edit
                                </a>
                                <button
                                    @click="form.delete(route('achievements.destroy', data.achievements_id))"
                                    class="text-red-600 hover:underline"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-else class="text-gray-500 text-center mt-6">
                Belum ada sertifikat.
            </div>
        </div>
    </AdminLayout>
</template>
