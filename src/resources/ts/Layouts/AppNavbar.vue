<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
import logo from '@/../media/logo.png';
import SocialPart from "@/Components/Custom/SocialPart.vue";
import {route} from "../../../vendor/tightenco/ziggy";

const {t} = useI18n();
const page = usePage();

const pages = ref([
    {name: t('navbar.links.who-are-we'), href: route('page.about-us', undefined, false)},
    {name: t('navbar.links.contact-us'), href: route('page.contact-us', undefined, false)},
    {name: t('navbar.links.privacy'), href: route('page.privacy', undefined, false)},
    {name: t('navbar.links.payments'), href: route('page.payments', undefined, false)}
]);

const menu = ref([
    {name: t('navbar.links.radio-rent'), href: route('page.radio-rent', undefined, false)},
    {name: t('navbar.links.services'), href: route('page.services', undefined, false)},
    {name: t('navbar.links.proposals'), href: route('page.proposals', undefined, false)},
    {name: t('navbar.links.jubilee-2025'), href: route('page.jubilee', undefined, false)}
]);

const scrollY = ref(0);

onMounted(() => {
    window.addEventListener('scroll', () => {
        scrollY.value = window.scrollY;
    });
});

const pagesVisible = computed(() => scrollY.value < 10);
const mobileMenuOpen = ref(false);
</script>

<template>
    <!--TODO sottomenu coi servizi e mobile view-->
    <header class="sticky top-0 z-50 bg-white shadow">
        <div class="container mx-auto hidden sm:flex items-center justify-between px-6 py-2 gap-6">

            <!-- LOGO -->
            <Link :href="route('page.home',undefined, false)" class="flex-shrink-0">
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
                            :class="['hover:text-blue-600 transition-colors', link.href === page.url ? 'text-blue-700 underline' : '']"
                        >
                            {{ link.name }}
                        </Link>
                        <SocialPart container-class="space-x-3" :icon-size="1.1"/>
                    </nav>
                </Transition>

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
        <div class="sm:hidden flex items-center justify-between px-4 py-2">
            <Link :href="route('page.home', undefined, false)">
                <img :src="logo" alt="Logo" class="h-auto w-24 object-contain" loading="eager"/>
            </Link>
            <Button
                icon="pi pi-bars"
                class="p-button-text p-button-rounded"
                @click="mobileMenuOpen = true"
                aria-label="Apri menu"
            />
        </div>

        <Drawer v-model:visible="mobileMenuOpen" position="right" class="w-64">
            <!-- HEADER TEMPLATE -->
            <template #header>
                <div class="flex justify-between items-center w-full">
                    <Link :href="route('page.home', undefined, false)">
                        <img :src="logo" alt="Logo" class="h-auto w-24 object-contain"/>
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
                    class="hover:text-blue-600 text-gray-800 transition-colors text-center"
                    :class="{ 'text-blue-700 underline': link.href === page.url }"
                    @click="mobileMenuOpen = false"
                >
                    {{ link.name }}
                </Link>
                <Link
                    v-for="link in menu"
                    :key="link.href"
                    :href="link.href"
                    class="hover:text-blue-600 text-gray-800 transition-colors text-center"
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

</style>
