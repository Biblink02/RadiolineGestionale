import './bootstrap.ts';
import '../css/app.css';
import 'primeicons/primeicons.css'
import { createInertiaApp, router } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createVueAppInstance } from "@/vue";
import {createI18nInstance, getLocaleFromUrl, setLanguage} from "~/lang/lang";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),

    async setup({el, App, props, plugin}) {
        const locale = props.initialPage.props.locale ?? 'en'
        const fallbackLocale = props.initialPage.props.fallbackLocale ?? 'en'

        const i18n = await createI18nInstance(locale, fallbackLocale)

        const vueApp = createVueAppInstance(App, props, plugin).use(i18n)

        router.on('navigate', async () => {
            const newLocale = getLocaleFromUrl()
            await setLanguage(i18n, newLocale)
        })

        return vueApp.mount(el)
    },
    progress: {
        color: '#4B5563',
    },
}).then()
