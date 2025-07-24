<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
import logo from '@/../media/logo.png';

const {t} = useI18n();
const page = usePage();

const pages = ref([
    {name: t('navbar.links.who-are-we'), href: '/who-we-are'},
    {name: t('navbar.links.contact-us'), href: '/contact-us'},
    {name: t('navbar.links.privacy'), href: '/privacy-policy'},
    {name: t('navbar.links.payments'), href: '/payments'}
]);

const menu = ref([
    {name: t('navbar.links.radio-rent'), href: '/radio-rent'},
    {name: t('navbar.links.services'), href: '/services'},
    {name: t('navbar.links.proposals'), href: '/proposals'},
    {name: t('navbar.links.jubilee-2025'), href: '/jubilee-2025'}
]);

const scrollY = ref(0);

onMounted(() => {
    window.addEventListener('scroll', () => {
        scrollY.value = window.scrollY;
    });
});

const pagesVisible = computed(() => scrollY.value < 10);

</script>

<template>
    <header class="sticky top-0 z-50 bg-white shadow">
        <div class="container mx-auto hidden sm:flex items-center justify-between px-6 py-2 gap-6">

            <!-- LOGO -->
            <Link href="/" class="flex-shrink-0">
                <img :src="logo" alt="Logo" class="h-auto w-28 object-contain" loading="eager"/>
            </Link>

            <!-- CONTAINER CON DUE NAVBAR -->
            <div class="flex-1 flex flex-col items-end">
                <!-- Top links -->
                <Transition name="fade">
                    <nav v-show="pagesVisible" class="flex gap-6 text-sm text-gray-600 pb-1">
                        <Link
                            v-for="link in pages"
                            :key="link.href"
                            :href="link.href"
                            :class="['hover:text-blue-600 transition-colors', link.href === page.url ? 'text-blue-800 underline' : '']"
                        >
                            {{ link.name }}
                        </Link>
                        <div class="space-x-3">
                            <a href="https://www.facebook.com/medjugorjeservice" target="_blank"
                               class="text-slate-500 hover:text-blue-600 transition-colors" aria-label="Facebook">
                                <span class="sr-only">Facebook</span>
                                <i class="pi pi-facebook" style="font-size: 1rem;"></i>
                            </a>
                            <a href="https://www.facebook.com/medjugorjeservice" target="_blank"
                               class="text-slate-500 hover:text-blue-600 transition-colors" aria-label="Facebook">
                                <span class="sr-only">Instagram</span>
                                <i class="pi pi-instagram" style="font-size: 1rem;"></i>
                            </a>
                        </div>
                    </nav>
                </Transition>

                <!-- Main menu -->
                <nav class="flex gap-8 text-base font-medium">
                    <Link
                        v-for="link in menu"
                        :key="link.href"
                        :href="link.href"
                        :class="['transition-colors hover:text-blue-600', link.href === page.url ? 'text-blue-800 underline' : 'text-gray-800']"
                    >
                        {{ link.name }}
                    </Link>
                </nav>

            </div>

        </div>
        <!-- MOBILE -->
        <Transition
            name="slide-left"
            enter-active-class="transition duration-300 ease-out"
            enter-from-class="opacity-0 translate-x-6"
            enter-to-class="opacity-100 translate-x-0"
            leave-active-class="transition duration-200 ease-in"
            leave-from-class="opacity-100 translate-x-0"
            leave-to-class="opacity-0 translate-x-6"
        >
            <nav
                v-show="mobileMenuOpen"
                class="sm:hidden px-6 pt-2 pb-4 absolute w-full z-50 bg-white"
                aria-label="Mobile navigation"
            >
                <hr class="text-gray-400 mx-auto"/>
                <Link
                    v-for="link in pages"
                    :key="link.href"
                    :href="link.href"
                    :class="[
        'block py-2 hover:text-blue-600 font-medium transition-colors duration-200 text-center',
        link.href === page.url ? 'text-blue-800 underline' : 'text-gray-800'
      ]"
                    @click="mobileMenuOpen = false"
                >
                    {{ link.name }}
                </Link>
            </nav>
        </Transition>

    </header>
</template>

<style scoped>

</style>
