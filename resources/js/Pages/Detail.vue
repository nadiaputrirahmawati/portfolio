<script setup>
const { project } = defineProps({
    project: Object,
});

console.log(project);

// import NavbarUser from "@/Assets/NavbarUser.vue";
import { STACKS } from "@/constants/stack";
import { LuArrowLeftCircle } from "vue-icons-plus/lu";
import { SiGithub } from "vue-icons-plus/si";
import { Fa6ArrowUpRightFromSquare } from "vue-icons-plus/fa6";
</script>

<template>
    <!-- <NavbarUser> -->
    <div v-if="project" class="p-4 flex flex-col justify-center items-center bg-hero">
        <div class="w-9/12 mt-5">
            <div class="mb-3">
                <a href="/" class="flex space-x-2"
                    ><LuArrowLeftCircle class="w-6 h-6" />
                    <span class="">Back</span>
                </a>
            </div>
            <div class="bg-[#ffffff31] text-gray-700  p-8 rounded-3xl shadow-xl">
                <h1 class="font-semibold tracking-wide">{{ project.title }}</h1>
                <div class="border border-dashed border-gray-400 mt-3"></div>
                <div class="mt-4 flex space-x-2 justify-between">
                    <div class="flex flex-wrap space-x-2">
                        <h1>Teach Stack :</h1>
                        <span
                            v-for="(stack, i) in project.skill"
                            :key="i"
                            class="flex items-center gap-1 text-sm font-medium"
                        >
                            <template v-if="STACKS[stack]">
                                <component
                                    :is="STACKS[stack].icon"
                                    :class="STACKS[stack].color"
                                />
                            </template>
                            <template v-else>
                                {{ stack }}
                            </template>
                        </span>
                    </div>
                    <div class="flex flex-wrap space-x-3">
                        <div>
                            <a href="" class="flex space-x-2"
                                ><SiGithub class="w-6 h-6" />
                                <span class="text-yellow-800">Source Code</span>
                            </a>
                        </div>
                        <span class="pl-1 pr-1">|</span>
                        <div>
                            <a href="" class="flex space-x-2"
                                ><Fa6ArrowUpRightFromSquare class="w-5 h-5" />
                                <span class="text-yellow-800">Live Demo</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-7 flex justify-center">
                    <img
                        :src="`/${project.image}`"
                        alt="Project Image"
                        class="w-7/12 rounded-xl shadow object-cover"
                    />
                </div>
                <div
                    v-html="project.description"
                    class="prose prose-neutral mt-5 max-w-none"
                ></div>
            </div>
        </div>
    </div>
    <!-- </NavbarUser> -->
</template>
