<script setup>
import { ref } from 'vue';
import { Link, usePage } from "@inertiajs/vue3";
// Tambahkan icon BsList (hamburger) dan BsX (close) untuk menu mobile
import { BsReverseLayoutTextWindowReverse, BsList, BsX } from "vue-icons-plus/bs";

const page = usePage();
const isMobileMenuOpen = ref(false); // State untuk mengatur menu mobile
</script>

<template>
    <header class="bg-[#FDF8F5] border-b-2 border-black  z-50 sticky top-0">
        <div class="flex items-center justify-between px-6 py-4">
            
            <div>
                <span class="text-xl font-extrabold tracking-wide">
                    MyPorto<span class="text-blue-500">.</span>
                </span>
            </div>

            <div class="hidden md:flex items-center gap-4">
                <Link
                    href="/projects"
                    class="px-5 py-2 rounded-full border-2 border-black font-semibold transition-all duration-200"
                    :class="
                        page.url.startsWith('/projects')
                            ? 'bg-[#FDE047] text-black shadow-[3px_3px_0px_rgba(0,0,0,1)] -translate-y-[2px]'
                            : 'bg-white text-black hover:shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-[2px]'
                    "
                >
                    <div class="flex items-center space-x-2">
                        <BsReverseLayoutTextWindowReverse class="w-4 h-4" />
                        <span>Projects</span>
                    </div>
                </Link>

                <Link
                    href="/achievements"
                    class="px-5 py-2 rounded-full border-2 border-black font-semibold transition-all duration-200"
                    :class="
                        page.url.startsWith('/achievements')
                            ? 'bg-[#FDE047] text-black shadow-[3px_3px_0px_rgba(0,0,0,1)] -translate-y-[2px]'
                            : 'bg-white text-black hover:shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-[2px]'
                    "
                >
                    <div class="flex items-center space-x-2">
                        <BsReverseLayoutTextWindowReverse class="w-4 h-4" />
                        <span>Achievements</span>
                    </div>
                </Link>
                <Link
                    href="/experiences"
                    class="px-5 py-2 rounded-full border-2 border-black font-semibold transition-all duration-200"
                    :class="
                        page.url.startsWith('/experiences')
                            ? 'bg-[#FDE047] text-black shadow-[3px_3px_0px_rgba(0,0,0,1)] -translate-y-[2px]'
                            : 'bg-white text-black hover:shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:-translate-y-[2px]'
                    "
                >
                    <div class="flex items-center space-x-2">
                        <BsReverseLayoutTextWindowReverse class="w-4 h-4" />
                        <span>Pengalaman</span>
                    </div>
                </Link>
            </div>

            <div class="flex items-center gap-3 md:gap-4">
                <button class="flex items-center justify-center w-10 h-10 rounded-full bg-[#E9D5FF] border-2 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] transition-all">
                    <i class="fas fa-bell text-black"></i>
                </button>
                
                <img
                    src="https://randomuser.me/api/portraits/men/75.jpg"
                    alt="Profile"
                    class="w-10 h-10 rounded-full border-2 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)] object-cover"
                />

                <button 
                    @click="isMobileMenuOpen = !isMobileMenuOpen"
                    class="md:hidden flex items-center justify-center w-10 h-10 bg-white rounded-lg border-2 border-black shadow-[3px_3px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-[3px] active:translate-y-[3px] transition-all"
                >
                    <BsX v-if="isMobileMenuOpen" class="w-6 h-6 text-black" />
                    <BsList v-else class="w-6 h-6 text-black" />
                </button>
            </div>
        </div>

        <div 
            v-show="isMobileMenuOpen" 
            class="md:hidden border-t-2 border-black bg-[#FDF8F5] px-6 py-4 space-y-4"
        >
            <Link
                href="/projects"
                class="flex w-full px-5 py-3 rounded-xl border-2 border-black font-semibold transition-all duration-200"
                :class="
                    page.url.startsWith('/projects')
                        ? 'bg-[#FDE047] text-black shadow-[3px_3px_0px_rgba(0,0,0,1)]'
                        : 'bg-white text-black'
                "
            >
                <div class="flex items-center space-x-2">
                    <BsReverseLayoutTextWindowReverse class="w-4 h-4" />
                    <span>Projects</span>
                </div>
            </Link>

            <Link
                href="/achievements"
                class="flex w-full px-5 py-3 rounded-xl border-2 border-black font-semibold transition-all duration-200"
                :class="
                    page.url.startsWith('/achievements')
                        ? 'bg-[#FDE047] text-black shadow-[3px_3px_0px_rgba(0,0,0,1)]'
                        : 'bg-white text-black'
                "
            >
                <div class="flex items-center space-x-2">
                    <BsReverseLayoutTextWindowReverse class="w-4 h-4" />
                    <span>Achievements</span>
                </div>
            </Link>
            <Link
                href="/experiences"
                class="flex w-full px-5 py-3 rounded-xl border-2 border-black font-semibold transition-all duration-200"
                :class="
                    page.url.startsWith('/experiences')
                        ? 'bg-[#FDE047] text-black shadow-[3px_3px_0px_rgba(0,0,0,1)]'
                        : 'bg-white text-black'
                "
            >
                <div class="flex items-center space-x-2">
                    <BsReverseLayoutTextWindowReverse class="w-4 h-4" />
                    <span>Experience</span>
                </div>
            </Link>
        </div>
    </header>
</template>