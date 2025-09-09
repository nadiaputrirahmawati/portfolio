<script setup lang="ts">
import { LiaCertificateSolid } from "vue-icons-plus/lia";
import {
    motion,
    useScroll,
    useDomRef,
    useMotionValueEvent,
    useMotionValue,
    animate,
} from "motion-v";
import { type CSSProperties } from "vue";

import useScrollReveal from "@/composables/useScrollReveal";
const {
    element: element4,
    isVisible: visible4,
    animation: animation4,
} = useScrollReveal("animate__zoomIn", 0.50);

// Refs untuk scroll container
const containerRef = useDomRef();
const { scrollXProgress } = useScroll({ container: containerRef });
const maskImage = useScrollOverflowMask(scrollXProgress);

const left = `0%`;
const right = `100%`;
const leftInset = `20%`;
const rightInset = `80%`;
const transparent = `#0000`;
const opaque = `#000`;

function useScrollOverflowMask(scrollXProgress) {
    const maskImage = useMotionValue(
        `linear-gradient(90deg, ${opaque}, ${opaque} ${left}, ${opaque} ${rightInset}, ${transparent})`
    );

    useMotionValueEvent(scrollXProgress, "change", (value) => {
        if (value === 0) {
            animate(
                maskImage,
                `linear-gradient(90deg, ${opaque}, ${opaque} ${left}, ${opaque} ${rightInset}, ${transparent})`
            );
        } else if (value === 1) {
            animate(
                maskImage,
                `linear-gradient(90deg, ${transparent}, ${opaque} ${leftInset}, ${opaque} ${right}, ${opaque})`
            );
        } else if (
            scrollXProgress.getPrevious() === 0 ||
            scrollXProgress.getPrevious() === 1
        ) {
            animate(
                maskImage,
                `linear-gradient(90deg, ${transparent}, ${opaque} ${leftInset}, ${opaque} ${rightInset}, ${transparent})`
            );
        }
    });

    return maskImage;
}

// styling tambahan
const list: CSSProperties = {
    display: "flex",
    gap: "20px",
    overflowX: "scroll",
    listStyle: "none",
    padding: "20px 0",
};

const listItem: CSSProperties = {
    flex: "0 0 260px", // tiap item fix width
};

const certificates = [
    { id: 1, image: "/project/sertif1.png" },
    { id: 2, image: "/project/sertificat.jpeg" },
    { id: 3, image: "/project/image.png" },
    // { id: 4, image: "/project/sertificat-4.jpeg" },
    // { id: 5, image: "/project/sertificat-5.jpeg" },
    // { id: 6, image: "/project/sertificat-6.jpeg" },
];
</script>

<template>
    <section class="px-4 md:px-16 lg:px-16 xl:px-44 mt-16 font-onest">
        <div class="px-10">
            <!-- Header -->
            <div class="flex space-x-4 px-6 mt-5">
                <LiaCertificateSolid class="w-7 h-7" />
                <h1 class="text-2xl font-normal">Achievements</h1>
            </div>
            <p class="text-gray-500 text-xl px-6">
                My certificates and awards.
            </p>

            <!-- Scrollable Certificates -->
            <div
                class="relative mt-6"
                ref="element4"
                :class="[
                    'transition-opacity duration-700',
                    visible4
                        ? `animate__animated ${animation4} opacity-100`
                        : 'opacity-0',
                ]"
            >
                <motion.ul
                    ref="containerRef"
                    :style="{ ...list, maskImage }"
                    class="scrollbar-hide"
                >
                    <motion.li
                        v-for="certificate in certificates"
                        :key="certificate.id"
                        :style="listItem"
                        :whileHover="{ scale: 1.05 }"
                        :whileTap="{ scale: 0.95 }"
                        class="rounded-3xl shadow-lg overflow-hidden"
                    >
                        <img
                            :src="certificate.image"
                            alt="Certificate"
                            class="w-full h-full object-cover"
                        />
                    </motion.li>
                </motion.ul>
            </div>
        </div>
    </section>
</template>


<style>
/* sembunyikan scrollbar */
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
