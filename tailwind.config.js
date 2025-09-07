import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],
    safelist: [
        // === Auto-generated Tailwind color classes ===

        // Background colors
        ...[
            "slate",
            "gray",
            "zinc",
            "neutral",
            "stone",
            "red",
            "orange",
            "amber",
            "yellow",
            "lime",
            "green",
            "emerald",
            "teal",
            "cyan",
            "sky",
            "blue",
            "indigo",
            "violet",
            "purple",
            "fuchsia",
            "pink",
            "rose",
        ].flatMap((color) =>
            [50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 950].map(
                (shade) => `bg-${color}-${shade}`
            )
        ),

        // Text colors
        ...[
            "slate",
            "gray",
            "zinc",
            "neutral",
            "stone",
            "red",
            "orange",
            "amber",
            "yellow",
            "lime",
            "green",
            "emerald",
            "teal",
            "cyan",
            "sky",
            "blue",
            "indigo",
            "violet",
            "purple",
            "fuchsia",
            "pink",
            "rose",
        ].flatMap((color) =>
            [50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 950].map(
                (shade) => `text-${color}-${shade}`
            )
        ),

        // Optional common text classes
        "text-white",
        "text-black",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree"],
                onest: ["Onest", ...defaultTheme.fontFamily.sans],
                playfair: ["Playfair Display", "serif"],
                sora: ["Sora", "sans-serif"],
            },
        },
    },

    plugins: [forms],
};
