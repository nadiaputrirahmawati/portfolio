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
    <div class="bg-hero min-h-screen w-full">
        <div
            v-if="project"
            class="lg:p-4 p-4 flex flex-col justify-center items-center"
        >
            <div class="lg:w-9/12 w-full mt-5">
                <div class="mb-3">
                    <a href="/" class="flex space-x-2"
                        ><LuArrowLeftCircle class="w-6 h-6" />
                        <span class="">Back</span>
                    </a>
                </div>
                <div
                    class="bg-[#ffffff67] text-gray-700 p-8 rounded-3xl shadow-xl"
                >
                    <h1 class="font-semibold tracking-wide text-xl">
                        {{ project.title }}
                    </h1>
                    <div
                        class="border border-dashed border-gray-400 mt-3"
                    ></div>
                    <div
                        class="mt-4 flex lg:flex-row flex-col lg:space-x-2 space-x-0 justify-between"
                    >
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
                        <div
                            class="flex flex-wrap space-x-3 lg:mt-0 mt-5 lg:justify-between justify-center"
                        >
                            <div v-if="project.code && project.code !== '#'">
                                <div>
                                    <a
                                        :href="project.code"
                                        class="flex space-x-2"
                                        ><SiGithub class="w-6 h-6" />
                                        <span class="text-yellow-800"
                                            >Source Code</span
                                        >
                                    </a>
                                </div>
                            </div>
                            <span
                                class="pl-1 pr-1"
                                v-if="project.link && project.link !== '#'"
                                >|</span
                            >
                            <div v-if="project.link && project.link !== '#'">
                                <div>
                                    <a
                                        :href="project.link"
                                        class="flex space-x-2"
                                        ><Fa6ArrowUpRightFromSquare
                                            class="w-5 h-5"
                                        />
                                        <span class="text-yellow-800"
                                            >Live Demo</span
                                        >
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:mt-7 mt-4 flex justify-center">
                        <img
                            :src="`/${project.image}`"
                            alt="Project Image"
                            class="lg:w-7/12 w-full rounded-xl shadow object-cover"
                        />
                    </div>
                    <div
                        v-html="project.description"
                        class="prose prose-neutral mt-5 max-w-none"
                    ></div>
                </div>
            </div>
        </div>
    </div>

    <!-- </NavbarUser> -->
</template>
