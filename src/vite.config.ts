import { defineConfig, loadEnv } from 'vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
import tailwindcss from "@tailwindcss/vite";
import Components from 'unplugin-vue-components/vite';
import {PrimeVueResolver} from '@primevue/auto-import-resolver';
import { imagetools } from 'vite-imagetools'
import AutoImport from 'unplugin-auto-import/vite'
interface Params {
    mode: string
}

// noinspection JSUnusedGlobalSymbols
export default ({ mode }: Params) => {
    process.env = { ...process.env, ...loadEnv(mode, process.cwd()) }

    return defineConfig({
        plugins: [
            AutoImport({ /* options */ }),
            laravel({
                input: ['./resources/ts/app.ts', './resources/css/app.css'],
                ssr: './resources/ts/ssr.ts',
                refresh: true,
            }),
            imagetools({
                defaultDirectives: () => {
                    return new URLSearchParams({
                        format: 'webp',
                        quality: '40',
                    })
                },
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
            tailwindcss(),
            Components({
                resolvers: [
                    PrimeVueResolver()
                ]
            }),
        ],
        resolve: {
            alias: {
                '@': '/resources/ts',
                '~': '/resources',
                '£': '/public/'
            },
        },
        server: {
            host: '0.0.0.0',
            port: parseInt(process.env.VITE_PORT ?? '3100'),
            hmr: {
                host: process.env.VITE_EXTERNAL_HOST,
            },
        },
    })
}
