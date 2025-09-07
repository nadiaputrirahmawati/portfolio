<template>
  <aside class="w-64 bg-gray-900 text-white h-screen p-4">
    <nav class="space-y-2">
      <Link
        href="/dashboard"
        class="block px-3 py-2 rounded hover:bg-gray-700"
        :class="{ 'bg-gray-700': isActive('Dashboard') }"
      >
        Dashboard
      </Link>

      <Link
        href="/users"
        class="block px-3 py-2 rounded hover:bg-gray-700"
        :class="{ 'bg-gray-700': isActive('Users') }"
      >
        Users
      </Link>

      <Link
        href="/settings"
        class="block px-3 py-2 rounded hover:bg-gray-700"
        :class="{ 'bg-gray-700': isActive('Settings') }"
      >
        Settings
      </Link>
    </nav>
  </aside>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();

// Cek component aktif
const isActive = (name) => {
  return page.component.includes(name);
};
</script>
