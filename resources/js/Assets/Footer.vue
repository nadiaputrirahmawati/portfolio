<script setup>
import { ref } from "vue";

import {
    LuGalleryVerticalEnd,
    LuArrowUpRight,
    LuInstagram,
    LuLinkedin,  LuContact2
} from "vue-icons-plus/lu";
import { LiaEnvelopeSolid, LiaGithub,  } from "vue-icons-plus/lia";

const activeSection = ref("home");

const scrollTo = (id) => {
  const section = document.getElementById(id);
  if (section) {
    section.scrollIntoView({ behavior: "smooth" });
    activeSection.value = id;
  }
};
</script>

<template>
  <footer class="bg-hero border-t border-gray-200 mt-20 footer-box">
    <div
      class="max-w-7xl mx-auto px-6 lg:px-16 py-10 grid grid-cols-1 md:grid-cols-3 gap-10 mt-4"
    >
      <!-- Brand -->
      <div>
        <h2 class="text-2xl font-bold text-green-light">Story Nad</h2>
        <p class="mt-3 text-gray-600 text-sm leading-relaxed">
          A personal portfolio & story hub where creativity meets experience.
        </p>
      </div>

      <!-- Navigation -->
      <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Navigation</h3>
        <ul class="space-y-2 text-gray-600">
          <li>
            <button
              @click="scrollTo('home')"
              :class="[
                'transition',
                activeSection === 'home'
                  ? 'text-green-light font-semibold'
                  : 'hover:text-green-light'
              ]"
            >
              Home
            </button>
          </li>
          <li>
            <button
              @click="scrollTo('about')"
              :class="[
                'transition',
                activeSection === 'about'
                  ? 'text-green-light font-semibold'
                  : 'hover:text-green-light'
              ]"
            >
              About
            </button>
          </li>
          <li>
            <button
              @click="scrollTo('projects')"
              :class="[
                'transition',
                activeSection === 'projects'
                  ? 'text-green-light font-semibold'
                  : 'hover:text-green-light'
              ]"
            >
              Projects
            </button>
          </li>
          <li>
            <button
              @click="scrollTo('contact')"
              :class="[
                'transition',
                activeSection === 'contact'
                  ? 'text-green-light font-semibold'
                  : 'hover:text-green-light'
              ]"
            >
              Contact
            </button>
          </li>
        </ul>
      </div>

      <!-- Socials -->
      <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Follow Me</h3>
        <div class="flex space-x-5">
          <a
            href="#"
            target="_blank"
            class="w-10 h-10 flex items-center justify-center rounded-full bg-green-light text-white hover:scale-110 transition"
          >
            <LuInstagram class="text-xl" />
          </a>
          <a
            href="#"
            target="_blank"
            class="w-10 h-10 flex items-center justify-center rounded-full bg-green-light text-white hover:scale-110 transition"
          >
            <LuLinkedin class="text-xl" />
          </a>
          <a
            href="#"
            target="_blank"
            class="w-10 h-10 flex items-center justify-center rounded-full bg-green-light text-white hover:scale-110 transition"
          >
            <LiaGithub class="text-xl" />
          </a>
        </div>
      </div>
    </div>

    <!-- Bottom -->
    <div class="border-t border-gray-200 mt-8">
      <p class="text-center text-sm text-gray-500 py-5">
        © 2025 Nadia Putri Rahmawati. All rights reserved.
      </p>
    </div>
  </footer>
</template>
