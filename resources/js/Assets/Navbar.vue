<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { AiOutlineHome } from "vue-icons-plus/ai";
import { BsReverseLayoutTextWindowReverse } from "vue-icons-plus/bs";

const page = usePage();
</script>

<template>
    <header class="flex items-center justify-between px-6 py-4">
        <!-- Left -->
        <div></div>

        <!-- Center: Navigation -->
        <div class="flex items-center gap-6">
            <!-- Dashboard -->
            <Link
                href="/dashboard"
                class="px-6 py-2 rounded-full font-medium"
                :class="
                    page.url.startsWith('/dashboard')
                        ? 'bg-black text-white'
                        : 'bg-slate-300 text-black'
                "
            >
                <div class="flex items-center space-x-2">
                    <AiOutlineHome class="w-5 h-5" />
                    <span class="text-md">Home</span>
                </div>
            </Link>

            <!-- Projects -->
            <Link
                href="/projects"
                class="px-6 py-2 rounded-full font-medium"
                :class="
                    page.url.startsWith('/projects')
                        ? 'bg-black text-white'
                        : 'bg-slate-300 text-black'
                "
            >
                <div class="flex items-center space-x-2">
                    <BsReverseLayoutTextWindowReverse class="w-4 h-4" />
                    <span class="text-md">Projects</span>
                </div>
            </Link>
            <Link
                href="/achievements"
                class="px-6 py-2 rounded-full font-medium"
                :class="
                    page.url.startsWith('/achievements')
                        ? 'bg-black text-white'
                        : 'bg-slate-300 text-black'
                "
            >
                <div class="flex items-center space-x-2">
                    <BsReverseLayoutTextWindowReverse class="w-4 h-4" />
                    <span class="text-md">Achievements</span>
                </div>
            </Link>
            <!-- Messege -->
            <Link
                href="/messege"
                class="px-6 py-2 rounded-full font-medium"
                :class="
                    page.url.startsWith('/messege')
                        ? 'bg-black text-white'
                        : 'bg-slate-300 text-black'
                "
            >
                <div class="flex items-center space-x-2">
                    <AiOutlineHome class="w-5 h-5" />
                    <span class="text-md">Messege</span>
                </div>
            </Link>
        </div>

        <!-- Right: Notification & Profile -->
        <div class="flex items-center gap-4">
            <button class="p-2 rounded-full hover:bg-gray-100">
                <i class="fas fa-bell"></i>
            </button>
            <img
                src="https://randomuser.me/api/portraits/men/75.jpg"
                alt="Profile"
                class="w-10 h-10 rounded-full"
            />
        </div>
    </header>
</template>
