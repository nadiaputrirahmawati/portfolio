<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue"; // 1. Import komponen Pagination

const props = defineProps({
    experiences: Object, // 2. Ubah tipe dari Array menjadi Object
});

const form = useForm({});

const destroy = (id) => {
    if (confirm("Yakin mau hapus pengalaman kerja ini?")) {
        form.delete(`/experiences/${id}`);
    }
};
</script>

<template>
    <AdminLayout>
        <div class="p-6 md:p-8  min-h-screen font-sans">
            
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    Pengalaman Kerja
                </h1>
                
                <Link
                    href="/experiences/create"
                    class="bg-black text-white font-semibold rounded-full border-2 border-black px-6 py-2 shadow-[4px_4px_0px_rgba(0,0,0,0.2)] hover:shadow-[2px_2px_0px_rgba(0,0,0,0.2)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all"
                >
                    + Tambah Pengalaman
                </Link>
            </div>

            <!-- 3. Cek data menggunakan experiences.data.length -->
            <div v-if="experiences.data.length > 0" class="overflow-x-auto bg-white border-2 border-black rounded-2xl shadow-[6px_6px_0px_rgba(0,0,0,1)]">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="bg-[#F8F9FA] text-gray-800 text-sm border-b-2 border-black">
                            <th class="p-4 font-bold text-left">Perusahaan & Posisi</th>
                            <th class="p-4 font-bold text-left">Durasi</th>
                            <th class="p-4 font-bold text-left">Model Kerja</th>
                            <th class="p-4 font-bold text-left">Lokasi</th>
                            <th class="p-4 font-bold text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 4. Looping diarahkan ke experiences.data -->
                        <tr
                            v-for="exp in experiences.data"
                            :key="exp.id"
                            class="border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition-colors"
                        >
                            <td class="p-4">
                                <div class="font-bold text-gray-900 text-lg">{{ exp.company_name }}</div>
                                <div class="text-sm text-gray-600 font-semibold">{{ exp.position }}</div>
                            </td>
                            
                            <td class="p-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-full border-2 border-black shadow-[2px_2px_0px_rgba(0,0,0,1)] bg-[#E9D5FF] text-black">
                                    {{ exp.start_date }} - {{ exp.end_date ? exp.end_date : 'Sekarang' }}
                                </span>
                            </td>

                            <td class="p-4 font-semibold text-gray-700">
                                <span :class="{ 'text-red-500 text-sm italic': !exp.work_model }">
                                    {{ exp.work_model || 'Tidak diisi' }}
                                </span>
                            </td>

                            <td class="p-4 font-semibold text-gray-700">
                                {{ exp.location || '-' }}
                            </td>

                            <td class="p-4 flex gap-3 h-full items-center mt-2">
                                <Link
                                    :href="`/experiences/${exp.id}/edit`"
                                    class="bg-[#BFDBFE] text-black border-2 border-black rounded-xl px-4 py-1.5 font-bold text-sm shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] transition-all"
                                >
                                    Edit
                                </Link>
                                <button
                                    @click="destroy(exp.id)"
                                    class="bg-[#FECDD3] text-black border-2 border-black rounded-xl px-4 py-1.5 font-bold text-sm shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] transition-all"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-else class="text-black text-center mt-12 bg-[#FEF08A] rounded-2xl border-2 border-black p-8 font-bold text-lg shadow-[6px_6px_0px_rgba(0,0,0,1)]">
                Belum ada pengalaman kerja yang ditambahkan!
            </div>

            <!-- 5. Panggil Komponen Pagination di bawah tabel -->
            <Pagination class="mt-6" :links="experiences.links" />

        </div>
    </AdminLayout>
</template>