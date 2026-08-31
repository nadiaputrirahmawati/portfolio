<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    experience: Object,
});

// Inisialisasi form dengan data experience yang sudah ada
const form = useForm({
    company_name: props.experience.company_name || "",
    position: props.experience.position || "",
    location: props.experience.location || "",
    start_date: props.experience.start_date || "",
    end_date: props.experience.end_date || "",
    description: props.experience.description || "",
});

const submit = () => {
    // Menggunakan method PUT/PATCH untuk update data
    form.put(`/experiences/${props.experience.id}`);
};
</script>

<template>
    <AdminLayout>
        <div class="p-6 md:p-8 bg-[#FDF8F5] min-h-screen font-sans flex justify-center">
            
            <div class="w-full max-w-3xl bg-white border-2 border-black rounded-3xl p-8 shadow-[8px_8px_0px_rgba(0,0,0,1)]">
                
                <div class="flex items-center justify-between mb-8">
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                        Edit Pengalaman
                    </h1>
                    <Link href="/experiences" class="text-gray-500 font-bold hover:text-black underline">
                        Batal
                    </Link>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    
                    <!-- Perusahaan & Posisi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="font-bold text-gray-800">Nama Perusahaan</label>
                            <input 
                                v-model="form.company_name" 
                                type="text" 
                                class="px-4 py-3 rounded-xl border-2 border-black focus:outline-none focus:shadow-[4px_4px_0px_rgba(0,0,0,1)] transition-all font-semibold"
                                placeholder="Contoh: PT. Teknologi Masa Depan"
                                required
                            />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-bold text-gray-800">Posisi / Jabatan</label>
                            <input 
                                v-model="form.position" 
                                type="text" 
                                class="px-4 py-3 rounded-xl border-2 border-black focus:outline-none focus:shadow-[4px_4px_0px_rgba(0,0,0,1)] transition-all font-semibold"
                                placeholder="Contoh: Frontend Engineer"
                                required
                            />
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="flex flex-col gap-2">
                        <label class="font-bold text-gray-800">Lokasi</label>
                        <input 
                            v-model="form.location" 
                            type="text" 
                            class="px-4 py-3 rounded-xl border-2 border-black focus:outline-none focus:shadow-[4px_4px_0px_rgba(0,0,0,1)] transition-all font-semibold"
                            placeholder="Contoh: Jakarta, Indonesia (Remote)"
                        />
                    </div>

                    <!-- Tanggal -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="font-bold text-gray-800">Tanggal Mulai</label>
                            <input 
                                v-model="form.start_date" 
                                type="date" 
                                class="px-4 py-3 rounded-xl border-2 border-black focus:outline-none focus:shadow-[4px_4px_0px_rgba(0,0,0,1)] transition-all font-semibold"
                                required
                            />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-bold text-gray-800">
                                Tanggal Selesai 
                                <span class="text-sm font-normal text-gray-500 ml-1">(Kosongkan jika masih bekerja)</span>
                            </label>
                            <input 
                                v-model="form.end_date" 
                                type="date" 
                                class="px-4 py-3 rounded-xl border-2 border-black focus:outline-none focus:shadow-[4px_4px_0px_rgba(0,0,0,1)] transition-all font-semibold"
                            />
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="flex flex-col gap-2">
                        <label class="font-bold text-gray-800">Deskripsi Pekerjaan</label>
                        <textarea 
                            v-model="form.description" 
                            rows="5"
                            class="px-4 py-3 rounded-xl border-2 border-black focus:outline-none focus:shadow-[4px_4px_0px_rgba(0,0,0,1)] transition-all font-semibold resize-none"
                            placeholder="Jelaskan tanggung jawab dan pencapaianmu di sini..."
                        ></textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="pt-4 flex justify-end">
                        <button 
                            type="submit" 
                            :disabled="form.processing"
                            class="bg-[#86EFAC] text-black font-extrabold text-lg px-8 py-3 rounded-full border-2 border-black shadow-[4px_4px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all w-full md:w-auto"
                        >
                            Update Pengalaman
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </AdminLayout>
</template>