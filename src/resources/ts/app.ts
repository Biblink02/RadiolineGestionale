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

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const messages = Object.assign(languages);

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
            .use(PrimeVue, {
                theme: {
                    preset: Material,
                    options: {
                        darkModeSelector: false,
                        cssLayer: {
                            name: 'primevue',
                        },
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
