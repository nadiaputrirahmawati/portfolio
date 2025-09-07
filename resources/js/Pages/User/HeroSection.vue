<script setup>
import { ArrowUpRight, CodeXml, Layers, Vibrate } from "lucide-vue-next";
import { Fa6Css3Alt, Fa6Html5, Fa6Js, Fa6Php, Fa6Vuejs } from "vue-icons-plus/fa6";
import { LiaLaravel, LiaReact } from "vue-icons-plus/lia";
</script>

<template>
  <section
    class="flex flex-col-reverse md:flex-row items-center justify-between bg-hero px-4 md:px-16 lg:px-16 xl:px-44 hero-box"
  >
    <!-- Left Content (Text) -->
    <div class="text-center md:text-left max-w-xl mt-3 sm:mt-0 md:mt-10 xl:mt-32">
      <h3
        class="text-2xl md:text-3xl xl:text-3xl uppercase font-semibold text-gray-800 "
      >
        Hello !
      </h3>
      <h1
        class="text-3xl md:text-5xl xl:text-6xl  mt-2 tracking-normal font-playfair"
      >
        I’M <span class="text-green-light font-playfair">NADIA,</span><br />
        <span class="font-playfair leading-normal">FULL STACK WEB </span>
        <span class="font-playfair">DEVELOPER</span>
      </h1>
      <p
        class="text-gray-600 mt-4 text-sm md:text-base leading-normal font-light tracking-wide"
      >
        I am a web developer who has a strong desire to learn <br
          class="hidden md:block"
        />
        and grow in the digital world, building the web one line <br
          class="hidden md:block"
        />
        of code at a time.
      </p>
      <div class="flex items-center justify-center md:justify-start space-x-4 mb-10">
        <a
          href="#projects"
          class="inline-flex items-center gap-2 bg-green-light text-white px-5 py-5 rounded-full font-semibold mt-4 shadow hover:bg-green transition"
        >
          <ArrowUpRight class="w-5 h-5" />
        </a>
        <h1 class="mt-7 tracking-wider mb-5">View My Resume</h1>
      </div>
    </div>

    <!-- Right Content (Image + Icons) -->
    <div class="relative mt-32 sm:mt-0 md:mt-32 flex justify-center">
      <img
        src="/image/image-hero.png"
        alt="Profile"
        class="w-64 h-64 md:w-96 md:h-96 xl:w-[39rem] xl:h-auto object-contain z-10"
      />

      <!-- Floating Icons -->
      <div
        class="absolute -top-12 left-14 md:-top-14 md:left-32 xl:-top-16 xl:left-52 bg-red-100 rounded-full p-4 shadow"
      >
        <LiaLaravel class="w-6 h-6 text-red-600" />
      </div>
      <div
        class="absolute -top-14 left-44 md:-top-4 md:left-80 xl:-top-10 xl:left-[30rem] bg-purple-100 rounded-full p-4 shadow"
      >
        <Fa6Php class="w-6 h-6 text-purple-600" />
      </div>
      <div
        class="absolute top-6 -left-8 md:top-10 md:-left-14 xl:top-20 xl:-left-14 bg-blue-100 rounded-full p-4 shadow"
      >
        <Fa6Css3Alt class="w-6 h-6 text-blue-600" />
      </div>
      <div
        class="absolute top-12 -right-14 md:top-32 md:-right-16 xl:top-28 bg-orange-100 rounded-full p-4 shadow"
      >
        <Fa6Html5 class="w-6 h-6 text-orange-600" />
      </div>
      <div
        class="absolute bottom-2 -left-4 md:bottom-36 md:-left-20 xl:bottom-72 xl:-left-28 bg-green-100 rounded-full p-4 shadow"
      >
        <Fa6Vuejs class="w-6 h-6 text-green-600" />
      </div>
      <div
        class="absolute bottom-20 -left-14 md:bottom-10 md:-left-6 xl:bottom-28 xl:-left-8 bg-yellow-100 rounded-full p-4 shadow"
      >
        <Fa6Js class="w-6 h-6 text-yellow-600" />
      </div>
      <div
        class="absolute bottom-10 left-[95%] md:bottom-16 md:left-[90%] xl:bottom-48 xl:left-[96%] bg-cyan-200 rounded-full p-4 shadow"
      >
        <LiaReact class="w-6 h-6 text-cyan-500" />
      </div>
    </div>
  </section>
</template>
