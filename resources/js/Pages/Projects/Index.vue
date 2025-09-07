<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    projects: Array,
});
</script>

<template>
   <Head title="Dashboard" />

    <AdminLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        
        <div class="p-6 text-gray-900">
            <h1 class="text-3xl font-bold">Projects Halaman Ini</h1>
            <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="px-6 py-3">Deskripsi</th>
                        <th scope="col" class="px-6 py-3">Image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="project in projects" :key="project.project_id">
                        <td class="px-6 py-4">
                            {{ project.project_id }}
                        </td>
                        <td class="px-6 py-4">
                            {{ project.title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ project.description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ project.image }}
                        </td>
                        <PrimaryButton>Detail</PrimaryButton>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>
