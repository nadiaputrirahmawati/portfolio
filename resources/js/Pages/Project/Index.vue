<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    projects: Array,
});

const form = useForm({});

import { STACKS } from "@/constants/stack";

const destroy = (id) => {
    if (confirm("Yakin mau hapus project ini?")) {
        form.delete(`/projects/${id}`);
    }
};
</script>

<template>
    <AdminLayout>
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Daftar Project</h1>
                <Link
                    href="/projects/create"
                    class="bg-blue-600 text-white px-4 py-2 rounded"
                >
                    + Tambah Project
                </Link>
            </div>

            <div v-if="projects.length > 0">
                <table
                    class="w-full border border-gray-300 rounded-lg overflow-hidden"
                >
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="p-2 border">Title</th>
                            <th class="p-2 border">Status</th>
                            <th>image</th>
                            <th>SKILL</th>
                            <th class="p-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="project in projects"
                            :key="project.project_id"
                        >
                            <td class="p-2 border">{{ project.title }}</td>
                            <td class="p-2 border">
                                <img
                                    :src="`${project.image}`"
                                    alt="Project Image"
                                    class="w-16 h-16 object-cover rounded"
                                />
                            </td>
                            <td class="p-2 border">
                                <span
                                    :class="
                                        project.status === 'active'
                                            ? 'text-green-600'
                                            : 'text-red-600'
                                    "
                                >
                                    {{ project.status }}
                                </span>
                            </td>

                            <td class="p-2 border">
                                <!-- render stacks -->
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        v-for="(stack, i) in project.skill"
                                        :key="i"
                                        class="flex items-center gap-1 text-sm font-medium"
                                    >
                                        <template v-if="STACKS[stack]">
                                            <component
                                                :is="STACKS[stack].icon"
                                                :class="STACKS[stack].color  "
                                            />
                                        </template>
                                        <template v-else>
                                            {{ stack }}   
                                        </template>
                                    </span>
                                </div>
                            </td>

                            <!-- <div v-html="project.description"></div> -->

                            <td class="p-2 border flex gap-4">
                                <Link
                                    :href="`/projects/${project.project_id}/edit`"
                                    class="text-blue-600 hover:underline"
                                >
                                    Edit
                                </Link>
                                <button
                                    @click="destroy(project.project_id)"
                                    class="text-red-600 hover:underline"
                                    :disabled="form.processing"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-else class="text-gray-500 text-center mt-6">
                Belum ada project.
            </div>
        </div>
    </AdminLayout>
</template>
