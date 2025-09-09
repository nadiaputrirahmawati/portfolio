import "../css/app.css";
import "../css/hero.css";
import "../css/skill.css";
import "../css/contact.css";
import "../css/footer.css";
import "./bootstrap";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import PrimeVue from "primevue/config";
import 'animate.css';
// import 'primeicons/primeicons.css';
import Aura from "@primeuix/themes/aura"; // Tema default

// ✅ Fonts
import "@fontsource/playfair-display";
import "@fontsource/sora/300.css";
import "@fontsource/sora/400.css";
import "@fontsource/sora/500.css";
import "@fontsource/sora/600.css";
import "@fontsource/sora/700.css";

import "@fontsource/onest/300.css";
import "@fontsource/onest/400.css";
import "@fontsource/onest/500.css";
import "@fontsource/onest/600.css";
import "@fontsource/onest/700.css";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) });

        // ✅ Register Plugin
        vueApp
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue, {
                // Default theme configuration
                theme: {
                    preset: Aura,
                    options: {
                        prefix: "p",
                        darkModeSelector: "light",
                        cssLayer: false,
                    },
                },
            })
            .mount(el);

        // ✅ (opsional) register global komponen PrimeVue biar nggak import manual
        // import Button from 'primevue/button';
        // import InputText from 'primevue/inputtext';
        // vueApp.component('Button', Button);
        // vueApp.component('InputText', InputText);

        return vueApp;
    },
    progress: {
        color: "#4B5563",
    },
});
