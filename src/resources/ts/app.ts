import './bootstrap.ts';
import '../css/app.css';
import 'primeicons/primeicons.css'
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import PrimeVue from 'primevue/config';
import Material from '@primeuix/themes/material';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue, {
                theme: {
                    preset: Material
                },
                options: {
                    //TODO
                    darkModeSelector: false || 'none',
                    cssLayer: {
                        name: 'primevue',
                        // Enable PrimeVue CSS layer and configure the tailwind styles to have higher specificity with layering
                        order: 'tailwind-base, primevue, tailwind-utilities',
                    },
                },

            })
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
}).then();
