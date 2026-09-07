<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    achievements: Object,
});

const form = useForm({});

const destroy = (id) => {
    if (confirm("Yakin mau hapus sertifikat ini?")) {
        form.delete(route('achievements.destroy', id));
    }
};
</script>

<template>
    <AdminLayout>
        <div class="p-6 md:p-8 min-h-screen font-sans">
            
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:justify-between justify-start items-start md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-4xl md:text-5xl lg:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Daftar Sertifikat
                    </h1>
                    <p class="text-gray-700 font-medium mt-2">Kelola semua pencapaian dan sertifikatmu di sini.</p>
                </div>
                
                <Link
                    :href="route('achievements.create')"
                    class="bg-black text-white font-semibold rounded-full border-2 border-black px-6 py-2 shadow-[4px_4px_0px_rgba(0,0,0,0.2)] hover:shadow-[2px_2px_0px_rgba(0,0,0,0.2)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all w-full md:w-auto text-center inline-block"
                >
                    + Tambah Sertifikat
                </Link>
            </div>

            <div v-if="achievements?.data?.length > 0">
                <!-- ============================================== -->
                <!-- TAMPILAN DESKTOP (TABEL)                       -->
                <!-- ============================================== -->
                <div class="hidden md:block overflow-x-auto bg-white border-2 border-black rounded-2xl shadow-[6px_6px_0px_rgba(0,0,0,1)]">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="bg-[#F8F9FA] text-gray-800 text-sm border-b-2 border-black">
                                <th class="p-4 font-bold text-left">No</th>
                                <th class="p-4 font-bold text-left">Sertifikat</th>
                                <th class="p-4 font-bold text-left">Kode / Credential</th>
                                <th class="p-4 font-bold text-left">Image</th>
                                <th class="p-4 font-bold text-left">Status</th>
                                <th class="p-4 font-bold text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Gunakan achiv.id atau achiv.achievements_id sesuai database -->
                            <tr
                                v-for="(achiv, index) in achievements.data"
                                :key="achiv.id ?? achiv.achievements_id"
                                class="border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition-colors"
                            >
                                <td class="p-4 font-bold text-gray-900">{{ index + 1 }}</td>
                                <td class="p-4 font-semibold text-gray-900">{{ achiv.title }}</td>
                                <td class="p-4 font-mono text-sm text-gray-700">{{ achiv.credentials || '-' }}</td>
                                
                                <td class="p-4">
                                    <img
                                        :src="achiv.image"
                                        alt="Sertifikat"
                                        class="w-20 h-auto object-cover rounded-xl border-2 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)]"
                                    />
                                </td>

                                <td class="p-4">
                                    <span
                                        class="px-3 py-1 text-xs font-bold rounded-full border-2 border-black shadow-[2px_2px_0px_rgba(0,0,0,1)]"
                                        :class="achiv.status === 'active' ? 'bg-[#86EFAC] text-black' : 'bg-[#FECACA] text-black'"
                                    >
                                        {{ achiv.status }}
                                    </span>
                                </td>

                                <td class="p-4">
                                    <div class="flex gap-3 h-full items-center">
                                        <!-- Perbaikan: gunakan achiv.id / achiv -->
                                        <Link
                                            :href="route('achievements.edit', achiv.id ?? achiv.achievements_id)"
                                            class="bg-[#BFDBFE] text-black border-2 border-black rounded-xl px-4 py-1.5 font-bold text-sm shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] transition-all"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="destroy(achiv.id ?? achiv.achievements_id)"
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
                <!-- TAMPILAN MOBILE (KARTU)                        -->
                <!-- ============================================== -->
                <div class="grid grid-cols-1 gap-6 md:hidden">
                    <div 
                        v-for="(achiv, index) in achievements.data" 
                        :key="achiv.id ?? achiv.achievements_id"
                        class="bg-white border-2 border-black rounded-2xl p-5 shadow-[6px_6px_0px_rgba(0,0,0,1)] flex flex-col gap-4"
                    >
                        <div class="flex justify-between items-start">
                            <span class="bg-[#FDE047] border-2 border-black font-bold px-3 py-1 rounded-lg text-sm shadow-[2px_2px_0px_rgba(0,0,0,1)]">
                                #{{ index + 1 }}
                            </span>
                            <span
                                class="px-3 py-1 text-xs font-bold rounded-full border-2 border-black shadow-[2px_2px_0px_rgba(0,0,0,1)]"
                                :class="achiv.status === 'active' ? 'bg-[#86EFAC] text-black' : 'bg-[#FECACA] text-black'"
                            >
                                {{ achiv.status }}
                            </span>
                        </div>

                        <img
                            :src="achiv.image"
                            alt="Sertifikat"
                            class="w-full h-40 object-cover rounded-xl border-2 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)]"
                        />

                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ achiv.title }}</h2>
                            <p class="font-mono text-sm text-gray-700 mt-1 flex items-center gap-2">
                                🎫 {{ achiv.credentials || 'Tidak ada kode' }}
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3 mt-2 pt-4 border-t-2 border-black border-dashed">
                            <!-- Perbaikan: gunakan achiv.id / achiv -->
                            <Link
                                :href="route('achievements.edit', achiv.id ?? achiv.achievements_id)"
                                class="flex-1 text-center bg-[#BFDBFE] text-black border-2 border-black rounded-xl px-4 py-2 font-bold text-sm shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] transition-all"
                            >
                                Edit
                            </Link>
                            <button
                                @click="destroy(achiv.id ?? achiv.achievements_id)"
                                class="flex-1 text-center bg-[#FECDD3] text-black border-2 border-black rounded-xl px-4 py-2 font-bold text-sm shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] transition-all"
                                :disabled="form.processing"
                            >
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="text-black text-center mt-12 bg-[#FEF08A] rounded-2xl border-2 border-black p-8 font-bold text-lg shadow-[6px_6px_0px_rgba(0,0,0,1)]">
                Belum ada sertifikat atau pencapaian yang ditambahkan! ✨
            </div>

            <Pagination class="mt-6" :links="achievements.links" />
            
        </div>
    </AdminLayout>
</template>