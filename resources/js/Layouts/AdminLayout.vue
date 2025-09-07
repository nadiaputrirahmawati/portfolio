<script setup>
import Navbar from '@/Assets/Navbar.vue'
</script>

<template>
  <div class="min-h-screen flex flex-col bg-primary">
    <!-- Navbar -->
    <Navbar />

    <!-- Konten Halaman -->
    <main class="flex-1 p-6">
      <slot />
    </main>
  </div>
</template>
