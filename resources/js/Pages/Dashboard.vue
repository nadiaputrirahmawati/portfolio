<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';


</script>

<template>
  <AdminLayout>
    <h1 class="text-2xl font-bold mb-4">My Profile</h1>
    <div class="grid grid-cols-12 gap-6">
      <!-- Profile Card -->
      <div class="col-span-12 md:col-span-4 bg-white p-4 rounded-xl shadow">
        <div class="flex items-center gap-4">
          <img
            src="https://randomuser.me/api/portraits/men/75.jpg"
            class="w-16 h-16 rounded-full"
          />
          <div>
            <h2 class="font-semibold text-lg">Robert Smith</h2>
            <p class="text-sm text-gray-500">Product Designer</p>
          </div>
        </div>
      </div>

      <!-- Ongoing Projects -->
      <div class="col-span-12 md:col-span-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-yellow-100 p-4 rounded-xl shadow">
          <h3 class="font-bold">Web Designing</h3>
          <p class="text-sm text-gray-600">Prototyping</p>
          <div class="mt-2 text-xs">Progress: 50%</div>
        </div>

        <div class="bg-blue-100 p-4 rounded-xl shadow">
          <h3 class="font-bold">Mobile App</h3>
          <p class="text-sm text-gray-600">Design</p>
          <div class="mt-2 text-xs">Progress: 80%</div>
        </div>

        <div class="bg-red-100 p-4 rounded-xl shadow">
          <h3 class="font-bold">Dashboard</h3>
          <p class="text-sm text-gray-600">Wireframe</p>
          <div class="mt-2 text-xs">Progress: 70%</div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
