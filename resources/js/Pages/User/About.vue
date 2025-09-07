<script setup>
import {
    LuGalleryVerticalEnd,
    LuArrowUpRight,
    LuInstagram,
    LuLinkedin,
} from "vue-icons-plus/lu";
import Image from "primevue/image";
import { LiaEnvelopeSolid, LiaGithub } from "vue-icons-plus/lia";
import { Fa6RegAddressBook } from "vue-icons-plus/fa6";
import { STACKS } from "@/constants/stack";
const allStacks = Object.keys(STACKS);
</script>

<template>
    <section
        id="about"
        class="px-4 md:px-16 lg:px-16 xl:px-44 mt-16 font-onest"
    >
        <div class="flex justify-center mb-16">
            <h1
                class="text-xl md:text-4xl xl:text-5xl uppercase font-light text-gray-800 font-playfair text-center"
            >
                NADIA PUTRI RAHMAWATI
            </h1>
        </div>

        <div class="flex flex-col md:flex-row gap-4">
            <!-- Left: Foto & sapaan -->
            <div class="lg:w-4/12 xl:4/12 md:4/12 sm:w-full">
                <div class="flex justify-center">
                    <img
                        src="/image/2.png"
                        alt="Profile"
                        class="w-64 h-64 md:w-40 md:h-40 xl:w-[15rem] xl:h-[15rem] object-cover"
                    />
                </div>
                <div
                    class="bg-green-light text-white rounded-2xl text-center p-3 box"
                >
                    <p class="font-semibold tracking-wider">About Me</p>
                    <p class="tracking-wide text-sm">
                        “ My journey as a web developer keeps growing. ”
                    </p>
                </div>

                <div class="bg-yellow rounded-xl p-4 mt-3 stamp">
                    <h3 class="font-bold text-green">Education</h3>
                    <p>Universitas Muhammadiyah Sukabumi</p>
                    <p class="text-sm text-gray-600">
                        Teknik Informatika (2022–2025)
                    </p>
                    <h3 class="mt-4 font-bold">Country</h3>
                    <p>Indonesia</p>
                </div>
            </div>

            <!-- Right: Featured Work -->
            <div class="md:col-span-2 rounded-3xl lg:w-8/12 xl:w-8/12 h-full">
                <!-- Header -->
                <div class="flex">
                    <div
                        class="bg-yellow rounded-t-3xl px-4 py-2 md:w-96 lg:w-96 xl:w-96 rounded-tab"
                    >
                        <h2
                            class="font-semibold tracking-wide text-lg py-1 px-6 text-green"
                        >
                            Featured Work
                        </h2>
                    </div>
                    <div class="mt-3">
                        <a
                            href="#projects"
                            class="flex items-center text-lg font-semibold text-green hover:text-green-800 transition"
                        >
                            View Projects
                            <span
                                class="ml-1 inline-flex items-center justify-center w-5 h-5 rounded-full bg-white text-green text-xs"
                            >
                                <LuArrowUpRight />
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Content -->
                <div
                    class="bg-yellow p-7 rounded-tr-3xl rounded-b-3xl shadow-lg"
                >
                    <div
                        class="flex flex-col md:flex-row space-x-0 lg:space-x-5 mb-6"
                    >
                        <div
                            class="lg:w-4/12 bg-white flex justify-center rounded-3xl box-circle"
                        >
                            <div
                                class="relative flex items-center space-x-[-70px] mb-4"
                            >
                                <!-- Gambar 1 -->
                                <div
                                    class="overflow-hidden relative -top-5 left-4 shadow-lg"
                                >
                                    <!-- <Image src="/project/ai.png" alt="Image" class="w-72 transform rotate-[0deg] transition-transform duration-500 hover:scale-110" preview /> -->
                                    <img
                                        src="/project/sertificat.jpeg"
                                        alt="Project 1"
                                        class="w-72 h-16 object-cover transform rotate-[0deg] transition-transform duration-500 hover:scale-110"
                                    />
                                </div>

                                <!-- Gambar 2 (tengah, paling depan) -->
                                <div
                                    class="overflow-hidden shadow-lg relative z-10 -bottom-10"
                                >
                                    <img
                                        src="/project/image.png"
                                        alt="Project 2"
                                        class="w-72 transform h-16 object-cover rotate-[0deg] transition-transform duration-500 hover:scale-110"
                                    />
                                </div>

                                <!-- Gambar 3 -->
                                <div
                                    class="overflow-hidden relative -left-3 -bottom-3 shadow-lg lg:mb-0 mb-5"
                                >
                                    <img
                                        src="/project/sertif1.png"
                                        alt="Project 3"
                                        class="w-72 transform h-16 object-cover rotate-[0deg] transition-transform duration-500 hover:scale-110"
                                    />
                                </div>
                            </div>
                        </div>
                        <!-- Bagian Skills -->
                        <div
                            class="bg-green-light rounded-3xl p-6 lg:w-8/12 lg:mt-0 mt-5"
                        >
                            <!-- Baris 1 -->
                            <div class="relative w-full overflow-hidden mb-4">
                                <div class="flex space-x-6 animate-marquee">
                                    <div
                                        v-for="(allStacks, index) in [
                                            ...allStacks,
                                            ...allStacks,
                                        ]"
                                        :key="'row1-' + index"
                                        class="bg-white shadow-md px-4 py-2 rounded-full flex items-center space-x-2 whitespace-nowrap"
                                    >
                                        <component
                                            v-if="STACKS[allStacks]"
                                            :is="STACKS[allStacks].icon"
                                            :class="STACKS[allStacks].color"
                                            :title="allStacks"
                                        />
                                        <span  class="text-sm font-medium" > {{ allStacks }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Baris 2 -->
                            <div class="relative w-full overflow-hidden">
                                <div
                                    class="flex space-x-6 animate-marquee-reverse"
                                >
                                    <div
                                        v-for="(allStacks, index) in [
                                            ...allStacks,
                                            ...allStacks,
                                        ]"
                                        :key="'row2-' + index"
                                        class="bg-white shadow-md px-4 py-2 rounded-full flex items-center space-x-2 whitespace-nowrap"
                                    >
                                        <component
                                            v-if="STACKS[allStacks]"
                                            :is="STACKS[allStacks].icon"
                                            :class="STACKS[allStacks].color"
                                            :title="allStacks"
                                        />
                                        <span  class="text-sm font-medium" > {{ allStacks }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian Projects -->
                    <div
                        class="flex flex-col md:flex-row space-x-0 lg:space-x-5"
                    >
                        <div
                            class="bg-green-light rounded-3xl overflow-hidden p-4 flex lg:w-8/12 w-full"
                        >
                            <div class="flex space-x-5">
                                <div class="w-6/12">
                                    <div
                                        class="bg-green-light-transparan rounded-md w-10 h-10 flex justify-center items-center px-2"
                                    >
                                        <LuGalleryVerticalEnd
                                            class="text-[#ebe5c2] text-xl"
                                        />
                                    </div>
                                    <h1
                                        class="text-left text-white tracking-wide font-semibold mt-3 text-md xl:text-xl"
                                    >
                                        My Newest Project
                                    </h1>
                                    <p
                                        class="text-white text-xs xl:text-sm font-light"
                                    >
                                        Just getting started <br />
                                        real projects, <br />
                                        real impact.
                                    </p>
                                </div>
                                <div
                                    class="h-40 overflow-y-auto scrollbar-hide space-y-4 w-6/12"
                                >
                                    <!-- Gambar 1 -->
                                    <img
                                        src="/project/ayo-donasi.png"
                                        alt="Project 1"
                                        class="rounded-xl shadow-md"
                                    />

                                    <!-- Gambar 2 -->
                                    <img
                                        src="/project/ai.png"
                                        alt="Project 2"
                                        class="rounded-xl shadow-md"
                                    />

                                    <!-- Bisa tambah lagi gambar -->
                                    <img
                                        src="/project/pkl.png"
                                        alt="Project 3"
                                        class="rounded-xl shadow-md"
                                    />
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-white rounded-3xl lg:w-5/12 lg:mt-0 mt-6 overflow-hidden corner-only"
                        >
                            <div
                                class="p-1 sm:mt-1 md:mt-1 lg:mt-1 xl:mt-3 mt-1"
                            >
                                <div class="flex space-x-2 mb-2 mt-2">
                                    <div>
                                        <Fa6RegAddressBook
                                            class="text-green-light text-xl"
                                        />
                                    </div>
                                    <div>
                                        <h1
                                            class="text-left text-green-light tracking-wide font-semibold text-md xl:text-xl"
                                        >
                                            My Contact
                                        </h1>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div
                                        class="py-1 px-1 bg-gradient-to-b from-[#8c27c8] via-[#df439f] to-[#f76b31] justify-center rounded-lg flex space-x-3 mt-1"
                                    >
                                        <div
                                            class="flex flex-row items-center space-x-2"
                                        >
                                            <div class="w-6/12">
                                                <h1
                                                    class="text-red-200 font-light text-[10px]"
                                                >
                                                    Instagram
                                                </h1>
                                            </div>
                                            <div
                                                class="w-6/12 rounded-md px-1 py-1 border-2 border-red-200 flex items-center justify-center backdrop-blur-xl bg-[#ebe5c220]"
                                            >
                                                <LuInstagram
                                                    class="text-white"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="py-1 px-1 bg-gradient-to-b from-[#106da1] to-[#056398] rounded-lg flex justify-center space-x-3 mt-1"
                                    >
                                        <div
                                            class="flex flex-row items-center space-x-2"
                                        >
                                            <div class="w-8/12">
                                                <h1
                                                    class="text-[#bfe8fb] font-light lg:text-[11px] xl:text-md"
                                                >
                                                    Linkedin
                                                </h1>
                                            </div>
                                            <div
                                                class="w-6/12 rounded-md px-1 py-1 border-2 border-[#6dc1e9] flex items-center justify-center backdrop-blur-xl bg-[#ebe5c220]"
                                            >
                                                <LuLinkedin
                                                    class="text-white"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-1">
                                    <div
                                        class="py-1 px-1 bg-gradient-to-b from-[#0c1326] to-[#464e64] rounded-lg flex space-x-3 mt-1 justify-center lg:justify-end xl:justify-center"
                                    >
                                        <div
                                            class="flex flex-row items-center space-x-2"
                                        >
                                            <div class="w-8/12">
                                                <h1
                                                    class="text-gray-200 font-light text-xs"
                                                >
                                                    Github
                                                </h1>
                                            </div>
                                            <div
                                                class="w-6/12 rounded-md px-1 py-1 border-2 border-gray-200 flex items-center justify-center backdrop-blur-xl bg-[#ebe5c220]"
                                            >
                                                <LiaGithub class="text-white" />
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="py-1 px-1 bg-gradient-to-b from-red-800 to-red-600 rounded-lg flex space-x-3 mt-1 justify-center lg:justify-end xl:justify-center"
                                    >
                                        <div
                                            class="flex flex-row items-center space-x-2"
                                        >
                                            <div class="w-8/12">
                                                <h1
                                                    class="text-red-200 font-light text-xs"
                                                >
                                                    Email
                                                </h1>
                                            </div>
                                            <div
                                                class="w-6/12 rounded-md px-1 py-1 border-2 border-red-300 flex items-center justify-center backdrop-blur-xl bg-[#ebe5c220]"
                                            >
                                                <LiaEnvelopeSolid
                                                    class="text-white"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

