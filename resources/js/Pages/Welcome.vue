<script setup>
import { ref, onMounted } from "vue";

import NavbarUuser from "@/Assets/NavbarUser.vue";
import HeroSection from "./User/HeroSection.vue";
import About from "./User/About.vue";
import Skill from "./User/Skill.vue";
import Sertifikat from "./User/Sertifikat.vue";
import Project from "./User/Project.vue";
import Contact from "./User/Contact.vue";
import Footer from "@/Assets/Footer.vue";


// Loader hanya saat awal buka
const loading = ref(true);

onMounted(() => {
    // Simulasi waktu load, bisa diganti dengan event lain (seperti gambar selesai dimuat)
    setTimeout(() => {
        loading.value = false;
    }, 1500); // 1.5 detik, sesuaikan sesuai kebutuhan
});

const props = defineProps({
  project: {
    type: Array,
    required: true,
  },
  sertif: {
    type: Array,
    required: true,
  },
})


</script>

<template>
    <div>
        <!-- Loader -->
        <div
            v-if="loading"
            class="fixed inset-0 bg-white flex items-center justify-center z-50"
        >
            <div class="loader"></div>
        </div>

        <!-- Konten utama hanya muncul setelah loader selesai -->
        <div v-if="!loading">
            <NavbarUuser />

            <section id="home">
                <HeroSection />
            </section>

            <section id="about">
                <About />
            </section>

            <section>
                <Skill />
            </section>

            <section>
                <Sertifikat />
            </section>

            <section id="projects">
                <Project :project="props.project" />
            </section>

            <section id="contact">
                <Contact />
            </section>

            <Footer />
        </div>
    </div>
</template>

<style>
/* HTML: <div class="loader"></div> */
.loader {
    width: 120px;
    height: 60px;
    border-radius: 200px 200px 0 0;
    -webkit-mask: repeating-radial-gradient(
        farthest-side at bottom,
        #0000 0,
        #000 1px 12%,
        #0000 calc(12% + 1px) 20%
    );
    background: radial-gradient(farthest-side at bottom, #514b82 0 95%, #0000 0)
        bottom/0% 0% no-repeat #ddd;
    animation: l10 2s infinite steps(6);
}
@keyframes l10 {
    100% {
        background-size: 120% 120%;
    }
}
</style>
