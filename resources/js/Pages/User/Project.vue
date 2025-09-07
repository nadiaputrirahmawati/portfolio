<script setup lang="ts">
import { LuGalleryVerticalEnd } from "vue-icons-plus/lu";
import { STACKS } from "@/constants/stack";
const allStacks = Object.keys(STACKS);

const allProject = [
    {
        name: "Ayo Donasi",
        image: "/project/ayo-donasi.png",
        stacks: ["Laravel", "Vue", "Tailwind", "PHP"],
    },
];
</script>

<template>
    <section
        class="px-4 md:px-16 lg:px-16 xl:px-44 mt-16 font-onest box-skill bg-hero"
    >
        <div class="p-10">
            <div class="flex space-x-4 px-6 mt-5">
                <LuGalleryVerticalEnd class="w-7 h-7" />
                <h1 class="text-2xl font-normal">Project</h1>
            </div>
            <p class="text-gray-500 text-xl px-6">My Project</p>

            <div
                class="mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mb-5"
            >
                <div
                    v-for="project in allProject"
                    :key="project.name"
                    class="relative flex w-80 flex-col rounded-xl bg-[#ffffff64] text-gray-700  backdrop-blur-md  shadow-lg shadow-blue-gray-500/40"
                >
                    <div
                        class="relative mx-4 -mt-6 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40 "
                    >
                        <img
                            :src="project.image"
                            :alt="project.name"
                            class="object-cover w-full h-48"
                        />
                    </div>
                    <div class="p-6">
                        <h5
                            class="mb-2 block text-xl font-normal leading-snug text-blue-gray-900"
                        >
                            {{ project.name }}
                        </h5>
                        <p
                            class="text-base font-light leading-relaxed text-inherit line-clamp-2"
                        >
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit. Nunc felis ligula.
                        </p>
                    </div>
                    <div class="p-6 pt-0 flex flex-wrap gap-2">
                        <template v-for="stack in project.stacks" :key="stack">
                            <component
                                v-if="STACKS[stack]"
                                :is="STACKS[stack].icon"
                                :class="STACKS[stack].color"
                                :title="stack"
                            />
                            <span v-else class="text-sm text-gray-400">{{
                                stack
                            }}</span>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
