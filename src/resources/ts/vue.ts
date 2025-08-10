import 'primeicons/primeicons.css'
import './bootstrap.ts';
import '../css/app.css';
import {createApp, h} from 'vue';
import {ZiggyVue} from "../../vendor/tightenco/ziggy";
import PrimeVue from 'primevue/config';
import Material from '@primeuix/themes/material';
import ToastService from 'primevue/toastservice';
import AnimateOnScroll from 'primevue/animateonscroll';
import { definePreset } from '@primeuix/themes';
import MasonryWall from '@yeger/vue-masonry-wall'

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
export function createVueAppInstance(App, props, plugin){
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
}
