<script setup>
import {
    LuGalleryVerticalEnd,
    LuArrowUpRight,
    LuInstagram,
    LuLinkedin,
    LuContact2,
} from "vue-icons-plus/lu";
import { LiaEnvelopeSolid, LiaGithub } from "vue-icons-plus/lia";
import { SiLinkedin } from "vue-icons-plus/si";
import useScrollReveal from "@/composables/useScrollReveal";

const {
    element: element1,
    isVisible: visible1,
    animation: animation1,
} = useScrollReveal("animate__lightSpeedInLeft", 0.8);
const {
    element: element2,
    isVisible: visible2,
    animation: animation2,
} = useScrollReveal("animate__flipInX", 0.10);
</script>

<template>
    <section class="px-5 md:px-1 lg:px-16 xl:px-32 mt-16 font-onest mb-10">
        <div class="flex space-x-4 px-6 mt-5">
            <LuContact2 class="w-7 h-7" />
            <h1 class="text-2xl font-normal">Contact</h1>
        </div>
        <p class="text-gray-500 text-xl px-6">Let`s get in touch</p>
        <div class="flex flex-col lg:flex-row gap-4 mt-5">
            <div
                class="w-full lg:3/12 bg-hero shadow-lg shadow-gray-300 shadow-opacity-20 lg:wavy-box xl:wavy-box"
                ref="element1"
                :class="[
                    'transition-opacity duration-700',
                    visible1
                        ? `animate__animated ${animation1} opacity-100`
                        : 'opacity-0',
                ]"
            >
                <h1 class="text-center text-xl p-4">Send Me A Message</h1>
                <div class="p-4">
                    <form action="" method="post">
                        <input
                            type="text"
                            class="w-full mb-3 bg-transparent border-b-2 border-green-light"
                            placeholder="Name"
                        />
                        <input
                            type="text"
                            class="w-full mb-3 bg-transparent border-b-2 border-green-light"
                            placeholder="Email"
                        />
                        <textarea
                            class="w-full bg-transparent border-b-2 border-green-light"
                            placeholder="Message"
                        ></textarea>
                        <div class="flex justify-center">
                            <button
                                class="py-2 px-8 mt-3 rounded-full bg-green-light text-white"
                            >
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-full lg:9/12">
                <h1 class="text-center text-2xl p-4">Contact Person</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div
                        class="relative rounded-2xl w-full sm:w-96 md:w-full lg:w-full x:w-full px-5 py-3 h-36 bg-gradient-to-b from-purple-500 via-pink-500 to-orange-400 shadow-lg overflow-hidden"
                        ref="element2"
                        :class="[
                            'transition-opacity duration-700',
                            visible2
                                ? `animate__animated ${animation2} opacity-100`
                                : 'opacity-0',
                        ]"
                    >
                        <!-- Bagian Teks -->
                        <div
                            class="relative z-10 flex flex-row space-y-2 xl:mt-4 mt-0 text-white w-11/12"
                        >
                            <div>
                                <h2 class="text-md font-semibold">
                                    Explore My Feed
                                </h2>
                                <p class="text-sm opacity-90 mb-3">
                                    Discover my visual journey.
                                </p>
                                <a
                                    href="https://instagram.com/yourusername"
                                    target="_blank"
                                    class="inline-flex items-center text-sm bg-white xl:mt-2 mt-0 text-black font-medium px-2 py-2 rounded-lg shadow hover:bg-gray-100 transition w-max"
                                >
                                    Go to Instagram
                                    <span class="ml-2">↗</span>
                                </a>
                            </div>
                            <div
                                class="w-3/12 relative sm:-left-52 sm:-bottom-2 md:left-32 md:-bottom-2 lg:left-6 lg:-bottom-14 left-16 -bottom-10 xl:left-44 xl:-bottom-10"
                            >
                                <h1>
                                    <LuInstagram class="text-white w-14 h-14" />
                                </h1>
                            </div>
                        </div>

                        <!-- Watermark IG di bawah -->
                        <div
                            class="bottom-48 -left-36 relative inset-x-5 w-64 h-8 flex justify-center opacity-20"
                        >
                            <LuInstagram
                                class="text-white w-96 h-80 rotate-[28deg]"
                            />
                        </div>
                    </div>
                    <div
                        class="relative rounded-2xl w-full sm:w-96 md:w-full lg:w-full x:w-full px-5 py-3 h-36 bg-gradient-to-r from-[#106da1] via-[#056398] to-[#056398] shadow-lg overflow-hidden"
                        ref="element2"
                        :class="[
                            'transition-opacity duration-700',
                            visible2
                                ? `animate__animated ${animation2} opacity-100`
                                : 'opacity-0',
                        ]"
                    >
                        <!-- Bagian Teks -->
                        <div
                            class="relative z-10 flex flex-row space-y-2 xl:mt-4 mt-0 text-white w-11/12"
                        >
                            <div>
                                <h2 class="text-md font-semibold">
                                    Let's Connect
                                </h2>
                                <p class="text-sm opacity-90 mb-3">
                                    Connect with my career path.
                                </p>
                                <a
                                    href="https://instagram.com/yourusername"
                                    target="_blank"
                                    class="inline-flex items-center text-sm bg-cyan-200 text-black font-medium px-2 py-2 rounded-lg shadow hover:bg-gray-100 transition w-max"
                                >
                                    Go to Linkedin
                                    <span class="ml-2">↗</span>
                                </a>
                            </div>
                            <div
                                class="w-3/12 relative sm:-left-52 sm:-bottom-2 md:left-32 md:-bottom-10 lg:left-6 lg:-bottom-14 left-12 -bottom-10 xl:left-40 xl:-bottom-8"
                            >
                                <h1>
                                    <SiLinkedin class="text-white w-14 h-14" />
                                </h1>
                            </div>
                        </div>

                        <!-- Watermark IG di bawah -->
                        <div
                            class="bottom-48 -left-36 relative inset-x-5 w-64 h-8 flex justify-center opacity-20"
                        >
                            <SiLinkedin
                                class="rotate-[28deg] text-white w-96 h-80"
                            />
                        </div>
                    </div>
                    <div
                        class="relative rounded-2xl px-5 py-3 h-36 w-full sm:w-96 md:w-full lg:w-full x:w-full bg-gradient-to-b from-[#0c1326] to-[#464e64] shadow-lg overflow-hidden"
                        ref="element2"
                        :class="[
                            'transition-opacity duration-700',
                            visible2
                                ? `animate__animated ${animation2} opacity-100`
                                : 'opacity-0',
                        ]"
                    >
                        <!-- Bagian Teks -->
                        <div
                            class="relative z-10 flex flex-row space-y-2 xl:mt-4 mt-0 text-white w-11/12"
                        >
                            <div>
                                <h2 class="text-md font-semibold">
                                    Explore My Code
                                </h2>
                                <p class="text-sm opacity-90 mb-3">
                                    Explore my coding projects.
                                </p>
                                <a
                                    href="https://instagram.com/yourusername"
                                    target="_blank"
                                    class="inline-flex items-center text-sm bg-white xl:mt-2 mt-0 text-black font-medium px-2 py-2 rounded-lg shadow hover:bg-gray-100 transition w-max"
                                >
                                    Go to Github
                                    <span class="ml-2">↗</span>
                                </a>
                            </div>
                            <div
                                class="w-3/12 relative sm:-left-52 sm:-bottom-2 md:left-28 md:-bottom-2 lg:left-6 lg:-bottom-14 left-16 -bottom-10 xl:left-44 xl:-bottom-10"
                            >
                                <h1>
                                    <LiaGithub class="text-white w-14 h-14" />
                                </h1>
                            </div>
                        </div>

                        <!-- Watermark IG di bawah -->
                        <div
                            class="bottom-48 -left-36 relative inset-x-5 w-64 h-8 flex justify-center opacity-20"
                        >
                            <LiaGithub
                                class="text-white w-96 h-80 rotate-[28deg]"
                            />
                        </div>
                    </div>
                    <div
                        class="relative rounded-2xl w-full sm:w-96 md:w-full lg:w-full x:w-full px-5 py-3 h-36 bg-gradient-to-b from-red-800 to-red-600 shadow-lg overflow-hidden"
                        ref="element2"
                        :class="[
                            'transition-opacity duration-700',
                            visible2
                                ? `animate__animated ${animation2} opacity-100`
                                : 'opacity-0',
                        ]"
                    >
                        <!-- Bagian Teks -->
                        <div
                            class="relative z-10 flex flex-row space-y-2 xl:mt-4 mt-0 text-white w-11/12"
                        >
                            <div>
                                <h2 class="text-md font-semibold">
                                    Let’s Talk Soon
                                </h2>
                                <p class="text-sm opacity-90 mb-3">
                                    Drop me a quick message.
                                </p>
                                <a
                                    href="https://instagram.com/yourusername"
                                    target="_blank"
                                    class="inline-flex items-center text-sm bg-red-200 text-black font-medium px-2 py-2 rounded-lg shadow hover:bg-gray-100 transition w-max"
                                >
                                    Go to Email
                                    <span class="ml-2">↗</span>
                                </a>
                            </div>
                            <div
                                class="w-3/12 relative sm:-left-52 sm:-bottom-2 md:left-32 md:-bottom-2 lg:left-6 lg:-bottom-14 left-16 -bottom-10 xl:left-44 xl:-bottom-10"
                            >
                                <h1>
                                    <LiaEnvelopeSolid
                                        class="text-white w-14 h-14"
                                    />
                                </h1>
                            </div>
                        </div>

                        <!-- Watermark IG di bawah -->
                        <div
                            class="bottom-48 -left-36 relative inset-x-5 w-64 h-8 flex justify-center opacity-20"
                        >
                            <LiaEnvelopeSolid
                                class="rotate-[28deg] text-white w-96 h-80"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
