import './bootstrap.ts';
import '../css/app.css';
import 'primeicons/primeicons.css'
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {createVueAppInstance} from "@/vue";
import {createI18nInstance} from "~/lang/lang";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        const i18n = createI18nInstance();
        const vueApp = createVueAppInstance(App, props, plugin).use(i18n);
        document.documentElement.setAttribute('lang', i18n.global.locale.value);
        return vueApp.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
}).then();
