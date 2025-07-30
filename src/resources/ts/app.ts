import './bootstrap.ts';
import '../css/app.css';
import 'primeicons/primeicons.css'
import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from "../../vendor/tightenco/ziggy";
import PrimeVue from 'primevue/config';
import Material from '@primeuix/themes/material';
import ToastService from 'primevue/toastservice';
import AnimateOnScroll from 'primevue/animateonscroll';
import {createI18n} from "vue-i18n";
import {languages, locale, fallbackLocale} from '~/lang/lang.ts'
import { definePreset } from '@primeuix/themes';
import MasonryWall from '@yeger/vue-masonry-wall'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const messages = Object.assign(languages);

const MyPreset = definePreset(Material, {
    semantic: {
        primary: {
            50: '{blue.800}',
            100: '{blue.800}',
            200: '{blue.800}',
            300: '{blue.800}',
            400: '{blue.800}',
            500: '{blue.800}',
            600: '{blue.800}',
            700: '{blue.800}',
            800: '{blue.800}',
            900: '{blue.800}',
            950: '{blue.800}'
        }
    }
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        const i18n = createI18n({
            globalInjection: true,
            locale: locale,
            fallbackLocale: fallbackLocale,
            formatFallbackMessages: true,
            messages: messages,
            legacy: false,
        })
        return createApp({render: () => h(App, props)})
            .directive('animateonscroll', AnimateOnScroll)
            .use(plugin)
            .use(ZiggyVue)
            .use(MasonryWall)
            .use(PrimeVue, {
                theme: {
                    preset: MyPreset,
                    options: {
                        darkModeSelector: false,
                    }
                },
            })
            .use(ToastService)
            .use(i18n)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
}).then();
