<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm, Link } from "@inertiajs/vue3";
import { ref } from "vue";

// State untuk mengatur tipe logo (teks atau gambar) dan preview gambar
const logoType = ref("text");
const previewUrl = ref(null);

const form = useForm({
    company_name: "",
    position: "",
    location: "",
    start_date: "",
    end_date: "", // is_current sudah dihapus
    description: "",
    work_model: "",
    company_logo: null,
});

// Fungsi untuk handle ketika file gambar dipilih
const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.company_logo = file;
        previewUrl.value = URL.createObjectURL(file); // Membuat URL preview sementara
    }
};

// Fungsi reset nilai logo ketika ganti tipe (Teks <-> Gambar)
const toggleLogoType = (type) => {
    logoType.value = type;
    form.company_logo = null;
    previewUrl.value = null;
};

const submit = () => {
    form.post("/experiences");
};
</script>

<template>
    <AdminLayout>
        <div class="p-6 md:p-8 min-h-screen font-sans flex justify-center">
            
            <div class="w-full max-w-4xl bg-white border-2 border-black rounded-3xl p-8 shadow-[8px_8px_0px_rgba(0,0,0,1)]">
                
                <div class="flex items-center justify-between mb-8 border-b-2 border-black pb-4">
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                        Tambah Pengalaman Baru
                    </h1>
                    <Link href="/experiences" class="text-gray-500 font-bold hover:text-black underline transition-colors">
                        Batal
                    </Link>
                </div>

                <form @submit.prevent="submit" class="space-y-8">
                    
                    <!-- Pilihan Company Logo -->
                    <div class="bg-[#F8F9FA] p-6 border-2 border-black rounded-2xl shadow-[4px_4px_0px_rgba(0,0,0,1)]">
                        <label class="font-bold text-gray-800 block mb-4 text-lg">Logo Perusahaan</label>
                        
                        <!-- Toggle Buttons Teks / Gambar -->
                        <div class="flex gap-4 mb-4">
                            <button 
                                type="button" 
                                @click="toggleLogoType('text')"
                                class="px-6 py-2 rounded-xl border-2 border-black font-bold transition-all"
                                :class="logoType === 'text' ? 'bg-[#FDE047] shadow-[3px_3px_0px_rgba(0,0,0,1)] -translate-y-1' : 'bg-white hover:bg-gray-100'"
                            >
                                Gunakan Teks
                            </button>
                            <button 
                                type="button" 
                                @click="toggleLogoType('image')"
                                class="px-6 py-2 rounded-xl border-2 border-black font-bold transition-all"
                                :class="logoType === 'image' ? 'bg-[#C4B5FD] shadow-[3px_3px_0px_rgba(0,0,0,1)] -translate-y-1' : 'bg-white hover:bg-gray-100'"
                            >
                                Upload Gambar
                            </button>
                        </div>

                        <!-- Input untuk Teks -->
                        <div v-if="logoType === 'text'">
                            <input 
                                v-model="form.company_logo" 
                                type="text" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-black focus:outline-none focus:shadow-[4px_4px_0px_rgba(0,0,0,1)] transition-all font-semibold"
                                placeholder="Contoh: Google, Meta, atau singkatan PT..."
                            />
                        </div>

                        <!-- Input untuk File Gambar & Preview -->
                        <div v-else class="flex items-center gap-6">
                            <div class="flex-1">
                                <input 
                                    type="file" 
                                    @change="handleFileChange"
                                    accept="image/*"
                                    
                                    class="w-full px-4 py-3 bg-white rounded-xl border-2 border-black focus:outline-none focus:shadow-[4px_4px_0px_rgba(0,0,0,1)] transition-all font-semibold file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-[#E9D5FF] file:text-black hover:file:bg-purple-300 cursor-pointer"
                                />
                            </div>
                            <!-- Kotak Preview -->
                            <div v-if="previewUrl" class="shrink-0 w-20 h-20 rounded-2xl border-2 border-black shadow-[4px_4px_0px_rgba(0,0,0,1)] overflow-hidden bg-white flex items-center justify-center p-2">
                                <img :src="previewUrl" alt="Preview" class="max-w-full max-h-full object-contain" />
                            </div>
                            <div v-else class="shrink-0 w-20 h-20 rounded-2xl border-2 border-dashed border-gray-400 flex items-center justify-center bg-gray-50 text-xs font-bold text-gray-400 text-center p-2">
                                No<br>Preview
                            </div>
                        </div>
                    </div>

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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Work Model (Remote / Onsite) -->
                        <div class="flex flex-col gap-2">
                            <label class="font-bold text-gray-800">Tipe Pekerjaan <small>(Onsite / Remote)</small></label>
                            <input 
                                v-model="form.work_model" 
                                type="text" 
                                class="px-4 py-3 rounded-xl border-2 border-black focus:outline-none focus:shadow-[4px_4px_0px_rgba(0,0,0,1)] transition-all font-semibold"
                                placeholder="Contoh: Remote / Onsite"
                            />
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
                    </div>

                    <!-- Tanggal (Tanpa is_current) -->
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
                            <label class="font-bold text-gray-800">Tanggal Selesai (Kosongkan jika masih bekerja)</label>
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
                            class="bg-[#86EFAC] text-black font-extrabold text-lg px-10 py-3 rounded-full border-2 border-black shadow-[4px_4px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] transition-all w-full md:w-auto disabled:opacity-50"
                        >
                            Simpan Pengalaman
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </AdminLayout>
</template>