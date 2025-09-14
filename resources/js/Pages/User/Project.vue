<script setup>
import { ref, onMounted, onUnmounted, computed } from "vue";
import { LuGalleryVerticalEnd, LuPin, LuArrowRight } from "vue-icons-plus/lu"; // tambahkan ikon pin

import { STACKS } from "@/constants/stack";
import useScrollReveal from "@/composables/useScrollReveal";

// Props
const props = defineProps({
    project: {
        type: Array,
        required: true,
    },
});

// State toggle
const showAll = ref(false);

// Ref untuk width
const screenWidth = ref(window.innerWidth);

// Update saat resize
const handleResize = () => {
    screenWidth.value = window.innerWidth;
};

onMounted(() => {
    window.addEventListener("resize", handleResize);
});

onUnmounted(() => {
    window.removeEventListener("resize", handleResize);
});

// Hitung slice berdasarkan breakpoint
const projectLimit = computed(() => {
    if (screenWidth.value >= 1280) return 4; // xl
    if (screenWidth.value >= 1024) return 3; // lg
    return 2; // sm - md
});

// Scroll animation
const { element, isVisible, animation } = useScrollReveal(
    "animate__fadeInUp",
    0.8
);
</script>

<template>
    <section
        class="px-0 md:px-16 lg:px-16 xl:px-44 mt-16 font-onest box-skill bg-hero"
    >
        <div class="p-10">
            <div class="flex space-x-4 px-6 mt-5">
                <LuGalleryVerticalEnd class="w-7 h-7" />
                <h1 class="text-2xl font-normal">Project</h1>
            </div>
            <p class="text-gray-500 text-xl px-6">My Project</p>

            <!-- Grid -->
            <div
                class="mt-7 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-5"
                ref="element"
                :class="[
                    'transition-opacity duration-700',
                    isVisible
                        ? `animate__animated ${animation} opacity-100`
                        : 'opacity-0',
                ]"
            >
                <div
                    v-for="data in showAll
                        ? props.project
                        : props.project.slice(0, projectLimit)"
                    :key="data.projects_id"
                    class="relative flex flex-col mt-10 rounded-xl bg-[#ffffff64] text-gray-700 backdrop-blur-md shadow-lg shadow-blue-gray-500/40"
                >

                    <!-- Gambar -->
                    <div
                        class="relative mx-4 -mt-6 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40 group"
                    >
                        <img
                            :src="data.image"
                            :alt="data.title"
                            class="object-cover w-full h-48 transition-transform duration-500 group-hover:scale-110"
                        />

                        <!-- Badge Pin -->
                        <div
                            v-if="data.pinned"
                            class="absolute top-2 left-2 flex items-center gap-1 bg-green-600 text-white text-xs tracking-wide font-medium px-3 py-1 rounded-md shadow"
                        >
                            <LuPin class="w-4 h-4" />
                            <span>Pinned</span>
                        </div>

                        <!-- Overlay Detail (muncul saat hover) -->
                        <div
                            class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-center items-center text-center p-4"
                        >
                            <a
                                :href="`/project/${data.slug}`"
                                class="mt-3 px-4 py-2  text-white text-sm rounded-lg shadow transition"
                            >
                            <div class="flex items-center space-x-2">
                              <span>View Detail</span>
                              <LuArrowRight class="w-4 h-4"/> 
                            </div>
                            </a>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="p-6">
                        <h5
                            class="mb-2 block text-lg font-normal leading-snug text-blue-gray-900"
                        >
                            {{ data.title }}
                        </h5>
                        <div
                            v-html="data.description"
                            class="line-clamp-1 text-sm font-light text-gray-500"
                        ></div>
                    </div>

                    <!-- Skill -->
                    <div class="p-6 pt-0 flex flex-wrap gap-2">
                        <template v-for="stack in data.skill" :key="stack">
                            <component
                                v-if="STACKS[stack]"
                                :is="STACKS[stack].icon"
                                :class="STACKS[stack].color + ' w-6 h-6'"
                                :title="stack"
                            />
                            <span v-else class="text-sm text-gray-400">
                                {{ stack }}
                            </span>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Tombol Lihat Semua -->
            <div
                v-if="props.project.length > projectLimit"
                class="text-center mt-6"
            >
                <button
                    @click="showAll = !showAll"
                    class="px-8 py-2 bg-green-light text-white rounded-full shadow hover:bg-green transition"
                >
                    {{ showAll ? "Tampilkan Lebih Sedikit" : "Lihat Semua" }}
                </button>
            </div>
        </div>
    </section>
</template>
