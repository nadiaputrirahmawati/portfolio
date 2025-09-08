<script setup lang="ts">
import { LiaCss3, LiaHtml5, LiaLaravel, LiaReact } from "vue-icons-plus/lia";
import { Fa6Code } from "vue-icons-plus/fa6";
import { Code2 } from "lucide-vue-next";
import { STACKS } from "@/constants/stack";

const allStacks = Object.keys(STACKS);
</script>

<template>
    <section
        class="px-3 md:px-16 lg:px-16 xl:px-44 mt-16 font-onest box-skill bg-hero"
    >
        <div class="p-10">
            <div class="flex space-x-4 px-6 mt-5">
                <Code2 class="w-7 h-7" />
                <h1 class="text-2xl font-normal">Skills</h1>
            </div>
            <div>
                <p class="text-gray-500 text-xl px-6">
                    My professional skills.
                </p>
            </div>
            <div class="grid lg:grid-cols-11 md:grid-cols-6   grid-cols-3 p-4 justify-start mt-4 gap-2 ">
                <div v-for="stack in allStacks" :key="stack" class="relative group mt-4">
                    <!-- Bayangan belakang -->
                    <div
                        :class="STACKS[stack].bg" class="absolute inset-0 bg-blue-500 rounded-[42%] translate-x-1 w-16 h-16 -translate-y-1 transition-transform duration-300 group-hover:translate-x-3 group-hover:-translate-y-3"
                    ></div>

                    <!-- Lingkaran utama -->
                    <div
                        class="relative z-10 flex items-center justify-center w-16 h-16 rounded-[42%] border-2 border-gray-200 backdrop-blur-xl bg-[#ebe5c220] text-white font-bold shadow-lg "
                    >
                        <component :is="STACKS[stack].icon" class="text-white"/>
                    </div>
                    <div
                        class="text-md text-green font-bold opacity-0 translate-y-2  transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0 group-hover:mt-3 "
                    >
                       {{ stack }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
