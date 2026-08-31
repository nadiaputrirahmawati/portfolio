<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { STACKS } from "@/constants/stack";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    projects: Object,
});

const form = useForm({});

const destroy = (id) => {
    if (confirm("Yakin mau hapus project ini?")) {
        form.delete(`/projects/${id}`);
    }
};
</script>

<template>
    <AdminLayout>
        <!-- Background krem agar menyatu dengan navbar -->
        <div class="p-6 md:p-8 min-h-screen font-sans">
            
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:justify-between justify-start items-start md:items-center gap-4 mb-8">
                <h1 class="text-4xl md:text-5xl lg:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Daftar Project
                </h1>
                
                <Link
                    href="/projects/create"
                    class="bg-black text-white font-semibold rounded-full border-2 border-black px-6 py-2 shadow-[4px_4px_0px_rgba(0,0,0,0.2)] hover:shadow-[2px_2px_0px_rgba(0,0,0,0.2)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all w-full md:w-auto text-center"
                >
                    + Tambah Project
                </Link>
            </div>

            <!-- PERBAIKAN 1: Tambahkan .data -->
            <div v-if="projects.data.length > 0">
                
                <!-- Desktop Table -->
                <div class="hidden md:block overflow-x-auto bg-white border-2 border-black rounded-2xl shadow-[6px_6px_0px_rgba(0,0,0,1)]">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="bg-[#F8F9FA] text-gray-800 text-sm border-b-2 border-black">
                                <th class="p-4 font-bold text-left">Title</th>
                                <th class="p-4 font-bold text-left">Status</th>
                                <th class="p-4 font-bold text-left">Image</th>
                                <th class="p-4 font-bold text-left">Skill</th>
                                <th class="p-4 font-bold text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- PERBAIKAN 2: Tambahkan .data -->
                            <tr
                                v-for="project in projects.data"
                                :key="project.project_id"
                                class="border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition-colors"
                            >
                                <td class="p-4 font-semibold text-gray-900">
                                    {{ project.title }}
                                </td>
                                
                                <td class="p-4">
                                    <span
                                        class="px-3 py-1 text-xs font-bold rounded-full border-2 border-black shadow-[2px_2px_0px_rgba(0,0,0,1)]"
                                        :class="project.status === 'active' ? 'bg-[#86EFAC] text-black' : 'bg-[#FECACA] text-black'"
                                    >
                                        {{ project.status }}
                                    </span>
                                </td>

                                <td class="p-4">
                                    <img
                                        :src="`${project.image}`"
                                        alt="Project Image"
                                        class="w-16 h-16 object-cover rounded-xl border-2 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)]"
                                    />
                                </td>

                                <td class="p-4 whitespace-normal min-w-[100px]">
                                    <div class="flex flex-wrap gap-2">
                                        <span
                                            v-for="(stack, i) in project.skill"
                                            :key="i"
                                            class="flex items-center gap-1 text-xs font-semibold bg-white border-2 border-black rounded-lg px-2 py-1 shadow-[2px_2px_0px_rgba(0,0,0,1)]"
                                        >
                                            <template v-if="STACKS[stack]">
                                                <component
                                                    :is="STACKS[stack].icon"
                                                    :class="STACKS[stack].color"
                                                    class="w-7 h-7"
                                                />
                                            </template>
                                            <template v-else>
                                                {{ stack }}
                                            </template>
                                        </span>
                                    </div>
                                </td>

                                <td class="p-4">
                                    <div class="flex gap-3 h-full items-center">
                                        <Link
                                            :href="`/projects/${project.project_id}/edit`"
                                            class="bg-[#BFDBFE] text-black border-2 border-black rounded-xl px-4 py-1.5 font-bold text-sm shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] transition-all"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="destroy(project.project_id)"
                                            class="bg-[#FECDD3] text-black border-2 border-black rounded-xl px-4 py-1.5 font-bold text-sm shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] transition-all"
                                            :disabled="form.processing"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- ============================================== -->
                <!-- TAMPILAN MOBILE (KARTU) - Sembunyi di Desktop  -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:hidden">
                    <!-- PERBAIKAN 3: Tambahkan .data -->
                    <div 
                        v-for="project in projects.data" 
                        :key="project.project_id"
                        class="bg-white border-2 border-black rounded-2xl p-5 shadow-[6px_6px_0px_rgba(0,0,0,1)] flex flex-col gap-4"
                    >
                        <!-- Header Kartu: Gambar & Status -->
                        <div class="flex justify-between items-start">
                            <img
                                :src="`${project.image}`"
                                alt="Project Image"
                                class="w-20 h-20 object-cover rounded-xl border-2 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)]"
                            />
                            <span
                                class="px-3 py-1 text-xs font-bold rounded-full border-2 border-black shadow-[2px_2px_0px_rgba(0,0,0,1)]"
                                :class="project.status === 'active' ? 'bg-[#86EFAC] text-black' : 'bg-[#FECACA] text-black'"
                            >
                                {{ project.status }}
                            </span>
                        </div>

                        <!-- Judul -->
                        <h2 class="text-xl font-bold text-gray-900 mt-2">
                            {{ project.title }}
                        </h2>

                        <!-- Skills -->
                        <div class="flex flex-wrap gap-2">
                            <span
                                v-for="(stack, i) in project.skill"
                                :key="i"
                                class="flex items-center gap-1 text-xs font-semibold bg-white border-2 border-black rounded-lg px-2 py-1 shadow-[2px_2px_0px_rgba(0,0,0,1)]"
                            >
                                <template v-if="STACKS[stack]">
                                    <component
                                        :is="STACKS[stack].icon"
                                        :class="STACKS[stack].color"
                                        class="w-6 h-6"
                                    />
                                </template>
                                <template v-else>
                                    {{ stack }}
                                </template>
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3 mt-4 pt-4 border-t-2 border-black border-dashed">
                            <Link
                                :href="`/projects/${project.project_id}/edit`"
                                class="flex-1 text-center bg-[#BFDBFE] text-black border-2 border-black rounded-xl px-4 py-2 font-bold text-sm shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] transition-all"
                            >
                                Edit
                            </Link>
                            <button
                                @click="destroy(project.project_id)"
                                class="flex-1 text-center bg-[#FECDD3] text-black border-2 border-black rounded-xl px-4 py-2 font-bold text-sm shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] transition-all"
                                :disabled="form.processing"
                            >
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- PERBAIKAN 4: Ganti experiences menjadi projects -->
                <Pagination class="mt-6" :links="projects.links" />
            </div>

            <div v-else class="text-black text-center mt-12 bg-[#FEF08A] rounded-2xl border-2 border-black p-8 font-bold text-lg shadow-[6px_6px_0px_rgba(0,0,0,1)]">
                Belum ada project yang ditambahkan! ✨
            </div>
            
        </div>
    </AdminLayout>
</template>