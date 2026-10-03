<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
import logo from '@/../media/logo.png';
import SocialPart from "@/Components/Custom/SocialPart.vue";
import {route} from "../../../vendor/tightenco/ziggy";
import LanguageSwitcher from "@/Components/Custom/LanguageSwitcher.vue";

const {t} = useI18n();
const page = usePage();

const pages = ref([
    {name: t('navbar.links.who-are-we'), href: route('page.about-us', { locale: page.props.locale }, false)},
    {name: t('navbar.links.contact-us'), href: route('page.contact-us', { locale: page.props.locale }, false)},
    {name: t('navbar.links.privacy'), href: route('page.privacy-policy', { locale: page.props.locale }, false)},
    {name: t('navbar.links.payments'), href: route('page.payments', { locale: page.props.locale }, false)},
    {name: t('navbar.links.gallery'), href: route('page.gallery', { locale: page.props.locale }, false)}
]);

const menu = ref([
    {name: t('navbar.links.radio-rent'), href: route('page.radio-rent', { locale: page.props.locale }, false)},
    {name: t('navbar.links.services'), href: route('page.services', { locale: page.props.locale }, false)},
    {name: t('navbar.links.proposals'), href: route('page.proposals', { locale: page.props.locale }, false)},
    {name: t('navbar.links.jubilee-2025'), href: route('page.jubilee-2025', { locale: page.props.locale }, false)}
]);

const isScrolled = ref(false);
const sentinelRef = ref<HTMLElement | null>(null);
let observer: IntersectionObserver | null = null;

onMounted(async () => {
    await nextTick();
    if (sentinelRef.value) {
        observer = new IntersectionObserver(
            ([entry]) => {
                isScrolled.value = !entry.isIntersecting;
            },
            { threshold: 0 }
        );
        observer.observe(sentinelRef.value);
    }
});

onUnmounted(() => {
    observer?.disconnect();
    observer = null;
});

const mobileMenuOpen = ref(false);
</script>

<template>
    <div ref="sentinelRef" class="absolute top-0 left-0 w-full h-8 pointer-events-none -z-50" aria-hidden="true"></div>

    <header class="sticky top-0 z-50 bg-white border-b border-slate-200/80 shadow-xs">

        <div
            class="container mx-auto hidden sm:flex items-center justify-between px-6 transition-[padding] duration-300 ease-in-out gap-6"
            :class="isScrolled ? 'py-1' : 'py-2.5'"
        >

            <!-- LOGO -->
            <Link :href="route('page.home', { locale: page.props.locale }, false)" class="flex-shrink-0">
                <img
                    width="1536"
                    height="1024"
                    title="Logo"
                    :src="logo"
                    alt="Logo"
                    class="h-auto object-contain transition-[width] duration-300 ease-in-out"
                    :class="isScrolled ? 'w-20' : 'w-28'"
                    loading="eager"
                />
            </Link>

            <!-- CONTAINER CON DUE NAVBAR -->
            <div class="flex-1 flex flex-col items-end">
                <!-- Top links with smooth height collapse -->
                <div class="nav-collapsible" :class="{ collapsed: isScrolled }">
                    <div class="nav-collapsible-inner">
                        <nav class="flex gap-6 text-sm text-gray-600 pb-1 items-center">
                            <Link
                                v-for="link in pages"
                                :key="link.href"
                                :href="link.href"
                                :class="['hover:text-blue-600 transition-colors', link.href === page.url ? 'text-blue-700 underline' : '']"
                            >
                                {{ link.name }}
                            </Link>
                            <SocialPart container-class="space-x-3" :icon-size="1.1"/>
                            <LanguageSwitcher/>
                        </nav>
                    </div>
                </div>

                <!-- Main menu -->
                <nav class="flex gap-8 text-base font-medium">
                    <Link
                        v-for="link in menu"
                        :key="link.href"
                        :href="link.href"
                        :class="['transition-colors hover:text-blue-600', link.href === page.url ? 'text-blue-700 underline' : 'text-gray-800']"
                    >
                        {{ link.name }}
                    </Link>
                </nav>

            </div>

        </div>
        <!-- MOBILE -->
        <div
            class="sm:hidden flex items-center justify-between px-4 transition-[padding] duration-300"
            :class="isScrolled ? 'py-0.5' : 'py-1.5'"
        >
            <Link :href="route('page.home', { locale: page.props.locale }, false)">
                <img
                    width="1536"
                    height="1024"
                    title="Logo"
                    :src="logo"
                    alt="Logo"
                    class="h-auto object-contain transition-[width] duration-300"
                    :class="isScrolled ? 'w-20' : 'w-24'"
                    loading="eager"
                />
            </Link>

            <div class="flex items-center gap-1">
                <LanguageSwitcher class="flex items-center" />
                <Button
                    icon="pi pi-bars"
                    class="p-button-text p-button-rounded"
                    @click="mobileMenuOpen = true"
                    aria-label="Apri menu"
                />
            </div>
        </div>


        <Drawer v-model:visible="mobileMenuOpen" position="right" class="w-64">
            <!-- HEADER TEMPLATE -->
            <template #header>
                <div class="flex justify-between items-center w-full">
                    <Link :href="route('page.home', { locale: page.props.locale }, false)">
                        <img width="1536" height="1024" title="Logo" :src="logo" alt="Logo" class="h-auto w-24 object-contain" loading="eager"/>
                    </Link>
                </div>
            </template>
            <hr/>

            <!-- CONTENUTO PRINCIPALE -->
            <nav class="flex flex-col space-y-4 text-lg font-medium mt-4">
                <Link
                    v-for="link in pages"
                    :key="link.href"
                    :href="link.href"
                    class="hover:text-blue-600 text-center"
                    :class="{ 'text-blue-700 underline': link.href === page.url }"
                    @click="mobileMenuOpen = false"
                >
                    {{ link.name }}
                </Link>
                <Link
                    v-for="link in menu"
                    :key="link.href"
                    :href="link.href"
                    class="hover:text-blue-600 text-center"
                    :class="{ 'text-blue-700 underline': link.href === page.url }"
                    @click="mobileMenuOpen = false"
                >
                    {{ link.name }}
                </Link>
            </nav>
            <!-- FOOTER TEMPLATE -->
            <template #footer>
                <div class="pt-6">
                    <SocialPart container-class="flex justify-center space-x-4" :icon-size="1.3"/>
                </div>
            </template>
        </Drawer>


    </header>
</template>

<style scoped>
.nav-collapsible {
    display: grid;
    grid-template-rows: 1fr;
    opacity: 1;
    transition: grid-template-rows 300ms cubic-bezier(0.4, 0, 0.2, 1),
                opacity 250ms ease-in-out;
}
.nav-collapsible.collapsed {
    grid-template-rows: 0fr;
    opacity: 0;
    pointer-events: none;
}
.nav-collapsible-inner {
    overflow: hidden;
    min-height: 0;
}
</style>
