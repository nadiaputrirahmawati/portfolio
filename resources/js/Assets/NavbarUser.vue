<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { Menu, X } from "lucide-vue-next";

const isOpen = ref(false);
const activeSection = ref("home");

const scrollTo = (id) => {
  const section = document.getElementById(id);
  if (section) {
    section.scrollIntoView({ behavior: "smooth" });
    activeSection.value = id;
    isOpen.value = false;
  }
};

// auto update active section saat scroll
const handleScroll = () => {
  const sections = ["home", "about", "projects", "contact"];
  for (const id of sections) {
    const el = document.getElementById(id);
    if (el) {
      const rect = el.getBoundingClientRect();
      if (rect.top <= 100 && rect.bottom >= 100) {
        activeSection.value = id;
        break;
      }
    }
  }
};

onMounted(() => window.addEventListener("scroll", handleScroll));
onUnmounted(() => window.removeEventListener("scroll", handleScroll));
</script>

<template>
  <nav class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 px-6 w-full md:w-[45%] lg:w-[45%] xl:w-[30%] max-w-4xl">
    <div
      class="bg-white rounded-full shadow-md px-4 py-2 flex items-center justify-between md:justify-center"
    >
      <!-- Mobile Branding -->
      <span class="md:hidden font-bold text-green-light tracking-wide text-sm">
        Story Nad
      </span>

      <!-- Desktop Menu -->
      <ul class="hidden md:flex space-x-6 font-medium text-gray-700">
        <li>
          <button
            @click="scrollTo('home')"
            :class="[
              'px-4 py-2 rounded-full transition tracking-wider',
              activeSection === 'home'
                ? 'bg-green-light text-white'
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
              'px-4 py-2 rounded-full transition tracking-wider',
              activeSection === 'about'
               ? 'bg-green-light text-white'
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
              'px-4 py-2 rounded-full transition tracking-wider',
              activeSection === 'projects'
               ? 'bg-green-light text-white'
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
              'px-4 py-2 rounded-full transition tracking-wider',
              activeSection === 'contact'
               ? 'bg-green-light text-white'
                : 'hover:text-green-light'
            ]"
          >
            Contact
          </button>
        </li>
      </ul>

      <!-- Mobile Menu Button -->
      <button @click="isOpen = !isOpen" class="md:hidden">
        <Menu v-if="!isOpen" class="w-6 h-6 text-gray-700" />
        <X v-else class="w-6 h-6 text-gray-700" />
      </button>
    </div>

    <!-- Mobile Menu -->
    <div
      v-if="isOpen"
      class="md:hidden bg-white rounded-xl shadow-lg mt-2 px-4 py-3 space-y-3 text-center"
    >
      <button
        @click="scrollTo('home')"
        :class="[
          'block w-full rounded-full py-2',
          activeSection === 'home'
             ? 'bg-green-light text-white'
                : 'hover:text-green-light'
        ]"
      >
        Home
      </button>
      <button
        @click="scrollTo('about')"
        :class="[
          'block w-full rounded-full py-2',
          activeSection === 'about'
             ? 'bg-green-light text-white'
                : 'hover:text-green-light'
        ]"
      >
        About
      </button>
      <button
        @click="scrollTo('projects')"
        :class="[
          'block w-full rounded-full py-2',
          activeSection === 'projects'
             ? 'bg-green-light text-white'
                : 'hover:text-green-light'
        ]"
      >
        Projects
      </button>
      <button
        @click="scrollTo('contact')"
        :class="[
          'block w-full rounded-full py-2',
          activeSection === 'contact'
             ? 'bg-green-light text-white'
                : 'hover:text-green-light'
        ]"
      >
        Contact
      </button>
    </div>
  </nav>
</template>
