<script setup>
import NavbarUuser from "@/Assets/NavbarUser.vue";
import HeroSection from "./User/HeroSection.vue";
import About from "./User/About.vue";
import Skill from "./User/Skill.vue";
import Sertifikat from "./User/Sertifikat.vue";
import Project from "./User/Project.vue";
import Contact from "./User/Contact.vue";
import Footer from "@/Assets/Footer.vue";
</script>

<template>
    <div>
        <NavbarUuser />

        <!-- Hero Section -->
        <section id="home">
            <HeroSection />
        </section>

        <!-- About Section -->
        <section id="about">
            <About />
        </section>

        <section>
            <Skill />
        </section>

        <section>
            <Sertifikat />
        </section>

        <!-- Projects Section -->
        <section id="projects">
            <Project />
        </section>

        <!-- Contact Section -->
        <section
            id="contact"
        >
            <Contact />
        </section>

        <Footer />
    </div>
</template>
