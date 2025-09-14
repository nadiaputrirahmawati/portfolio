<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0"
    >
        <div
            class="w-full overflow-hidden bg-hero px-6 py-4 shadow-md sm:max-w-md sm:rounded-3xl"
        >
            <div class="flex justify-center">
                <Link href="/">
                    <ApplicationLogo
                        class="h-48 w-48 fill-current text-gray-500"
                    />
                </Link>
            </div>
            <slot />
        </div>
    </div>
</template>
