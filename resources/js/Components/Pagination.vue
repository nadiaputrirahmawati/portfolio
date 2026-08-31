<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    links: Array,
});
</script>

<template>
    <div v-if="links.length > 3" class="flex flex-wrap items-center justify-center gap-2 mt-8">
        <template v-for="(link, k) in links" :key="k">
            <!-- Jika link tidak aktif (misal tombol 'Previous' di halaman 1) -->
            <div
                v-if="link.url === null"
                class="px-4 py-2 border-2 border-gray-300 rounded-xl bg-gray-100 text-gray-400 font-bold text-sm cursor-not-allowed shadow-[2px_2px_0px_rgba(0,0,0,0.05)]"
                v-html="link.label"
            ></div>

            <!-- Jika link aktif dan bisa diklik -->
            <Link
                v-else
                :href="link.url"
                class="px-4 py-2 border-2 border-black rounded-xl font-bold text-sm transition-all shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px]"
                :class="
                    link.active
                        ? 'bg-[#FDE047] text-black' // Warna kuning saat halaman sedang aktif
                        : 'bg-white text-black hover:bg-gray-50'
                "
                v-html="link.label"
            />
        </template>
    </div>
</template>